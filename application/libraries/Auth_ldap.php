<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * This file is part of Auth_Ldap.

    Auth_Ldap is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Auth_Ldap is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Auth_Ldap.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
/**
 * Auth_Ldap Class
 *
 * Simple LDAP Authentication library for Code Igniter.
 *
 * @package         Auth_Ldap
 * @author          Greg Wojtak <greg.wojtak@gmail.com>
 * @link            http://github.com/gwojtak/Auth_Ldap.git
 * @license         GNU Lesser General Public License (LGPL)
 * @copyright       Copyright © 2010,2011 by Greg Wojtak <greg.wojtak@gmail.com>
 * @todo            Allow for privileges in groups of groups in AD
 * @todo            Rework roles system a little bit to a "auth level" paradigm
 */
class CI_Auth_ldap extends CI_Controller{
    function __construct() {
        $this->ci =& get_instance();

        log_message('debug', 'Auth_Ldap initialization commencing...');

        // Load the session library
        $this->ci->load->library('session');

        // Load the configuration
        $this->ci->load->config('auth_ldap');

        // Load the language file
        // $this->ci->lang->load('auth_ldap');

        $this->_init();
    }


    /**
     * @access private
     * @return void
     */
    private function _init() {

        // Verify that the LDAP extension has been loaded/built-in
        // No sense continuing if we can't
        if (! function_exists('ldap_connect')) {
            show_error('LDAP functionality not present.  Either load the module ldap php module or use a php with ldap support compiled in.');
            log_message('error', 'LDAP functionality not present in php.');
        }

        $this->ldap_uri = $this->ci->config->item('ldap_uri');
        //$this->portLDAP = $this->ci->config->item('portLDAP');
        //$this->use_tls = $this->ci->config->item('use_tls');
        $this->basedn = $this->ci->config->item('basedn');
        //$this->account_ou = $this->ci->config->item('account_ou');
        $this->login_attribute  = $this->ci->config->item('login_attribute');
        //$this->use_ad = $this->ci->config->item('use_ad');
        //$this->ad_domain = $this->ci->config->item('ad_domain');
        $this->usernameldap = $this->ci->config->item('usernameldap');
        $this->passwordldap = $this->ci->config->item('passwordldap');
        //$this->proxy_user = $this->ci->config->item('proxy_user');
        //$this->proxy_pass = $this->ci->config->item('proxy_pass');
        $this->roles = $this->ci->config->item('roles');
        $this->auditlog = $this->ci->config->item('auditlog');
        $this->member_attribute = $this->ci->config->item('member_attribute');
    }

    /**
     * @access public
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login($username, $password) {
        /*
         * For now just pass this along to _authenticate.  We could do
         * something else here before hand in the future.
         */

        if (defined('LOGIN_LOCAL') && !empty('LOGIN_LOCAL')){
            if ($username == 'prueba' && $password == 'local'){
                $user_info = array('name'=>'Prueba', 'error'=>'');
                $customdata = array('username' => $username,
                    'cn' => 'prueba',
                    'role' => 'prueba',
                    'logged_in' => TRUE);
            }
            else{
                $user_info['error'] = 'Login local incorrecto';
            }

        }
        else{
            $user_info = $this->_authenticate($username,$password);
            //echo '<h1>Return autenticate</h1><pre>';
            //print_r($user_info);
            //echo '</pre>';
            /*if(empty($user_info['role'])) {
                log_message('info', $username." has no role to play.");
                //show_error($username.' succssfully authenticated, but is not allowed because the username was not found in an allowed access group.');
                return FALSE;
            }*/
            // Record the login
            if($user_info['error']==""){
                $this->_audit("Successful login: ".$user_info['cn']."(".$username.") from ".$this->ci->input->ip_address());

                $customdata = array('username' => $username,
                    'cn' => $user_info['cn'],
                    'role' => $user_info['role'],
                    'logged_in' => TRUE);
            }
        }

        if (isset($customdata)){
            $this->ci->session->set_userdata($customdata);
        }

        return $user_info;
    }

    /**
     * @access public
     * @return bool
     */
    function is_authenticated() {
        if($this->ci->session->userdata('logged_in')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * @access public
     */
    function logout() {
        // Just set logged_in to FALSE and then destroy everything for good measure
        $this->ci->session->set_userdata(array('logged_in' => FALSE));
        $this->ci->session->sess_destroy();
    }

    /**
     * @access private
     * @param string $msg
     * @return bool
     */
    private function _audit($msg){
        $date = date('d/m/Y H:i:s');
        if( ! file_put_contents($this->auditlog, $date.": ".$msg."\n",FILE_APPEND)) {
            log_message('info', 'Error opening audit log '.$this->auditlog);
            return FALSE;
        }
        return TRUE;
    }

    /**
     * @access private
     * @param string $username
     * @param string $password
     * @return array
     */
    private function _authenticate($username, $password) {
        $needed_attrs = array('dn', 'cn', $this->login_attribute);

        //*******************************************************SETEO DE OPCIONES LDAP******************* */
        ldap_set_option(NULL, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option(NULL, LDAP_OPT_REFERRALS, 0);

        ldap_set_option(NULL, LDAP_OPT_X_TLS_REQUIRE_CERT, 3); //con esta opcion se requerie el uso del CA
        ldap_set_option(NULL, LDAP_OPT_X_TLS_CACERTFILE, "C:\OpenLDAP\sysconf\CA_UnitecBlue_2048_2015_11_02.crt"); //path al CA

        //en el raiz del server (eg: C:) se debe crear una carpeta llamada OpenLDAP y una sub carpeta sysconf y ahi adentro colocar el CA
        //ademas dentro de sysconf crear un archivo ldap.conf con lo siguiente:
        //  TLS_REQCERT allow
        //  TLS_CACERT c:\OpenLDAP\sysconf\CA_UnitecBlue_2048_2015_11_02.crt (aqui colocar la ruta al CA)

        if($this->ldapconn = ldap_connect($this->ldap_uri)) { //se intenta la primera conexión al server LDAP via la url detallada en el archivo de configuración Auth_ldap (dentro de aplication/conf)
            $this->_audit('Conectado a : '.$this->ldap_uri);

            // We've connected, now we can attempt the login...
            $this->_audit('binding...');
           $bind = ldap_bind($this->ldapconn,$this->usernameldap,$this->passwordldap); //una vez que nos conectamos intentamos un bind con el user y password proporcinados
            //si este bind falla es porque hay un problema con los datos de autenticación (user y pass) o bien con el protocolo de conexión al servidor (eg: ldaps)
            if(!$bind){
                $cn = "";
                $dn = "";
                $id = "";
                $role = "";
                $role ="";
                $error = "Imposible autentificar al servidor";
                $this->_audit('error, Unable to perform anonymous');
                return array('cn' => $cn, 'dn' => $dn, 'id' => $id,
                    'role' => $role ,'error'=>$error); //este metodo devuelve este array con los distintos datos que se esten obteniendo
            }
            $this->_audit('debug, Successfully bound to directory.  Performing dn lookup for '.$username);

            $filter = '('.$this->login_attribute.'='.$username.')';
            $search = ldap_search($this->ldapconn, $this->basedn, $filter, array('dn', $this->login_attribute, 'cn', 'memberof'));
            $entries = ldap_get_entries($this->ldapconn, $search);

            //una vez que el bind anterior fue un exito, armamos la busqueda con para el usuario que se esta logueando y los datos del archivo config
            //con la variable $search armada buscamos que entrada coincide y las guardamos en $entries. Si esto esta vacio es que no se encontro usuario con el username provisto
            if ($entries['count']==0){
                $cn = "";
                $dn = "";
                $id = "";
                $role = "";
                $role ="";
                $error = "Credenciales invalidas";
                $this->_audit('Registro no encontrado');
            }else{//si se consiguio encontrar coicidencia con el username, buscamos en particular el parametro para autenticar con el password ingresado y realizamos un nuevo bind
                $binddn = $entries[0]['cn'][0];
                // foreach ($entries[0] as $key => $value){
                //   echo '<br /> ======== <br />';
                //   var_dump($key, '===>', $value);
                // }
                $bind = @ldap_bind($this->ldapconn, $binddn, $password);
                if(! $bind) {
                    $error = "Credenciales invalidas";
                    $this->_audit("Failed login attempt: ".$username." from ".$_SERVER['REMOTE_ADDR']);
                }else{
                  $checkGroup = FALSE;
                  if (isset($entries[0]['memberof']) && !empty($cantidadGrupos = $entries[0]['memberof']['count'])){
                    for ($i = 0; $i<$cantidadGrupos; $i++){
                      if (strpos(strtolower($entries[0]['memberof'][$i]), 'cn=cotizaciones')!==FALSE){
                        $checkGroup = TRUE;
                      }
                    }
                  }

                }

                if (isset($checkGroup) && $checkGroup === FALSE){
                  $cn = "";
                  $dn = "";
                  $id = "";
                  $role = "";
                  $role ="";
                  $error = "Usuario no autorizado";
                  $this->_audit('Usuario no autorizado');
                }
                else{
                  $cn = $entries[0]['cn'][0];
                  $dn = stripslashes($entries[0]['dn']);
                  $id = $entries[0][$this->login_attribute][0];
                  $role = 'user'; //TODO: realizar manejo de roles
                  //en este punto el usuario se encontro y puede o no estar autenticado dependiendo del contenido de la variable $error
                }

            }


        }else { //en este else se entra si la primer conexión al servidor falla
            $cn = "";
            $dn = "";
            $id = "";
            $role = "";
            $role ="";
            $error = "Error en la conexión al servidor.";
            $this->_audit('Error en la conexión al servidor.');
        }

        $return = array('cn' => $cn, 'dn' => $dn, 'id' => $id,
        'role' => $role ,'error'=>isset($error)?$error:NULL, 'binddn'=>isset($binddn)?$binddn:NULL);
        // var_dump($return); exit;
        return $return;

    }

    /**
     * @access private
     * @param string $str
     * @param bool $for_dn
     * @return string
     */
    private function ldap_escape($str, $for_dn = false) {
        /**
         * This function courtesy of douglass_davis at earthlink dot net
         * Posted in comments at
         * http://php.net/manual/en/function.ldap-search.php on 2009/04/08
         */
        // see:
        // RFC2254
        // http://msdn.microsoft.com/en-us/library/ms675768(VS.85).aspx
        // http://www-03.ibm.com/systems/i/software/ldap/underdn.html

        if  ($for_dn)
            $metaChars = array(',','=', '+', '<','>',';', '\\', '"', '#');
        else
            $metaChars = array('*', '(', ')', '\\', chr(0));

        $quotedMetaChars = array();
        foreach ($metaChars as $key => $value) $quotedMetaChars[$key] = '\\'.str_pad(dechex(ord($value)), 2, '0');
        $str=str_replace($metaChars,$quotedMetaChars,$str); //replace them
        return ($str);
    }

    /**
     * @access private
     * @param string $username
     * @return int
     */
    private function _get_role($username) {
        //echo $username;
        $filter = '('.$this->member_attribute.'='.$username.')';
        $search = ldap_search($this->ldapconn, $this->basedn, $filter, array('cn'));
        if(! $search ) {
            $this->_audit('error', "Error searching for group:".ldap_error($this->ldapconn));
            //show_error('Couldn\'t find groups: '.ldap_error($this->ldapconn));
        }
        $results = ldap_get_entries($this->ldapconn, $search);
        /*echo '<h1>Resultado de roles</h1><pre>';
        print_r($results);
        echo '</pre>';*/
        if($results['count'] != 0) {
            for($i = 0; $i < $results['count']; $i++) {
                $role = array_search($results[$i]['cn'][0], $this->roles);
                echo $role;
                if($role !== FALSE) {

                    return $role;
                }
            }
        }
        $role = 'user'; //TODO: se harcodea el role para una posterior utilización
        return $role;
    }
}

?>

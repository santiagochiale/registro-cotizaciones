<?php 

class ConnLDAP extends CI_Controller {
    function __construct() {
        parent::__construct();

         //Carga de helpers de CI
        $this->load->helper("url"); //este helper se carga para poder usar el base_url()
        // Load the configuration
        $this->load->config('auth_ldap');

    }

    public function index(){


        $this->ldap_uri = $this->config->item('ldap_uri');
        $this->ldap_port = $this->config->item('ldap_port');
        $this->use_tls = $this->config->item('use_tls');
        $this->basedn = $this->config->item('basedn');
        $this->customdn = $this->config->item('customdn');
        $this->account_ou = $this->config->item('account_ou');
        $this->login_attribute  = $this->config->item('login_attribute');
        $this->use_ad = $this->config->item('use_ad');
        $this->ad_domain = $this->config->item('ad_domain');
        $this->usernameldap = $this->config->item('usernameldap');
        $this->passwordldap = $this->config->item('passwordldap');
        $this->proxy_user = $this->config->item('proxy_user');
        $this->proxy_pass = $this->config->item('proxy_pass');
        $this->roles = $this->config->item('roles');
        $this->auditlog = $this->config->item('auditlog');
        $this->member_attribute = $this->config->item('member_attribute');

        // La secuencia básica con LDAP es conectar, amarrar, buscar, interpretar el resultado
        // de la búsqueda, y cerrar la conexión.

        echo "<h3>Consulta de prueba LDAP</h3>";
        echo "Conectando ...";
        $ldapconn=ldap_connect($this->ldap_uri);  // Debe ser un servidor LDAP válido!
        echo "El resultado de la conexión es " . $ldapconn . "<br />";

        if ($ldapconn) { 
            ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
            ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
            echo "Vinculando ..."; 
            $ldapbind=ldap_bind($ldapconn,$this->usernameldap,$this->passwordldap);  

            if($ldapbind){
                echo "El resultado de la vinculación es " . $ldapbind . "<br />";

                $filter = '('.$this->login_attribute.'=schiale)';
                $result= ldap_search($ldapconn, $this->basedn, $filter, array('dn', $this->login_attribute, 'cn'));
                echo "El resultado de la búsqueda es " . $result . "<br />";

                echo "El número de entradas devueltas es " . ldap_count_entries($ldapconn, $result) . "<br />";
                          
                $data = ldap_get_entries($ldapconn, $result); 

                // SHOW ALL DATA
                echo '<h1>Dump all data</h1><pre>';
                print_r($data);   
                echo '</pre>';

                $bindDn = $data[0]['cn'][0];
                
                echo $bindDn;
                // Now actually try to bind as the user
                
                $auth_result = ldap_bind($ldapconn, $bindDn, 'Proyecto2017');
                //echo $auth_result;
                if ($auth_result) {
                    echo "Usuario autentificado!!!";
                } else {
                    echo "Usuario incorrecto"; 
                }
                
                echo "Cerando la conexión";
                ldap_close($ldapconn);
            }  
            

        } else {
            echo "<h4>No se puede conectar al servidor LDAP</h4>";
        }
    }
}
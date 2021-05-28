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
 * @author      Greg Wojtak <greg.wojtak@gmail.com>
 * @copyright   Copyright © 2010,2011 by Greg Wojtak <greg.wojtak@gmail.com>
 * @package     Auth_Ldap
 * @subpackage  auth demo
 * @license     GNU Lesser General Public License
 */
class Auth extends CI_Controller {
    function __construct() {
        parent::__construct();

        //$this->load->helper('url');
        //$this->load->helper('form');
        //$this->load->library('Form_validation');
        //$this->load->library('Auth_ldap');
        //$this->load->library('table');
        //$this->load->library("parser");


    }

    //************************************************************METODOS DE DEBUG******************************************
    //
    //
    //
    
    function index() {
        $data['error']="";
        $this->logout($data);
    }

    function login($errorMsg = NULL){
        if(!$this->auth_ldap->is_authenticated()) {
            // Set up rules for form validation
            $rules = $this->form_validation;
            $rules->set_rules('username', 'Username', 'required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');
            $rules->set_rules('password', 'Password', 'required');

            // Do the login...
            
            $user_info = $this->auth_ldap->login($this->input->post('username'),$this->input->post('password'));
            /*echo '<h1>Return ldap_login</h1><pre>';
            echo $this->session->userdata('username');   
            echo '</pre>';*/
            if($rules->run() && $user_info['error']=="") {
                // Login WIN!
                $view["contenido"] = null;
                $view["titulo"] = "Pagina Principal";
                //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
                $this->parser->parse("app/estructura_app",$view);
                //$this->load->view("app/estructura_app");
                
            }else {
                //echo $user_info['error'];
                // Login FAIL o primera vez que nos logueamos
                $data['error'] = $user_info['error'];
                $this->logout($data);
                
                $view["contenido"] = null;
                //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
                $this->parser->parse("app/estructura_app",$view);
                

            }
        }else {
                // Already logged in...
                $view["contenido"] = null;
                $view["titulo"] = "Pagina Principal";
                //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
                $this->parser->parse("app/estructura_app",$view);

                //$this->load->view("app/estructura_app");
        }
    }

    function logout($data= NULL) {
        if($this->session->userdata('logged_in')) {
            $data['name'] = $this->session->userdata('cn');
            $data['username'] = $this->session->userdata('username');
            $data['logged_in'] = TRUE;
            $this->auth_ldap->logout();
            $data['error'] = "";
        } else {
            $data['logged_in'] = FALSE;
        }

        $view["contenido"] = $this->load->view("admin/login", $data, TRUE);
        //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
        $this->parser->parse("template/body_login",$view);
    }
}

?>

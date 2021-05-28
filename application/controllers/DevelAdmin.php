<?php


class DevelAdmin extends CI_Controller
{


  public function __construct() //este es el primer metodo que se ejecuta al cargar el controlador
  {

    parent::__construct();
    //carga de base de datos
    //$this->load->database();

    //carga de librerias de CI
    //$this->load->library("parser");
    //$this->load->library("Form_validation");
    //$this->load->library('pagination');

    //Carga de helpers de CI
    //$this->load->helper("url"); //este helper se carga para poder usar el base_url()
    //$this->load->helper("form"); //helper para manejar formularios


    //Carga de helpers propios
    $this->load->helper("hash_helper");
    $this->load->helper("date_helper");
  }

  //************************************************************************************************************************************* */
  //********************************************************METODOS DE MANEJO DE PAGINAS**************************************************/
  public function index()
  { 
      $view["contenido"] = null;
      $view["titulo"] = "Pagina Principal";
      //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
      $this->parser->parse("app/estructura_app",$view);
    
  }
}

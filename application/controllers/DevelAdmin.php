<?php


class DevelAdmin extends CI_Controller
{


  public function __construct() //este es el primer metodo que se ejecuta al cargar el controlador
  {

    parent::__construct();
    //Carga de helpers propios
    $this->load->helper("hash_helper");
    $this->load->helper("date_helper");
  }

  //************************************************************************************************************************************* */
  //********************************************************METODOS DE MANEJO DE PAGINAS**************************************************/
  public function index()
  { 
      $view["contenido"] = $this->load->view("app/content_home",NULL, TRUE);;
      $view["titulo"] = "Pagina Principal";
      //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
      $this->parser->parse("app/estructura_app",$view);
    
  }

  public function productos() {
      $view["contenido"] = $this->load->view("app/content_productos",NULL, true);
        
      $view["titulo"] = "Pagina Productos";
      //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
      $this->parser->parse("app/estructura_app",$view);
  }
}

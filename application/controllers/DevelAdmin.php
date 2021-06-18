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
    $view["contenido"] = $this->load->view("app/content_home", NULL, TRUE);;
    $view["titulo"] = "Pagina Principal";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function productos()
  {
    $view["contenido"] = $this->load->view("app/content_productos", NULL, true);

    $view["titulo"] = "Pagina Productos";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function clientes()
  {
    $view["contenido"] = $this->load->view("app/content_clientes", NULL, true);

    $view["titulo"] = "Pagina Clientes";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function empresas()
  {
    $view["contenido"] = $this->load->view("app/content_empresas", NULL, true);

    $view["titulo"] = "Pagina Empresas";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function estado_oc()
  {
    $view["contenido"] = $this->load->view("app/content_estado_oc", NULL, true);

    $view["titulo"] = "Pagina Estados OC";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function estado_cotizacion()
  {
    $view["contenido"] = $this->load->view("app/content_estado_cotizacion", NULL, true);

    $view["titulo"] = "Pagina Estados Cotización";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function estado_produccion()
  {
    $view["contenido"] = $this->load->view("app/content_estado_produccion", NULL, true);

    $view["titulo"] = "Pagina Estados Producción";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function grupos()
  {
    $view["contenido"] = $this->load->view("app/content_grupos", NULL, true);

    $view["titulo"] = "Pagina Grupos";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function impuestos()
  {
    $view["contenido"] = $this->load->view("app/content_impuestos", NULL, true);

    $view["titulo"] = "Pagina Impuestos";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function monedas()
  {
    $view["contenido"] = $this->load->view("app/content_monedas", NULL, true);

    $view["titulo"] = "Pagina Monedas";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function resumen_cotizaciones()
  {
    $view["contenido"] = $this->load->view("app/content_resumen_cotizaciones", NULL, true);

    $view["titulo"] = "Pagina Resumen Cotizaciones";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function form_cotizaciones($id=null)
  {
    $data['prueba'] = $this->crud->prueba();
    //TODO: recibe el id del registro, si es vacio no envia ningun dato para mostrar, si no envia los datos del id a editar
    //$data['prueba'] = 'prueba';
    $view["contenido"] = $this->load->view("app/content_form_cotizaciones", $data, true);
    
    $view["titulo"] = "Formulario cotizaciones";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }
  
}

<?php


class DevelAdmin extends CI_Controller
{

    private $camposObligatorios = array('id_cliente', 'numero_cotizacion', 'id_estado_coti', 'fecha_cotizacion', 'id_producto', 'cantidad', 'id_moneda_coti', 'id_moneda_pres', 'valor_dolar', 'costo');//, 'precio_unitario');

  public function __construct() //este es el primer metodo que se ejecuta al cargar el controlador
  {

    parent::__construct();
    //Carga de helpers propios
    $this->load->helper("hash_helper");
    $this->load->helper("date_helper");

    $this->load->model('ClientesModel');
    $this->load->model('EstadoCotizacionModel');
    $this->load->model('ProductosModel');
    $this->load->model('MonedasModel');
    $this->load->model('EstadoOcModel');
    $this->load->model('EmpresasModel');
    $this->load->model('EstadoProduccionModel');
    $this->load->model('RegistroCotizacionesModel');
      if(!$this->auth_ldap->is_authenticated()) {
          redirect('/Auth');
      }
  }

  //************************************************************************************************************************************* */
  //********************************************************METODOS DE MANEJO DE PAGINAS**************************************************/
  public function index(){

        //echo 'index devel admin';die();
      $data['filtros'] =!empty($this->input->post())?$this->input->post():NULL;
      $data['submit'] = !empty($this->input->post())?TRUE:FALSE;
      if (!empty($data['filtros'])){
          foreach ($data['filtros'] as $key => $value){
              if (empty($value)){
                  unset($data['filtros'][$key]);
              }
//              if (!empty($value)){
//                  $data['filtros']['rc.'.$key] = $value;
//              }
//              unset($data['filtros'][$key]);
          }
//          var_dump($data['filtros']); exit;
//          $data['filtros']['registro_cotizaciones'] = true;
//          if (!empty($data['filtros']['fecha_cotizacion'])){
//              $data['filtros']['fecha_cotizacion'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['filtros']['fecha_cotizacion'])));
//          }
//          if (!empty($data['filtros']['fecha_oc'])){
//              $data['filtros']['fecha_oc'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['filtros']['fecha_oc'])));
//          }
//          var_dump($data['filtros']); exit;
      }
      $data['clientes'] = $this->ClientesModel->getClientes();
      $data['estados_cotizacion'] = $this->EstadoCotizacionModel->getEstadosCotizacion();
      $data['productos'] = $this->ProductosModel->getProductos();
      $data['monedas'] = $this->MonedasModel->getMonedas();
      $data['estados_oc'] = $this->EstadoOcModel->getEstadosOC();
      $data['empresas'] = $this->EmpresasModel->getEmpresas();
      $data['estados_produccion'] = $this->EstadoProduccionModel->getEstadosProduccion();

      if (!empty($data['submit'])){
          $data['cantidad_cotizaciones'] = $this->RegistroCotizacionesModel->traerCantidadCotizacionesDashboard($data['filtros']);
          $data['data_dashboard'] = $this->RegistroCotizacionesModel->traerDataDashboard($data['filtros']);
      }
      $view["contenido"] = $this->load->view("app/content_home", $data, TRUE);;
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
//      var_dump($this->input->get(), $this->input->post()); exit;
    $data = array();
    $data['filtros'] =!empty($this->input->post())?$this->input->post():$this->input->get();
    if (!empty($data['filtros'])){
        foreach ($data['filtros'] as $key => $value){
            if (empty($value)){
                unset($data['filtros'][$key]);
            }
        }
        $data['filtros']['registro_cotizaciones'] = true;
//        if (!empty($data['filtros']['fecha_cotizacion'])){
//            $data['filtros']['fecha_cotizacion'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['filtros']['fecha_cotizacion'])));
//        }
//        if (!empty($data['filtros']['fecha_oc'])){
//            $data['filtros']['fecha_oc'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['filtros']['fecha_oc'])));
//        }

    }
//    var_dump($data['filtros']); exit;
      $data['clientes'] = $this->ClientesModel->getClientes();
      $data['estados_cotizacion'] = $this->EstadoCotizacionModel->getEstadosCotizacion();
      $data['productos'] = $this->ProductosModel->getProductos();
      $data['monedas'] = $this->MonedasModel->getMonedas();
      $data['estados_oc'] = $this->EstadoOcModel->getEstadosOC();
      $data['empresas'] = $this->EmpresasModel->getEmpresas();
      $data['estados_produccion'] = $this->EstadoProduccionModel->getEstadosProduccion();

      $view["contenido"] = $this->load->view("app/content_resumen_cotizaciones", $data, true);

    $view["titulo"] = "Pagina Resumen Cotizaciones";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function form_cotizaciones($id=null)
  {
     
      $incompleto = FALSE;
      if (!empty($post = $this->input->post())){
          foreach ($post as $key => $value){
              if (in_array($key, $this->camposObligatorios) && strlen($value)==0){
                  $incompleto = TRUE;
              }
          }
          if (!is_null($id)){
              $post['id_cotizacion'] = $id;
              
          }
          if ($incompleto === FALSE){
               
              $cotizacion_id = $this->RegistroCotizacionesModel->altaCotizacion($post);
              
              if (!empty($cotizacion_id)){
//              redirect('form_cotizaciones/'.$cotizacion_id);
                  redirect('DevelAdmin/resumen_cotizaciones');
              }
          }

      }
      if ($incompleto){
          $post['fecha_cotizacion'] = !empty($post['fecha_cotizacion'])?date('Y-m-d', strtotime(str_replace('/', '-', $post['fecha_cotizacion']))):'';
          $post['fecha_oc'] = !empty($post['fecha_oc'])?date('Y-m-d', strtotime(str_replace('/', '-', $post['fecha_oc']))):'';
          $data_contenido['data_cotizacion'] = $post;
//          var_dump($data_contenido['data_cotizacion']); exit;

      }
      elseif (!is_null($id)){
          $data_contenido['data_cotizacion'] = $this->RegistroCotizacionesModel->buscarCotizacion($id);
      }
      $data_contenido['incompleto'] = $incompleto;
      $data_contenido['clientes'] = $this->ClientesModel->getClientes();
      $data_contenido['estados_cotizacion'] = $this->EstadoCotizacionModel->getEstadosCotizacion();
      $data_contenido['productos'] = $this->ProductosModel->getProductos();
      $data_contenido['monedas'] = $this->MonedasModel->getMonedas();
      $data_contenido['estados_oc'] = $this->EstadoOcModel->getEstadosOC();
      $data_contenido['empresas'] = $this->EmpresasModel->getEmpresas();
      $data_contenido['estados_produccion'] = $this->EstadoProduccionModel->getEstadosProduccion();
//      var_dump($data_contenido); exit;
      $view["contenido"] = $this->load->view("app/content_form_cotizaciones", $data_contenido, true);
    
    $view["titulo"] = "Formulario cotizaciones";
    //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
    $this->parser->parse("app/estructura_app", $view);
  }

  public function delete_cotizaciones($id){
      $result = $this->RegistroCotizacionesModel->eliminarCotizacion($id);
      echo json_encode($result);
  }

  public function calcular_facturacion_costo(){
      if ($this->input->is_ajax_request() && !empty($post = $this->input->post())){
          $post = $this->RegistroCotizacionesModel->formatear_campos_formulario($post);

          $moneda_cotizacion = !empty($post['moneda_cotizacion'])?$post['moneda_cotizacion']:'$';
          $moneda_presentacion = !empty($post['moneda_presentacion'])?$post['moneda_presentacion']:'$';

          $data = $this->RegistroCotizacionesModel->calcularVariables($post);

          
          if (!empty($data['facturacion'])){
              
              $data['facturacion'] = $moneda_presentacion.' '.number_format($data['facturacion'], 2, ',', '.');
          }

          if (!empty($data['costo_total'])){
              $data['costo_total'] = $moneda_cotizacion.' '.number_format($data['costo_total'], 2, ',', '.');
          }

          if (isset($data['margen'])){
              $data['margen'] = number_format($data['margen'], 2, ',', '.').' %';
          }

          if (!empty($data['impuestos'])){
              $data['impuestos'] = $moneda_presentacion.' '.number_format($data['impuestos'], 2, ',', '.');
          }

          if (!empty($data['cmg_moneda'])){
              $data['cmg_moneda'] = $moneda_presentacion.' '.number_format($data['cmg_moneda'], 2, ',', '.');
          }

          if (!empty($data['cmg_porcentaje'])){
              $data['cmg_porcentaje'] = number_format($data['cmg_porcentaje'], 2, ',', '.').' %';
          }

          if (!empty($data['margen_sobreUB'])){
              $data['margen_sobreUB'] = number_format($data['margen_sobreUB'], 2, ',', '.');
          }

          if (!empty($data['precio_ganador'])){
              $data['precio_ganador'] = $moneda_presentacion.' '.number_format($data['precio_ganador'], 2, ',', '.');
          }

          if (!empty($data['cantidad_pendiente'])){
              $data['cantidad_pendiente'] = number_format($data['cantidad_pendiente'], 2, ',', '.');
          }



          echo json_encode($data);

      }
      else{
          show_404();
      }
  }

  public function formatear_nro(){
      if ($this->input->is_ajax_request() && !empty($post = $this->input->post())){
          $nro_formateado = number_format($post['valor'], !empty($post['cantidad_decimales'])?$post['cantidad_decimales']:0, ',','.');
          if (!empty($post['tipo']) && $post['tipo']=='money'){
              $nro_formateado = '$ '.$nro_formateado;
          }
          echo $nro_formateado;
      }
  }
  
}

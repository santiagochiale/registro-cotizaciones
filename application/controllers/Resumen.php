<?php


class Resumen extends CI_Controller
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

    //Carga de modelos
    $this->load->model("ClientesModel");
    $this->load->model('EmpresasModel');
    $this->load->model("EstadoCotizacionModel");
    $this->load->model("EstadoOcModel");
    $this->load->model("EstadoProduccionModel");
    $this->load->model("GruposModel");
    $this->load->model("MonedasModel");
    $this->load->model("ProductosModel");
    $this->load->model("RegistroCotizacionesModel");
  }
 

  //******************************************METODOS RESUMEN DE DATOS********************************************************* */

  

  public function totalizar_registro()
  {
    //TODO: redireccionar a auth si no hay sesion inicial
    //forma de envio: {"modelo":"RegistroCotizacionesModel","field":"cantidad"}
    if (!$_POST) {
      $data = array(
        'status'          => 'error',
        'code'            => 403,
        'message_error'   => 'Error en el metodo de petición',
        'data'            => ''
      );
      $dataJ = json_encode($data);
      if ($this->input->is_ajax_request()) { //si la peticion la hace un ajax, realiza un echo para poder, si no un return
        echo $dataJ;
      } else {
        echo $dataJ;
      }
      return;
    }
    $json = json_decode($_POST['json'], true);
    if (isset($json['modelo']) && !empty($json['modelo']) && isset($json['field']) && !empty($json['field'])) {
      $modelo = $json['modelo'];
      $field = $json['field'];

      if (!empty($json['filtros'])) {
        $filtros = $json['filtros'][0];
      } else {
        $filtros = array();
      }
      $respuesta['payload'] = $this->$modelo->totalize($field,$filtros); //TODO: evaluar si esta sentencia arraja error

      $data = array(
        'status'          => 'success',
        'code'            => 200,
        'message_error'   => '',
        'data'            => $respuesta['payload']
      );



      $dataJ = json_encode($data);
      if ($this->input->is_ajax_request()) { //si la peticion la hace un ajax, realiza un echo para poder, si no un return
        echo $dataJ;
      } else {
        echo $dataJ;
      }
    } else {
      $data = array(
        'status'          => 'error',
        'code'            => 400,
        'message_error'   => 'Error en el formato de la petición',
        'data'            => ''
      );
      $dataJ = json_encode($data);
      if ($this->input->is_ajax_request()) { //si la peticion la hace un ajax, realiza un echo para poder, si no un return
        echo $dataJ;
      } else {
        echo $dataJ;
      }
    }
  }

}

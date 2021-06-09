<?php


class Crud extends CI_Controller
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
  //****************************************************METODOS DE PRUEBA*****************************************************************

  //**************************************METODO PARA CARAGAR MASIVAMENTE DATOS EN LA TABLA***********************************************


  //************************************************************************************************************************************* */
  //********************************************************METODOS DE MANEJO DE PAGINAS**************************************************/
  public function index()
  { //metodo que carga la pagina principal
    if (!$this->auth_ldap->is_authenticated()) {
      redirect('auth', 'refresh');
    } else {

      $view["contenido"] = $this->load->view("admin/index", NULL, TRUE);
      $view["titulo"] = "Pagina Principal";
      //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
      $this->parser->parse("admin/template/body_admin", $view);
    }
  }


  //*************************************************************METODOS CRUD********************************************************* */

  public function guardar_registro()
  { //metodo para insertar o actualizar dispositivos
    //TODO: redireccionar a auth si no hay sesion inicial
    //forma: {"modelo":"ProductosModel","valores":[{"id":"26","descripcion_producto":"tarjetas nuevas","id_grupo":"2","cod_sap":"0000"}]}
    $id = null; //se asume id como null (si es asi es una inserción de un registro)

    //con el siguiente if se evalua si el metodo guardar_proceso recibio algun dato del formulario de la pagina o simplemente fue llamado para cargar la vista
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
    } else {
      //se reciben los datos por json 
      $json = json_decode($_POST['json'], true);

      if (isset($json['modelo']) && !empty($json['modelo']) && isset($json['valores'])) {
        $valores = $json['valores'];
        $modelo = $json['modelo'];
        if (isset($valores['id'])) {
          $id = $valores['id'];
        }
        //se establecen los datos a validar

        $this->form_validation->set_data($valores);

        //lo proximo es establecer las reglas de validación para cada campo

        $reglas = $this->$modelo->array_validacion; //se traen las reglas de validación desde el modelo
        foreach ($reglas as $regla) {
          $this->form_validation->set_rules($regla['id'], $regla['label'], $regla['parametros']);
        }

        if ($this->form_validation->run()) {
          //en este punto nuestro formulario es valido
          if ($id == null) { //se evalua si es un registro nvo o un update y se direcciona al metodo que corresponda
            //print_r($to_save);
            if ($this->$modelo->insert($valores)) { //se llama al modelo donde se especifica la tabla donde insertar los datos. Esta clase extiende de CI_Model en donde creamos los metodos del CRUD (entre ellos el insert)
              $data = array(
                'status'            => 'success',
                'code'              => 200,
                'message_error'     => '',
                'data'              => '',
                'validation_errors' => 'Registro Insertado'
              ); //TODO: agregar craeted_at
            } else {
              $data = array(
                'status'            => 'error',
                'code'              => 500,
                'message_error'     => 'Error al insertar el registro',
                'data'              => '',
                'validation_errors' => 'Error al insertar el registro'
              );
            }
          } else {
            $filtros = array(
              'id' => $valores['id']
            );
            $count = $this->$modelo->find($filtros); //se evalua si el id existe en la bd
            if (!empty($count) && $this->$modelo->update($valores, $id)) {
              $data = array(
                'status'            => 'success',
                'code'              => 200,
                'message_error'     => '',
                'data'              => '',
                'validation_errors' => 'Registro Modificado'
              );//TODO: agregar updated_at y ultimo usuario que realizo cambios
            } else {
              $data = array(
                'status'            => 'error',
                'code'              => 500,
                'message_error'     => 'Error al modificar el registro',
                'data'              => '',
                'validation_errors' => 'Error al modificar el registro'
              );
            }
          }
        } else {
          $data = array(
            'status'            => 'error',
            'code'              => 500,
            'message_error'     => 'Error de validación',
            'data'              => '',
            'validation_errors' => validation_errors()
          );
          //TODO: clasificar errores para mostrar que validación fallo
        }
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

  public function encontrar_registro()
  {
    //TODO: redireccionar a auth si no hay sesion inicial
    //forma de envio: {"modelo":"ClientesModel","filtros":[{"id":"2"}]}
    //var_dump($_POST);
    //die();

    if (!$_POST) {
      $data = array(
        'status'          => 'error',
        'code'            => 403,
        'message_error'   => 'Error en el metodo de petición no entra al if del post',
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
    $json = json_decode($_POST['json'],true);
    /*var_dump($this->input->post(null, true));
    var_dump($this->input->post(null, false));
    die();*/

    if (isset($json['modelo']) && !empty($json['modelo']) && isset($json['filtros'])) {
      $modelo = $json['modelo'];
      if (!empty($json['filtros'])) {
        $filtros = $json['filtros'];
      } else {
        $filtros = array();
      }
      $respuesta['payload'] = $this->$modelo->find($filtros); //TODO: evaluar si esta sentencia arraja error

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

  public function borrar_registro()
  {
    //TODO: redireccionar a auth si no hay sesion inicial
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
    } else {
      $json = json_decode($_POST['json'], true);
      if (isset($json['modelo']) && !empty($json['modelo']) && isset($json['filtros'])) {
        $modelo = $json['modelo'];
        $filtros = $json['filtros'];

        $filtros = array(
          'id' => $filtros['id']
        );
        //$count = $this->$modelo->find($filtros); //se evalua si el id existe en la bd

        if (!empty($this->$modelo->find($filtros))) {
          $respuesta['payload'] = $this->$modelo->delete($filtros['id']);
          $data = array(
            'status'          => 'success',
            'code'            => 200,
            'message_error'   => '',
            'data'            => $respuesta['payload']
          );
        } else {
          $data = array(
            'status'          => 'error',
            'code'            => 404,
            'message_error'   => 'El registro no existe en la BD',
            'data'            => ''
          );
        }
        //TODO: evaluar si tiene registros asociados al registro que se quiere borrar

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
}

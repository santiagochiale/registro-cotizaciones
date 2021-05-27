<?php


class Admin extends CI_Controller{


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
    $this->load->model("ProductosModel");

    //$this->db->join('ordenes', 'clientes.id=ordenes.id_cliente');
    
  }
  //****************************************************METODOS DE PRUEBA*****************************************************************

  //**************************************METODO PARA CARAGAR MASIVAMENTE DATOS EN LA TABLA***********************************************
 

  //************************************************************************************************************************************* */
  //********************************************************METODOS DE MANEJO DE PAGINAS**************************************************/
  public function index(){//metodo que carga la pagina principal
    if(!$this->auth_ldap->is_authenticated()) { 
      redirect('auth', 'refresh');
     }else{
       
      $view["contenido"] = $this->load->view("admin/index", NULL, TRUE);
      $view["titulo"] = "Pagina Principal";
      //el atributo TRUE indica que no se renderice la vista desde el load sino que lo cargue en la variable $view["contenido"] como texto
      $this->parser->parse("admin/template/body_admin",$view);
     }
  }


  //*************************************************************METODOS GENERALES********************************************************* */
  
  public function borrar($modelo=NULL,$identificador=NULL,$valor=NULL){
    if($modelo==NULL || $identificador==NULL || $valor==NULL){
      $respuesta = 'error';
    }else{
      $respuesta = $this->$modelo->delete($identificador,$valor);
    }
    echo json_encode($respuesta);
  }


  //*************************************************************METODOS PARTICULARES DE LAS PAGINAS**************************************** */
  //*******************************************************************MAQUINAS************************************************************* */
  public function encontrar_registro(){
    //TODO: redireccionar a auth si no hay sesion inicial
    if(!$_POST){
      echo "no se recibieron datos de la petición";
      return;
    }
    $json = json_decode($_POST['json'],true);
    $modelo = $json['modelo'];

    if(!empty($json['filtros'])){
      $filtros = $json['filtros'][0];
    }else{
      $filtros = array();
    }
    //forma de envio: {"modelo":"ClientesModel","filtros":[{"id":"2"}]}
    

    $data['data'] = $this->$modelo->find($filtros);
    //************************************************************************************************************************************* */
    $dataJ = json_encode($data);
    if($this->input->is_ajax_request()){ //si la peticion la hace un ajax, realiza un echo para poder, si no un return
      echo $dataJ;
    }else{
      echo $dataJ;
    }   
  }

  public function guardar_registro(){ //metodo para insertar o actualizar dispositivos
    //forma: {"id":"26","modelo":"ProductosModel","valores":[{"descripcion_producto":"tarjetas nuevas","id_grupo":"2","cod_sap":"0000"}]}
      $id=null; //se asume id como null (si es asi es una inserción de un registro)

    //con el siguiente if se evalua si el metodo guardar_proceso recibio algun dato del formulario de la pagina o simplemente fue llamado para cargar la vista
      if(!$_POST){
        echo "no se recibieron datos de la petición";
        return;                   
      }else{
        //se reciben los datos por json 
        $json = json_decode($_POST['json'],true);
        $modelo = $json['modelo'];

        if(!empty($json['valores'])){
          $valores = $json['valores'][0];
          if(isset($valores['id'])){
            $id = $valores['id']; 
          };
        }else{
          echo "No se recibieron valores para guardar en la BD";
        }
        //se establecen los datos a validar

        $this->form_validation->set_data($valores);

        //lo proximo es establecer las reglas de validación para cada campo

        $reglas = $this->$modelo->array_validacion; //se traen las reglas de validación desde el modelo
        foreach ( $reglas as $regla) {
          $this->form_validation->set_rules($regla['id'],$regla['label'],$regla['parametros']);
        }

        if($this->form_validation->run()){
          //en este punto nuestro formulario es valido
          if($id==null){ //se evalua si es un registro nvo o un update y se direcciona al metodo que corresponda
            //print_r($to_save);
            $this->$modelo->insert($valores);//se llama al modelo donde se especifica la tabla donde insertar los datos. Esta clase extiende de CI_Model en donde creamos los metodos del CRUD (entre ellos el insert)
            $data['validation_errors'] = "registroInsertado";
          }else{
            $this->$modelo->update($valores,$id);
            $data['validation_errors'] = "registroModificado";
          }
          
        }else{
          $data['validation_errors'] = validation_errors();
          //TODO: clasificar errores para mostrar que validación fallo
        }
      }
      //$data['data'] = $this->$modelo->find($filtros);
      //************************************************************************************************************************************* */
      $dataJ = json_encode($data);
      if($this->input->is_ajax_request()){ //si la peticion la hace un ajax, realiza un echo para poder, si no un return
        echo $dataJ;
      }else{
        echo $dataJ;
      }
  }

  public function guardar_maquina($id_maquina=NULL){ //metodo para insertar o actualizar dispositivos
   
    //con el siguiente if se evalua si el metodo guardar_proceso recibio algun dato del formulario de la pagina o simplemente fue llamado para cargar la vista
      if($this->input->server('REQUEST_METHOD')=="POST"){
        //lo proximo es establecer las reglas de validación para cada campo

        if($id_maquina==null){ //si el id es nulo quiere decir que estamos agregando un nvo dato y por lo que que debemos verificar, ademas de la validacion std, si el nvo registro es nvo en la bd
          $this->form_validation->set_rules('nombre_maquina','Maquina','required|is_unique[maquinas.nombre_maquina]|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]'); 
          $this->form_validation->set_rules('uph_esperado','UPH esperado','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');
        }else{
          $this->form_validation->set_rules('nombre_maquina','Maquina','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]'); 
          $this->form_validation->set_rules('uph_esperado','UPH esperado','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');
        }
      
        if($this->form_validation->run()){
          //en este punto nuestro formulario es valido
          //el siguiente array es el que se guardara en la base de datos 
          $to_save = array(
            'nombre_maquina' => $this->input->post("nombre_maquina"),
            'id_proceso' => $this->input->post("id_proceso"),
            'uph_esperado' => $this->input->post("uph_esperado")
          );
          //print_r($to_save);
          if($id_maquina==null){ //se evalua si es un registro nvo o un update y se direcciona al metodo que corresponda
            //print_r($to_save);
            $this->Maquina->insert($to_save);//se llama al modelo donde se especifica la tabla donde insertar los datos. Esta clase extiende de CI_Model en donde creamos los metodos del CRUD (entre ellos el insert)
            $data['validation_errors'] = "registroInsertado";
          }else{
            $identificador='id_maquina';
            $valor = $id_maquina;
            //print_r($to_save);
            $this->Maquina->update($to_save,$identificador, $valor);
            $data['validation_errors'] = "registroModificado";
          }
          
        }else{
          $data['validation_errors'] = validation_errors();
          //TODO: clasificar errores para mostrar que validación fallo
        }                         
      }
      echo $data['validation_errors'];
  }
  //*****************************************************************PROCESOS*************************************************************** */
  

  //*******************************************************REGISTROS ROLLOS**************************************************************** */
  public function guardar_registro_rollos($id_reg_rol=NULL){ //metodo para insertar o actualizar dispositivos
   
    //con el siguiente if se evalua si el metodo guardar_proceso recibio algun dato del formulario de la pagina o simplemente fue llamado para cargar la vista
      if($this->input->server('REQUEST_METHOD')=="POST"){
        //lo proximo es establecer las reglas de validación para cada campo

          //TODO: validacion diferenciado si es un registro nuevo de una edicion + campos requeridos si son hologramas o chips

          $this->form_validation->set_rules('id_orden','OT',          'required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]'); 
          $this->form_validation->set_rules('id_turno','Turno',       'required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');  
          $this->form_validation->set_rules('id_operario','Operario', 'required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');
          $this->form_validation->set_rules('id_rollo_holograma','Rollo Holograma','regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');
          $this->form_validation->set_rules('id_rollo_chip','Rollo Chip','regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');  
          $this->form_validation->set_rules('id_maquina','Maquina','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');  
          $this->form_validation->set_rules('fecha','Fecha','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');
          $this->form_validation->set_rules('pieza_desde','Desde','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');
          $this->form_validation->set_rules('pieza_hasta','Hasta','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');   
          $this->form_validation->set_rules('cant_buenas','Cantidad Buenas','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');  
          $this->form_validation->set_rules('cant_malas','Cantidad Malas','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');  
          $this->form_validation->set_rules('id_defecto','Defecto','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');  
          $this->form_validation->set_rules('tiempo_asignado','Tiempo Asignado','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]'); 
          $this->form_validation->set_rules('tiempo_parada','Tiempo Parada','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]');  
          $this->form_validation->set_rules('id_parada','Parada','required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]'); 
          
         
      
        if($this->form_validation->run()){
          //en este punto nuestro formulario es valido
          
          //como la tabla de registros de rollos es una sola para el caso de los chips y hologramas, exixte la posibilidad de que los campos de seleccion de rollos de chips y hologramas vengan con el texto NULL dependiendo si el caso se trata de un registro de chips u hologrmas
          //con este if se trasnforma el texto NULL en variable NULL para que se pueda guardar en la BD y no tire errror
          if($this->input->post("id_rollo_holograma")=="NULL"){
            $id_rollo_holograma = NULL;
          }else{
            $id_rollo_holograma = $this->input->post("id_rollo_holograma");
          }
          if($this->input->post("id_rollo_chip")=="NULL"){
            $id_rollo_chip = NULL;
          }else{
            $id_rollo_chip = $this->input->post("id_rollo_chip");
          }
          //el siguiente array es el que se guardara en la base de datos 
          $to_save = array(
            'user' => $this->session->userdata('username'),
            'id_orden' => $this->input->post("id_orden"),
            'id_turno' => $this->input->post("id_turno"),
            'id_operario' => $this->input->post("id_operario"),
            'id_rollo_holograma' => $id_rollo_holograma,
            'id_rollo_chip' => $id_rollo_chip,
            'id_maquina' => $this->input->post("id_maquina"),
            'fecha' => $this->input->post("fecha"),
            'pieza_desde' => $this->input->post("pieza_desde"),
            'pieza_hasta' => $this->input->post("pieza_hasta"),
            'cant_buenas' => $this->input->post("cant_buenas"),
            'cant_malas' => $this->input->post("cant_malas"),
            'id_defecto' => $this->input->post("id_defecto"),
            'tiempo_asignado' => $this->input->post("tiempo_asignado"),
            'tiempo_parada' => $this->input->post("tiempo_parada"),
            'id_parada' => $this->input->post("id_parada")
          );
          //print_r($to_save);
          if($id_reg_rol==null){ //se evalua si es un registro nvo o un update y se direcciona al metodo que corresponda
            //print_r($to_save);
            $this->Registro_rollos->insert($to_save);//se llama al modelo donde se especifica la tabla donde insertar los datos. Esta clase extiende de CI_Model en donde creamos los metodos del CRUD (entre ellos el insert)
            $data['validation_errors'] = "registroInsertado";
          }else{
            $identificador='id_reg_rol';
            $valor = $id_reg_rol;
            //print_r($to_save);
            $this->Registro_rollos->update($to_save,$identificador, $valor);
            $data['validation_errors'] = "registroModificado";
          }
          
        }else{
          $data['validation_errors'] = validation_errors();
          //TODO: clasificar errores para mostrar que validación fallo
        }                         
      }
      echo $data['validation_errors'];
  }

  
  public function encontrar_registros_rollos($tipo=NULL,$identificador=NULL,$valor=NULL){//recibe el identificador para buscar y el valor del identificador

    //*****************************************************BLOQUE STD PARA EL PEDIDO DE DATOS A LA BD********************************** */
    $modelo = 'Registro_rollos'; //se define el modelo a traves del cual se hace la consulta
    //se definen los joins, si queda vacio se trabaja con la tabla aislada
    if($tipo=="chips"){
        $joins = array( 
          'ordenes'=>'registros_rollos.id_orden=ordenes.id_orden',
          'clientes' =>'ordenes.id_cliente=clientes.id_cliente',
          'productos' =>'ordenes.id_producto=productos.id_producto',
          'turnos' =>'registros_rollos.id_turno=turnos.id_turno',
          'operarios' =>'registros_rollos.id_operario=operarios.id_operario',
          'maquinas' =>'registros_rollos.id_maquina=maquinas.id_maquina',
          'procesos' =>'maquinas.id_proceso=procesos.id_proceso',
          'defectos' =>'registros_rollos.id_defecto=defectos.id_defecto',
          'paradas' =>'registros_rollos.id_parada=paradas.id_parada',
          'chips' =>'registros_rollos.id_rollo_chip=chips.id_chip'/*,
          'hologramas' =>'registros_rollos.id_rollo_holograma=hologramas.id_holograma'*/
        );
    }
    if($tipo=="hologramas"){
      $joins = array( 
        'ordenes'=>'registros_rollos.id_orden=ordenes.id_orden',
        'clientes' =>'ordenes.id_cliente=clientes.id_cliente',
        'productos' =>'ordenes.id_producto=productos.id_producto',
        'turnos' =>'registros_rollos.id_turno=turnos.id_turno',
        'operarios' =>'registros_rollos.id_operario=operarios.id_operario',
        'maquinas' =>'registros_rollos.id_maquina=maquinas.id_maquina',
        'procesos' =>'maquinas.id_proceso=procesos.id_proceso',
        'defectos' =>'registros_rollos.id_defecto=defectos.id_defecto',
        'paradas' =>'registros_rollos.id_parada=paradas.id_parada',
        /*'chips' =>'registros_rollos.id_rollo_chip=chips.id_chip',
        */'hologramas' =>'registros_rollos.id_rollo_holograma=hologramas.id_holograma'
      );
    }
    //en tipo viene chips u hologramas. En funciòn de esa variable se generan los joins
    //se definen los filtros, si queda vacio lista todos los registros
    if($identificador!=NULL){
      $filtros = array(
        $identificador=>$valor
      );
    }else{
      $filtros = array();
    }
    
    $data['data'] = $this->$modelo->findByField($filtros,$joins);
    //************************************************************************************************************************************* */
   
    $dataJ = json_encode($data);
    if($this->input->is_ajax_request()){ //si la peticion la hace un ajax, realiza un echo para poder, si no un return
      echo $dataJ;
    }else{
      return $dataJ; //esta salida debe hacerse con return. Se coloca echo para debug
    } 
    
  }


}
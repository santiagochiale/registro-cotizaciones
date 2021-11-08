<?php 


class RegistroCotizacionesModel extends MY_Model{

  public $table = "registro_cotizaciones";
  public $primary_key = "id_cotizacion";
  public $id = "id_cotizacion";

  public $joins = array(
    "estado_cotizacion"        => "estado_cotizacion.id_estado_coti=registro_cotizaciones.id_estado_coti",
    "clientes"                 => "clientes.id_cliente=registro_cotizaciones.id_cliente",
    "grupos"                   => "grupos.id_grupo=registro_cotizaciones.id_grupo",
    "productos"                => "productos.id_producto=registro_cotizaciones.id_producto",
    "monedas"                  => "monedas.id_moneda=registro_cotizaciones.id_moneda_coti", 
    "monedas"                  => "monedas.id_moneda=registro_cotizaciones.id_moneda_pres",

  );

  public $leftJoins = array(
      "empresas"                 => "empresas.id_empresa=registro_cotizaciones.id_empresas",
      //"impuestos"                => "impuestos.id_impuesto=registro_cotizaciones.id_impuesto",
      "estados_oc"               => "estados_oc.id_estado_oc=registro_cotizaciones.id_estado_oc",
      "estado_produccion"        => "estado_produccion.id_estado-produccion=registro_cotizaciones.id_estado_produccion"
  );

  public $array_validacion = array(   [
                                      "id"=>"id_cliente",
                                      "label"=>"id_cliente",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"fecha_cotizacion",
                                      "label"=>"fecha_cotizacion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"numero_cotizacion",
                                      "label"=>"numero_cotizacion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_grupo",
                                      "label"=>"id_grupo",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_producto",
                                      "label"=>"id_producto",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cod_sap",
                                      "label"=>"cod_sap",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cantidad",
                                      "label"=>"cantidad",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_moneda_coti",
                                      "label"=>"id_moneda_coti",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_moneda_pres",
                                      "label"=>"id_moneda_pres",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"valor_dolar",
                                      "label"=>"valor_dolar",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"costo",
                                      "label"=>"costo",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"costo_total",
                                      "label"=>"costo_total",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"precio_unitario",
                                      "label"=>"precio_unitario",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"facturacion",
                                      "label"=>"facturacion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"margen",
                                      "label"=>"margen",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"impuestos",
                                      "label"=>"impuestos",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cmg_moneda",
                                      "label"=>"cmg_moneda",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cmg_porcentaje",
                                      "label"=>"cmg_porcentaje",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_empresas",
                                      "label"=>"id_empresas",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"precio_ganador",
                                      "label"=>"precio_ganador",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"diferencia_sobreUB",
                                      "label"=>"diferencia_sobreUB",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"margen_sobreUB",
                                      "label"=>"margen_sobreUB",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_estado_oc",
                                      "label"=>"id_estado_oc",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"fecha_oc",
                                      "label"=>"fecha_oc",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_estado_produccion",
                                      "label"=>"id_estado_produccion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cantidad_entregada",
                                      "label"=>"cantidad_entregada",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cantidad_pendiente",
                                      "label"=>"cantidad_pendiente",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ]
                                    );

  public function altaCotizacion($data){
      $data_producto = $this->ProductosModel->getProductos(array('id_producto'=>$data['id_producto']));
      $data['id_grupo'] = !empty($data_producto['id_grupo']) ? $data_producto['id_grupo'] : 0;
      $data['cod_sap'] = !empty($data_producto['cod_sap']) ? $data_producto['cod_sap'] : '';
      $data['fecha_cotizacion'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['fecha_cotizacion'])));
      $data['fecha_oc'] = !empty($data['fecha_oc'])?date('Y-m-d', strtotime(str_replace('/', '-', $data['fecha_oc']))):NULL;

      $data = $this->formatear_campos_formulario($data);

      $data_calculada = $this->calcularVariables($data);

      $data = array_merge($data, $data_calculada);
      //TODO falta diferencia_sobreUB
      if (!empty($data['id_cotizacion'])){
          $id_cotizacion = $data['id_cotizacion'];
          unset($data['id_cotizacion']);
          $this->db->update('registro_cotizaciones', $data, array('id_cotizacion'=>$id_cotizacion));
          return $id_cotizacion;
      }
      $insert = $this->db->insert('registro_cotizaciones', $data);
      if ($insert){
          return $this->db->insert_id();
      }

  }

  public function calcularVariables($data){
//      var_dump($data); //exit;
      if (empty($data['moneda_cotizacion'])){
          $data['moneda_cotizacion'] = '$';
      }
      if (empty($data['moneda_presentacion'])){
          $data['moneda_presentacion'] = '$';
      }

      $valor_cotizacion = 1;

//      if ($data['moneda_presentacion']<>$data['moneda_cotizacion']){
//          if ($data['moneda_presentacion'] == '$'){
//              $valor_cotizacion = !empty($data['valor_dolar'])?$data['valor_dolar']:0;
//          }
//          elseif ($data['moneda_cotizacion'] == '$'){
//              $valor_cotizacion =!empty($data['valor_dolar'])?1/$data['valor_dolar']:0;
//          }
//      }

      $return['facturacion'] = $valor_cotizacion*$this->calcularTotal(!empty($data['cantidad'])?$data['cantidad']:0, !empty($data['precio_unitario'])?$data['precio_unitario']:0);
      $return['costo_total'] = $valor_cotizacion*$this->calcularTotal(!empty($data['cantidad'])?$data['cantidad']:0, !empty($data['costo'])?$data['costo']:0);
//      var_dump($return); exit;
      if (!empty($data['precio_unitario']) && !empty($data['costo'])){
          $return['margen'] = floatval(round((($data['precio_unitario'] / $data['costo'])-1) * 100, 2));
      }
      else{
          $return['margen'] = FALSE;
      }
      $return['impuestos'] = !empty($return['facturacion'])?$return['facturacion']*0.025:FALSE;
      $return['cmg_moneda'] = !empty($return['facturacion']) && !empty($return['costo_total'])?floatval($return['facturacion']-$return['costo_total']-$return['impuestos']):FALSE;
      $return['cmg_porcentaje'] = $return['cmg_moneda']!==FALSE && !empty($return['facturacion']) ? floatval(round($return['cmg_moneda'] / $return['facturacion'] * 100, 2)):FALSE;

//      $return['diferencia_sobreUB'] =
      $return['margen_sobreUB'] = !empty($data['precio_ganador']) && !empty($data['precio_unitario']) ? floatval( round($data['precio_ganador']/$data['precio_unitario']*100,2)) : FALSE;
      $return['cantidad_pendiente'] = !empty($data['cantidad']) ? $data['cantidad'] - (!empty($data['cantidad_entregada'])?$data['cantidad_entregada']:0) : FALSE;

      $return['precio_ganador'] = !empty($data['precio_ganador']) ? $valor_cotizacion*$data['precio_ganador'] : FALSE;

      return $return;



  }

  private function calcularTotal($cantidad, $valor_unitario){
      if (!empty($cantidad) && !empty($valor_unitario)){
          return floatval(round($cantidad*$valor_unitario, 2));
      }
      return FALSE;
  }

  private function formatearMoneda($valor){
      if (substr_count($valor, ',') <= 1){
//          $valor = str_replace('.','',$valor);
          $valor = str_replace(',','.',$valor);
          return $valor;
      }
      else{
          return FALSE;
      }
  }

  public function formatear_campos_formulario($data){
      if (isset($data['valor_dolar'])) $data['valor_dolar'] = $this->formatearMoneda($data['valor_dolar']);
      if (isset($data['costo'])) $data['costo'] = $this->formatearMoneda($data['costo']);
      if (isset($data['precio_unitario'])) $data['precio_unitario'] = $this->formatearMoneda($data['precio_unitario']);
      if (isset($data['precio_ganador'])) $data['precio_ganador'] = $this->formatearMoneda($data['precio_ganador']);

      return $data;
  }

  public function traerCantidadCotizacionesDashboard($params = array()){
//      var_dump($params); exit;
      if (!empty($params['fecha_cotizacion'])){
          $fechas = explode(' - ', $params['fecha_cotizacion']);
          $begin = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[0])));
          $end = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[1])));
          $this->db->where("fecha_cotizacion BETWEEN '$begin' AND '$end'");
          unset($params['fecha_cotizacion']);
      }
      if (!empty($params['fecha_oc'])){
          $fechas = explode(' - ', $params['fecha_oc']);
          $begin = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[0])));
          $end = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[1])));
          $this->db->where("fecha_oc BETWEEN '$begin' AND '$end'");
          unset($params['fecha_oc']);
      }
      $this->db->from('registro_cotizaciones as rc');
      if (!empty($params) && count($params)>0){
        $this->db->where($params);
      }
      return $this->db->count_all_results();
  }

  public function traerDataDashboard($params = array()){
      $this->db->from('registro_cotizaciones rc')
          ->join('estado_cotizacion ec', 'rc.id_estado_coti = ec.id_estado_coti')
          ->join('monedas m', 'rc.id_moneda_coti = m.id_moneda')
          ->select('m.moneda as moneda, estado_cotizacion as estado_cotizacion, sum(cantidad) as cantidad, sum(facturacion) as facturacion, round(sum(cmg_moneda),2) as cmg_moneda, rc.id_estado_coti, rc.id_moneda_coti')
          ->group_by('m.moneda, estado_cotizacion');

      if (!empty($params['fecha_cotizacion'])){
          $fechas = explode(' - ', $params['fecha_cotizacion']);
          $begin = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[0])));
          $end = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[1])));
          $this->db->where("rc.fecha_cotizacion BETWEEN '$begin' AND '$end'");
//          unset($params['fecha_cotizacion']);
      }

      if (!empty($params['fecha_oc'])){
          $fechas = explode(' - ', $params['fecha_oc']);
          $begin = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[0])));
          $end = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[1])));
          $this->db->where("rc.fecha_oc BETWEEN '$begin' AND '$end'");
//          unset($params['fecha_oc']);
      }

      if (!empty($params) && count($params)>0){
          foreach ($params as $key => $value){
              if (!in_array($key, array('fecha_oc', 'fecha_cotizacion'))){
                  $this->db->where('rc.'.$key, $value);
              }
          }
//          $this->db->where($params);
      }

      $sql = $this->db->get();

//      var_dump($this->db->last_query()); exit;

      if ($sql->num_rows()){
          $dataDashboard = array();
          $result = $sql->result_array();
          foreach ($result as $data){
              $dataDashboard[$data['moneda']][$data['estado_cotizacion']] = $data + array('porcentaje'=>$this->calcularPorcentajeCotizaciones($data['id_moneda_coti'], $data['id_estado_coti'], $params));
          }
//          var_dump($dataDashboard); exit;
          return $dataDashboard;
      }
  }

  private function calcularPorcentajeCotizaciones($id_moneda, $id_estado_cotizacion, $params = array()){
    $this->db->from('registro_cotizaciones')
        ->where('id_moneda_coti', $id_moneda);

      if (!empty($params['fecha_cotizacion'])){
          $fechas = explode(' - ', $params['fecha_cotizacion']);
          $begin = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[0])));
          $end = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[1])));
          $this->db->where("fecha_cotizacion BETWEEN '$begin' AND '$end'");
//          unset($params['fecha_cotizacion']);
      }

      if (!empty($params['fecha_oc'])){
          $fechas = explode(' - ', $params['fecha_oc']);
          $begin = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[0])));
          $end = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[1])));
          $this->db->where("fecha_oc BETWEEN '$begin' AND '$end'");
//          unset($params['fecha_oc']);
      }

      if (!empty($params) && count($params)>0){
          foreach ($params as $key => $value){
              if (!in_array($key, array('fecha_oc', 'fecha_cotizacion'))){
                  $this->db->where($key, $value);
              }
          }
//          $this->db->where($params);
      }

    $cantidad_cotizaciones_moneda = $this->db->count_all_results();

    $this->db->from('registro_cotizaciones')
        ->where('id_moneda_coti', $id_moneda)
        ->where('id_estado_coti', $id_estado_cotizacion);

      if (!empty($params['fecha_cotizacion'])){
          $fechas = explode(' - ', $params['fecha_cotizacion']);
          $begin = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[0])));
          $end = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[1])));
          $this->db->where("fecha_cotizacion BETWEEN '$begin' AND '$end'");
      }

      if (!empty($params['fecha_oc'])){
          $fechas = explode(' - ', $params['fecha_oc']);
          $begin = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[0])));
          $end = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[1])));
          $this->db->where("fecha_oc BETWEEN '$begin' AND '$end'");
      }

      if (!empty($params) && count($params)>0){
          foreach ($params as $key => $value){
              if (!in_array($key, array('fecha_oc', 'fecha_cotizacion'))){
                  $this->db->where($key, $value);
              }
          }
//          $this->db->where($params);
      }

      $cantidad_cotizaciones_moneda_estado = $this->db->count_all_results();
    if ($cantidad_cotizaciones_moneda <> 0){
        return $cantidad_cotizaciones_moneda_estado * 100 / $cantidad_cotizaciones_moneda;
    }
    return NULL;

  }

  public function buscarCotizacion($id){
      $sql = $this->db->get_where('registro_cotizaciones', array('id_cotizacion'=>$id));
      if ($sql->num_rows()==1){
          return $sql->row_array();
      }
  }

  public function eliminarCotizacion($id){
      $existe_id = $this->buscarCotizacion($id);
      if (!empty($existe_id)){
          $this->db->trans_begin();
          $this->db->where('id_cotizacion', $id);
          $this->db->delete('registro_cotizaciones');
          if ($this->db->affected_rows()==1 && $this->db->trans_status()===TRUE){
              $this->db->trans_commit();
              return array('success'=>TRUE);
          }
          else{
              $this->db->trans_rollback();
              return array('success'=>FALSE, 'message'=>'Ocurrió un error al intentar eliminar la cotización');
          }
      }
  }
  

}
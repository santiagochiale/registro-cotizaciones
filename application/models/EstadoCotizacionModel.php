<?php 


class EstadoCotizacionModel extends MY_Model{

  public $table = "estado_cotizacion";
  public $primary_key = "id_estado_coti";
  public $id = "id_estado_coti";

  public $joins = array(
    
  );

  public $array_validacion = array( [
                                      "id"=>"estado_cotizacion",
                                      "label"=>"estado_cotizacion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ]
                                    );


  public function getEstadosCotizacion($params = array()){
      $this->db->from($this->table)
          ->order_by('estado_cotizacion');

      $sql = $this->db->get();
      if ($sql->num_rows()){
          return $sql->result_array();
      }
  }
  

}
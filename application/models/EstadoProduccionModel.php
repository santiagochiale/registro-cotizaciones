<?php 


class EstadoProduccionModel extends MY_Model{

  public $table = "estado_produccion";
  public $primary_key = "id_estado-produccion";
  public $id = "id_estado-produccion";

  public $joins = array(
    
  );

  public $array_validacion = array( [
                                      "id"=>"estado_produccion",
                                      "label"=>"estado_produccion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ]
                                    );

    public function getEstadosProduccion($params = array()){
        $this->db->from($this->table)
            ->order_by('estado_produccion');

        $sql = $this->db->get();
        if ($sql->num_rows()){
            return $sql->result_array();
        }
    }
  

}
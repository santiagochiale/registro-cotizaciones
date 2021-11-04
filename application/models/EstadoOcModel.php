<?php 


class EstadoOcModel extends MY_Model{

  public $table = "estados_oc";
  public $primary_key = "id_estado_oc";
  public $id = "id_estado_oc";

  public $joins = array(
    
  );

  public $array_validacion = array( [
                                      "id"=>"estado_oc",
                                      "label"=>"estado_oc",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ]
                                    );

    public function getEstadosOC($params = array()){
        $this->db->from($this->table)
            ->order_by('estado_oc');

        $sql = $this->db->get();
        if ($sql->num_rows()){
            return $sql->result_array();
        }
    }
  

}
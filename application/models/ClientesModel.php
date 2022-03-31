<?php 


class ClientesModel extends MY_Model{

  public $table = "clientes";
  public $primary_key = "id_cliente";
  public $id = "id_cliente";

  public $joins = array(
  );

  public $array_validacion = array( [
                                    "id"=>"nombre_cliente",
                                    "label"=>"nombre_cliente",
                                    "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                    ]
                                  );

  public function getClientes($params = array()){
      $this->db->from($this->table)
          ->order_by('nombre_cliente');

      $sql = $this->db->get();
      if ($sql->num_rows()){
          return $sql->result_array();
      }
  }

}
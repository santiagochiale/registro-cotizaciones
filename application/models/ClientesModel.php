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

}
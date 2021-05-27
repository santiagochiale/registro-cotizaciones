<?php 


class ClientesModel extends MY_Model{

  public $table = "clientes";
  public $primary_key = "id";
  public $id = "id_cliente";

  public $joins = array(
  );

  public $array_validacion = array( [
                                    "id"=>"descripcion_producto",
                                    "label"=>"descripcion_producto",
                                    "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                    ],
                                    [  
                                    "id"=>"id_grupo",
                                    "label"=>"id_grupo",
                                    "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                    ],
                                    [  
                                    "id"=>"cod_sap",
                                    "label"=>"cod_sap",
                                    "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                    ]
                                  );

}
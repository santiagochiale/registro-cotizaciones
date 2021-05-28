<?php 


class ProductosModel extends MY_Model{

  public $table = "productos";
  public $primary_key = "id_producto";
  public $id = "id_producto";

  public $joins = array(
    "grupos" => "grupos.id_grupo=productos.id_grupo"
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
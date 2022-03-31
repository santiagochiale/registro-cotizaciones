<?php 


class ImpuestosModel extends MY_Model{

  public $table = "impuestos";
  public $primary_key = "id_impuesto";
  public $id = "id_impuesto";

  public $joins = array(
    
  );

  public $array_validacion = array( [
                                      "id"=>"impuesto",
                                      "label"=>"impuesto",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                    ],
                                    [
                                      "id"=>"valor_impuesto",
                                      "label"=>"valor_impuesto",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                    ]

                                    );
  

}
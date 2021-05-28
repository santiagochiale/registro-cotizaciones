<?php 


class MonedasModel extends MY_Model{

  public $table = "monedas";
  public $primary_key = "id_moneda";
  public $id = "id_moneda";

  public $joins = array(
    
  );

  public $array_validacion = array( [
                                      "id"=>"moneda",
                                      "label"=>"moneda",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                     ],
                                     [
                                      "id"=>"conversion",
                                      "label"=>"conversion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                     ]
                              );
  

}
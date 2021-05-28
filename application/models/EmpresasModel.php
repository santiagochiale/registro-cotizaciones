<?php 


class EmpresasModel extends MY_Model{

  public $table = "empresas";
  public $primary_key = "id_empresa";
  public $id = "id_empresa";

  public $joins = array(
    
  );

  public $array_validacion = array( [
                                      "id"=>"empresa",
                                      "label"=>"empresa",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ]
                                    );
  

}
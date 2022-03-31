<?php 


class GruposModel extends MY_Model{

  public $table = "grupos";
  public $primary_key = "id_grupo";
  public $id = "id_grupo";

  public $joins = array(
    
  );

  public $array_validacion = array( [
                                      "id"=>"descripcion_grupo",
                                      "label"=>"descripcion_grupo",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ]
                                    );
  

}
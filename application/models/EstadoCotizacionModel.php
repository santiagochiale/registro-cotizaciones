<?php 


class EstadoCotizacionModel extends MY_Model{

  public $table = "estado_cotizacion";
  public $primary_key = "id_estado_coti";
  public $id = "id_estado_coti";

  public $joins = array(
    
  );

  public $array_validacion = array( [
                                      "id"=>"estado_cotizacion",
                                      "label"=>"estado_cotizacion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ]
                                    );
  

}
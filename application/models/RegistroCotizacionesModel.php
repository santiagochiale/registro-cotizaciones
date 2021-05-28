<?php 


class RegistroCotizacionesModel extends MY_Model{

  public $table = "registro_cotizaciones";
  public $primary_key = "id_cotizacion";
  public $id = "id_cotizacion";

  public $joins = array(
    "estado_cotizacion"       => "estado_cotizacion.id_estado_coti=registro_cotizaciones.id_estado_coti",
    "clientes"                 => "clientes.id_cliente=registro_cotizaciones.id_cliente",
    "grupos"                   => "grupos.id_grupo=registro_cotizaciones.id_grupo",
    "productos"               => "productos.id_producto=registro_cotizaciones.id_producto",
    "monedas"                  => "monedas.id_moneda=registro_cotizaciones.id_moneda_coti", 
    "monedas"                  => "monedas.id_moneda=registro_cotizaciones.id_moneda_pres",
    "empresas"                => "empresas.id_empresa=registro_cotizaciones.id_empresas",
    "estados_oc"              => "estados_oc.id_estado_oc=registro_cotizaciones.id_estado_oc",
    "estado_produccion"       => "estado_produccion.id_estado-produccion=registro_cotizaciones.id_estado_produccion"
  );

  public $array_validacion = array( [
                                      "id"=>"id_estado_coti",
                                      "label"=>"id_estado_coti",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_cliente",
                                      "label"=>"id_cliente",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"fecha_cotizacion",
                                      "label"=>"fecha_cotizacion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"numero_cotizacion",
                                      "label"=>"numero_cotizacion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_grupo",
                                      "label"=>"id_grupo",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_producto",
                                      "label"=>"id_producto",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cod_sap",
                                      "label"=>"cod_sap",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cantidad",
                                      "label"=>"cantidad",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_moneda_coti",
                                      "label"=>"id_moneda_coti",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_moneda_pres",
                                      "label"=>"id_moneda_pres",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"valor_dolar",
                                      "label"=>"valor_dolar",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"costo",
                                      "label"=>"costo",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"costo_total",
                                      "label"=>"costo_total",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"precio_unitario",
                                      "label"=>"precio_unitario",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"facturacion",
                                      "label"=>"facturacion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"margen",
                                      "label"=>"margen",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"impuestos",
                                      "label"=>"impuestos",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cmg_moneda",
                                      "label"=>"cmg_moneda",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cmg_porcentaje",
                                      "label"=>"cmg_porcentaje",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_empresas",
                                      "label"=>"id_empresas",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"precio_ganador",
                                      "label"=>"precio_ganador",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"diferencia_sobreUB",
                                      "label"=>"diferencia_sobreUB",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"margen_sobreUB",
                                      "label"=>"margen_sobreUB",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_estado_oc",
                                      "label"=>"id_estado_oc",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"fecha_oc",
                                      "label"=>"fecha_oc",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"id_estado_produccion",
                                      "label"=>"id_estado_produccion",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cantidad_entregada",
                                      "label"=>"cantidad_entregada",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"=>"cantidad_pendiente",
                                      "label"=>"cantidad_pendiente",
                                      "parametros"=>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ]
                                    );
  

}
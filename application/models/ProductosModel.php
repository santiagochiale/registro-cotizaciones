<?php 


class ProductosModel extends MY_Model{

  public $table = "productos";
  public $primary_key = "id";
  public $id = "id_producto";

  public $joins = array(
    "grupos" => "grupos.id_grupo=productos.id_grupo"
  );

  
  

}
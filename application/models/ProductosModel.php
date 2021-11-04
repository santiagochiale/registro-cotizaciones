<?php 


class ProductosModel extends MY_Model{

  public $table = "productos";
  public $primary_key = "id_producto";
  public $id = "id_producto";

  public $joins = array(
    "grupos" => "grupos.id_grupo=productos.id_grupo"
  );

  public $array_validacion = array( [
                                      "id"            =>"descripcion_producto",
                                      "label"         =>"descripcion_producto",
                                      "parametros"    =>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"            =>"id_grupo",
                                      "label"         =>"id_grupo",
                                      "parametros"    =>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ],
                                      [  
                                      "id"            =>"cod_sap",
                                      "label"         =>"cod_sap",
                                      "parametros"    =>"required|regex_match[/[a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9.]+$/]"
                                      ]
                                    );

    public function getProductos($params = array()){
        $this->db->from($this->table)
            ->order_by('descripcion_producto');

        if (!empty($params['id_producto'])){
            $this->db->where('id_producto', $params['id_producto']);
        }

        $sql = $this->db->get();
        if ($sql->num_rows()){
            if (!empty($params['id_producto'])){
                return $sql->row_array();
            }
            return $sql->result_array();
        }
    }

    public function getGrupoIdByProductoId($id_producto){
        $sql = $this->db->get_where('productos', array('id_producto'=>$id_producto));
        if ($sql->num_rows()==1){
            $result = $sql->row_array();
            return $result['id_grupo'];
        }
        return NULL;
    }
  

}
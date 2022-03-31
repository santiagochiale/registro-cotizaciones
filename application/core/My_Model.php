<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Model extends CI_Model
{
	 function __construct()
	{
		parent::__construct();
	}


  // -----------------------------------------------------------------------
  //*********************************************CRUD***********************************************************

  function find($filtros){ //esta funcion busca todos los elementos del campo field que coiciden con la condicion de value en ese campo y la fecha $fecha
    $this->db->select(); //selecciona todos los campos de la bd
    $this->db->from($this->table); //se define la tabla de la cual se van a seleccionar los campos. Esto viene del modelo
    
    if(!empty($this->joins)){
      foreach ($this->joins as $key => $value) {
        $this->db->join($key, $value);
      }
    }

    if(!empty($this->leftJoins)){
      foreach ($this->leftJoins as $key => $value) {
        $this->db->join($key, $value, 'left');
      }
    }
    if(!empty($filtros)){
      foreach ($filtros as $key => $value) {
        if($key=="id"){
          $key=$this->id;
        }
        if ($key=='registro_cotizaciones.fecha_cotizacion'){
            $fechas = explode(' - ', $value);
            $begin = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[0])));
            $end = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[1])));
            $this->db->where("registro_cotizaciones.fecha_cotizacion BETWEEN '$begin' AND '$end'");
        }
        elseif ($key=='registro_cotizaciones.fecha_oc'){
            $fechas = explode(' - ', $value);
            $begin = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[0])));
            $end = date('Y-m-d', strtotime(str_replace('/', '-',$fechas[1])));
            $this->db->where("registro_cotizaciones.fecha_oc BETWEEN '$begin' AND '$end'");
        }
        else{
            $this->db->where($key, $value);
        }
      }
    }
    $query = $this->db->get(); //se obtienen los datos de  ese id
//    var_dump($query, $this->db->last_query()); die();
    return $query->result();; //descarga una fila con los datos del id recibido
  }

  function update($to_save,$id){
    unset($to_save['id']);//truncar el array de valores para eliminar el id
    $this->db->where($this->primary_key, $id);
    return $this->db->update($this->table, $to_save);
  }
  
  function delete($id){ 
    return $this->db->delete($this->table, array($this->primary_key => $id)); 
  }

  function insert($to_save){
    $this->db->insert($this->table, $to_save);
    return $this->db->insert_id();
  }

  //-----------------------------------METODOS RESUMENES---------------------------------------

  function totalize($field,$filtros){
    $this->db->select_sum($field); //selecciona todos los campos de la bd
    $this->db->from($this->table); //se define la tabla de la cual se van a seleccionar los campos. Esto viene del modelo
    if(!empty($this->joins)){
      foreach ($this->joins as $key => $value) {
        $this->db->join($key, $value);
      }
    }
    if(!empty($filtros)){
      foreach ($filtros as $key => $value) {
        if($key=="id"){
          $key=$this->id;
        }
        $this->db->where($key, $value); 
      }
    }
    $query = $this->db->get(); //se obtienen los datos de  ese id
    return $query->result();; //descarga una fila con los datos del id recibido
  }
}

/* End of file MY_Model.php */
/* Location: /community_auth/core/MY_Model.php */
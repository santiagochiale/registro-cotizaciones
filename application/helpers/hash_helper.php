<?php 


function hash_data($data,$coste){

  // las siguientes son las opciones de hasheo
  $opciones = [
  'cost' => $coste
  ];
  return password_hash($data, PASSWORD_BCRYPT, $opciones);

}
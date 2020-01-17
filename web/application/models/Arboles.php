<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Arboles extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function listar()
	{		
		log_message('DEBUG', 'Arboles/listar'); 
    $resource = '/arbol/listado/especies'; 
    $url = REST.$resource;
    $array = $this->rest->callAPI("GET", $url);
    return json_decode($array['data']);
	}

  function Guardar_Nuevo($data){				
	
		$_nueva_especie = array(
			"valor"=> $data["nombre"],
			"tabla"=> "tipo_arbol"						
		);
		$datos['arbol'] = $_nueva_especie;
		log_message('DEBUG', 'Arboles/Guardar_Nuevo  | Datos a Guardar: '.json_encode($_nueva_especie)); 
    $resource = '/arbol/especie';
    $url = REST.$resource;
    $array = $this->rest->callAPI("POST", $url, $datos);
    return json_decode($array['code']);
	}

	function borrar($id){

		$_especie = array(
			"tabl_id"=> $id				
		);
		$datos['arbol'] = $_especie;
		log_message('DEBUG', 'Arboles/borrar  | Id de Especie: '.$id); 
    $resource = '/arbol/especie/delete';
    $url = REST.$resource;
    $array = $this->rest->callAPI("PUT", $url, $datos);
    return json_decode($array['code']);
	}
        
}


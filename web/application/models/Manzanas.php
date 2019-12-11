<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Manzanas extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	//// LISTA MANZANAS
	function listar()
	{   
    $parametros["http"]["method"] = "GET";	
		$parametros["http"]["header"] = "Accept: application/json";	 	 
		$param = stream_context_create($parametros);
		$resource = '/listamanzanas';	 	
		$url = REST.$resource;
		$array = file_get_contents($url, false, $param);
		return json_decode($array);
	}
	//// LISTA AREAS
	function listarAreas($depaId)
	{
	 
		$parametros["http"]["method"] = "GET";
		$parametros["http"]["header"] = "Accept: application/json";	 
		$param = stream_context_create($parametros);
		$resource = '/listaareas';	 	
		$url = REST.$resource;
		$array = file_get_contents($url, false, $param);
	 	return json_decode($array);
	}
	// Guarda manzana nueva con area geografica
  function Guardar_Nuevo($data){	

		$manzana = array(
			"nombre"=> $data["nombre"],	
			"arge_id"=>$data["argeo"]				
		);		
		$post_manz['manzana_post'] = $manzana;			

		$resource = '/manzana';
		$url = REST.$resource;
		$array = $this->rest->callAPI("POST", $url, $post_manz); 	
		log_message('DEBUG', 'Manzanas/Guardar_Nuevo() Resultado post-> '.json_encode($array));	
		return json_decode($array['data']);
	}


}
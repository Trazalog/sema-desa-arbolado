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
		log_message('DEBUG', 'Manzanas/Guardar_Nuevo() data-> '.json_encode($data));
		$manzana = array(
			"nombre"=> $data["nombre"],	
			"arge_id"=>$data["argeo"]				
		);		
		$post_manz['_post_manzana'] = $manzana;	
		$resource = '/manzana';
		$url = REST.$resource;
		$array = $this->rest->callAPI("POST", $url, $post_manz); 	
		log_message('DEBUG', 'Manzanas/Guardar_Nuevo() Resultado post-> '.json_encode($array));	
		return json_decode($array['data']);
	}

	function borrar($id){

		log_message('DEBUG', 'Manzanas/Borrar  | id: '.json_encode($id));
		$manzana = array(
			"manz_id"=> $id				
		);
		$datos['manzana'] = $manzana;
		$resource = '/manzanas/delete';
    $url = REST.$resource;
    $array = $this->rest->callAPI("PUT", $url, $datos);
    return json_decode($array['data']);
	}

	function editar($data){
		$post['_put_manzana_actualizar'] = $data;
		log_message('DEBUG','#TRAZA|MANZANAS|editar($data) >> '.json_encode($data));
		$aux = $this->rest->callAPI("PUT",REST."/manzana/actualizar", $post);
		$aux =json_decode($aux["code"]);
		return $aux;
	}

}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Calles extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function listar()
	{
			
		$parametros["http"]["method"] = "GET";	
		$parametros["http"]["header"] = "Accept: application/json";	 	 
		$param = stream_context_create($parametros);
		$resource = '/listacalles';	 	
		$url = REST.$resource;
		$array = file_get_contents($url, false, $param);
		return json_decode($array);
	}

	
	
	function Guardar_Nuevo($data){

//TODO:SACAR HARCODE DE DEPARTAMENTO ID

		

		$_post_setcalle = array(
			"nombre"=> $data["nombre"],
			"depa_id"=>$data["depa_id"]				
		);
		$datos['_post_setcalle'] = $_post_setcalle;	
		$data = json_encode($datos);
		var_dump($data);

		$parametros["http"]["method"] = "POST";
		$parametros["http"]["header"] = "Accept: application/json";	
		$parametros["http"]["header"] = "Content-Type: application/json";	
		$parametros["http"]["content"] = $data;	
		$param = stream_context_create($parametros);
		$resource = '/setCalle';	 				
		$url = REST.$resource;
		$array = file_get_contents($url, false, $param);
		return json_decode($array);	
	}


}
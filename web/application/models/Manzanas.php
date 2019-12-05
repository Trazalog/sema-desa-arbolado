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
	
	
	

    function Guardar_Nuevo($data){

        
//TODO:SACAR HARCODE DE DEPARTAMENTO ID

		

		$_post_setmanzana = array(
			"nombre"=> $data["nombre"],
			"argeo"=>$data["argeo"]	,
			"argeo"=>$data["argeo"]				
		);
		
		$datos['manzana_calle'] = $_post_setmanzana;	
		$data = json_encode($datos);
		 var_dump($data);

		$parametros["http"]["method"] = "POST";
		$parametros["http"]["header"] = "Accept: application/json";	
		$parametros["http"]["header"] = "Content-Type: application/json";	
		$parametros["http"]["content"] = $data;	
		$param = stream_context_create($parametros);
		$resource = '';	 				
		$url = REST.$resource;
		$array = file_get_contents($url, false, $param);
		return json_decode($array);	
	}


    }
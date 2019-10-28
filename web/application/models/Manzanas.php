<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Manzanas extends CI_Model
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
		$resource = '/listamanzanas';	 	
		$url = REST.$resource;
		$array = file_get_contents($url, false, $param);
		return json_decode($array);

    }

    function Guardar_Nuevo($data){

        
//TODO:SACAR HARCODE DE DEPARTAMENTO ID

		$data["depa_id"] = "1";

		$_post_setcalle = array(
			"nombre"=> $data["nombre"],
			"depa_id"=>$data["depa_id"]				
		);
		$datos['_post_setcalle'] = $_post_setcalle;	
		$data = json_encode($datos);

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


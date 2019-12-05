<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Arboles extends CI_Model
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
        $resource = '/listaarboles';	 	
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        return json_decode($array);
    }

    function Guardar_Nuevo($data){

        
        //TODO:SACAR HARCODE DE DEPARTAMENTO ID
        
                
        
                $_post_setarbol = array(
                    "nombre"=> $data["nombre"],
                   			
                );
                $datos['_post_setarbol'] = $_post_setarbol;	
                $data = json_encode($datos);
        
                $parametros["http"]["method"] = "POST";
                $parametros["http"]["header"] = "Accept: application/json";	
                $parametros["http"]["header"] = "Content-Type: application/json";	
                $parametros["http"]["content"] = $data;	
                $param = stream_context_create($parametros);
                $resource = '/set';	 				
                $url = REST.$resource;
                $array = file_get_contents($url, false, $param);
                return json_decode($array);	
            }
        
}


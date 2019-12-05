<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Censistas extends CI_Model
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
        $resource = '/censista/list';	 	
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        return json_decode($array);
    }
    
// Funcion Guardar Nuevo

function Guardar_Nuevo($data){

    $_post_setCensista = array(
        "nombre"=> $data["nombre"]				
    );

    $datos ['_post_setCensista'] = $_post_setCensista;
    $data = json_encode($datos);

    $parametros["http"]["method"] = "POST";
    $parametros["http"]["header"] = "Accept: application/json";	
    $parametros["http"]["header"] = "Content-Type: application/json";	
    $parametros["http"]["content"] = $data;	
    $param = stream_context_create($parametros);
    $resource = '/';	 				
    $url = REST.$resource;
    $array = file_get_contents($url, false, $param);
    return json_decode($array);	

}
}
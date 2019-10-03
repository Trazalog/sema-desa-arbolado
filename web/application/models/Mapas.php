<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mapas extends CI_Model
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
        $resource = '/puntosmapa';	 	
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        return json_decode($array);
    }
    function Detalles($id)
    {
        if($id == 1)
        {
            $resource = 'punto1';
        }
        if($id == 2)
        {
            $resource = 'punto2';
        }
        if($id == 3)
        {
            $resource = 'punto3';
        }
        $parametros["http"]["method"] = "GET";		 
        $param = stream_context_create($parametros); 	
        $url = REST.$resource;
        $data= file_get_contents($url, false, $param);
        return json_decode($data);
    }
}
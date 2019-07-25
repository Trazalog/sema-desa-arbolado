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
        $param = stream_context_create($parametros);
        $resource = 'listaarboles';	 	
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        return json_decode($array);
    }
}
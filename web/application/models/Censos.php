<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Censos extends CI_Model
{
	function __construct()
	{
		parent::__construct();
    }
    function listar()
    {
        
        $parametros["http"]["method"] = "GET";		 
        $param = stream_context_create($parametros);
        $resource = 'listacensos';	 	
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        return json_decode($array);
    }
    function buscaCensos()
    {
        $resource = 'listacensosarmadostodo';
        $parametros["http"]["method"] = "GET";		 
        $param = stream_context_create($parametros);	 	
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        return json_decode($array);
    }

    function getFormulario(){
        $parametros["http"]["method"] = "GET";
        $parametros["http"]["header"] = "Accept: application/json";	 
        $param = stream_context_create($parametros);
        $resource = '/getFromulario';	 	
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        return json_decode($array);
    }
}
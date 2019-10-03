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
}
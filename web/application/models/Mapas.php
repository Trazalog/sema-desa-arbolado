<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mapas extends CI_Model
{
	function __construct()
	{
		parent::__construct();
    }

    // retorna listado de arboles por id de censo
    function listar($cens_id)
    {
        
				$parametros["http"]["method"] = "GET";
        $parametros["http"]["header"] = "Accept: application/json";	 
        $param = stream_context_create($parametros);   	
        
        $resource = '/tree_list/censo/';
        $url = REST.$resource.$cens_id;  
        $array = file_get_contents($url, false, $param); 

        return json_decode($array);
    }
    function Detalles($id)
    {

        // if($id == 1)
        // {
        //     $resource = 'punto1';
        // }
        // if($id == 2)
        // {
        //     $resource = 'punto2';
        // }
        // if($id == 3)
        // {
        //     $resource = 'punto3';
        // }
        // $parametros["http"]["method"] = "GET";		 
        // $param = stream_context_create($parametros); 	
        // $url = REST.$resource;
        // $data= file_get_contents($url, false, $param);
				// return json_decode($data);
				
				$parametros["http"]["method"] = "GET";
        $parametros["http"]["header"] = "Accept: application/json";	 
        $param = stream_context_create($parametros);
    		//	$resource = '/perfil/local';	 
        //$url = REST.$resource;

        $resource = '/formulario/';	
        $url = REST.$resource.$id;

       // $url = 'http://dev-trazalog.com.ar:8280/services/arboladoDS/formulario/1';

        $array = file_get_contents($url, false, $param);
        
    
       // $vuelta = json_decode($array);

        //var_dump($array);


       return $array;   



    }
}
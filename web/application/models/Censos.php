<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Censos extends CI_Model
{
	function __construct()
	{
		parent::__construct();
    }



    //////////////////////////////// ABM LISTA CENSO 

    // ------------------ GET > Lista censos ------------------

    function listar()
    {
        
        $parametros["http"]["method"] = "GET";
        $parametros["http"]["header"] = "Accept: application/json";			 
        $param = stream_context_create($parametros);
        $resource = '/listacensos';	 	
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        return json_decode($array);
    }

    // ------------------ GET > Lista censistas ------------------

    function listarCensistas()
    {
        
        $parametros["http"]["method"] = "GET";
        $parametros["http"]["header"] = "Accept: application/json";				 
        $param = stream_context_create($parametros);
        $resource = '/listacensistas';	 	
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        return json_decode($array);
    }


    // ------------------ GET > Buscar Censos ID ------------------
    
    function buscaCensos($idcenso)
    {
        //$resource = 'listacensosarmadostodo';
        $parametros["http"]["method"] = "GET";	
        $parametros["http"]["header"] = "Accept: application/json";			 
        $param = stream_context_create($parametros);
        $resource = '/censo/list/porid/'.$idcenso;		 	
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        return json_decode($array);
    }

     // ------------------ GET > FORMULARIO ------------------

    function getFormulario(){
        $parametros["http"]["method"] = "GET";
        $parametros["http"]["header"] = "Accept: application/json";	 
        $param = stream_context_create($parametros);
        $resource = '/formulario/list';	 	
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        return json_decode($array);
    }


    //////////////////////////////// ABM NUEVO CENSO

    // ------------------ POST > Guardar Censo ------------------


    function guardarCenso($data){ 
        log_message('DEBUG', '#MODEL #CENSOS > Guardar_Nuevo  | #DATA: '.json_encode($data));
        
        $parametros["http"]["method"] = "POST";
		$parametros["http"]["header"] = "Accept: application/json";	
		$parametros["http"]["header"] = "Content-Type: application/json";	
		$parametros["http"]["content"] = json_encode($data);	
		$param = stream_context_create($parametros);
        $resource = '/censo';
		$url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        log_message('DEBUG', '#MODEL #CENSOS > Resultado post  | #DATA: '.json_encode($array));
		return json_decode($array);

    }

    // ------------------ POST > Guardar Areas censo ------------------

    function guardarAreaCensos($data){ 
        log_message('DEBUG', '#MODEL #AREA #CENSOS > Guardar_Nuevo  | #DATA: '.json_encode($data));
        
        $parametros["http"]["method"] = "POST";
		$parametros["http"]["header"] = "Accept: application/json";	
		$parametros["http"]["header"] = "Content-Type: application/json";	
		$parametros["http"]["content"] = json_encode($data);	
		$param = stream_context_create($parametros);
        $resource = '/censo/area/add_batch_req';
		$url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        log_message('DEBUG', '#MODEL #CENSOS > Resultado post  | #DATA: '.json_encode($array));
		return json_decode($array);

    }

    // ------------------ POST > Buscar censo ID ------------------


    function buscarCensos($data){ 
        
        log_message('DEBUG', '#MODEL #CENSOS >    | #DATA: '.json_encode($data));
        
        $parametros["http"]["method"] = "GET";
        $parametros["http"]["header"] = "Accept: application/json";
        // $parametros["http"]["header"] = "Content-Type: application/json";	
	
		// $parametros["http"]["content"] = json_encode($data);	
		$param = stream_context_create($parametros);
        $resource = '/censo/list/porid/'.$data;
		$url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        log_message('DEBUG', '#MODEL #CENSOS > Resultado post  | #DATA: '.json_encode($array));
		return json_decode($array);

    }







    // ------------------ POST ------------------

    // function crearCenso()
    // {
    //     $resource = 'listacensosarmadostodo';
    //     $parametros["http"]["method"] = "POST";		 
    //     $param = stream_context_create($parametros);
    //     $resource = '/';		 	
    //     $url = REST.$resource;
    //     $array = file_get_contents($url, false, $param);
    //     return json_decode($array);
    // }
    
    // ------------------ POST ASIGNAR ------------------

    function AsignarCensista($asignar){ 
        
        $aux['cens_us_ar'] = $asignar;
        
        $parametros["http"]["method"] = "PUT";
		$parametros["http"]["header"] = "Accept: application/json";	
		$parametros["http"]["header"] = "Content-Type: application/json";	
		$parametros["http"]["content"] = json_encode($aux);	
		$param = stream_context_create($parametros);
        $resource = '/censo/area/censista/set';
		$url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        
		return json_decode($array);

    }

  
}



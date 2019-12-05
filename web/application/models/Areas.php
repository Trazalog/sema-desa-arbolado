<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Areas extends CI_Model
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
         $resource = '/listaareas';	 	
         $url = REST.$resource;
         $array = file_get_contents($url, false, $param);
        //log_message("DEBUG", "#Areas/ObtenerAreas".json_encode($array));
        //var_dump($array);
         return json_decode($array);
     }

     
     
     function Guardar_Nuevo($data){ 
        
        //log_message('DEBUG', '#MODEL #CENSOS > Guardar_Nuevo  | #DATA: '.json_encode($data));
        
        $parametros["http"]["method"] = "POST";
        $parametros["http"]["header"] = "Accept: application/json";	
        $parametros["http"]["header"] = "Content-Type: application/json";	
        $parametros["http"]["content"] = json_encode($data);	
        $param = stream_context_create($parametros);
        $resource = '/area';
        $url = REST.$resource;
        $array = file_get_contents($url, false, $param);
        //log_message('DEBUG', '#MODEL #CENSOS > Resultado post  | #DATA: '.json_encode($array));
        return json_decode($array);

  }







     # Obtener Informacion de areass por Departamento
     function ObtenerXDepartamentos($depaId)
     {
      # GET Para obtener datos del servicio
      $parametros["http"]["method"] = 'GET';
      $parametros["http"]["header"] = 'Accept: application/json';
      $param = stream_context_create($parametros);
      $resource = '/listaareas/pordepartamento/'.$depaId;	 	
      $url = REST.$resource;

      #Envio MSJ GET
      $array = file_get_contents($url, false, $param);


      log_message("DEBUG", "#Areas/ObtenerXDepartamentos".json_encode($array));
      return json_decode($array);

     }
     
}


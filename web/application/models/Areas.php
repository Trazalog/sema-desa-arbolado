<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Areas extends CI_Model
{
	function __construct()
	{
    parent::__construct();
  }  
  // listado de area y departamentos asociados
  function listar(){

    $resource = '/listadoAreaSimple';
    $url = REST.$resource;
    $array = $this->rest->callAPI("Get", $url);
    return json_decode($array['data']);
  }  

  // listado de areas solo id y nombre para seleccionar 
  function listarAreasTodas(){      
    
    $resource = '/listaareas/todas';
    $url = REST.$resource;
    $array = $this->rest->callAPI("Get", $url);
    return json_decode($array['data']);
  }  

  function Guardar_Nuevo($data){
        
    log_message('DEBUG', 'Areas/Guardar_Nuevo  | #DATA: '.json_encode($data));
    
    $parametros["http"]["method"] = "POST";
    $parametros["http"]["header"] = "Accept: application/json";	
    $parametros["http"]["header"] = "Content-Type: application/json";	
    $parametros["http"]["content"] = json_encode($data);	
    $param = stream_context_create($parametros);
    $resource = '/area_batch_req';
    $url = REST.$resource;
    $array = file_get_contents($url, false, $param);
    log_message('DEBUG', '#MODEL #CENSOS > Resultado post  | #DATA: '.json_encode($array));
    return json_decode($array);
  }
  # Obtener Informacion de areas por Departamento
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

  # Obtener Informacion de areas por Departamento
  function ObtenerXDepaSinAsignar($cens_id, $depa_id)
  {
    # GET Para obtener datos del servicio
    $parametros["http"]["method"] = 'GET';
    $parametros["http"]["header"] = 'Accept: application/json';
    $param = stream_context_create($parametros);
    $resource = '/listaareas/censo/'.$cens_id.'/dep/'.$depa_id;
    $url = REST.$resource;
    #Envio MSJ GET
    $array = file_get_contents($url, false, $param);
    log_message("DEBUG", "#Areas/ObtenerXDepartamentos".json_encode($array));
    return json_decode($array);
  }

  function eliminar($id){

    log_message('DEBUG', 'Areas/eliminar  | #ID: '.json_encode($id));     
    $put_area = array(
			"arge_id"=> $id						
		);
		$data['_put_area_delete'] = $put_area;
    $resource = '/area/delete';
    $url = REST.$resource;
    $array = $this->rest->callAPI("PUT", $url, $data);
    return json_decode($array['code']);
  }

  function editar($data){
    $post['_put_area_actualizar'] = $data;
    $aux = $this->rest->callAPI("PUT",REST."/area/actualizar", $post);
    $aux =json_decode($aux["code"]);
    return $aux;
  }

}


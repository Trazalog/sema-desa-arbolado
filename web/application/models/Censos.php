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
    // listado de censos para dibujar en la tabla
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
			$resource = '/censo';
			$url = REST.$resource;
			$array = $this->rest->callAPI("POST", $url, $data); 		
			log_message('DEBUG', 'Censos/insertAreaCenso->(Resultado Post)->'.json_encode($array));
			return json_decode($array['code']);
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
		// asigna areas a censos
		function insertAreaCenso($data){	

			log_message('DEBUG', 'Censos/insertAreaCenso->($data): '.json_encode($data));			
			$resource = '/censo/area/add';
			$url = REST.$resource;
			$array = $this->rest->callAPI("POST", $url, $data); 		
			log_message('DEBUG', 'Censos/insertAreaCenso->(Resultado Post)->'.json_encode($array));
			return json_decode($array['code']);
		}
    // ------------------ POST > Buscar censo ID ------------------
    function buscarCensos($data){ 
        
        log_message('DEBUG', '#MODEL #CENSOS >    | #DATA: '.json_encode($data));        
        $resource = '/censo/list/porid/'.$data;
        $url = REST.$resource;
        $array = $this->rest->callAPI("GET",$url,  $id); 	
        log_message('DEBUG', '#MODEL #CENSOS > Resultado post  | #DATA: '.json_encode($array));	
        return json_decode($array['data']);
    }   
    // ------------------ POST ASIGNAR ------------------
    function AsignarCensista($data){ 		

			log_message('DEBUG', '#MODEL #CENSOS > Resultado post  | #DATA: '.json_encode($data));

			$censusuario['_put_censo_area_censista_set'] = $data;
			$resource = '/censo/area/censista/set';
			$url = REST.$resource;
			$array = $this->rest->callAPI("PUT",$url,$censusuario); 	
			// log_message('DEBUG', '#MODEL #CENSOS > Resultado post  | #DATA: '.json_encode($array));	
			return json_decode($array['status']);
    }
    // elimina relacion en censos_usuarios_areas
    function eliminar($idrelacion){		

        log_message('DEBUG', '#MODEL #CENSOS | #id Relacion: '.json_encode($idrelacion));
        $censUsAr = array("ceua_id"=> $idrelacion);
        $data['ceusar'] = $censUsAr;
        $resource = '/censos/usuarios/areas';
        $url = REST.$resource;
        $array = $this->rest->callAPI("POST",$url,$data); 	
        log_message('DEBUG', '#MODEL #CENSOS > Eliminar  | #DATA: '.json_encode($array));	
        return json_decode($array['status']);
    }
		//actualiza area por departamento en censo determinado
		function actualizarArea($data)
		{
			$post['_put_censo_actualizar_area_departamento'] = $data;
			log_message('DEBUG','#TRAZA|actualizarArea($data)|$post: >> '.json_encode($post));
			$aux = $this->rest->callAPI("PUT",REST."/censo/actualizar/area/departamento",$data);
			$aux =json_decode($aux["code"]);
			return $aux;
		}
}



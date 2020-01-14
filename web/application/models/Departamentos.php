<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Departamentos extends CI_Model
{
		function __construct()
		{
				parent::__construct();
		}
		// listado departamentos
		function listar()
		{        					
				$resource = '/listadepartamentos';	 
				$url = REST.$resource;
				$array = $this->rest->callAPI("GET",$url); 	
				log_message('DEBUG', 'Departamentos/listadodepartaentos-> ' .json_encode($array));	
				return json_decode($array['data']);
		}
		// Funcion Guardar Nuevo
		function Guardar_Nuevo($data){

				$_post_setdepartamentos = array(
					"nombre"=> $data["nombre"]				
				);

				$datos ['_post_setdepartamentos'] = $_post_setdepartamentos;
				$data = json_encode($datos);

				$parametros["http"]["method"] = "POST";
				$parametros["http"]["header"] = "Accept: application/json";	
				$parametros["http"]["header"] = "Content-Type: application/json";	
				$parametros["http"]["content"] = $data;	
				$param = stream_context_create($parametros);
				$resource = '/setDepartamentos';	 				
				$url = REST.$resource;
				$array = file_get_contents($url, false, $param);
				return json_decode($array);	
		}

		function eliminar($id){

			log_message('DEBUG', 'Departamentos/eliminar  | #ID: '.json_encode($id));     
			$departamento = array(
				"depa_id"=> $id						
			);
			$data['departamento'] = $departamento;	    
			$resource = '/departamentos/delete';
			$url = REST.$resource;
			$array = $this->rest->callAPI("PUT", $url, $data);
			return json_decode($array['code']);
		}
}
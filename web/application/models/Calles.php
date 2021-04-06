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
	// guarda calle nueva
	function Guardar_Nuevo($data){

		$_post_setcalle = array(
			"nombre"=> $data["nombre"],
			"depa_id"=>$data["depa_id"]				
		);
		$datos['_post_setcalle'] = $_post_setcalle;		

		log_message('DEBUG', 'Calles/Guardar_Nuevo(): '.json_encode($datos));   
		$resource = '/setCalle';	 
		$url = REST.$resource;
		var_dump($url);
		$array = $this->rest->callAPI("POST",$url, $datos); 	
		log_message('DEBUG', 'Calles/Guardar_Nuevo respuesta servicio-> ' .json_encode($array));	
		return json_decode($array['data']);

	}

	function borrar($id){

		// log_message('DEBUG', 'Calles/Borrar  | id: '.json_encode($id));
		// $manzana = array(
		// 	"manz_id"=> $id				
		// );
		// $datos['manzana'] = $manzana;
		// $resource = '/manzanas/delete';
    // $url = REST.$resource;
    // $array = $this->rest->callAPI("PUT", $url, $datos);
    // return json_decode($array['data']);
	}

	function editar($data){

		$post['_put_calle_actualizar'] = $data;
		log_message('DEBUG','#TRAZA|CALLE|editar($data) >> '.json_encode($data));
		$aux = $this->rest->callAPI("PUT",REST."/calle/actualizar", $post);
		$aux =json_decode($aux["code"]);
		return $aux;
	}


}
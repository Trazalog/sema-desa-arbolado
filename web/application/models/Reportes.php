<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Reportes extends CI_Model
{
	function __construct()
	{
    parent::__construct();
  }  

// listado del reporte
function listar_reporte($censo_seleccionada, $fecha_desde, $fecha_hasta, $departamento , $area, $manzana){
 
  //select multiple departamento
  $array_dptos = explode(",", $departamento);

     for ($i=0;$i<count($array_dptos);$i++) 
         {
          $datos = "depa_id_list=".$array_dptos[$i];
            $array_contenedor_dptos[] = $datos;
            $str_dato_array = implode("&",$array_contenedor_dptos); 
            $this->session->set_userdata('datos_dptos',$str_dato_array);
           } 

     $datos_dptos = $this->session->userdata('datos_dptos');

      //select multiple area
  $array_area = explode(",", $area);


  for ($i=0;$i<count($array_area);$i++) 
      {
       $datos = "arge_id_list=".$array_area[$i]; 
         $array_contenedor_areas[] = $datos;
         $str_dato_array = implode("&",$array_contenedor_areas); 
         $this->session->set_userdata('datos_arge',$str_dato_array);
        } 

  $datos_arge = $this->session->userdata('datos_arge');

    //select multiple manzana
    $array_manzana = explode(",", $manzana);


    for ($i=0;$i<count($array_manzana);$i++) 
        {
         $datos = "manz_id_list=".$array_manzana[$i]; 
           $array_contenedor_manzanas[] = $datos;
           $str_dato_array = implode("&",$array_contenedor_manzanas); 
           $this->session->set_userdata('datos_manzana',$str_dato_array);
          } 
  
    $datos_manzana = $this->session->userdata('datos_manzana');


$resource = "/arboles/cens_id/$censo_seleccionada/fec_desde/$fecha_desde/fec_hasta/$fecha_hasta?$datos_dptos&$datos_arge&$datos_manzana";
  $url = REST_REPO.$resource;
  $array = $this->rest->callAPI("Get", $url);
  log_message("DEBUG", "#reporte gral 1".json_encode($array));
  return json_decode($array['data']);

  if($array == true){

    log_message('DEBUG', '#TRAZA | #REPORTE >> listar_reporte  >> trae datos');
  }
  else{
    log_message('ERROR', '#TRAZA | #REPORTE >> listar_reporte  >> No trae datos');
  }
}  


# Obtener Informacion de areas por Departamento
function ObtenerXDepartamentos($departamento)
{
  $resource = '/listaareas/pordepartamento/'.$departamento;	 	
  $url = REST.$resource;
  $array = $this->rest->callAPI("Get", $url);

  log_message("DEBUG", "#Areas/ObtenerXDepartamentos".json_encode($array));
  return json_decode($array);
}

  // listado de area y departamentos asociados
  function listar_tabla(){

    $censo_seleccionada = "54";
    $fecha_hoy = date("Y-m-d");
    
      $resource = "/arboles/cens_id/$censo_seleccionada/fec_desde/1990-01-01/fec_hasta/$fecha_hoy";
      $url = REST_REPO.$resource;
      $array = $this->rest->callAPI("Get", $url);
      return json_decode($array['data']);
    }  

    function Detalles($id)
  {

    $parametros["http"]["method"] = "GET";
    $parametros["http"]["header"] = "Accept: application/json";
    $param = stream_context_create($parametros);
  

    $resource = '/formulario/';
    $url = REST . $resource . $id;

    // $url = 'http://dev-trazalog.com.ar:8280/services/arboladoDS/formulario/1';

    $array = file_get_contents($url, false, $param);


    // $vuelta = json_decode($array);

    //var_dump($array);


    return $array;
  }

  function Imagen($id)
  {
    $parametros["http"]["method"] = "GET";
    $parametros["http"]["header"] = "Accept: application/json";
    $param = stream_context_create($parametros);

    $resource = '/arbol/' . $id . '/imagen';
    $url = REST . $resource;
    $array = file_get_contents($url, false, $param);

    return $array;
  }
     
}


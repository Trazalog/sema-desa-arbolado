<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Reportes extends CI_Model
{
	function __construct()
	{
    parent::__construct();
  }  

// listado del reporte total y reporte gral 1
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
 
  if($array['status'] == true){
    log_message("DEBUG", "#reporte gral Trae datos".json_encode($array));
    return json_decode($array['data']);
  }
  else{
    log_message('ERROR', '#TRAZA | #REPORTE >> listar_reporte  >> No trae datos');
    return;
  }
}  


# Obtener Informacion de areas por Departamento
function AreaXdepartamento($departamento)
{
  $count_dptos = count($departamento);
 
  
  for ($i=0;$i<count($departamento);$i++) 
      {
       $datos = "depa_id_list=".$departamento[$i];
         $array_contenedor_dptos[] = $datos;
         $str_dato_array = implode("&",$array_contenedor_dptos); 
        } 

 $datos_dptos = $str_dato_array;

  $resource = '/areasGeograficas/eliminado/0?'.$datos_dptos;	 	
  $url = REST_REPO.$resource;
  $array = $this->rest->callAPI("Get", $url);

  log_message("DEBUG", "#Reporte/AreaXdepartamento".json_encode($array));
  return json_decode($array['data']);
}


   # Obtener Informacion de manzanas por areas
function ManzanaXarea($area)
{
  $count_areass = count($area);
 
  
  for ($i=0;$i<count($area);$i++) 
      {
       $datos = "arge_id_list=".$area[$i];
         $array_contenedor_areas[] = $datos;
         $str_dato_array = implode("&",$array_contenedor_areas); 
     
        } 

 $datos_areas = $str_dato_array;

  $resource = '/manzanas/eliminado/0?'.$datos_areas;	 	
  $url = REST_REPO.$resource;
  $array = $this->rest->callAPI("Get", $url);

  log_message("DEBUG", "#Reporte/ManzanaXarea".json_encode($array));
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


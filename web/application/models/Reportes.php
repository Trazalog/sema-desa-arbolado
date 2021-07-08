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
      $data = json_decode($array['data']);
      return $data->arboles->arbol;
    }
    else{
      log_message('ERROR', '#TRAZA | #REPORTE >> listar_reporte  >> No trae datos');
      return;
    }
}

// listado del reporte reporte gral 2
function listar_reporte_gral2($censo_seleccionada, $fecha_desde, $fecha_hasta, $departamento, $area, $manzana, $calle, $tipo_taza, $especie, $aliniacion_arbol, $estado_sanitario, $tapa_taza_incrustada, $acequia){
  
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


   //////////////////////
   //////////////////////

   //select multiple calles
  $array_calle = explode(",", $calle);


  for ($i=0;$i<count($array_calle);$i++)
    {
     $datos = "call_id_list=".$array_calle[$i];
       $array_contenedor_calle[] = $datos;
       $str_dato_array = implode("&",$array_contenedor_calle);
       $this->session->set_userdata('datos_calle',$str_dato_array);
      } 

  $datos_calle = $this->session->userdata('datos_calle');


  //select multiple tipo taza
  $array_tipo_taza = explode(",", $tipo_taza);
  for ($i=0;$i<count($array_tipo_taza);$i++)
  {
    $datos = "taza_list=".rawurlencode ($array_tipo_taza[$i]);// FIXME: ACA
    $array_contenedor_tipo_taza[] = $datos;
    $str_dato_array = implode("&",$array_contenedor_tipo_taza);
    $this->session->set_userdata('datos_tipo_taza',$str_dato_array);
  }

  $datos_tipo_taza = $this->session->userdata('datos_tipo_taza');


  //select multiple tipo especie
  $array_especie = explode(",", $especie);
  for ($i=0;$i<count($array_especie);$i++)
  {
    $datos = "especie_id_list=".$array_especie[$i];
      $array_contenedor_especie[] = $datos;
      $str_dato_array = implode("&",$array_contenedor_especie);
      $this->session->set_userdata('datos_especie',$str_dato_array);
  }

  $datos_especie = $this->session->userdata('datos_especie');



  //select multiple aliniacion_arbol
  $array_aliniacion_arbol = explode(",", $aliniacion_arbol);
  for ($i=0;$i<count($array_aliniacion_arbol);$i++)
  {
    $datos = "alineacion_list=".rawurlencode ($array_aliniacion_arbol[$i]);
    $array_contenedor_aliniacion_arbol[] = $datos;
    $str_dato_array = implode("&",$array_contenedor_aliniacion_arbol);
    $this->session->set_userdata('datos_aliniacion_arbol',$str_dato_array);
  }

  $datos_aliniacion_arbol = $this->session->userdata('datos_aliniacion_arbol');


  //select multiple estado_sanitario
  $array_estado_sanitario = explode(",", $estado_sanitario);
  for ($i=0;$i<count($array_estado_sanitario);$i++)
  {
    $datos = "estado_list=".$array_estado_sanitario[$i];
    $array_contenedor_estado_sanitario[] = $datos;
    $str_dato_array = implode("&",$array_contenedor_estado_sanitario);
    $this->session->set_userdata('datos_estado_sanitario',$str_dato_array);
  }

  $datos_estado_sanitario = $this->session->userdata('datos_estado_sanitario');

  //select multiple tapa_taza_incrustada
  $array_tapa_taza_incrustada = explode(",", $tapa_taza_incrustada);


  for ($i=0;$i<count($array_tapa_taza_incrustada);$i++)
  {
    $datos = "tapa_list=".$array_tapa_taza_incrustada[$i];
      $array_contenedor_tapa_taza_incrustada[] = $datos;
      $str_dato_array = implode("&",$array_contenedor_tapa_taza_incrustada); 
      $this->session->set_userdata('datos_tapa_taza_incrustada',$str_dato_array);
  }

  $datos_tapa_taza_incrustada = $this->session->userdata('datos_tapa_taza_incrustada');

  //select multiple acequia
  $array_acequia = explode(",", $acequia);


  for ($i=0;$i<count($array_acequia);$i++)
  {
    $datos = "acequia_list=".$array_acequia[$i];
    $array_contenedor_acequia[] = $datos;
    $str_dato_array = implode("&",$array_contenedor_acequia);
    $this->session->set_userdata('datos_acequia',$str_dato_array);
  }

  $datos_acequia = $this->session->userdata('datos_acequia');

  //saco los espacios
  //$datos_tipo_taza = urlencode($datos_tipo_taza);

  $resource = "/arboles/avanzado/cens_id/$censo_seleccionada/fec_desde/$fecha_desde/fec_hasta/$fecha_hasta?$datos_dptos&$datos_arge&$datos_manzana&$datos_calle&$datos_tipo_taza&$datos_aliniacion_arbol&estado_list=$estado_sanitario&$datos_tapa_taza_incrustada&$datos_acequia";

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
 
  
//   for ($i=0;$i<count($departamento);$i++)
//   {
//       $datos = "depa_id_list=".$departamento[$i];
//       $array_contenedor_dptos[] = $datos;
//       $str_dato_array = implode("&",$array_contenedor_dptos);
//   }

//  $datos_dptos = $str_dato_array;

  // $resource = '/areasGeograficas/eliminado/0?'.$datos_dptos;
  $resource = '/areasGeograficas/eliminado/0?depa_id_list='.$departamento;
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

# Obtener Informacion de calles por Departamento
function CallesXdepartamento($departamento)
{
  $count_dptos = count($departamento);
 
  
  for ($i=0;$i<count($departamento);$i++)
      {
       $datos = "depa_id_list=".$departamento[$i];
         $array_contenedor_dptos[] = $datos;
         $str_dato_array = implode("&",$array_contenedor_dptos);
        } 

 $datos_dptos = $str_dato_array;

  $resource = '/calles/eliminado/0?'.$datos_dptos;
  $url = REST_REPO.$resource;
  $array = $this->rest->callAPI("Get", $url);

  log_message("DEBUG", "#Reporte/CallesXdepartamento".json_encode($array));
  return json_decode($array['data']);
}



 // // Listar tipo taza
 public function tipo_taza()
 {
  log_message('DEBUG', 'tipo taza/listar'); 
     $resource = '/tabla/tazas/eliminado/0';
     $url = REST_REPO . $resource;
     $array = $this->rest->callAPI("GET", $url);
     return json_decode($array['data']);
 } 

 //obtiene arbol especie
function listar_arbol_especie()
{		
  log_message('DEBUG', 'Arboles/listar'); 
  $resource = '/tabla/tipo_arbol/eliminado/0'; 
  $url = REST_REPO.$resource;
  $array = $this->rest->callAPI("GET", $url);
  return json_decode($array['data']);
}

 //obtiene alineacion arbol
 function alineacion_arbol()
 {		
   log_message('DEBUG', 'alineacion arbol/listar'); 
   $resource = '/tabla/alineacion_arbol/eliminado/0'; 
   $url = REST_REPO.$resource;
   $array = $this->rest->callAPI("GET", $url);
   return json_decode($array['data']);
 }

 //obtiene estado arbol
 function estado()
 {		
   log_message('DEBUG', 'estado arbol/listar'); 
   $resource = '/tabla/estado/eliminado/0'; 
   $url = REST_REPO.$resource;
   $array = $this->rest->callAPI("GET", $url);
   return json_decode($array['data']);
 }

 //obtiene tazainscrustada arbol
 function taza_inscrustada()
 {		
   log_message('DEBUG', 'taza inscrustada/listar'); 
   $resource = '/tabla/taza_inscrustada/eliminado/0'; 
   $url = REST_REPO.$resource;
   $array = $this->rest->callAPI("GET", $url);
   return json_decode($array['data']);
 }

 //obtiene acequia arbol
 function acequia()
 {		
   log_message('DEBUG', 'acequia/listar'); 
   $resource = '/tabla/acequia/eliminado/0'; 
   $url = REST_REPO.$resource;
   $array = $this->rest->callAPI("GET", $url);
   return json_decode($array['data']);
 }


//detalles del form dinamico
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

  // obtiene imagen de arbol del form dinamico
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
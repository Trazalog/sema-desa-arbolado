<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Censo extends CI_Controller {
  
  function __construct(){

    parent::__construct();
    $this->load->helper('file');
    $this->load->model('Censistas');
    $this->load->model('Departamentos');
    $this->load->model('Areas');
    $this->load->model('Manzanas');
    $this->load->model('Calles');
    $this->load->model('Censos');
    if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/web/Dash')
    {
      $this->session->set_userdata('direccionsalida','sema-desa-arbolado/web/Login');
      logout();
    }     
  }

  // lista censos y permite asignarlos a usuarios y cargarles areas 
  function index(){
    $data['censos'] = $this->Censos->listar()->censos->censo;
    $data['censistas'] = $this->Censos->listarCensistas()->censistas->censista;
    $data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
    $data['titulo'] = 'Lista Censos';
    $data['nombre'] = 'Censista';
    $this->load->view('censo/listar',$data);
    $this->load->view('censo/modal_departamentos',$data);
    $this->load->view('censo/modal_censista',$data);
    $this->load->view('censo/modal_areas_asignar',$data);    
  }

//////////////////////////////// ABM NUEVO CENSO 
  // crea nuevos censos
  function Nuevo(){
    
    //$data['lang'] = lang_get('spanish',5);
    //   $data['areas'] = $this->Areas->listar()->areas->area;
    $data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
    $data['formulario'] = $this->Censos->getFormulario()->formularios->formulario;
    $data['titulo'] = 'Nuevo Censo';
    $data['nombre'] = 'Censista';
    $data['accion'] = 'Nuevo';
    $this->load->view('censo/abm',$data);
    
  }

  // buscar area por departamento
  function getAreaPorDeptoSinAsignar(){   

    $cens_id = $this->input->post('id_censo');
    $depa_id = $this->input->post('id_depto');     
    $areas = $this->Areas->ObtenerXDepaSinAsignar($cens_id, $depa_id)->areas->area;

    echo json_encode($areas);

  }


//////////////////////////////// ABM NUEVO CENSO > GUARDAR

 // guarda un censo nuevo 
 function guardarCenso(){  
    $data['nombre'] = $this->input->post('nombre');
    $data['form_id'] = $this->input->post('form_id');
    log_message('DEBUG', '#censo #guardarCenso'.json_encode($data));
    $censo['_post_censo'] = $data;
    $rsp =  $this->Censos->guardarCenso($censo);
    echo json_encode($rsp);
 }

 function guardarAreaCenso()
 {
     $data = $this->input->post('data');
     log_message('DEBUG', '#censo #guardarAreaCenso'.json_encode($data));
     $rsp =  $this->Censos->guardarAreaCensos($data);
     echo json_encode($rsp);
 }
 // asigna areas a censos
 function insertAreaCenso(){
  
    $data['cens_id'] =  $this->input->post('id_censo');
    $data['arge_id'] =  $this->input->post('id_area');
    $arrayAreaCenso['censo'] = $data; 
    $response = $this->Censos->insertAreaCenso($arrayAreaCenso);
    echo json_encode($response); 
 }


///////////////////////////////// ABM LISTA CENSOS > BUSCAR CENSO
 function buscarCenso()
 {
     $data = $this->input->post('data');
     log_message('DEBUG', '#censo #buscarCensos'.$data);
     $rsp =  $this->Censos->buscarCensos($data)->censos->censo;
     echo json_encode($rsp);
 }



///////////////////////////////// ABM LISTA CENSOS > ASIGNAR CENSISTA
 function AsignarCensista(){  

     $data['usua_id'] = $this->input->post('usua_id');
     $data['arge_id'] = $this->input->post('arge_id');
     $data['cens_id'] = $this->input->post('cens_id');
     log_message('DEBUG', '#AsignarCensista'.json_encode($data));
     $rsp =  $this->Censos->AsignarCensista($data);
     echo json_encode($rsp);
 }
 //elimina censo (relacion en censos_usuarios_areas)
 function eliminar(){
    $response = $this->Censos->eliminar($this->input->post('idrelacion'));
    echo json_encode($response);
 }
}
?>

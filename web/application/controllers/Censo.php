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
  function index(){
    $data['censos'] = $this->Censos->listar()->censos->censo;
    $data['censosarmados'] = $this->Censos->buscaCensos()->censos->censo;
    $data['titulo'] = 'Lista Censos';
    $data['nombre'] = 'Censista';
    $this->load->view('censo/listar',$data);
    
  }

  function Nuevo(){
    
    $data['lang'] = lang_get('spanish',5);
    $data['areas'] = $this->Areas->listar()->areas->area;
    $data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
    $data['formulario'] = $this->Censos->getFormulario()->formularios->formulario;
    $data['titulo'] = 'Nuevo Censo';
    $data['nombre'] = 'Censista';
    $data['accion'] = 'Nuevo';
    $this->load->view('censo/abm',$data);
    
  }
  function Guardar_Nuevo()
  {
      $data = json_decode($this->input->post('data'));
      echo json_encode($data);
  }
}
?>
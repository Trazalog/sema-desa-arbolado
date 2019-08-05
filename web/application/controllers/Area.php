<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {
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
      $data['lista'] = $this->Areas->listar()->areas->area;
      $data['censistas'] = $this->Censistas->listar()->censistas->censista;
      $data['titulo'] = 'ABM Areas geograficas';
      $data['nombre'] = 'Area geografica';
      $this->load->view('area/listar',$data);
      
   }
   function Nuevo(){
      $data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
      $data['areas'] = $this->Areas->listar()->areas->area;
      $data['manzanas'] = $this->Manzanas->listar()->manzanas->manzana;
      $data['calles'] = $this->Calles->listar()->calles->calle;
      $data['lang'] = lang_get('spanish',5);
      $data['titulo'] = 'Nuevo Area';
      $data['accion'] = 'Nuevo';
      $this->load->view('area/abm',$data);
      
   }
   function Guardar_Nuevo()
 {
     $data['nombre'] = $this->input->post('datonombre');
     echo json_encode($data);
 }
}
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calle extends CI_Controller {
   function __construct(){

      parent::__construct();
      $this->load->helper('file');
      $this->load->model('Calles');
      $this->load->model('Departamentos');
      $this->load->model('Areas');
      
      if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/web/Dash')
      {
       $this->session->set_userdata('direccionsalida','sema-desa-arbolado/web/Login');
       logout();
      }
     
   }
   function index(){
      $data['lista'] = $this->Calles->listar()->calles->calle;
      
      $data['titulo'] = 'ABM Calles';
      $data['nombre'] = 'Calle';
      $this->load->view('general/listar',$data);
      
	 }
	 // levanta vista nueva calle
   function Nuevo(){
      $data['titulo'] = 'Nuevo Calle';
      $data['nombre'] = 'Calle';
      $data['accion'] = 'Nuevo';
      $data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
      $data['areas'] = $this->Areas->listar()->areas->area;
      $this->load->view('general/abm',$data);
   }
   // Funcion Guardar Nuevo   
   function Guardar_Nuevo()
   {
     $data['nombre'] = $this->input->post('datonombre');
     $data['depa_id']= $this->input->post('depaId');
     $response = $this->Calles->Guardar_Nuevo($data);
     echo json_encode($response);
   }
}
?>
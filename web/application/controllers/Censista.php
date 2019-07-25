<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Censista extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('file');
      $this->load->model('Censistas');
     
     if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/Dash')
     {
      $this->session->set_userdata('direccionsalida','sema-desa-arbolado/Login');
      logout();
     }
     
   }
   function index(){
      $data['lista'] = $this->Censistas->listar()->censistas->censista;
      $data['titulo'] = 'ABM Censistas';
      $data['nombre'] = 'Censista';
      $this->load->view('general/listar',$data);
      
   }
   function Nuevo(){
    $data['titulo'] = 'Nuevo Censista';
    $data['nombre'] = 'Censista';
    $data['accion'] = 'Nuevo';
    $this->load->view('general/abm',$data);
    
 }
 function Guardar_Nuevo()
 {
     $data['nombre'] = $this->input->post('datonombre');
     $data['apellido'] = $this->input->post('apellido');
     $data['telefono'] = $this->input->post('telefono');
     $data['direccion'] = $this->input->post('direccion');
     echo json_encode($data);
 }
}
?>
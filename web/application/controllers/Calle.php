<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calle extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('file');
      $this->load->model('Calles');
     
     if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/Dash')
     {
      $this->session->set_userdata('direccionsalida','sema-desa-arbolado/Login');
      logout();
     }
     
   }
   function index(){
      $data['lista'] = $this->Calles->listar()->calles->calle;
      $data['titulo'] = 'ABM Calles';
      $data['nombre'] = 'Calle';
      $this->load->view('general/listar',$data);
      
   }
   function Nuevo(){
      $data['titulo'] = 'Nuevo Calle';
      $data['nombre'] = 'Calle';
      $data['accion'] = 'Nuevo';
      $this->load->view('general/abm',$data);
      
   }
   function Guardar_Nuevo()
 {
     $data['nombre'] = $this->input->post('datonombre');
     echo json_encode($data);
 }
}
?>
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Manzana extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('file');
      $this->load->model('Manzanas');
     
     if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/Dash')
     {
      $this->session->set_userdata('direccionsalida','sema-desa-arbolado/Login');
      logout();
     }
     
   }
   function index(){
      $data['lista'] = $this->Manzanas->listar()->manzanas->manzana;
      $data['titulo'] = 'ABM Manzanas';
      $data['nombre'] = 'Manzana';
      $this->load->view('general/listar',$data);
      
   }
   function Nuevo(){
    $data['titulo'] = 'Nuevo Manzana';
    $data['nombre'] = 'Manzana';
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
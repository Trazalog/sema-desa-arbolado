<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Manzana extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('file');
      $this->load->model('Manzanas');
      $this->load->model('Areas');
     
      if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/web/Dash')
      {
       $this->session->set_userdata('direccionsalida','sema-desa-arbolado/web/Login');
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
    $data['lista'] = $this->Areas->listar()->areas->area;
    
    
    $this->load->view('general/abm',$data);
    
   }
   function Guardar_Nuevo()
   {
      $data['nombre'] = $this->input->post('datonombre');
      $data['arge_id'] = $this->input->post('arge_id');

      $response = $this->Manzanas->Guardar_Nuevo($data);
      echo json_encode($response);
   }
}
?>
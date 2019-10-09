<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calle extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('file');
      $this->load->model('Calles');
      $this->load->model('Departamentos');
      
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
   function Nuevo(){
      $data['titulo'] = 'Nuevo Calle';
      $data['nombre'] = 'Calle';
      $data['accion'] = 'Nuevo';
      $data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
      $this->load->view('general/abm',$data);
      
   }
   function Guardar_Nuevo()
   {
     $data['nombre'] = $this->input->post('datonombre');
     $data['depa_id']= $this->input->post('depa_id');
     echo json_encode($data);
   }
}
?>
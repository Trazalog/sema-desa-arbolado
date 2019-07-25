<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departamento extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('file');
      $this->load->model('Departamentos');
     
     if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/Dash')
     {
      $this->session->set_userdata('direccionsalida','sema-desa-arbolado/Login');
      logout();
     }
     
   }
   function index(){
      $data['lista'] = $this->Departamentos->listar()->departamentos->departamento;
      $data['titulo'] = 'ABM Departamentos';
      $data['nombre'] = 'Departamento';
      $this->load->view('general/listar',$data);
      
   }
   function Nuevo(){
      $data['titulo'] = 'Nuevo Departamento';
      $data['nombre'] = 'Departamento';
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
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Arbol extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('file');
      $this->load->model('Arboles');
     
      if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/web/Dash')
     {
      $this->session->set_userdata('direccionsalida','sema-desa-arbolado/web/Login');
      logout();
     }
   }
   function index(){
      $data['lista'] = $this->Arboles->listar()->arboles->arbol;
      $data['titulo'] = 'ABM Tipo de Arboles';
      $data['nombre'] = 'Arbol';
      $this->load->view('general/listar',$data);
      
   }
   function Nuevo(){
      $data['titulo'] = 'Nuevo Arbol';
      $data['nombre'] = 'Arbol';
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
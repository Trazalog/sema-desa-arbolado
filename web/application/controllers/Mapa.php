<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mapa extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('file');
      $this->load->model('Mapas');
     
      if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/web/Dash')
      {
       $this->session->set_userdata('direccionsalida','sema-desa-arbolado/web/Login');
       logout();
      }
     
   }
   function index()
   {
      
      $this->load->view('mapa/mapa');      
   }

   // retorna listado de arboles por id de censo
   function getArbolesCensoId(){
      $cens_id = $this->input->post('cens_id');      
      $data['puntos'] = $this->Mapas->listar($cens_id)->arbol_list->area;   
      echo json_encode($data);
   }
   // retorna formulario de arbol por info_id
   function getDetalle()
   {
      $id = $this->input->post('id');          
      $data['html'] = json_decode($this->Mapas->Detalles($id))->formulario;

      // transforma el json traido del DS en un html que se inserta en el modal formulario
      $data['html'] =  form($data['html']);            
      echo json_encode($data);
   }

}
?>
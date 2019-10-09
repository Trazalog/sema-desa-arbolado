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
      //TODO:LLAMAR AL SERVICE TREE_LIST HECHO NUEVO 

			// $data['puntos'] = $this->Mapas->listar()->puntos->punto;
			$data['puntos'] = $this->Mapas->listar()->arbol_list->area;   
      //var_dump($data);   
      $this->load->view('mapa/mapa',$data);      
   }
   function getDetalle()
   {
      $id = $this->input->post('id');
      $response = $this->Mapas->Detalles($id);
      

      echo json_encode($response);

      // echo json_encode($response->punto);
   }

}
?>
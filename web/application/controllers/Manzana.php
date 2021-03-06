<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Manzana extends CI_Controller {
    function __construct(){

      parent::__construct();
      $this->load->helper('file');
      $this->load->model('Manzanas');
      $this->load->model('Areas');
      $this->load->model('Departamentos');
     
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
			$data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
			$data['areas'] = $this->Areas->listarAreasTodas()->areas->area;  
			$this->load->view('general/abm',$data);    
   }
   //   Funcion Guardar Nuevo
   function Guardar_Nuevo()
   {     
      $data['nombre'] = $this->input->post('datonombre');    
      $data['argeo'] = $this->input->post('argeo');  
			// respuesta ->manz_id
      $response = $this->Manzanas->Guardar_Nuevo($data)->respuesta->manz_id;
      echo json_encode($response);
	 }
	 
   function borrar(){		 
      $response = $this->Manzanas->borrar($this->input->post('id'));
      return json_encode($response);
   }

	function editar(){
		$resp = $this->Manzanas->editar($this->input->post('data'));
		echo json_encode($resp);
	}
}
?>


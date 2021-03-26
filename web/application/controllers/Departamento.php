<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departamento extends CI_Controller {
	function __construct(){

		parent::__construct();
		$this->load->helper('file');
		$this->load->model('Departamentos');
		
		if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/web/Dash')
		{
			$this->session->set_userdata('direccionsalida','sema-desa-arbolado/web/Login');
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

	//   Funcion Guardar Nuevo
	function Guardar_Nuevo()
	{
		$data['nombre'] = $this->input->post('datonombre');
		$resp = $this->Departamentos->Guardar_Nuevo($data);
		echo json_encode($resp);
	}

	// borra departamento
	function eliminar(){
		$resp = $this->Departamentos->eliminar($this->input->post('id'));
		echo json_encode($resp);
	}

	function editar(){
		$resp = $this->Departamentos->editar($this->input->post('data'));
		echo json_encode($resp);
	}

}
?>
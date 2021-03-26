<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {
	function __construct(){

		parent::__construct();
		$this->load->helper('file');
		$this->load->model('Censistas');
		$this->load->model('Departamentos');
		$this->load->model('Areas');
		$this->load->model('Manzanas');
		$this->load->model('Calles');
		$this->load->model('Censos');
		if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/web/Dash')
		{
			$this->session->set_userdata('direccionsalida','sema-desa-arbolado/web/Login');
			logout();
		}
	}
	///////////// INDEX ///////////////
	function index(){

		$data['lista'] = $this->Areas->listar()->areas->area;
		$data['titulo'] = 'ABM Areas geograficas';
		$data['nombre'] = 'Area geografica';
		$this->load->view('area/listar',$data);
	}
	///////////// NUEVO ABM REGISTRO ///////////////	
	function Nuevo(){

		$data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
		$data['areas'] = $this->Areas->listar()->areas->area;
		// $data['manzanas'] = $this->Manzanas->listar()->manzanas->manzana;
		$data['calles'] = $this->Calles->listar()->calles->calle;
		$data['lang'] = lang_get('spanish',5);
		$data['titulo'] = 'Nuevo Area';
		$data['accion'] = 'Nuevo';
		$this->load->view('area/abm',$data);
		
	}  
  // Guardar Nueva Area  
  function Guardar_Nuevo(){

		$data = $this->input->post('data');      
		foreach ($data as $key => $value) {
			$arrayareas['nombre'] = $value['area'];
			$arrayareas['depa_id'] = $value['depa_id'];  
			$detalle['_post_area'][$key] = (object)$arrayareas;    
		}

		$arrayPost['_post_area_batch_req'] = $detalle;      
		$response = $this->Areas->Guardar_Nuevo($arrayPost);
		echo json_encode($response);
  } 
	function ObtenerXdepartamento(){
		//recibe un post del ajax con datos = departamento ID
		$depaId = $this->input->post('depaId');		
		//Llamo al modelo y le mando el id depaId		
		$data= $this->Areas->ObtenerXDepartamentos($depaId);
		echo json_encode($data);
	}

	function eliminar(){
		$response = $this->Areas->eliminar($this->input->post('id'));
		echo json_encode($response);
	}

	function editar(){
		$response = $this->Areas->editar($this->input->post());
		echo json_encode($response);
	}
}
?>
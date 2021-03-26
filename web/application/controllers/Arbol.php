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
  // listado de especies de arbol
  function index(){
    $data['lista'] = $this->Arboles->listar()->arboles->arbol;
    $data['titulo'] = 'ABM Tipo de Arboles';
    $data['nombre'] = 'Arbol';
    $this->load->view('general/listar',$data);    
  }    
  // ABM nueva  especie
  function Nuevo(){
    $data['titulo'] = 'Nueva Especie de Arbol';
    $data['nombre'] = 'Arbol';
    $data['accion'] = 'Nuevo';
    $this->load->view('general/abm',$data);    
  }     
  //   Funcion Guardar Nueva especie de arbol   
  function Guardar_Nuevo()
  {
    $data['nombre'] = $this->input->post('datonombre'); 
    $response = $this->Arboles->Guardar_Nuevo($data);
    echo json_encode($response);
  }
  // borrado de especie
  function borrar(){
    $id = $this->input->post('id');
    $response = $this->Arboles->borrar($id);
    echo json_encode($response);
  }

  function editar(){
		$resp = $this->Arboles->editar($this->input->post('data'));
		echo json_encode($resp);
	}
}
?>
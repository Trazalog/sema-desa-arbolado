<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {
	function __construct(){

		parent::__construct();
		$this->load->helper('file');
		//$this->load->model('Censistas');
		 $this->load->model('Departamentos');
		 $this->load->model('Areas');
		$this->load->model('Manzanas');
		$this->load->model('Calles');
		$this->load->model('Censos');
		$this->load->model('Reportes');
	
      

		if(!isset($this->session->userdata['first_name']) || $this->session->userdata['direccion'] != 'sema-desa-arbolado/web/Dash')
		{
			$this->session->set_userdata('direccionsalida','sema-desa-arbolado/web/Login');
			logout();
		}
	}
	///////////// INDEX ///////////////
	function index(){

	$data['censos'] = $this->Censos->listar()->censos->censo;
	$data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
	//$data['areas'] = $this->Areas->listar()->areas->area;
	//$data['manzanas'] = $this->Manzanas->listar()->manzanas->manzana;
	$this->load->view('reporte/listar_total',$data);	
	}

	function listar_gral_1(){

		$data['censos'] = $this->Censos->listar()->censos->censo;
		$data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
		//$data['areas'] = $this->Areas->listar()->areas->area;
		//$data['manzanas'] = $this->Manzanas->listar()->manzanas->manzana;
		$this->load->view('reporte/listar_gral_1',$data);	
		}
	

	public function buscar_por_filtros()
{
	$censo_seleccionada = $this->input->post('censo_select');
	$fecha_desde = $this->input->post('fec_desde');
	$fecha_hasta = $this->input->post('fec_hasta');
	$newDate_inicio = date("Y-m-d", strtotime($fecha_desde));
	$newDate_fin = date("Y-m-d", strtotime($fecha_hasta));
	echo "OK";
	
}

//buscar por filtros para reporte totoal
public function buscar_por_filtro_listar()
{
	if($_GET)
		{
			$censo_seleccionada = $_GET["cens_id"];
			$fecha_desde = $_GET["fec_desde"];
			$fecha_hasta = $_GET["fec_hasta"];
			$departamento = $_GET["departamento"];
					$area = $_GET["area"];
			$manzana = $_GET["manzana"];
		
			$data['reportes'] = $this->Reportes->listar_reporte($censo_seleccionada, $fecha_desde, $fecha_hasta, $departamento, $area, $manzana)->arboles->arbol;
			
			$this->load->view('reporte/listar_table_reporte',$data);
		}
	else	{
		$censo_seleccionada = $this->input->post('censo_select');
		$fecha_desde = $this->input->post('fec_desde');
		$fecha_hasta = $this->input->post('fec_hasta');
		$departamento = $this->input->post('departamento');
		$area = $this->input->post('area');
		$manzana = $this->input->post('manzana');

			$data['reportes'] = $this->Reportes->listar_reporte($censo_seleccionada, $fecha_desde, $fecha_hasta, $departamento, $area, $manzana)->arboles->arbol;
			$this->load->view('reporte/listar_table_reporte',$data);
		}
}

//buscar por filtros para reporte gral 1
public function buscar_por_filtro_listar_gral_1()
{
	if($_GET)
		{
			$censo_seleccionada = $_GET["cens_id"];
			$fecha_desde = $_GET["fec_desde"];
			$fecha_hasta = $_GET["fec_hasta"];
			$departamento = $_GET["departamento"];
					$area = $_GET["area"];
			$manzana = $_GET["manzana"];
		
			$data['reportes'] = $this->Reportes->listar_reporte($censo_seleccionada, $fecha_desde, $fecha_hasta, $departamento, $area, $manzana)->arboles->arbol;
			
			$this->load->view('reporte/listar_table_reporte_gral_1',$data);
		}
	else	{
		$censo_seleccionada = $this->input->post('censo_select');
		$fecha_desde = $this->input->post('fec_desde');
		$fecha_hasta = $this->input->post('fec_hasta');
		$departamento = $this->input->post('departamento');
		$area = $this->input->post('area');
		$manzana = $this->input->post('manzana');

			$data['reportes'] = $this->Reportes->listar_reporte($censo_seleccionada, $fecha_desde, $fecha_hasta, $departamento, $area, $manzana)->arboles->arbol;
			$this->load->view('reporte/listar_table_reporte_gral_1',$data);
		}
}

function AreaXdepartamento(){
	if($_GET){	
		$departamento = $_GET["departamento"];

		$data['areas'] = $this->Reportes->AreaXdepartamento($departamento)->areas->area;
		}
	else	{

	$departamento = $this->input->post('departamento');


	$data['areas'] = $this->Reportes->AreaXdepartamento($departamento)->areas->area;
	echo json_encode($data);
}
}


function ManzanaXarea(){
	if($_GET){	
		$area = $_GET["area"];

		$data['manzanas'] = $this->Reportes->ManzanaXarea($area)->manzanas->manzana;

		}
	else	{

	$area = $this->input->post('area');
					

	$data['manzanas'] = $this->Reportes->ManzanaXarea($area)->manzanas->manzana;
	echo json_encode($data);
}
}

		// retorna formulario de arbol por info_id
		function getDetalle()
		{
			$id = $this->input->post('id');
			$data['html'] = json_decode($this->Reportes->Detalles($id))->formulario;

			// transforma el json traido del DS en un html que se inserta en el modal formulario
			$data['html'] =  form($data['html']);
			echo json_encode($data);
		}
		function getImagen()
		{
			$id = $this->input->post('id');
			$data['html'] = json_decode($this->Reportes->Imagen($id))->imagenes->imagen;

			echo json_encode($data);
		}


		
  } 
?>
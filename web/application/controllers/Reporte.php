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
	$this->load->view('reporte/listar_total',$data);	
	}

	function listar_gral_1(){

		$data['censos'] = $this->Censos->listar()->censos->censo;
		$data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
			$this->load->view('reporte/listar_gral_1',$data);	
		}

	function listar_gral_2(){

		$data['censos'] = $this->Censos->listar()->censos->censo;
		$data['departamentos'] = $this->Departamentos->listar()->departamentos->departamento;
		$data['tipo_taza'] = $this->Reportes->tipo_taza()->tablas->tabla;
		$data['listar_arbol_especie'] = $this->Reportes->listar_arbol_especie()->tablas->tabla;
		$data['alineacion_arbol'] = $this->Reportes->alineacion_arbol()->tablas->tabla;
		$data['estado'] = $this->Reportes->estado()->tablas->tabla;
		$data['taza_inscrustada'] = $this->Reportes->taza_inscrustada()->tablas->tabla;
		$data['acequia'] = $this->Reportes->acequia()->tablas->tabla;

		$this->load->view('reporte/listar_gral_2',$data);	
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


//buscar por filtros para reporte gral 2
public function buscar_por_filtro_listar_gral_2()
{
	if($_GET)
		{
			$censo_seleccionada = $_GET["cens_id"];
			$fecha_desde = $_GET["fec_desde"];
			$fecha_hasta = $_GET["fec_hasta"];
			$departamento = $_GET["departamento"];
			$area = $_GET["area"];
			$manzana = $_GET["manzana"];

			$calle = $_GET["calle"];
			$tipo_taza = $_GET["tipo_taza"];
			$especie = $_GET["especie"];
			$aliniacion_arbol = $_GET["aliniacion_arbol"];
			$estado_sanitario = $_GET["estado_sanitario"];
			$tapa_taza_incrustada = $_GET["tapa_taza_incrustada"];
			$acequia = $_GET["acequia"];

		
			$data['reportes'] = $this->Reportes->listar_reporte_gral2($censo_seleccionada, $fecha_desde, $fecha_hasta, $departamento, $area, $manzana, $calle, $tipo_taza, $especie, $aliniacion_arbol, $estado_sanitario, $tapa_taza_incrustada, $acequia)->arboles->arbol;
			
			$this->load->view('reporte/listar_table_reporte_gral_2',$data);
		}
	else	{
		$censo_seleccionada = $this->input->post('censo_select');
		$fecha_desde = $this->input->post('fec_desde');
		$fecha_hasta = $this->input->post('fec_hasta');
		$departamento = $this->input->post('departamento');
		$area = $this->input->post('area');
		$manzana = $this->input->post('manzana');

		$calle = $this->input->post('calle');
		$tipo_taza = $this->input->post('tipo_taza');
		$especie = $this->input->post('especie');
		$aliniacion_arbol = $this->input->post('aliniacion_arbol');
		$estado_sanitario = $this->input->post('estado_sanitario');
		$tapa_taza_incrustada = $this->input->post('tapa_taza_incrustada');
		$acequia = $this->input->post('acequia');

		$data['reportes'] = $this->Reportes->listar_reporte($censo_seleccionada, $fecha_desde, $fecha_hasta, $departamento, $area, $manzana, $calle, $tipo_taza, $especie, $aliniacion_arbol, $estado_sanitario, $tapa_taza_incrustada, $acequia)->arboles->arbol;
			
			$this->load->view('reporte/listar_table_reporte_gral_2',$data);
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

function CallesXdepartamento(){
	if($_GET){	
		$departamento = $_GET["departamento"];

		$data['calles'] = $this->Reportes->CallesXdepartamento($departamento)->calles->calle;
		}
	else	{

	$departamento = $this->input->post('departamento');


	$data['calles'] = $this->Reportes->CallesXdepartamento($departamento)->calles->calle;
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
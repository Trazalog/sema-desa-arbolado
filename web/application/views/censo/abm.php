<?php $this->load->view('censo/modal_departamentos')?>
<?php $this->load->view('censo/modal_areas')?>
<?php $this->load->view('area/modal_calles')?>


	<div class="box">
			<div class="box-header bg-green">
					<h3 class="box-title"><?php echo $titulo;?></h3>

			</div><!-- /.box-header -->

			<div class="box-body">

					<form class="formCenso" id="formCenso">

							<div class="col-md-12">

									<div class="form-group">

											<div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
													<label for="Nombre" class="form-label">Nombre Censo:</label>
													<input type="text" name="texto" id="Nombre"
															<?php if($accion == 'Editar'){echo ('value="'.$etapa->lote.'"');}?> class="form-control"
															placeholder="Inserte nombre del Censo" />
											</div>

											<div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
													<label for="Nombre" class="form-label">Formulario:</label>
													<select name="select" id="id_form" class="form-control">
															<option value="-1" disabled selected>-Seleccione Formulario-</option>
															<?php foreach($formulario as $fila)
															{
																echo  "<option value='".$fila->form_id."'>".$fila->nombre.'</option>';
															}                                
													?>
													</select>
											</div>

									</div>

							</div>

							<div class="col-md-12">
									<br>
							</div>
					</form>
							<div class="col-md-12">
								<button type="button" class="btn tn-primary pull-right" onclick="guardarCensoNuevo()">GUARDAR</button>
							</div>

			</div>

	</div>

</body>


<script>

function guardarCensoNuevo(){

	nombre = $('#Nombre').val();
	id_form = $('#id_form').val();

	if(nombre == "" || id_form == "-1"){
		Swal.fire('Por favor rellene el campo Nombre Censo...');
		return;
	}
	if(id_form == null){
		Swal.fire('Por favor seleccione formulario...');
		return;
	}

	$.ajax({
        type: 'POST',
        data: {				
            nombre: nombre,				
						form_id: id_form
        },
        url: 'Censo/guardarCenso',
        success: function(result) {
                           Swal.fire({
								text: 'El Censo fue guardado Correctamente',
								icon: 'success',
								confirmButtonText: 'Ok',
									});
                linkTo();                           
						//var cens_id = JSON.parse(result).respuesta.cens_id;
            //agregarAreaCenso(cens_id, array);
        },
        error: function() {
            Swal.fire("Cancelado", "No se pudo guardar intente nuevamente", "error");
        }
    });
}

</script>

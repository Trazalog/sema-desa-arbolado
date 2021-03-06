<div class="box">

    <div class="box-header bg-green">
        <h3 class="box-title"><?php echo $titulo;?></h3>
    </div><!-- /.box-header -->

    <div class="box-body">
        <form role="form" id="formulario">


            <div class="form-group" style="width:40%">
                <label class="form-label">Censo:</label>
                <select name="select" class="form-control select2" style="width: 100%;" id="Nombre" class="form-control" onchange="buscaCensos()">
                    <option value="" disabled selected>-Seleccione Censo-</option>
                    <?php
                        foreach($censos as $fila)
                        {
                           echo '<option data-json=\''.json_encode($fila).'\' value="'.$fila->id.'">'.$fila->nombre.'</option>' ;
                        }
                        ?>
                </select>
						</div>	

						<div class="row">

                <div class="col-md-12">
                    <button type="button" class="btn btn-primary pull-left"
												onclick="AgregarArea()">Agregar Areas Geográficas</button>									
								</div>
						</div>			

            <!-- TABLA CENSOS -->

            <div id="divcensos">
                <div class="row" style="margin-top:25px">
                    <div class="col-xs-12">
                        <table id="censos" class="table">
                            <thead bgcolor="#eeeeee">
                                <tr>
                                    <th>Acciones</th>
                                    <th>Departamento</th>
                                    <th>Area Geografica</th>
                                    <th>Asignado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- _________________SEPARADOR_________________ -->

            <div class="col-md-12">
                <hr>
            </div>

            <!-- _________________SEPARADOR_________________ -->
            <div class="row">	</div>
						
        </form>


    </div>
</div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row -->
</body>

<?php 
$this->load->view('censo/modal_censista');
$this->load->view('censo/modal_areas_asignar');


?>

<script>

	$(document).ready(function() {
					$('#censos').DataTable({
							responsive: true,
							language: {
									url: '<?php base_url() ?>lib/bower_components/datatables.net/js/es-ar.json' //Ubicacion del archivo con el json del idioma.
							}
					});
	});

	$(document).off('click', '.asignar_censista').on('click', '.asignar_censista', function() {
			TrActual = $(this).parents('tr');
			$('#modal_censista').modal('show');
	});

	function AgregarArea(){
		id = document.getElementById('Nombre').value;
		if(id<=0 || id==null){
		
			Swal.fire("Error", "Debe seleccionar un censo para poder agregar Area..'", "error");
									
		}else{
			$('#modal_areas_asignar').modal('show');
		}
	}


	function buscaCensos() {
			wo();
			id = document.getElementById('Nombre').value; 
			var tablaCensos = $('#censos').DataTable();
			tablaCensos.clear().draw();

			$.ajax({
					type: 'POST',
					data: {
							data: id           
					},
					url: 'Censo/buscarCenso',
					success: function(result) {
							censos = JSON.parse(result);
						
							if (censos != null) {
									console.log(censos);
									for (i = 0; i < censos.length; i++) {

											if (id == censos[i].idcenso) {
													tr = "";
													tr += "<tr class='"+ censos[i].idrelacion +"' id='" + censos[i].idcenso + "' data-json='" + JSON.stringify(censos[i]) +
															"'>";
													tr += '<td>';
													//<i class="fa fa-fw fa-pencil text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Editar"></i>';
													tr +=
															'<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="eliminar('+censos[i].idrelacion+')"></i>';
													tr +=
															'<i class="fa fa-fw fa fa-user text-light-blue asignar_censista" style="cursor: pointer; margin-left: 15px;" title="Asignar/Cambiar Censista" data-toggle="modal" data-target="#modal_censista"></i></td>';
													tr += "<td>" + censos[i].nombredepartamento + "</td>";
													tr += "<td>" + censos[i].nombreareageo + "</td>";
													if(censos[i].nombreusuario != null){
														tr += "<td>" + censos[i].nombreusuario + "</td>";
													}else{
														tr += "<td>Sin asignar</td>";
													}										
													tr += "</tr>";

													tablaCensos.row.add($(tr)).draw();
											}
									}
							}

							wc();
					},
					error: function() {
						wc();
							alert('Error');
					}
			}); 
	}

	function eliminar(idrelacion){
		//alert(idrelacion);
		$.ajax({
					type: 'POST',
					data: {
						idrelacion: idrelacion
					},
					url: 'Censo/eliminar',
					success: function(result) {
				
							Swal.fire({
								title: 'Estas Seguro de Eliminar este Registro del Censo?',
								text: "No podras revertir este proceso!",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Si, Eliminar!'
							}).then((result) => {
								if (result.value) {
									Swal.fire({
										text: '"Eliminado!","El Registro ha sido eliminado!"',
										icon: 'success',
										confirmButtonText: 'Ok',
									})
									setTimeout(function () {
										$('#censos tbody').find('tr.'+idrelacion).remove();
									}, 3000); 
								
								} else {
									Swal.fire("Cancelado", "El Reclamo está a salvo! :)", "error");
								}

							});

						

					},
					error: function() {
						Swal.fire("Cancelado", "No se pudo eliminar el censo...'", "error");
									}
		});  

	}
</script>

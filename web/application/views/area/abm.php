<?php $this->load->view('area/modal_calles')?>
<?php $this->load->view('censo/modal_areas')?>
<div class="box">
      <div class="box-header bg-green ">
          <h3 class="box-title"><?php echo $titulo;?></h3>
      </div><!-- /.box-header -->

      <div class="box-body">

        <form role="form" id="formulario">

          <div class="form-group">
            <div class="col-md-6">
							<label  class="form-label">Area geografica:</label>
							<input  id="inputareas" class="form-control" autocomplete="off" placeholder="Inserte nombre de Area">
            </div>
          </div>

					<div class="col-md-6">

							<div class="form-group"  >
								<label  class="form-label">Departamento:</label>
								<select  name="select"  id="Nombre" class="form-control">
									<option value="" disabled selected>-Seleccione Departamento-</option>
									<?php
									foreach($departamentos as $fila)
									{
											echo '<option value="'.$fila->id.'">'.$fila->nombre.'</option>' ;
									}
									?>
								</select>
							</div>
					</div>

          <div class="col-md-12">
						<hr>
						<span class="input-group-btn">
								<button class='btn btn-primary pull-right '
								onclick='AgregarArea()'>
								Agregar</button>
						</span>
					</div>
				</form>
      </div>


</div>



</body>


<div class="box">
	<div class="row" style="margin-top:25px">
		<div class="box-body table-scroll">

			<div class="col-md-12">
					<table id="manzanas_asignadas" class="table">
							<thead bgcolor="#eeeeee" color="#fff" align="center">
									<tr>
											<th>Acciones</th>
											<th>Area Geografica</th>
											<th>Departamento</th>
									</tr>
							</thead>
							<tbody>
							</tbody>
					</table>
			</div>

			<!-- _________________SEPARADOR_________________ -->
				<div class="col-md-12">
					<hr>
				</div>
			<!-- _________________SEPARADOR_________________ -->

			<div class="col-md-12"> <button type="button" class="btn btn-primary pull-right" onclick="Guardar_Nuevo()">GUARDAR</button> </div>

		</div>
	</div>
</div>

<script>

  var manzanasAsignadas=$('#manzanas_asignadas').DataTable();
  $(document).ready(function() {
    $('#formulario').bootstrapValidator({
        message: 'Este Valor no es valido',
        fields: {
            select: {
                message: 'El Nombre ingresado no es valido',
                validators: {
                    notEmpty: {
                        message: 'Seleccione algun Valor'
                    }
                }
            },
            texto: {
                message: 'El Nombre ingresado no es valido',
                validators: {
                    notEmpty: {
                        message: 'Ingreso algun Valor'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'El nombre solo puede usar caracteres alfabeticos o numericos'
                    }
                }
            }
        }
    })
	});

	function Guardar_Nuevo() {

		var arrayarge = []
		var arrayarea;  
		//Extraer de la Tabla cada JSON
		$('#manzanas_asignadas tbody tr').each(function() {
					var json = JSON.parse(this.dataset.json);
					arrayarge.push(json);
		});
		console.log(arrayarge);

			$.ajax({
				type: 'POST',
				dataType: "json",
				data: {
						data: arrayarge
				},
				url: 'Area/Guardar_Nuevo',          
				success: function(result) {

						linkTo('Area');		
						// var arge_id = JSON.parse(result).respuesta.arge_id;
						// agregarAreaCenso(cens_id, array);
				},
				error: function() {
						alert('Error');
				}
		});

	}

	function checkTabla(idtabla, idrecipiente, json, acciones)
	{
		lenguaje = <?php echo json_encode($lang)?>;
		if(document.getElementById(idtabla)== null)
		{
			armaTabla(idtabla,idrecipiente,json,lenguaje,acciones);
		}
	}

	function MuestraCalles()
	{
			if(document.getElementById('checkcalles').checked)
			{
					document.getElementById('divcalles').hidden = false;
			}else{
					document.getElementById('divcalles').hidden = true;
			}
	}

	function AgregarArea()
	{
			// Varaibles de datos de los campos a listar
			var data = {};
			data.area = $('#inputareas').val();
			data.departamento = $('#Nombre').find('option:selected').html();
			data.depa_id = $('#Nombre').val();
			
			tr="";
			tr+="<tr data-json='"+JSON.stringify(data)+"' data-calles=''>";
			tr+="<td><i class='fa fa-fw fa-minus text-light-blue manzanas_asignadas_borrar' style='cursor: pointer; margin-left: 15px;' title='Eliminar'></i>";
			tr+="<i class='fa fa-fw fa-plus text-light-blue manzanas_asignadas_calle' style='cursor: pointer; margin-left: 15px;' title='Asignar Calles'></i>";
			tr+="<i class='fa fa-fw fa-search text-light-blue manzanas_asignadas_ver' style='cursor: pointer; margin-left: 15px;' title='Ver Calles'></i></td>";
			tr+="<td>"+data.area+"</td><td>"+data.departamento+"</td></tr>";
			manzanasAsignadas.row.add($(tr)).draw();

			// Limpiar Campos
			data.area = $('#inputareas').val('');
			data.departamento = $('#Nombre').val('');
	}

	$(document).off('click','.manzanas_asignadas_borrar').on('click', '.manzanas_asignadas_borrar', function(){
			var tableRow = manzanasAsignadas.row($(this).parents('tr'));
			manzanasAsignadas.row( tableRow ).remove().draw();
	});

	$(document).off('click','.manzanas_asignadas_calle').on('click', '.manzanas_asignadas_calle', function(){
			checkTabla("tablacalles","modalcalles",`<?php echo json_encode($calles);?>`,"Add");
			TrActual= $(this).parents('tr');
			$('#modal_calles').modal('show');
	});

</script>

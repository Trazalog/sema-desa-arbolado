<style>
    .dt-button {
        padding: 0;
        border: none;
    }

    #WindowLoad {
        position: fixed;
        top: 0px;
        left: 0px;
        z-index: 3200;
        filter: alpha(opacity=65);
        -moz-opacity: 65;
        opacity: 0.65;
        background: #000000;
    }
</style>

<div class="box">
    <div class="box-header bg-green">
        <h3 class="box-title">Reporte Total - Arboles Censados</h3>

    </div><!-- /.box-header -->


    <div class="box-body">
        <!-- /// ----------------------------------- FORMULARIO ----------------------------------- /// -->
        <form id="form">
            <div class="row">

                <div class="form-group col-md-12" style="width:30%">
                    <label for="censo_select">Censo:</label>
                    <select id="censo_select" name="censo_select" class="form-control" required>
                        <option value="">-Seleccione Censo-</option>
                        <?php foreach($censos as $fila)
											{
												echo  "<option value='".$fila->id."'>".$fila->nombre.'</option>';    
											} 
										?>
                    </select>

                </div>

                <div class="form-group col-md-2" >

                    <label for="fec_desde" class="col-6 col-form-label">Fecha Desde:</label>
                    <input class="form-control" type="date" id="fec_desde" name="fec_desde" required>

                </div>

                <div class="form-group col-md-2" >

                    <label for="fec_hasta" class="col-6 col-form-label">Fecha Hasta:</label>
                    <input class="form-control" type="date" id="fec_hasta" name="fec_hasta" required>

                </div>

            </div><!-- /.row -->
            <div class="row">

                <div class="form-group col-md-2">
                    <label for="departamento" class="col-6 col-form-label">Departamento:</label>
                    <div class="input-group date" id="carg" class="col-md-2">
                        <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                        <select class="form-control" id="departamento" name="departamento" data-live-search="true" title="Seleccione Departamento" data-actions-box="true" style="width: 50%;" data-style="btn-success" data-count="<?php echo count($departamentos);?>" required>
                            <option value="" disabled>-Seleccione Departamento-</option>
														<!-- <option value="TODOS">Todos los Departamentos</option> -->
                            <?php
																	foreach($departamentos as $fila)
																	{
																		echo '<option value="'.$fila->id.'">'.$fila->nombre.'</option>' ;
																	}
														?>
                        </select>
												<!-- <select class="form-control" id="departamento" name="departamento" title="Seleccione Departamento" style="width: 50%;" data-style="btn-success" data-count="<?php //echo count($departamentos);?>" required>
                            <option value="" disabled>-Seleccione Departamento-</option>
														<option value="0">Todos los Departamentos</option>
                            <?php
																	// foreach($departamentos as $fila)
																	// {
																	// 	echo '<option value="'.$fila->id.'">'.$fila->nombre.'</option>' ;
																	// }
														?>
                        </select> -->
                    </div>
                </div>
                </div><!-- /.row -->
                <div class="row">
									<div class="form-group col-md-3" style="width:20%">
											<label for="area" style="margin-left:10px">Area:</label>
											<div class="input-group date" id="c" class="col-md-2">
													<div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
													<select class="form-control" id="area" name="area" multiple="multiple" title="Seleccione Area" data-actions-box="true"
															style="width: 500%;" data-style="btn-success" data-count="" required>
													</select>
											</div>
									</div>
                </div>
                <div class="row">
									<div class="form-group col-md-3">
											<label for="manzana" style="margin-left:10px">Manzana:</label>
											<div class="col-md-6 col-xs-12 input-group">
													<div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
													<select class="form-control selectpicker" id="manzana" name="manzana" multiple="multiple" data-actions-box="true"
															title="Seleccione Manzana" style="width: 500%;" data-style="btn-success" data-count=""
															required>
													</select>
											</div>
									</div>
                </div>
                <div class="row">

                    <div class="col-md-8">
                    </div>

                    <div class="col-md-4">
                        <br>
                        <button id="btn_buscar_filtros" type="button"
                            class="btn btn-success waves-effect waves-light mt-2" style="margin-top: 1rem;">Listar
                            Coincidencias</button>
												<button id="btn_exportar" type="button" class="btn btn-success waves-effect waves-light mt-2"
											style="margin-top: 1rem;">Exportar Info Departamento</button>
                    </div>

                    <div class="col-xs-12">
                        <hr>
                    </div>

                    <div class="col-md-12 table-responsive" id="cargar_tabla"></div>
                    <div class="row">

                    </div><!-- /.box-body -->
                </div><!-- /.row -->
            </div><!-- /.col -->
        </form>
    </div><!-- /box-body -->

</body>

<script>
   	$('select').selectpicker({
			selectAllText: 'Todos',
			deselectAllText: 'Nada'
		});

    function jsRemoveWindowLoad() {
        // eliminamos el div que bloquea pantalla
        $("#WindowLoad").remove();

    }

    $(document).ready(function() {
        $("#WindowLoad").remove();
        $(this).click(jsShowWindowLoad('Se esta Generando la Información'));
        setTimeout(() => {
            jsRemoveWindowLoad();
        }, 100);
    });

    function jsShowWindowLoad(mensaje) {
        //eliminamos si existe un div ya bloqueando
        jsRemoveWindowLoad();

        //si no enviamos mensaje se pondra este por defecto
        if (mensaje === undefined) mensaje = "Procesando la información<br/>Espere por favor";

        //centrar imagen gif
        height = 20; //El div del titulo, para que se vea mas arriba (H)
        var ancho = 0;
        var alto = 0;

        //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
        if (window.innerWidth == undefined) ancho = window.screen.width;
        else ancho = window.innerWidth;
        if (window.innerHeight == undefined) alto = window.screen.height;
        else alto = window.innerHeight;

        //operación necesaria para centrar el div que muestra el mensaje
        var heightdivsito = alto / 2 - parseInt(height) / 2; //Se utiliza en el margen superior, para centrar

        //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
        imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div  style='color:#1C2833;margin-top:" +
            heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje +
            "</div><img  src='<?php echo base_url(); ?>assets/img/Isologo.png'></div>";

        //creamos el div que bloquea grande------------------------------------------
        div = document.createElement("div");
        div.id = "WindowLoad"
        div.style.width = ancho + "px";
        div.style.height = alto + "px";
        $("body").append(div);

        //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
        input = document.createElement("input");
        input.id = "focusInput";
        input.type = "text"

        //asignamos el div que bloquea
        $("#WindowLoad").append(input);

        //asignamos el foco y ocultamos el input text
        $("#focusInput").focus();
        $("#focusInput").hide();

        //centramos el div del texto
        $("#WindowLoad").html(imgCentro);

    }

    $('#departamento').change(function() {

			    $('#area').empty();
			    $('#area').prop('disabled', false);
			    $('#area').selectpicker('refresh');

			    var departamento = $("#departamento").val();
			    var leng_departamentos = departamento.length;
			    contador_departamento = $('#departamento').attr('data-count');

			    if (leng_departamentos == 1) {
			        var departamento = $("#departamento").val();
			    } else if (leng_departamentos == contador_departamento) {
			        var departamento = "0";
			    }  else {
			        var departamento = $("#departamento").val();
			    }

			    console.log(departamento);
			    var url = "Reporte/AreaXdepartamento?departamento=" + departamento;
			    console.log(url)

					wo();
			    $.ajax({
			        type: 'POST',
			        data: {
			            departamento
			        },
			        url: 'index.php/Reporte/AreaXdepartamento',
			        success: function(data) {
								wc();
			            var datos = JSON.parse(data);
			            var contador_area = datos.areas.length;
			            $('#area').attr('data-count', contador_area);

			            for (i = 0; i < datos.areas.length; i++) {
			                $('#area').prepend('<option value=' + datos.areas[i].id + '>' + datos.areas[i]
			                    .nombre + '</option>');
			            }

			        },
			        error: function(data) {
									wc();
			            alert('Error');
			        },
			        complete: function(data) {
									wc();
			            $('#area').selectpicker('refresh');
			            return;
			        }
			    });

    }); // end buscar area x dpto

    $('#area').change(function() {

        $('#manzana').empty();
        $('#manzana').prop('disabled', false);
        $('#manzana').selectpicker('refresh');

        var area = $("#area").val();
        var leng_areas = area.length;
        contador_area = $('#area').attr('data-count');
      
            if (leng_areas == 1) {
                var area = $("#area").val();
            }   else if (leng_areas == contador_area) {
                var area = "0";
            } else {
                var area = $("#area").val();
            }

        console.log(area);
        var url = "Reporte/ManzanaXarea?area=" + area;
        console.log(url);

				wo();
        $.ajax({
            type: 'POST',
            data: {
                area
            },
            url: 'index.php/Reporte/ManzanaXarea',
            success: function(data) {
							wc();
                var datos = JSON.parse(data);
                var contador_manzana = datos.manzanas.length;
                $('#manzana').attr('data-count', contador_manzana);
                for (i = 0; i < datos.manzanas.length; i++) {
                    $('#manzana').prepend('<option value=' + datos.manzanas[i].id + '>' + datos
                        .manzanas[i].nombre + '</option>');
                }
								
            },
            error: function(data) {
								wc();
                alert('Error');
            },
            complete: function(data) {
								wc();
                $('#manzana').selectpicker('refresh');
                return
            }
        });
    }); // end buscar manzana x area

    $("#btn_buscar_filtros").click(function(e) {

			var censo_select = $("#censo_select").val();
			var fec_desde = $("#fec_desde").val();
			var fec_hasta = $("#fec_hasta").val();
			var departamento = $("#departamento").val();
			var area = $("#area").val();
			var manzana = $("#manzana").val();

			if (censo_select == "" || departamento == "" || fec_desde == "" || fec_hasta == "" || area == "" ||
					manzana == "") { //muestras el botón

					Swal.fire({
							icon: 'error',
							title: 'Campos Vacios...',
							text: 'Completa todos los Campos para generar el Reporte!!',
					})
					return;

			} else { //no muestras el botón

				//conteo de arrays
				var leng_departamentos = departamento.length;

				var leng_areas = area.length;

				var leng_manzanas = manzana.length;

				contador_departamento = $('#departamento').attr('data-count');

				if (leng_departamentos == 1) {
				var departamento = $("#departamento").val();
            
        } else if (leng_departamentos == contador_departamento) {
          
            var departamento = "0";

        }  else {
            var departamento = $("#departamento").val();
        }
				//////////

				contador_area = $('#area').attr('data-count');

				if (leng_areas == 1) {
					var area = $("#area").val();
				}   else if (leng_areas == contador_area) {
					var area = "0";
				} else {
					var area = $("#area").val();
				}
				//////////

				contador_manzana = $('#manzana').attr('data-count');

				if (leng_manzanas == 1){
						var manzana = $("#manzana").val();
				}
				else if (leng_manzanas == contador_manzana) {
						var manzana = "0";
				} else {
						var manzana = $("#manzana").val();
				}

				console.log(censo_select)
				console.log(fec_desde)
				console.log(fec_hasta)
				console.log(departamento)
				console.log(area)
				console.log(manzana)
				console.log("count array dptos:", leng_departamentos)
				console.log("count array areas:", leng_areas)
				console.log("count array manzanas:", leng_manzanas)

				var url = "Reporte/buscar_por_filtro_listar?cens_id=" + censo_select + "&fec_desde=" + fec_desde +
						"&fec_hasta=" + fec_hasta + "&departamento=" + departamento + "&area=" + area + "&manzana=" +
						manzana;

				console.log(url);

				$("#WindowLoad").remove();

        $(this).click(jsShowWindowLoad('Se esta Generando la Información'));


				$.ajax({
						type: 'POST',
						data: {
								censo_select,
								fec_desde,
								fec_hasta,
								departamento,
								area,
								manzana
						},
						url: 'index.php/Reporte',
						success: function(data) {
								debugger;
								$("#cargar_tabla").load("<?php echo base_url(); ?>" + url + "");
								
						},
						error: function(data) {
								
								alert('Error');
						},
						complete: function(data) {

								setTimeout(() => {
										jsRemoveWindowLoad();
								}, 9000);
								$('select').selectpicker('deselectAll');
								$("#form")[0].reset();
								wc();
						}
				});
    	}

    }); // END BUSCAR


		$("#btn_exportar").click(function(e) {

			var censo_select = $("#censo_select").val();
			var fec_desde = $("#fec_desde").val();
			var fec_hasta = $("#fec_hasta").val();
			var departamento = $("#departamento").val();
			var area = "0";
			var manzana = "0";

			if (censo_select == "" || departamento == "" || fec_desde == "" || fec_hasta == "") { //muestras el botón

					Swal.fire({
							icon: 'error',
							title: 'Campos Vacios...',
							text: 'Completa todos los Campos para generar el Reporte!!',
					})
					return;

			} else {

					var url = "Reporte/reporteTotalExcel?cens_id=" + censo_select + "&fec_desde=" + fec_desde +	"&fec_hasta=" + fec_hasta + "&departamento=" + departamento + "&area=" + area + "&manzana=" + manzana;

					console.log(url);

					// abro nueva pestaña y traigo excel
					url = "<?php echo base_url(); ?>" + url;
					window.open(url);
			}
		});

</script>


</div>
</div>
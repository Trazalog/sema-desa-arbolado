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

<div class="box" style="width:77%">
    <div class="box-header bg-green">
        <h3 class="box-title">Reporte General 2 - Arboles Censados</h3>

    </div><!-- /.box-header -->


    <div class="box-body">
        <!-- /// ----------------------------------- FORMULARIO ----------------------------------- /// -->
        <form id="form" method>
            <div class="row">

                <div class="form-group col-md-5" style="width:30%">
                    <label for="censo_select">Censo:</label>
                    <select id="censo_select" name="censo_select" class="form-control" required>
                        <option value="" disabled selected>-Seleccione Censo-</option>
                        <?php foreach($censos as $fila)
											{
												echo  "<option value='".$fila->id."'>".$fila->nombre.'</option>';    
											} 
										?>
                    </select>

                </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="form-group col-md-2" style="width:15%">

                    <label for="fec_desde" class="col-6 col-form-label">Fecha Desde:</label>
                    <input class="form-control" type="date" id="fec_desde" name="fec_desde" required>

                </div>

                <div class="form-group col-md-2" style="width:15%">

                    <label for="fec_hasta" class="col-6 col-form-label">Fecha Hata:</label>
                    <input class="form-control" type="date" id="fec_hasta" name="fec_hasta" required>

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

</div><!-- /box-body -->



<!-- Left side column. contains the logo and sidebar -->
<aside class="control-sidebar control-sidebar-dark control-sidebar-open" style="width:20%">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header" style="height: 5px;"></li>
            <!-- Optionally, you can add icons to the links -->

            <li class="">
                <label for="departamento" class="col-6 col-form-label">Departamento:</label>
                <div class="input-group date" id="carg" class="col-md-2">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                    <select class="form-control" id="departamento" name="departamento" multiple="multiple"
                        data-live-search="true" title="Seleccione Departamento" data-actions-box="true"
                        style="width: 50%;" data-style="btn-success" data-count="<?php echo count($departamentos);?>"
                        required>
                        <option value="" disabled  style="background: #5cb85c; color: #fff;">-Seleccione Departamento-</option>
                        <?php
                                          foreach($departamentos as $fila)
                                          {
                                            echo '<option value="'.$fila->id.'" style="background: #5cb85c; color: #fff;">'.$fila->nombre.'</option>' ;
                                          }
                                    ?>
                    </select>
                </div>
                <br>
            </li>
            <li class="">
                <label for="area" style="margin-left:10px">Area:</label>
                <div class="input-group date" id="c" class="col-md-2">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                    <select class="form-control" id="area" name="area" multiple="multiple" data-live-search="true"
                        title="Seleccione Area" data-actions-box="true" style="width: 500%;" data-style="btn-success"
                        data-count="" required>
                     <!--   <option value="" disabled style="background: #5cb85c; color: #fff;">Seleccione Area</option> -->
                    </select>
                </div>
            </li>
            <br>
            <li class="">
                <label for="manzana" style="margin-left:10px">Manzana:</label>
                <div class="col-md-6 col-xs-12 input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                    <select class="form-control selectpicker" id="manzana" name="manzana" multiple="multiple"
                        data-live-search="true" title="Seleccione Manzana" data-actions-box="true" style="width: 500%;"
                        data-style="btn-success" data-count="" required>
                    </select>
                </div>
            </li>
            <br>
            <li class="">
                <label for="calle" style="margin-left:10px">Calle:</label>
                <div class="col-md-6 col-xs-12 input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                    <select class="form-control selectpicker" id="calle" name="calle" multiple="multiple"
                        data-live-search="true" title="Seleccione Calle" data-actions-box="true" style="width: 500%;"
                        data-style="btn-success" data-count="" required>
                    </select>
                </div>
            </li>
            <br>
            <li class="">
                <label for="tipo_taza" style="margin-left:10px">Tipo de Taza:</label>
                <div class="col-md-6 col-xs-12 input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                    <select class="form-control selectpicker" id="tipo_taza" name="tipo_taza" multiple="multiple"
                        data-live-search="true" title="Seleccione Manzana" data-actions-box="true" style="width: 500%;"
                        data-style="btn-success" data-count="" required>
                        <?php 
                                        if(is_array($tipo_taza)){
                                            foreach ($tipo_taza as $i) {
                                                echo "<option value = $i->valor style='background: #5cb85c; color: #fff;'>$i->valor</option>";
                                              }
                                        }
                                        ?>
                    </select>
                </div>
            </li>
            <br>
            <li class="">
                <label for="especie" style="margin-left:10px">Especie:</label>
                <div class="col-md-6 col-xs-12 input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                    <select class="form-control selectpicker" id="especie" name="especie" multiple="multiple"
                        data-live-search="true" title="Seleccione Manzana" data-actions-box="true" style="width: 500%;"
                        data-style="btn-success" data-count="" required>
                                              <?php 
                                        if(is_array($listar_arbol_especie)){
                                            foreach ($listar_arbol_especie as $i) {
                                                echo "<option value = $i->valor style='background: #5cb85c; color: #fff;'>$i->valor</option>";
                                              }
                                        }
                                        ?>
                    </select>
                </div>
            </li>
            <br>
            <li class="">
                <label for="aliniacion_arbol" style="margin-left:10px">Alineacion del Arbol:</label>
                <div class="col-md-6 col-xs-12 input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                    <select class="form-control selectpicker" id="aliniacion_arbol" name="aliniacion_arbol"
                        multiple="multiple" data-live-search="true" title="Seleccione Manzana" data-actions-box="true"
                        style="width: 500%;" data-style="btn-success" data-count="" required>
                        <?php 
                                        if(is_array($alineacion_arbol)){
                                            foreach ($alineacion_arbol as $i) {
                                                echo "<option value = $i->valor style='background: #5cb85c; color: #fff;'>$i->valor</option>";
                                              }
                                        }
                                        ?>
                    </select>
                </div>
            </li>
            <br>
            <li class="">
                <label for="estado_sanitario" style="margin-left:10px">Estado Sanitario:</label>
                <div class="col-md-6 col-xs-12 input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                    <select class="form-control selectpicker" id="estado_sanitario" name="estado_sanitario"
                        multiple="multiple" data-live-search="true" title="Seleccione Manzana" data-actions-box="true"
                        style="width: 500%;" data-style="btn-success" data-count="" required>
                        <?php 
                                        if(is_array($estado)){
                                            foreach ($estado as $i) {
                                                echo "<option value = $i->valor style='background: #5cb85c; color: #fff;'>$i->valor</option>";
                                              }
                                        }
                                        ?>
                    </select>
                </div>
            </li>
            <br>
            <li class="">
                <label for="tapa_taza_incrustada" style="margin-left:10px">Tapa Taza Incrustada:</label>
                <div class="col-md-6 col-xs-12 input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                    <select class="form-control selectpicker" id="tapa_taza_incrustada" name="tapa_taza_incrustada"
                        multiple="multiple" data-live-search="true" title="Seleccione Manzana" data-actions-box="true"
                        style="width: 500%;" data-style="btn-success" data-count="" required>
                        <?php 
                                        if(is_array($taza_inscrustada)){
                                            foreach ($taza_inscrustada as $i) {
                                                echo "<option value = $i->valor style='background: #5cb85c; color: #fff;'>$i->valor</option>";
                                              }
                                        }
                                        ?>
                    </select>
                </div>
            </li>
            <br>
            <li class="">
                <label for="acequia" style="margin-left:10px">Acequia:</label>
                <div class="col-md-6 col-xs-12 input-group">
                    <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                    <select class="form-control selectpicker" id="acequia" name="acequia" multiple="multiple"
                        data-live-search="true" title="Seleccione Manzana" data-actions-box="true" style="width: 500%;"
                        data-style="btn-success" data-count="" required>
                        <?php 
                                        if(is_array($acequia)){
                                            foreach ($acequia as $i) {
                                                echo "<option value = $i->valor style='background: #5cb85c; color: #fff;'>$i->valor</option>";
                                              }
                                        }
                                        ?>
                    </select>
                </div>
            </li>
            <br>
            <li>
                <button id="btn_buscar_filtros" type="button" class="btn btn-success waves-effect waves-light mt-2"
                    style="margin-top: 1rem;">Listar Coincidencias</button>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
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
    }, 10000);
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
        debugger;
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

        console.log(departamento)

        var url = "Reporte/AreaXdepartamento?departamento=" + departamento;

        console.log(url)

        $.ajax({
            type: 'POST',
            data: {
                departamento
            },
            url: 'index.php/Reporte/AreaXdepartamento',
            success: function(data) {
                var datos = JSON.parse(data);

                var contador_area = datos.areas.length;
                $('#area').attr('data-count', contador_area);


                for (i = 0; i < datos.areas.length; i++) {
                    $('#area').prepend('<option style="background: #5cb85c; color: #fff"; value=' + datos.areas[i].id + '>' + datos.areas[i]
                        .nombre + '</option>');

                }

            },
            error: function(data) {
                alert('Error');
            },
            complete: function(data) {

                $('#area').selectpicker('refresh');

                return
            }
        });

    }); // end buscar area x dpto

    $('#area').change(function() {
        $('#manzana').empty();
        $('#manzana').prop('disabled', false);
        $('#manzana').selectpicker('refresh');
debugger;
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

        console.log(area)

        var url = "Reporte/ManzanaXarea?area=" + area;

        console.log(url)

        $.ajax({
            type: 'POST',
            data: {
                area
            },
            url: 'index.php/Reporte/ManzanaXarea',
            success: function(data) {
                var datos = JSON.parse(data);

                var contador_manzana = datos.manzanas.length;
                $('#manzana').attr('data-count', contador_manzana);

                for (i = 0; i < datos.manzanas.length; i++) {
                    $('#manzana').prepend('<option style="background: #5cb85c; color: #fff"; value=' + datos.manzanas[i].id + '>' + datos
                        .manzanas[i].nombre + '</option>');
                }
                
            },
            error: function(data) {
                alert('Error');
            },
            complete: function(data) {

                $('#manzana').selectpicker('refresh');
                return
            }
        });
    }); // end buscar manzana x area

// select multiple de departamento al cambiar trae las calles
$('#manzana').change(function() {
    $('#calle').empty();
    $('#calle').prop('disabled', false);
    $('#calle').selectpicker('refresh');

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

    console.log(departamento)

    //calles
    var url1 = "Reporte/CallesXdepartamento?departamento=" + departamento;

    console.log(url1)

    $.ajax({
        type: 'POST',
        data: {
            departamento
        },
        url: 'index.php/Reporte/CallesXdepartamento',
        success: function(data) {
            var datos = JSON.parse(data);
            debugger;
            var contador_calle = datos.calles.length;
            $('#calle').attr('data-count', contador_calle);

            for (i = 0; i < datos.calles.length; i++) {
                $('#calle').prepend('<option  style="background: #5cb85c; color: #fff"; value=' + datos.calles[i].nombre + '>' + datos.calles[
                    i].nombre + '</option>');

            }

        },
        error: function(data) {
            alert('Error');
        },
        complete: function(data) {

            $('#area').selectpicker('refresh');

            return
        }
    });

}); // end buscar calles x dptos


$("#btn_buscar_filtros").click(function(e) {
    debugger;
    var censo_select = $("#censo_select").val();
    var fec_desde = $("#fec_desde").val();
    var fec_hasta = $("#fec_hasta").val();
    var departamento = $("#departamento").val();
    var area = $("#area").val();
    var manzana = $("#manzana").val();

    var calle = $("#calle").val();
    var tipo_taza = $("#tipo_taza").val();
    var especie = $("#especie").val();
    var aliniacion_arbol = $("#aliniacion_arbol").val();
    var estado_sanitario = $("#estado_sanitario").val();
    var tapa_taza_incrustada = $("#tapa_taza_incrustada").val();
    var acequia = $("#acequia").val();


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

        var leng_calle = calle.length;

        var leng_tipo_taza = tipo_taza.length;

        var leng_especie = especie.length;

        var leng_aliniacion_arbol = aliniacion_arbol.length;

        var leng_estado_sanitario = estado_sanitario.length;

        var leng_tapa_taza_incrustada = tapa_taza_incrustada.length;

        var leng_acequia = acequia.length;

////////////
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

        if (leng_manzanas == 1) {
            
            var manzana = $("#manzana").val();

        }else if (leng_manzanas == contador_manzana) {
            var manzana = "0";
        } else {
            var manzana = $("#manzana").val();
        }

        contador_calle = $('#calle').attr('data-count');

        if (leng_calle == contador_calle) {
            var calle = "0";
        } else {
            var calle = $("#calle").val();
        }

        contador_tipo_taza = $('#tipo_taza').attr('data-count');

        if (leng_tipo_taza == contador_tipo_taza) {
            var tipo_taza = "TODOS";
        } else {
            var tipo_taza = $("#tipo_taza").val();
        }

        contador_especie = $('#especie').attr('data-count');

        if (leng_especie == contador_especie) {
            var especie = "TODOS";
        } else {
            var especie = $("#tipo_taza").val();
        }


        contador_aliniacion_arbol = $('#aliniacion_arbol').attr('data-count');

        if (leng_aliniacion_arbol == contador_aliniacion_arbol) {
            var aliniacion_arbol = "TODOS";
        } else {
            var aliniacion_arbol = $("#tipo_taza").val();
        }

        contador_estado_sanitario = $('#estado_sanitario').attr('data-count');

        if (leng_estado_sanitario == contador_estado_sanitario) {
            var estado_sanitario = "TODOS";
        } else {
            var estado_sanitario = $("#tipo_taza").val();
        }


        contador_tapa_taza_incrustada = $('#tapa_taza_incrustada').attr('data-count');

        if (leng_tapa_taza_incrustada == contador_tapa_taza_incrustada) {
            var tapa_taza_incrustada = "TODOS";
        } else {
            var tapa_taza_incrustada = $("#tipo_taza").val();
        }


        contador_acequia = $('#acequia').attr('data-count');

        if (leng_acequia == contador_acequia) {
            var acequia = "TODOS";
        } else {
            var acequia = $("#tipo_taza").val();
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


        var url = "Reporte/buscar_por_filtro_listar_gral_2?cens_id=" + censo_select + "&fec_desde=" +
            fec_desde +
            "&fec_hasta=" + fec_hasta + "&departamento=" + departamento + "&area=" + area + "&manzana=" +
            manzana + "&calle=" + calle + "&tipo_taza=" + tipo_taza + "&especie=" + especie +
            "&aliniacion_arbol=" + aliniacion_arbol + "&estado_sanitario=" + estado_sanitario + "&tapa_taza_incrustada=" + tapa_taza_incrustada + "&acequia=" + acequia;

        console.log(url)

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

            }
        });
    }





}); // END BUSCAR

function validarFormulario() {
    $("#form").validate({
        ignore: ":hidden:not(.selectpicker)",

        rules: {
            censo_select: {
                required: true

            },
            fec_desde: {
                required: true
            },
            fec_hasta: {
                required: true
            },
            departamento: {
                required: true
            },
            area: {
                required: true
            },
            manzana: {
                required: true
            }


        },
        messages: {
            censo_select: {
                required: "Debe seleccionar Censo"
            },
            fec_desde: {
                required: "Debe seleccionar Fecha"

            },
            fec_hasta: {
                required: "Debe seleccionar Fecha"
            },
            departamento: {
                required: "Debe seleccionar Departamento"
            },
            area: {
                required: "Debe seleccionar Area"
            },
            manzana: {
                required: "Debe seleccionar Manzana"
            }
        },

        submitHandler: function(form) {

            form.submit();

        }
    });
};
</script>




</div>
</div>
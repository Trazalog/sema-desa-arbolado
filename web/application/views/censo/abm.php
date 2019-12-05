<?php $this->load->view('censo/modal_departamentos')?>
<?php $this->load->view('censo/modal_areas')?>
<?php $this->load->view('area/modal_calles')?>


<div class="box">
    <div class="box-header bg-green">
        <h3 class="box-title"><?php echo $titulo;?></h3>

    </div><!-- /.box-header -->


    <div class="box-body">
        <!--.box-body -->

        <!-- /// ----------------------------------- FORMULARIO ----------------------------------- /// -->

        <form class="formCenso" id="formCenso">

            <!-- ____________________________ GRUPO 1 ____________________________ -->

            <div class="col-md-12">

                <div class="form-group">

                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <label for="Nombre" class="form-label">Nombre Censo:</label>
                        <input type="text" name="texto" id="Nombre"
                            <?php if($accion == 'Editar'){echo ('value="'.$etapa->lote.'"');}?> class="form-control"
                            placeholder="Inserte nombre del Censo" />
                    </div>

                    <!-- ________________________________________________________ -->

                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <label style="margin-left:10px" for="Nombre" class="form-label">Seleccione Fecha:</label>
                        <input type="date" name="texto" id="Fecha" class="form-control" />
                    </div>

                    <!-- ________________________________________________________ -->

                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <label for="Nombre" class="form-label">Formulario:</label>



                        <select name="select" id="Nombree" class="form-control">
                            <option value="" disabled selected>-Seleccione Formulario-</option>

                            <?php foreach($formulario as $fila)
                            {
                                echo  "<option value='".$fila->form_id."'>".$fila->nombre.'</option>';    
                            }                                
                        ?>
                        </select>

                    </div>

                    <!-- ________________________________________________________ -->

                </div>

            </div>

            <div class="col-md-12">
                <br>
            </div>

            <!-- ____________________________ GRUPO 2 ____________________________ -->

            <div class="col-md-12">

                <div class="form-group">

                    <div class="col-md-6 col-sm-6 mb-4 mb-lg-0">

                        <label style="margin-left:10px" for="">Departamento:</label>
                        <div class="col-md-12  input-group" style="margin-left:15px">

                            <input list="departamentos" id="inputdepartamentos" placeholder="Seleccione departamento"
                                class="form-control" autocomplete="off">

                            <datalist id="departamentos">
                                <?php foreach($departamentos as $fila)
                            {
                                echo  "<option data-json='".json_encode($fila)."' value='".$fila->nombre."'>";
                            }
                                ?>
                            </datalist>


                            <span class="input-group-btn">
                                <button class='btn btn-primary' data-toggle="modal" data-target="#modal_departamentos">
                                    <i class="glyphicon glyphicon-search"></i></button>
                            </span>

                        </div>
                    </div>


                    <!-- ____________________________ ROW____________________________ -->

                    <div class="col-md-6 col-sm-6 mb-4 mb-lg-0">
                        <label for="" style="margin-left:10px">Area:</label>
                        <div class="col-md-12  input-group" style="margin-left:15px">
                            <input list="areas" id="inputareas" class="form-control" autocomplete="off"
                                placeholder="Seleccione Area">
                            <datalist id="areas">


                            </datalist>
                            <span class="input-group-btn">
                                <button class='btn btn-primary' data-toggle="modal" data-target="#modal_areas">
                                    <i class="glyphicon glyphicon-search"></i></button>
                            </span>
                        </div>
                    </div>




                    <!-- <div class="form-group">
                    <div class="col-md-4">
                    
                    
                
                        <label for="" style="margin-left:10px">Formulario:</label>
                        <div class="col-md-12  input-group" style="margin-left:15px">
                            <input list="form" id="form" class="form-control" autocomplete="off" placeholder="Seleccione Formulario" onchange="">
                            <datalist id="form">
                            <?php foreach($formulario as $form)
                            {
                                echo  "<option data-json='".json_encode($form)."'value='".$form->form_id."'>";
                            }
                                ?>
                            </datalist>
                            <span class="input-group-btn">
                                <button class='btn btn-primary' 
                                data-toggle="modal" data-target="#modal_areas">
                                <i class="glyphicon glyphicon-search"></i></button>
                                </span> 
                                </div>
                                </div>
                    </div>

                </div> -->










                    <div class="col-md-12">
                        <hr>
                    </div>




                </div>


                <!-- ____________________________ ROW____________________________ -->


                <div class="col-md-12">


                    <button type="button" class="btn-sm btn-primary pull-right"
                        onclick="AgregarAreaInput()">Aceptar</button>


                </div>




        </form>









        <!-- ____________________________ GUARDAR ____________________________ -->



    </div>


    <!-- /// ----------------------------------- FIN FORMULARIO ----------------------------------- /// -->


</div><!-- /.box-body -->

</div><!-- /.box -->

</div><!-- /.col -->


<!-- /// ----------------------------------- FIN FORMULARIO ----------------------------------- /// -->

<!-- ///////////////////////////////////////// TABLAS /////////////////////////////////////////-->

<div class="box">

    <div class="row" style="margin-top:25px">
        <div class="box-body table-scroll">

            <div class="col-md-12">
                <table class="table" id="tablaareasasignadas">
                    <thead bgcolor="#eeeeee">
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


            <div class="col-md-12"> <button type="button" class="btn btn-primary pull-right"
                    onclick="guardarCenso()">GUARDAR</button></div>

        </div>

    </div>


</div><!-- /.box -->


<!-- ///////////////////////////////////////// TABLAS /////////////////////////////////////////-->

</div><!-- /.row -->
</body>

<!-- ///////////////////////////////////////// SCRIPT TABLAS /////////////////////////////////////////-->



<script>

TablaAsignadas = $('#tablaareasasignadas').DataTable();
$('#tablaareas').DataTable();
$('#tabladepartamentos').DataTable();
$(document).ready(function() {
    $('#formulario').bootstrapValidator({
        message: 'Este Valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            texto: {
                message: 'El Nombre ingresado no es valido',
                validators: {
                    notEmpty: {
                        message: 'Ingrese algun Valor'
                    }
                }
            }
        }
    });
});

///////////////////////////////////////// SCRIPT /////////////////////////////////////////-->


///////////////////////////////////////// FUNCIONES /////////////////////////////////////////-->


//<!-- ____________________________ GUARDAR ____________________________ -->


function Guardar() {
    $('#formulario').bootstrapValidator('validate');
    estado = $('#formulario').data('bootstrapValidator').isValid();

    if (estado) {
        data = {};
        data.nombre = document.getElementById('Nombre').value;
        data.fecha = document.getElementById('Fecha').value;
        data = JSON.stringify(data);
        //console.log(data);
        $.ajax({
            type: 'POST',
            data: {
                data: data
            },
            url: 'Censo/Guardar_Nuevo',
            success: function(result) {
                linkTo('Censo');
            }
        });

    }
}


// ______________________________________AJAX POST____________________________

function guardarCenso() {
    
    var array = [];
    var arraycenso = [];

    $('#tablaareasasignadas tbody tr').each(function() {
        var json = JSON.parse(this.dataset.json);
        array.push(json);
    });


    var datosCenso = JSON.parse('{ "_post_censo": {"nombre": "' + $('#Nombre').val() + '", "form_id": "' + $("#Nombree")
        .val() + '"}}');
    arraycenso.push(datosCenso);
  
  console.log(arraycenso)

    $.ajax({
        type: 'POST',
        data: {
            data: arraycenso[0]
        },
        url: 'Censo/buscarCenso',
        success: function(result) {
            var cens_id = JSON.parse(result).respuesta.cens_id;
            agregarAreaCenso(cens_id, array);
        },
        error: function() {
            alert('Error');
        }
    });
}

function agregarAreaCenso(cens_id, array) {

    cens_id = '"cens_id": "'+ cens_id+'"';
    var jsonInicio = '{"areas":{"area":[';
    var jsonFinal = ']}}';
    var dato = '';
    array.forEach(function(elemento, index) {
        if(index < array.length - 1){
            dato = dato+'{'+cens_id+ ',"arge_id": "'+elemento.id+'"},';
        }else{
            dato = dato+'{'+cens_id+ ',"arge_id": "'+elemento.id+'"}';
        }
    });
    var jsonfinal = jsonInicio+dato+jsonFinal;
    jsonfinal = JSON.parse(jsonfinal);

    $.ajax({
        type: 'POST',
        data: {
            data: jsonfinal
        },
        url: 'Censo/guardarAreaCenso',
        success: function(result) {
            console.log(result);
        },
        error: function() {
            alert('Error');
        }
    });
}



//<!-- ____________________________ AJAX - POST  ____________________________ -->


$('#inputdepartamentos').on('change', function() {


    var nombreDepa = this.value;
    var json = $('#departamentos').find('[value="' + nombreDepa + '"]').attr('data-json');
    json = JSON.parse(json);
    var depaId = json.id;




    //AJAX 

    $.ajax({
        type: 'POST',
        dataType: 'JSON',

        data: {
            depaId: json.id
        },
        url: 'Area/ObtenerXDepartamento',
        success: function(rsp) {
            //console.log(rsp);
            //alert('Hecho');
            $('#areas').find('option').remove();
            $('#inputareas').val('');
            rsp.areas.area.forEach(function(e) {

                $('#areas').append("<option data-json='" + JSON.stringify(e) + "' value='" +
                    e.nombre + "'></option");

            });

        },
        error: function(rsp) {
            alert('Error');
        },
        complete: function(rsp) {
            //alert('Siempre me ejecuto');
        }
    });

});

//<!-- ____________________________ AJAX - POST  ____________________________ -->


//<!-- ____________________________ AGREGAR AREA  ____________________________ -->

function AgregarArea(area) {

    tr = "";
    tr += "<tr data-json='" + JSON.stringify(area) + "'>";
    tr +=
        "<td><i class='fa fa-fw fa-minus text-light-blue tablas_asignadas_borrar' style='cursor: pointer; margin-left: 15px;' title='Eliminar'></i>";
    tr +=
        "<i class='fa fa-fw fa-plus text-light-blue tablas_asignadas_calle' style='cursor: pointer; margin-left: 15px;' title='Asignar Calles'onclick=\$('#modal_calles').modal('show')\></i>";
    tr +=
        "<i class='fa fa-fw fa-search text-light-blue tablas_asignadas_ver' style='cursor: pointer; margin-left: 15px;' title='Ver Calles'></i></td>";
    tr += "<td>" + area.nombre + "</td>"
    tr += "<td>" + area.departamento + "</td></tr>";
    TablaAsignadas.row.add($(tr)).draw();
}

$(document).off('click', '.tablas_asignadas_borrar').on('click', '.tablas_asignadas_borrar', function() {
    var tableRow = TablaAsignadas.row($(this).parents('tr'));
    TablaAsignadas.row(tableRow).remove().draw();
});


//<!-- ____________________________ AGREGAR AREA ____________________________ -->


function AgregarAreaInput() {
    ban = $("#areas option[value='" + $('#inputareas').val() + "']").length;

    if (ban == 0) {
        alert('Area Incorrecta');
    } else {
        area = JSON.parse($("#areas option[value='" + $('#inputareas').val() + "']").attr('data-json'));
        //console.log(area);
        AgregarArea(area);
    }
}


//<!-- ____________________________ AGREGAR DEPARTAMENTO ____________________________ -->


function AgregarDepartamentoInput() {
    ban = $("#departamentos option[value='" + $('#inputdepartamentos').val() + "']").length;
    if (ban == 0) {
        alert('Departamento Incorrecto');
    } else {
        departamento = JSON.parse($("#departamentos option[value='" + $('#inputdepartamentos').val() + "']")
            .attr('data-json'));

        areas = [];
        for (i = 0; i < areas.length; i++) {
            if (departamento.id == areas[i].iddepartamento) {

                AgregarArea(areas[i]);
            }
        }
    }
}
</script>


<!-- ///////////////////////////////////////// SCRIPT /////////////////////////////////////////-->
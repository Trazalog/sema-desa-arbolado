<?php $this->load->view('censo/modal_areas')?>
<?php $this->load->view('censo/modal_departamentos')?>


<!--_________________________.TITULOS._________________________ -->

<div class="box">
    <div class="box-header bg-green">
        <h3 class="box-title"><?php echo $titulo;?></h3>

    </div>
    <!--_________________________.Box Body._________________________ -->

    <div class="box-body ">

        <!--_________________________. FORMULARIO._________________________ -->

        <form role="form" id="formulario">

            <div class="form-group" style="width:40%">

                <label for="Nombre" class="form-label"><?php echo $nombre;?>:</label>
                <input type="text" name="texto" id="Nombre"
                    <?php if($accion == 'Editar'){echo ('value="'.$etapa->lote.'"');}?> class="form-control"
                    placeholder="Inserte nombre del <?php echo $nombre;?>" />


            </div>


            <!-- //////////////////////////////////////////////////////////////////////////////////////// DEPARTAMENTOS //////////////////////////////////////////////////////////////////////////////////////// -->



            <form class="formDepartamentos" id="formDepartamentos">

                <div class="form-group">

                    <?php  if($nombre == 'Departamento'){?>



                    <!--_____________________________________________-->

                    <div class="col-md-12">

                        <hr>

                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary pull-right"
                                onclick="Guardar('<?php echo $nombre;?>')">Aceptar</button>
                        </span>
                    </div>

                    <!--******************************************-->


                    <?php } ?>


            </form>

    </div>


    <!-- //////////////////////////////////////////////////////////////////////////////////////// DEPARTAMENTOS //////////////////////////////////////////////////////////////////////////////////////// -->


    <!-- //////////////////////////////////////////////////////////////////////////////////////// CALLES //////////////////////////////////////////////////////////////////////////////////////// -->


    <form class="formCalles" id="formCalles">

        <div class="form-group">

            <?php  if($nombre == 'Calle'){?>

            <!--******************************************-->

            <div class="col-md-12">


                <div class="col-md-6">

                    <label style="margin-left:10px" for="">Departamento:</label>
                    <div class="col-md-12  input-group" style="margin-left:15px">

                        <select name="select" id="depa_id" class="form-control">
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

                <!--_____________________________________________-->

                <div class="col-md-6 ">

                    <label for="" style="margin-left:10px">Area:</label>
                    <div class="col-md-12  input-group" style="margin-left:15px">
                        <input list="areas" id="inputareas" class="form-control" autocomplete="off"
                            placeholder="Seleccione Area" onchange="AgregarAreaInput()">
                        <datalist id="areas">
                            <?php foreach($areas as $fila)
								{
									echo  "<option data-json='".json_encode($fila)."'value='".$fila->nombre."'>";
								}
									?>
                        </datalist>
                        <span class="input-group-btn">
                            <button class='btn btn-primary' data-toggle="modal" data-target="#modal_areas">
                                <i class="glyphicon glyphicon-search"></i></button>
                        </span>
                    </div>

                </div>
                <!--_____________________________________________-->

                <div class="col-md-12">

                    <hr>

                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary pull-right"
                            onclick="Guardar('<?php echo $nombre;?>')">Aceptar</button>
                    </span>
                </div>

                <!--******************************************-->


                <?php } ?>


    </form>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// CALLES //////////////////////////////////////////////////////////////////////////////////////// -->



<!-- //////////////////////////////////////////////////////////////////////////////////////// MANZANA //////////////////////////////////////////////////////////////////////////////////////// -->



<form class="formManzana" id="formManzana">

    <div class="form-group">



        <?php  if($nombre == 'Manzana'){?>



        <!--******************************************-->

        <div class="col-md-12">

            <div class="col-md-6">

                <label style="margin-left:10px" for="">Departamento:</label>
                <div class="col-md-12  input-group" style="margin-left:15px">

                    <select name="select" id="departamento" class="form-control">
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

            <!--_____________________________________________-->

            <div class="col-md-6 ">

                <label for="" style="margin-left:10px">Area:</label>
                <div class="col-md-12  input-group" style="margin-left:15px">
                    <input list="areas" id="argeo" class="form-control" autocomplete="off"
                        placeholder="Seleccione Area" onchange="AgregarAreaInput()">
                    <datalist id="areas">
                        <?php foreach($areas as $fila)
								{
									echo  "<option data-json='".json_encode($fila)."'value='".$fila->nombre."'>";
								}
									?>
                    </datalist>

                    <span class="input-group-btn">
                        <button class='btn btn-primary' data-toggle="modal" data-target="#modal_areas">
                            <i class="glyphicon glyphicon-search"></i></button>
                    </span>

                </div>

            </div>




        </div>

        <!--******************************************-->


        <!--_____________________________________________-->

        <div class="col-md-12">
            <br>
        </div>

        <!--_____________________________________________-->

        <div class="col-md-12">

            <hr>

            <span class="input-group-btn">
                <button type="button" class="btn btn-primary pull-right"
                    onclick="Guardar('<?php echo $nombre;?>')">Aceptar</button>
            </span>
        </div>


        <!--******************************************-->


        <?php } ?>

    </div>

</form>
</div>


<!-- //////////////////////////////////////////////////////////////////////////////////////// MANZANA//////////////////////////////////////////////////////////////////////////////////////// -->


<!-- //////////////////////////////////////////////////////////////////////////////////////// CENCISTA //////////////////////////////////////////////////////////////////////////////////////// -->

<form class="formCensista" id="formCensista">

    <div class="form-group">

        <?php if($nombre == 'Censista'){?>

        <!--******************************************-->

        <div class="col-md-12">
            

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Apellido:</label>
                    <input type="text" id="Apellido" name="texto"
                        <?php if($accion == 'Editar'){echo ('value="'.$etapa->lote.'"');}?> class="form-control"
                        placeholder="Inserte Apellido" />
                </div>
            </div>

            <!--_____________________________________________-->

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Direccion:</label>
                    <input type="text" id="Direccion" name="texto"
                        <?php if($accion == 'Editar'){echo ('value="'.$etapa->lote.'"');}?> class="form-control"
                        placeholder="Inserte Direccion" />
                </div>
            </div>

            <!--_____________________________________________-->

            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label">Telefono:</label>
                    <input type="number" id="Telefono" name="texto"
                        <?php if($accion == 'Editar'){echo ('value="'.$etapa->lote.'"');}?> class="form-control"
                        placeholder="Inserte Telefono" />
                </div>
            </div>



        </div>

        <!--******************************************-->

        <div class="col-md-12">

            <!--_____________________________________________-->

            <div class="col-md-12">

                <hr>

                <span class="input-group-btn">
                    <button type="button" class="btn btn-primary pull-right"
                        onclick="Guardar('<?php echo $nombre;?>')">Aceptar</button>
                </span>
            </div>

            <!--_____________________________________________-->

            <div class="col-md-12">
                <br>
            </div>

            <!--******************************************-->


            <?php } ?>


        </div>

        <div class="row">



</form>
</div>
<!-- //////////////////////////////////////////////////////////////////////////////////////// CENCISTA //////////////////////////////////////////////////////////////////////////////////////// -->










<!-- /.box-body -->
</div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row -->
</body>



<!-- ///////////////////////////////////////// BOOSTRAP VALIDATOR /////////////////////////////////////////-->

<script>
$(document).ready(function() {
    nombre = '<?php echo $nombre?>';
    if (nombre = 'Censista') {
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
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: 'El nombre solo puede usar caracteres alfabeticos o numericos'
                        }
                    }
                }
            }
        });
    } else {
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
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: 'El nombre solo puede usar caracteres alfabeticos o numeros'
                        }
                    }
                }
            }
        });
    }
});



//<!--________________________________________ GUARDAR ________________________________________-->


///////////////////////////////////////// FUNCION GUARDAR /////////////////////////////////////////-->


function Guardar(nombre) {

    $('#formulario').bootstrapValidator('validate');
    estado = $('#formulario').data('bootstrapValidator').isValid();
    if (estado) {
        datonombre = document.getElementById('Nombre').value;


        //TODO: TOMAR VALOR DE DEPARTAMENTO
        //var depa_id = "";
        // 				datoId = $("#departamentos option:selected").attr('data-id');

        // 				var value = $("#departamentos").ui.attribute.val();

        // alert(value);


        //datoId = 

        // var val = $('#item').val()
        // var xyz = $('#departamentos option').filter(function() {
        // 		return this.value == val;
        // }).data('xyz');
        // /* if value doesn't match an option, xyz will be undefined*/
        // var msg = xyz ? 'xyz=' + xyz : 'No Match';
        // alert(msg);





        //datoId =  $('#departamentos').value;
        //	alert(datoId);
        //dataId = $('#inputdepartamentos').data('id');

        //TODO:SACAR PA GUARDAR
        //return;
        //alert(dataId);



        switch (nombre) {
            case 'Arbol':
                $.ajax({
                    type: 'POST',
                    data: {
                        datonombre: datonombre
                    },
                    url: 'Arbol/Guardar_Nuevo',
                    success: function(result) {
                        linkTo('Arbol');
                    }
                });
                break;


            case 'Area geografica':
                $.ajax({
                    type: 'POST',
                    data: {
                        datonombre: datonombre
                    },
                    url: 'Area/Guardar_Nuevo',
                    success: function(result) {
                        console.log(result);
                        linkTo('Area');
                    }
                });
                break;

            case 'Censista':
                apellido = document.getElementById('Apellido').value
                direccion = document.getElementById('Direccion').value
                telefono = document.getElementById('Telefono').value
                $.ajax({
                    type: 'POST',
                    data: {
                        datonombre: datonombre,
                        apellido: apellido,
                        direccion: direccion,
                        telefono: telefono
                    },
                    url: 'Censista/Guardar_Nuevo',
                    success: function(result) {
                        console.log(result);
                        linkTo('Censista');
                    }
                });
                break;

            case 'Departamento':
                $.ajax({
                    type: 'POST',
                    data: {
                        datonombre: datonombre

                    },
                    url: 'Departamento/Guardar_Nuevo',
                    success: function(result) {
                        console.log(result);
                        linkTo('Departamento');
                    }
                });
                break;



            case 'Calle':

                depa_id = document.getElementById('depa_id').value ;  
                // console.log(datonombre);
                //  console.log(depa_id);


                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    data: {
                        datonombre: datonombre,
                        depa_id: depa_id
                    },
                    url: 'Calle/Guardar_Nuevo',
                    success: function(result) {
                        // console.log(result);
                        linkTo('Calle');
                    }
                });
                break;

            case 'Manzana':

                argeo = document.getElementById('argeo').value
                departamento = document.getElementById('departamento').value
               
                console.log(argeo);
                 console.log(departamento);
                 console.log(datonombre);


                $.ajax({
                    type: 'POST',
                    data: {
                        datonombre: datonombre,
                        argeo: argeo,
                        departamento: departamento,
                    },
                    url: 'Manzana/Guardar_Nuevo',
                    success: function(result) {
                        console.log(result);
                        linkTo('Manzana');
                    }
                });
                break;
            default:
                break;
        }
    }
}
</script>

<!-- ///////////////////////////////////////// SCRIPT AGREGAR AREA /////////////////////////////////////////-->


<!-- <script>

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
</script> -->

<!-- ///////////////////////////////////////// SCRIPT TABLAS /////////////////////////////////////////-->

<script>
$(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'autoFill': true,
        'buttons': true,
        'fixedHeader': true,
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    })
})
</script>
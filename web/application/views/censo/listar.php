<?php 
$this->load->view('area/modal_censista')
?>



<div class="box">

    <div class="box-header bg-green">
        <h3 class="box-title"><?php echo $titulo;?></h3>

    </div><!-- /.box-header -->
    <div class="box-body">
        <form role="form" id="formulario">


            <div class="form-group" style="width:40%">
                <label class="form-label">Censo:</label>
                <select name="select" class="form-control select2" style="width: 100%;" id="Nombre" class="form-control"
                    onchange="buscaCensos()">
                    <option value="" disabled selected>-Seleccione Censo-</option>
                    <?php
                        foreach($censos as $fila)
                        {
                           echo '<option data-json=\''.json_encode($fila).'\' value="'.$fila->id.'">'.$fila->nombre.'</option>' ;
                        }
                        ?>
                </select>
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
            <div class="row">

                <div class="col-md-12">
                    <button type="button" class="btn btn-primary pull-right"
                        onclick="Guardar('<?php echo $nombre;?>')">Aceptar</button>
                </div>
            </div>
        </form>


    </div>
</div><!-- /.box -->
</div><!-- /.col -->
</div><!-- /.row -->
</body>

<script>
$('#censos').DataTable();
$(document).off('click', '.asignar_censista').on('click', '.asignar_censista', function() {
    TrActual = $(this).parents('tr');
    $('#modal_censista').modal('show');
});
</script>





<script>
var tablaCensos = $('#censos').DataTable();


function buscaCensos() {



    id = document.getElementById('Nombre').value;

    // console.log(id);

    tablaCensos.clear().draw();
    // censos = '<?php echo json_encode($censosarmados)?>';
    // censos = JSON.parse(censos);

    // hacer un ajax llamando al buscaCenso mandqando el id

    $.ajax({
        type: 'POST',
        data: {
            data: id,
            dataType: 'JSON'
        },
        url: 'Censo/buscarCenso',
        success: function(result) {
            censos = JSON.parse(result);
            // console.log(censos);
            // var id = JSON.parse(result);
            
            if (censos != null) {
                console.log(censos);
                for (i = 0; i < censos.length; i++) {

                    if (id == censos[i].idcenso) {
                        tr = "";
                        tr += "<tr id='" + censos[i].idcenso + "' data-json='" + JSON.stringify(censos[i]) +
                            "'>";
                        tr +=
                            '<td><i class="fa fa-fw fa-pencil text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Editar"></i>';
                        tr +=
                            '<i class="fa fa-fw fa-plus text-light-blue asignar_censista" style="cursor: pointer; margin-left: 15px;" title="Asignar Censista" data-toggle="modal" data-target="#modal_censista"></i>';
                        tr +=
                            '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="seleccionar(this)"></i></td>';
                        tr += "<td>" + censos[i].nombredepartamento + "</td>";
                        tr += "<td>" + censos[i].nombreareageo + "</td>";
                        tr += "<td>" + censos[i].nombreusuario + "</td>";

                        tr += "</tr>";

                        tablaCensos.row.add($(tr)).draw();
                    }
                }
            }
            else console.log("y ella?");
        },
        error: function() {
            alert('Error');
        }
    });





    // esto t devuelve el listado de censo po ¿r id de depto





    for (i = 0; i < censos.length; i++) {

        if (id == censos[i].idcenso) {
            tr = "";
            tr += "<tr id='" + censos[i].idcenso + "' data-json='" + JSON.stringify(censos[i]) + "'>";
            tr +=
                '<td><i class="fa fa-fw fa-pencil text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Editar"></i>';
            tr +=
                '<i class="fa fa-fw fa-plus text-light-blue asignar_censista" style="cursor: pointer; margin-left: 15px;" title="Asignar Censista" data-toggle="modal" data-target="#modal_censista"></i>';
            tr +=
                '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="seleccionar(this)"></i></td>';
            tr += "<td>" + censos[i].nombredepartamento + "</td>";
            tr += "<td>" + censos[i].nombreareageo + "</td>";
            tr += "<td>" + censos[i].nombremanzana + "</td>";

            tr += "</tr>";

            tablaCensos.row.add($(tr)).draw();
        }
    }


}
</script>
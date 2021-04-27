<?php
$this->load->view('area/modal_editar');
?>
<div class="box">
      <div class="box-header bg-green">
          <h3 class="box-title"><?php echo $titulo?></h3>
            
        </div><!-- /.box-header -->
        <div class="box-body">

        <!-- /// ----------------------------------- FORMULARIO ----------------------------------- /// -->
        
        <div class="row">
                <div class="col-xs-2">
                 <button type="button" class=" btn btn-primary btn-block" onclick="linkTo('Area/Nuevo');">Nuevo</button>
                </div>

                <div class="col-md-12">
                  <hr>
                </div>

                <div class="col-xs-10">
                 </div>
             </div>
          <div class="row" style="margin-top:15px;">
            <div class="col-xs-12">
            <table id="tabla_lista" class="table table-bordered table-striped">
            <thead class="thead-dark" bgcolor="#eeeeee"  >
                <tr>
                  <th>Acciones</th>
                  <th>Area Geografica</th>
                  <th>Departamento</th>
                  
                </tr>
              </thead>
              <tbody>
              
                <?php
                
                if($lista)
                {
                      foreach($lista as $fila)
                      {
                          echo "<tr  id='".$fila->idArea."' data-json='".json_encode($fila)."'>";
                          echo '<td>';
                          echo '<i class="fa fa-fw fa-pencil text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Editar"></i>';
                          echo '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="borrar('.$fila->idArea.')"></i>';
                          echo '</td>';
                          echo '<td>'.$fila->nombreArea.'</td>';
                          echo '<td>'.$fila->departamento.'</td>';   
                          echo '</tr>';                          
                        
                      }
                    }
                  ?>
              </tbody>
            </table>
              
         
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  </body>
  <script>
    $(document).ready(function() {
        $('#tabla_lista').DataTable({
            responsive: true,
            language: {
                url: '<?php base_url() ?>lib/bower_components/datatables.net/js/es-ar.json' //Ubicacion del archivo con el json del idioma.
            }
        });
    });
 
    $(document).off('click','.asignar_censista').on('click', '.asignar_censista', function(){
        TrActual= $(this).parents('tr');
        $('#modal_censista').modal('show');
    } );

    function borrar(id){

      Swal.fire({
								title: 'Estas Seguro de Eliminar esta Area del Censo?',
								text: "No podras revertir este proceso!",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Si, Eliminar!'
							}).then((result) => {

								if (result.value) {

                  $.ajax({
                      type: 'POST',
                      data: {id: id},
                      url: 'Area/eliminar',
                      success: function(result) {
                        if(result < 300){
                          Swal.fire({
                                title: '"Eliminado!"',
                                text: '"El Area ha sido eliminada!"',
                                icon: 'success',
                                confirmButtonText: 'Ok',
                              });
                          linkTo('Area');
                        }
                      },
                      error: function() {
                        Swal.fire("Error", "No se pudo eliminar el Area...'");
                      }
                  });
								} else {
									Swal.fire("Cancelado");
								}
							});
    }

    // levanta modal editar y lo llena
    $(document).off('click', '.fa-pencil').on('click', '.fa-pencil', function() {
      row = $(this).parents('tr').attr('data-json');
      info = JSON.parse(row);
      $("#modal_editar").modal("show");
      $("#selectDepto_editar").val(info.departamento);
      $("#selectArea_editar").val(info.nombreArea);
      $("#select_idArea_editar").val(info.idArea);
    });
    
  </script>




</div>
</div>
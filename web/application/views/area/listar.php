<?php $this->load->view('area/modal_censista')?>
<div class="box"> 
      <div class="box-header">
          <h3 class="box-title"><?php echo $titulo?></h3>
            
        </div><!-- /.box-header -->
        <div class="box-body">
        <div class="row">
                <div class="col-xs-2">
                 <button type="button" class=" btn btn-primary btn-block" onclick="linkTo('Area/Nuevo');">Nuevo</button>
                </div>
                <div class="col-xs-10">
                 </div>
             </div>
          <div class="row" style="margin-top:15px;">
            <div class="col-xs-12">
            <table id="tabla_lista" class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                  <th>Acciones</th>
                  <th>Area Geografica</th>
                  <th>Departamento</th>
                  <th>Asignado</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if($lista)
                {
                      foreach($lista as $fila)
                      {
                    
                          $id=$fila->id;
                          echo '<tr  id="'.$id.'" data-json:'.json_encode($fila).'>';

                          echo '<td>';
                          echo '<i class="fa fa-fw fa-pencil text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Editar" onclick=linkTo("general/Etapa/editar?id='.$id.'")></i>';
                          if($fila->nombrecensista == 'Sin Asignar')
                          {
                            echo '<i class="fa fa-fw fa-plus text-light-blue asignar_censista" style="cursor: pointer; margin-left: 15px;" title="Asignar Censista" data-toggle="modal"></i>';
                          }
                          echo '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="seleccionar(this)"></i>';
                          echo '</td>';
                          echo '<td>'.$fila->nombre.'</td>';
                          echo '<td>'.$fila->departamento.'</td>';
                          echo '<td>'.$fila->nombrecensista.'</td>';
                   
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
  $('#tabla_lista').DataTable();
  $(document).off('click','.asignar_censista').on('click', '.asignar_censista', function()
  {
    TrActual= $(this).parents('tr');
    $('#modal_censista').modal('show');
} );
  </script>
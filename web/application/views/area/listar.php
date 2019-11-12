<?php $this->load->view('area/modal_censista')?>
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








<!-- --------------------------/// DROPDOWN ///-------------------------- --> 

<div class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="fa fa-ellipsis-h text-light-blue opcion" style="cursor: pointer;"></i></a>
        <ul class="dropdown-menu" style="[5:51, 28/3/2019] Mi Princesa: 
              background: -moz-linear-gradient(45deg, rgba(60,148,201,1) 0%, rgba(70,170,232,1) 100%); /* ff3.6+ */
              background: -webkit-gradient(linear, left bottom, right top, color-stop(0%, rgba(60,148,201,1)), color-stop(100%, rgba(70,170,232,1))); /* safari4+,chrome */
              background: -webkit-linear-gradient(45deg, rgba(60,148,201,1) 0%, rgba(70,170,232,1) 100%); /* safari5.1+,chrome10+ */
              background: -o-linear-gradient(45deg, rgba(60,148,201,1) 0%, rgba(70,170,232,1) 100%); /* opera 11.10+ */
              background: -ms-linear-gradient(45deg, rgba(60,148,201,1) 0%, rgba(70,170,232,1) 100%); /* ie10+ */
              background: linear-gradient(45deg, rgba(60,148,201,1) 0%, rgba(70,170,232,1) 100%); /* w3c */
              filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=" #46aae8
                ",="" endcolorstr="#3c94c9
                " ,gradienttype="1" );"="">

              <li role="presentation"><a onclick="editar(this)" style="color:white;" role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#modaleditar"><i class="fa fa-pencil text-white" style="color:white; cursor: pointer;"></i>Editar</a></li>
              <li role="presentation"><a onclick="borrar(this)" style="color:white;" role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#modallista"><i class="fa fa-fw fa-times-circle text-white" style="color:white; cursor: pointer;margin-left:-3px"></i>Borrar</a></li>
            
         </ul>
<div>

<!-- --------------------------/// DROPDOWN ///-------------------------- --> 

</div>
</div>
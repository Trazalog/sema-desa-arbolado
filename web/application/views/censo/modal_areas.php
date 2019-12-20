<div class="modal" id="modal_areas" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Areas Geograficas</h4>
      </div>

      <div class="modal-body" id="modalBodyArticle">
         <div class="row">
             <div class="col-xs-12 table-responsive" id="modalareas">
                <table class="table" id="tablaareas">
                    <thead>
                        <tr>
                        <th>Acciones</th>
                        <th>Area Geografica</th>
                        <th>Departamento</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                if($areas)
                {
                      foreach($areas as $fila)
                      {
                    
                          $id=$fila->id;
                          echo "<tr id='".$id."' data-json='".json_encode($fila)."'>";

                          echo '<td>';
                          echo '<i class="fa fa-fw fa-plus text-light-blue tabla_areas_agregar" style="cursor: pointer; margin-left: 15px;" title="Editar"></i>';
                          echo '</td>';
                          echo '<td>'.$fila->nombre.'</td>';
                          echo '<td>'.$fila->departamento.'</td>';
                          echo '</tr>'; 
                      }
                    }
                  ?>
                    </tbody>
                </table>
             </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<script>
 $(document).off('click','.tabla_areas_agregar').on('click', '.tabla_areas_agregar', function()
  {
    var area = $(this).closest('tr').data('json');
   AgregarArea(area);
    $("#modal_areas").modal('hide');
  });
</script>
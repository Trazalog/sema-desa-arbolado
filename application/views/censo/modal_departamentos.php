<div class="modal" id="modal_departamentos" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Departamentos</h4>
      </div>

      <div class="modal-body" id="modalBodyArticle">
         <div class="row">
             <div class="col-xs-12 table-responsive" id="modaldepartamentos">
             <table class="table" id="tabladepartamentos">
                    <thead>
                        <tr>
                        <th>Acciones</th>
                        <th>Departamento</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                if($departamentos)
                {
                      foreach($departamentos as $fila)
                      {
                    
                          $id=$fila->id;
                          echo '<tr  id="'.$id.'" data-json='.json_encode($fila).'>';

                          echo '<td>';
                          echo '<i class="fa fa-fw fa-plus text-light-blue tabla_departamentos_agregar" style="cursor: pointer; margin-left: 15px;" title="Editar"></i>';
                          echo '</td>';
                          echo '<td>'.$fila->nombre.'</td>';
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
 $(document).off('click','.tabla_departamentos_agregar').on('click', '.tabla_departamentos_agregar', function()
  {
    var departamento = $(this).closest('tr').data('json');
    
    areas ='<?php echo json_encode($areas)?>';
    areas = JSON.parse(areas);
    for(i=0;i<areas.length;i++)
    {
        if(departamento.id == areas[i].iddepartamento)
        {
           
            AgregarArea(areas[i]);
        }
    }
    $("#modal_departamentos").modal('hide');
  });

</script>
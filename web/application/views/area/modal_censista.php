


<div class="modal" id="modal_censista" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Asignar Censista</h4>
      </div>

      <div class="modal-body" id="modalBodyArticle">
        <div class="form-group" style="width:40%">
            <label  class="form-label">Censista:</label>
            <select type="text" id="censista" class="form-control">
                <option value="" selected disabled>-Seleccione censista-</option>
                <?php
                    foreach($censistas as $fila)
                    {
                        echo '<option value='.$fila->id.'>'.$fila->nombre.' '.$fila->apellido.'</option>';
                    }
                ?>
           </select>
            </div>
        </div>

      <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="AsignarCensista()">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<script>
function AsignarCensista()
{
    idcensista = document.getElementById('censista').value;
    censista = $("#censista>option:selected").html();
    TrActual.children().eq(3).html(censista);
    TrActual.children().eq(0).find('.asignar_censista').hide();
    $('#modal_censista').modal('hide');
}
</script>
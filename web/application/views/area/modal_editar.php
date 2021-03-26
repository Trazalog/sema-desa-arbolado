<div class="modal" id="modal_editar" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Area Geografica</h4>
      </div>

      <div class="modal-body" id="modalBodyArticle">
        <div class="row">

         <!-- ____________________________ AREA GEOGRAFICA  ____________________________ -->
          <div class="col-md-12">
              <input type="text" class="hidden" id="id_relacion"></input>
              <div class="form-group"  >
                  <label  class="form-label">Departamento:</label>
                  <input  name="selectDepto_editar"  id="selectDepto_editar" class="form-control" disabled />
              </div>

          </div>

          <div class="col-md-12">

            <div class="form-group"  >
                <label  class="form-label">Area Geográfica:</label>
                <input  name="selectArea_editar"  id="selectArea_editar" class="form-control" />
            </div>

          </div>

          <input  name="select_idArea_editar"  id="select_idArea_editar" class="form-control hidden" />


        </div> <!-- ./ modal-body -->

        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Guardar</button> -->
          <button type="button" class="btn btn-primary pull-right" onclick="actualizarArea()">Guardar</button>
        </div>

      </div>
    </div>
  </div>
</div>

<script>

  // actualiza areas
  function actualizarArea(){

      data = {};
      data.arge_id = $('#select_idArea_editar').val();
      data.nombre = $("#selectArea_editar").val();
      $.ajax({
            type: 'POST',
            data: {data},
            url: 'Area/editar',
            dataType: 'json',
            success: function(result) {
              $("#modal_editar").modal("hide");
                  if (result == 500) {
                    alert("Error al actualizar Area");
                  }else{
                    $("#modal_editar").modal('hide');
                    linkTo('Area');
                  }
            },
            error: function() {
                  alert('Error en Aactualizacion de Area...');
            }
      });
  }

</script>
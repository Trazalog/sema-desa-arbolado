<div class="modal" id="modal_editar" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar <?php echo $nombre;?></h4>
      </div>

      <div class="modal-body" id="modalBodyArticle">
        <div class="row">

         <!-- _______________ DEPARTAMENTOS Y ARBOLES  _____________ -->

            <div class="col-md-12">
                <input type="text" class="hidden" id="id_relacion"></input>
                <div class="form-group"  >
                    <label  class="form-label"><?php echo $nombre;?>:</label>
                    <input  name="nomDeptoArb"  id="nomDeptoArb" class="form-control"/>
                </div>
            </div>
            <input  name="idDeptoArbEditar"  id="idDeptoArbEditar" class="form-control hidden" />

        </div> <!-- ./ modal-body -->

        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Guardar</button> -->
          <button type="button" class="btn btn-primary pull-right" onclick="actualizarDeptoArb()">Guardar</button>
        </div>

      </div>
    </div>
  </div>
</div>

<script>

  // actualiza areas
  function actualizarDeptoArb(){

      var controller = '<?php echo $nombre;?>';

      var data = {};
      if (controller == 'Departamento') {
        data.depa_id = $('#idDeptoArbEditar').val();
        data.nombre = $("#nomDeptoArb").val();
        var url = 'Departamento/editar';
      } else {
        data.tabl_id = $('#idDeptoArbEditar').val();
        data.valor = $("#nomDeptoArb").val();
        var url = 'Arbol/editar';
      }

      $.ajax({
            type: 'POST',
            data: {data},
            url: url,
            dataType: 'json',
            success: function(result) {

                  $("#modal_editar").modal("hide");
                  if (result == 500) {

                      alert("Error al actualizar Area");
                  }else{

                      $("#modal_editar").modal('hide');
                      if (controller == 'Departamento') {
                          linkTo('Departamento');
                      }else{
                        linkTo('Arbol');
                      }
                  }
            },
            error: function() {
                  alert('Error Actualizacion...');
            }
      });
  }

</script>
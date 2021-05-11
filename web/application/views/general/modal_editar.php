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
        <form role="form" id="frm_editar">
         <!-- _______________ DEPARTAMENTOS Y ARBOLES  _____________ -->

            <div class="col-md-12">
                <input type="text" class="hidden" id="id_relacion"></input>
                <div class="form-group"  >
                    <label  class="form-label"><?php echo $nombre;?>:</label>
                    <input  name="nomDeptoArb"  id="nomDeptoArb" class="form-control"/>
                </div>
            </div>
            <input  name="idDeptoArbEditar"  id="idDeptoArbEditar" class="form-control hidden" />
        </form>
        </div> <!-- ./ modal-body -->

        <div class="modal-footer">
          <button type="button" class="btn btn-primary pull-right" onclick="actualizarDeptoArb()">Guardar</button>
        </div>

      </div>
    </div>
  </div>
</div>

<script>

  // actualiza Depto o Arboles
  function actualizarDeptoArb(){

    var controller = '<?php echo $nombre;?>';

    var id = $("#nomDeptoArb").val();
    if(id == ""){
      Swal.fire('Por favor rellene el campo vacio...');
      return;
    }
    var data = {};
    if (controller == 'Departamento') {
      data.depa_id = $('#idDeptoArbEditar').val();
      data.nombre = id;
      var url = 'Departamento/editar';
    } else {
      data.tabl_id = $('#idDeptoArbEditar').val();
      data.valor = id;
      var url = 'Arbol/editar';
    }
    wo();
    $.ajax({
          type: 'POST',
          data: {data},
          url: url,
          dataType: 'json',
          success: function(result) {
                wc();
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
                wc();
                alert('Error Actualizacion...');
          }
    });
  }

</script>
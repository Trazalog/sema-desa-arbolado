<div class="modal" id="modal_editar_Mzanas_Calles" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar <?php echo $nombre;?></h4>
      </div>

      <div class="modal-body" id="modalBodyArticle">
        <div class="row">

         <!-- ____________________________ MANZANA - CALLE  ____________________________ -->
         <div class="col-md-12">
              <div class="form-group"  >
                  <label  class="form-label">Departamento:</label>
                  <input  name="Depto_ed"  id="Depto_ed" class="form-control" disabled />
                  <input  name="Depto_id_ed"  id="Depto_id_ed" class="form-control hidden" disabled />
              </div>
          </div>
          <?php if($nombre == "Calle"){ ?>

            <div class="col-md-12">
                <div class="form-group"  >
                    <label  class="form-label">Calle:</label>
                    <input  name="calle_nom_editar"  id="calle_nom_editar" class="form-control" />
                    <input  name="calle_id_editar"  id="calle_id_editar" class="form-control" />
                </div>
            </div>

          <?php }else{  ?>

            <div class="col-md-12">
              <div class="form-group"  >
                  <label  class="form-label">Area Geográfica:</label>
                  <!-- <select  name="ar_editar"  id="ar_editar" class="form-control" /> -->
                  <input  name="ar_editar_nom"  id="ar_editar_nom" class="form-control" disabled />
              </div>
            </div>

            <div class="col-md-12">
                <div class="form-group"  >
                    <label  class="form-label">Manzana:</label>
                    <input  name="manz_nom_editar"  id="manz_nom_editar" class="form-control" />
                    <input  name="manz_id_editar"  id="manz_id_editar" class="form-control" />
                </div>
            </div>

          <?php      }  ?>



        </div> <!-- ./ modal-body -->

        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Guardar</button> -->
          <button type="button" class="btn btn-primary pull-right" onclick="actualizar_Manz_Calle()">Guardar</button>
        </div>

      </div>
    </div>
  </div>
</div>

<script>


// llena select Area por departamentos para edicion
function fillSelectArea(){
  $('#ar_editar').find('option').remove();
  id_depto = $('#Depto_id_ed').val();
  //wo();
  $.ajax({
        type: 'POST',
        data: {id_depto: id_depto},
        url: 'Censo/getAreaPorDepto',
        dataType: 'json',
        success: function(result) {

          for (let index = 0; index < result.length; index++) {
            $('#ar_editar').append("<option value='" + result[index].id + "'>" +result[index].nombre +"</option");
          }
          $("#ar_editar option[value='"+ arge_id +"']").prop("selected",true);
          // wc();
        },
        error: function() {
          //wc();
            alert('No hay Areas Geograficas para este Departamento...');
        }
  });
}

// actualiza Manzanas o Calles
function actualizar_Manz_Calle(){

  var controller = '<?php echo $nombre;?>';

  var data = {};
  if (controller == 'Manzana') {

    data.manz_id = $('#manz_id_editar').val();
    data.nombre = $("#manz_nom_editar").val();
    var url = 'Manzana/editar';
  } else {

    data.call_id = $('#calle_id_editar').val();
    data.nombre = $("#calle_nom_editar").val();
    var url = 'Calle/editar';
  }

  $.ajax({
        type: 'POST',
        data: {data},
        url: url,
        dataType: 'json',
        success: function(result) {

              $("#modal_editar_Mzanas_Calles").modal("hide");
              if (result == 500) {

                  alert("Error al actualizar " + controller);
              }else{

                  $("#modal_editar_Mzanas_Calles").modal('hide');
                  if (controller == 'Manzana') {
                      linkTo('Manzana');
                  }else{
                    linkTo('Calle');
                  }
              }
        },
        error: function() {
              alert('Error Actualizacion...');
        }
  });
}

</script>
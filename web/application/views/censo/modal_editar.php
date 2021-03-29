<div class="modal" id="modal_editar" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Areas Geograficas en Departamento</h4>
      </div>

      <div class="modal-body" id="modalBodyArticle">
        <div class="row">

         <!-- ____________________________ AREA GEOGRAFICA  ____________________________ -->
          <div class="col-md-12">
              <input type="text" class="hidden" id="id_relacion"></input>
              <div class="form-group"  >
                  <label  class="form-label">Departamento:</label>
                  <select  name="select"  id="selectDepto_editar" class="form-control">
                      <option value="" disabled selected>-Seleccione Departamento-</option>
                      <?php
                      foreach($departamentos as $fila)
                      {
                        echo '<option value="'.$fila->id.'">'.$fila->nombre.'</option>' ;
                      }
                      ?>
                  </select>
              </div>

          </div>

          <div class="col-md-12">

            <div class="form-group"  >
                <label  class="form-label">Area Geográfica:</label>
                <select  name="select"  id="selectArea_editar" class="form-control" />
            </div>

          </div>


        </div> <!-- ./ modal-body -->

        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Guardar</button> -->
          <button type="button" class="btn btn-primary pull-right" onclick="actualizarAreaCenso()">Guardar</button>
        </div>

      </div>
    </div>
  </div>
</div>

<script>

  $('#selectDepto_editar').on('change', function() {
    fillSelectArea();
  });

  //llena selec con Todas la Areas geograficas seleccionadno la de la Edicion
  function fillSelectArea(idareageo){
    $('#selectArea_editar').find('option').remove();
    id_depto = $('#selectDepto_editar').val();
    wo();
    $.ajax({
          type: 'POST',
          data: {id_depto: id_depto},
          url: 'Censo/getAreaPorDepto',
          dataType: 'json',
          success: function(result) {

            for (let index = 0; index < result.length; index++) {
              $('#selectArea_editar').append("<option value='" + result[index].id + "'>" +result[index].nombre +"</option");
            }
            $("#selectArea_editar option[value='"+ idareageo +"']").prop("selected",true);
            wc();
          },
          error: function() {
              wc();
              alert('No hay Areas Geograficas para este Departamento...');
          }
    });
  }

  // asigna areas a censos
  function actualizarAreaCenso(){

      data = {};
      data.arge_id = $('#selectArea_editar').val();
      data.ceua_id = $("#id_relacion").val();
      $.ajax({
            type: 'POST',
            data: {data},
            url: 'Censo/actualizarArea',
            dataType: 'json',
            success: function(result) {
              $("#modal_editar").modal("hide");
                  if (result == 500) {
                    alert("El area ya se encuentra asignada a este Censo");
                  }else{
                    $("#modal_areas_asignar").modal('hide');
                    buscaCensos();
                  }
            },
            error: function() {
                  alert('Error en Asignacion de Area...');
            }
      });
  }

</script>
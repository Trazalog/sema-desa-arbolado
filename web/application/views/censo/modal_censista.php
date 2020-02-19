<div class="modal" id="modal_censista" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
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
                        echo '<option data-json=\''.json_encode($fila).'\' value='.$fila->id.'>'.$fila->nombre.' '.$fila->apellido.'</option>';
                    }
                ?>
           </select>
            </div>
        </div>

      <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="AsignarCensista()">Asignar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


<!-- //////////////////////////////// SCRIPT /////////////////////////////////// -->
<script>


function AsignarCensista()
{
    
    //  alert(idcensista);
    //  alert('censo: '+ idcenso);

    // censista = $("#censista>option:selected").html();
    //censistaaa = TrActual.children().eq(3).html(censista);

    
   // console.table(JSON.parse(censistaaa));
    // alert(censistaaa.idareageo);
    // TrActual.children().eq(0).find('.asignar_censista').hide();

    // $('#modal_censista').modal('hide');

    // var asignar = {};

    // var json =  $("#censista>option:selected").attr('data-json');
    // jsoncensista = JSON.parse(json);
    // asignar.usua_id = jsoncensista.id;


    // var json =  $("#Nombre>option:selected").attr('data-json');
    // jsoncenso = JSON.parse(json);
    // asignar.cens_id = jsoncenso.id;



    // var json =  $("#"+jsoncenso.id).attr('data-json');
    // jsonarea = JSON.parse(json);
    // asignar.arge_id = jsonarea.idareageo;
    atribjson = JSON.parse(TrActual.attr('data-json'));
    idarea = atribjson.idareageo;
    idcensista = document.getElementById('censista').value;
    idcenso = document.getElementById('Nombre').value;

    $.ajax({
        type: 'POST',
        data: {
          usua_id: idcensista,
          arge_id: idarea,
          cens_id: idcenso
        },        
        url: 'Censo/AsignarCensista',        
        success: function(result) {
                  $('#modal_censista').modal('hide');
                  buscaCensos();                    
        },
        error: function() {
                  alert('Error');
        }        
    });
   
}
</script>



<!-- //////////////////////////////// SCRIPT /////////////////////////////////// -->
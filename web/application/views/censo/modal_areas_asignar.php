<div class="modal" id="modal_areas_asignar" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Areas Geograficas a Censo</h4>
      </div>

      <div class="modal-body" id="modalBodyArticle">
        <div class="row">
             <!-- <div class="col-xs-12 table-responsive" id="modalareas">
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
                // if($areas)
                // {
                //       foreach($areas as $fila)
                //       {
                    
                //           $id=$fila->id;
                //           echo "<tr id='".$id."' data-json='".json_encode($fila)."'>";

                //           echo '<td>';
                //           echo '<i class="fa fa-fw fa-plus text-light-blue tabla_areas_agregar" style="cursor: pointer; margin-left: 15px;" title="Editar"></i>';
                //           echo '</td>';
                //           echo '<td>'.$fila->nombre.'</td>';
                //           echo '<td>'.$fila->departamento.'</td>';
                //           echo '</tr>'; 
                //       }
                //     }
                //  ?>
                    </tbody>
                </table>
             </div>
        </div> -->


         <!-- ____________________________ AREA GEOGRAFICA  ____________________________ -->
        <div class="col-md-12">

            <div class="form-group"  >      
                <label  class="form-label">Departamento:</label>
                <select  name="select"  id="selectDepto" class="form-control">
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
            <select  name="select"  id="selectArea" class="form-control">
                <option value="" disabled selected>-Seleccione Area-</option>               
            </select>
        </div>
        
</div>


      </div> <!-- ./ modal-body -->

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Guardar</button> -->
        <button type="button" class="btn btn-primary pull-right" onclick="insertAreaCenso()">Guardar</button>	
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div> -->
    </div>
  </div>
</div>
<script>
//  $(document).off('click','.tabla_areas_agregar').on('click', '.tabla_areas_agregar', function()
//   {
//     var area = $(this).closest('tr').data('json');
//    AgregarArea(area);
//     $("#modal_areas_asignar").modal('hide');
//   });

$('#selectDepto').on('change', function() {

  id_depto = $('#selectDepto').val();
  id_censo = document.getElementById('Nombre').value; 
  $.ajax({
        type: 'POST',
        data: {id_depto: id_depto,
                id_censo: id_censo},
        url: 'Censo/getAreaPorDeptoSinAsignar',
        dataType: 'json',
        success: function(result) {
          $('#selectArea').find('option').remove();
          //$('#selectArea').append("<option value="">-Seleccione Area Geográfica-</option>");
          for (let index = 0; index < result.length; index++) {       
            $('#selectArea').append("<option value='" + result[index].arge_id + "'>" +result[index].nombre +"</option");    
          }  
        },
        error: function() {
            alert('Error');
        }
  });
});
// asigna areas a censos
function insertAreaCenso(){
    ban = true;
    id_censo = $('#Nombre').val();
    id_area = $('#selectArea').val();
    if (id_censo == null) {
      ban= false;
      alert("Seleccione Departamento...");
    } 
    if (id_area == null) {
      ban= false;
      alert("Seleccione Area...");
    } 

    if(ban){
      $.ajax({
            type: 'POST',
            data: {id_censo: id_censo,
                  id_area: id_area },
            url: 'Censo/insertAreaCenso',
            dataType: 'json',
            success: function(result) { 
                
                      Swal.fire({
                icon: 'success',
                title: 'Area Asignada',
                text: 'El area fue asignada al Censo!',
                             })

                  if (result == 500) {
                  
                    Swal.fire({
                icon: 'error',
                title: 'Area Asignada',
                text: 'El area ya se encuentra asignada a este Censo!',
                             })

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

}



</script>
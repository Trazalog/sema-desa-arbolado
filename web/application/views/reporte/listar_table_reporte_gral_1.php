<div class="container-fluid">
<?php  if(isset($reportes))
                {
              $total =  count($reportes);
                }?>

   <a class="btn btn-success"><?php echo "Total de Registros:  ";?> <?php if(isset($reportes)){echo $total;  }?></a>
   <br>
   <br>

<table id="tabla_lista" class="table table-bordered table-striped">
            <thead class="thead-dark" bgcolor="#eeeeee"  >
                <tr>
                  <th>Nro</th>
                  <th>Departamento</th>
                  <th>Area Geográfica</th>
                  <th>Manzana</th>
                  <th>Longitud -Latitud</th>
                  <th>Calle</th>
                  <th>Nro</th>
                  <th>Barrio</th>
                  <th>Tipo de taza</th>
                  <th>Nombre Especie</th>
                  <th>Alineacion del arbol</th>
                  <th>Estado Sanitario General</th>
                  <th>Tapa de Taza Incrust.</th>
                  <th>Acequia</th>
                  <!-- <th>Opciones</th>  -->
                </tr>
              </thead>
              <tbody>
              
                <?php
                
                if(isset($reportes))
                {
                      foreach($reportes as $fila)
                      {   
                          echo '<tr  id="'.$fila->arbo_id.'" data-json:'.json_encode($fila).'>';
                         
                          echo '<td>'.$fila->arbo_id.'</td>';
                          echo '<td>'.$fila->departamento.'</td>'; 
                          echo '<td>'.$fila->area_geografica.'</td>';
                          echo '<td>'.$fila->manzana.'</td>';
                          echo '<td>'.$fila->lat_long_gps.'</td>';
                          echo '<td>'.$fila->calle.'</td>';
                          echo '<td></td>';
                          echo '<td>'.$fila->barrio.'</td>';
                          echo '<td>'.$fila->taza.'</td>';
                          echo '<td>'.$fila->especie.'</td>';
                          echo '<td>'.$fila->ALINEACION_DEL_ARBOL.'</td>';
                          echo '<td>'.$fila->ESTADO_SANITARIO_GENERAL.'</td>';
                          echo '<td>'.$fila->TAPA_DE_TAZA_INSCRUSTADA.'</td>';
                          echo '<td>'.$fila->ACEQUIA.'</td>';
                     //   echo '<td> &nbsp;&nbsp;<button onclick="Detalles('.$fila->info_id.')"class="btn btn-success">Detalles</button></td>';   
                          echo '</tr>';                          
                        
                      }
                    }
                  ?>
              </tbody> 
            </table>

            </div>


            <!-- MODAL DETALLE -->
<div class="modal" id="modal_detalles" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalles</h4>
      </div>

      <div class="modal-body" id="modalBodyArticle">
    
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL IMAGEN -->

<div class="modal" id="modal_imagen" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Imagen</h4>
            </div> -->

            <div class="modal-body" id="modalArbol">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
                <div class="center box">
                    <img id="imagen_modal" src="">
                </div>
            </div>

            <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
      </div> -->
        </div>
    </div>
</div>
            <script>
    $(document).ready(function() {
        $('#tabla_lista').DataTable({
            responsive: true,
            language: {
                url: '<?php base_url() ?>lib/bower_components/datatables.net/js/es-ar.json' //Ubicacion del archivo con el json del idioma.
            },
            dom: 'lfrtipB',
    buttons: [{
        //Botón para Excel
        extend: 'excel',
        footer: true,
        title: 'Reporte Arbolado',
        filename: 'Reporte_Arbolado',

        //Aquí es donde generas el botón personalizado
        text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
        }
      // //Botón para PDF
      // {
      //   extend: 'pdf',
      //   footer: true,
      //   title: 'Reporte Arbolado',
      //   filename: 'Reporte_Arbolado_pdf',
      //   text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
      // }
    ]
        });
    });
 

    function Detalles(id) {

$.ajax({
    type: 'POST',
    data: {
        id: id
    },
    url: 'Reporte/getDetalle',
    success: function(result) {

        $('#modal_detalles').find('.modal-body').html(result.html);
        $('#modal_detalles').modal('show');
        $('.modal-body > form').find('input, textarea, button, select').attr('disabled',
            'disabled');
        $('#read_only').attr('disabled');
        $('.frm-save').hide();
    },
    dataType: 'json'
})
}

function Imagen(id) {
$.ajax({
    type: 'POST',
    data: {
        id: id
    },
    url: 'Reporte/getImagen',
    success: function(result) {

        if(imagen != null || imagen!= '' || imagen != "") {
          
            var imagen = result.html.replace('dataimage/jpegbase64', 'data:image/jpeg;base64,');
        $('#modal_imagen').find('#imagen_modal').prop("src", imagen);
        $('#modal_imagen').modal('show');
 }
 else {
   alert('te salio para el culo!');
}
       
    },
    dataType: 'json'
})
}

  </script>

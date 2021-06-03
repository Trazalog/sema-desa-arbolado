<div class="container-fluid">
  <?php
    if(isset($reportes))
    {
      $total =  count($reportes);
    }
  ?>

  <a class="btn btn-success"><?php echo "Total de Registros:  ";?> <?php if(isset($reportes)){echo $total;  }?></a>
    <br>
    <br>

  <table id="tabla_lista" class="table table-bordered table-striped">
    <thead class="thead-dark" bgcolor="#eeeeee"  >
        <tr>
          <th></th>
          <th>Nro</th>
          <th>Fecha</th>
          <th>Foto</th>
          <th>Departamento</th>
          <th>Area Geográfica</th>
          <th>Manzana</th>
          <th>Longitud -Latitud</th>
          <th>Calle</th>
          <th>Nro</th>
          <th>Barrio</th>
          <th>Tipo de taza</th>
          <th>Especie</th>
          <th>Alineacion del arbol</th>
          <th>Altura total</th>
          <th>Aaltura de fuste</th>
          <th>Cap</th>
          <th>Medicion del cap</th>
          <th>Copa - medida 1</th>
          <th>Copa - medida 2</th>
          <th>Raices descubiertas</th>
          <th>Cuello visible</th>
          <th>Levantamiento de veredas</th>
          <th>Levantamiento de pavimento</th>
          <th>Fuste unico</th>
          <th>Fuste bifurcado</th>
          <th>Fuste inclinacion mayor a 45°</th>
          <th>Descortezamiento fuste</th>
          <th>Fuste con fructificaciones fungicas</th>
          <th>Deformacion fuste</th>
          <th>Codominancia fuste</th>
          <th>Cavidad expuesta</th>
          <th>Cavidad expuesta basal</th>
          <th>Cavidad expuesta alta</th>
          <th>Cavidad expuesta media</th>
          <th>Ramas bajas</th>
          <th>Ramas secas</th>
          <th>Ramas quebradas</th>
          <th>Ramas codominantes</th>
          <th>Agallas/cancros</th>
          <th>Descopado/brotacion</th>
          <th>Clorosis</th>
          <th>Dencidad del Follaje</th>
          <th>Estado Sanitario General</th>
          <th>Acequia</th>
          <th>Poste</th>
          <th>Vereda</th>
          <th>Interfiere Cables</th>
          <th>Tapa de Taza Incrust.</th>
          <th>Observaciones</th>
          <!-- <th>Opciones</th>  -->
        </tr>
    </thead>
    <tbody>
      
      <?php

      if(isset($reportes))
      {
            foreach($reportes as $fi)
            {
              $fila = json_decode(json_encode($fi),true);

                echo '<tr  id="'.$fila['arbo_id'].'" data-json:'.json_encode($fila).'>';
                echo '<td></td>';
                echo '<td>'.$fila["arbo_id"].'</td>';
                echo '<td>'.$fila['fecha'].'</td>';
                echo '<td><button type="button" class="btn btn-info btn-sm" onclick="Imagen('.$fila['arbo_id'].')">Imagen</button></td>';
                echo '<td>'.$fila['departamento'].'</td>';
                echo '<td>'.$fila['area_geografica'].'</td>';
                echo '<td>'.$fila['manzana'].'</td>';
                echo '<td>'.$fila['lat_long_gps'].'</td>';
                echo '<td>'.$fila['calle'].'</td>';
                echo '<td>'.$fila['altura'].'</td>';
                echo '<td>'.$fila['barrio'].'</td>';
                echo '<td>'.$fila['taza'].'</td>';
                echo '<td>'.$fila['especie'].'</td>';
                echo '<td>'.$fila['ALINEACION_DEL_ARBOL'].'</td>';
                echo '<td>'.$fila['ALTURA_TOTAL__M_'].'</td>';
                echo '<td>'.$fila['ALTURA_DEL_FUSTE__M_'].'</td>';
                echo '<td>'.$fila['CIRCUNFERENCIA_ALTURA_PECHO__CM__CAP'].'</td>';
                echo '<td>'.$fila['ALTURA_MEDICION_DEL_CAP'].'</td>';
                echo '<td>'.$fila['COPA__M__-_MEDIDA_1'].'</td>';
                echo '<td>'.$fila['COPA__M__-_MEDIDA_2'].'</td>';
                echo '<td>'.$fila['DESCUBIERTAS'].'</td>';
                echo '<td>'.$fila['CUELLO_VISIBLE'].'</td>';
                echo '<td>'.$fila['LEVANTAMIENTO_DE_VEREDAS'].'</td>';
                echo '<td>'.$fila['LEVANTAMIENTO_DE_PAVIMENTO'].'</td>';
                echo '<td>'.$fila['UNICO'].'</td>';
                echo '<td>'.$fila['BIFURCADO'].'</td>';
                echo '<td>'.$fila['INCLINACION_MAYOR_A_45_'].'</td>';
                echo '<td>'.$fila['DESCORTEZAMIENTO'].'</td>';
                echo '<td>'.$fila['FRUCTIFICACIONES_FUNGICAS'].'</td>';
                echo '<td>'.$fila['DEFORMACION'].'</td>';
                echo '<td>'.$fila['CODOMINANCIA'].'</td>';
                echo '<td>'.$fila['DESCUBIERTAS'].'</td>';
                echo '<td>'.$fila['BASAL'].'</td>';
                echo '<td>'.$fila['ALTA'].'</td>';
                echo '<td>'.$fila['MEDIA'].'</td>';
                echo '<td>'.$fila['BAJAS'].'</td>';
                echo '<td>'.$fila['SECAS'].'</td>';
                echo '<td>'.$fila['QUEBRADAS'].'</td>';
                echo '<td>'.$fila['CODOMINANTES'].'</td>';
                echo '<td>'.$fila['AGALLA_CANCROS'].'</td>';
                echo '<td>'.$fila['DESCOPADO_Y_BROTACION'].'</td>';
                echo '<td>'.$fila['CLOROSIS'].'</td>';
                echo '<td>'.$fila['DENSIDAD_DEL_FOLLAJE'].'</td>';
                echo '<td>'.$fila['ESTADO_SANITARIO_GENERAL'].'</td>';
                echo '<td>'.$fila['ACEQUIA'].'</td>';
                echo '<td>'.$fila['POSTES_CERCA'].'</td>';
                echo '<td>'.$fila['VEREDA'].'</td>';
                echo '<td>'.$fila['INTERFIERE_CABLES'].'</td>';
                echo '<td>'.$fila['TAPA_DE_TAZA_INSCRUSTADA'].'</td>';
                echo '<td>'.$fila['OBSERVACIONES'].'</td>';
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
  wo();
  $.ajax({
      type: 'POST',
      data: {
          id: id
      },
      url: 'Reporte/getImagen',
      success: function(result) {
        wc();
        if (result.html != null) {
            var imagen = result.html.replace('dataimage/jpegbase64', 'data:image/jpeg;base64,');

            if(imagen != null || imagen!= '' || imagen != "") {

              $('#modal_imagen').find('#imagen_modal').prop("src", imagen);
              $('#modal_imagen').modal('show');
            }
            else {
              alert('Error');
            }

        }else{

            Swal.fire('No hay Imagen guardada de este Arbol')
        }

      },
      dataType: 'json'
  });
}

  </script>

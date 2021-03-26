<?php
$this->load->view('general/modal_editar');
  $this->load->view('general/modal_editar_Mzanas_Calles');
?>
<div class="box">
      <div class="box-header bg-green">
          <h3 class="box-title"><?php echo $titulo?></h3>
            
        </div><!-- /.box-header -->
        <div class="box-body">
        <div class="row">
                <div class="col-xs-2">
                 <button type="button" class=" btn-sm btn-primary btn-block" onclick="Nuevo('<?php echo $nombre;?>')">Nuevo</button>
                </div>

                <div class="col-md-12">
                  <hr>
                </div>

                <div class="col-xs-10">
                 </div>
             </div>
          <div class="row" style="margin-top:15px;">
            <div class="col-xs-12">
            <table id="tabla_lista" class="table table-bordered table-striped">
            <thead class="thead-dark"bgcolor="#eeeeee">
                <tr>
                  <th>Acciones</th>
                  <th><?php echo $nombre;?></th>
                  <?php
                    if(isset($lista[0]->depa_nombre)){
                      echo '<th>Departamento</th>';
                    }
                    if(isset($lista[0]->arge_nombre)){
                      echo '<th>Area Geográfica</th>';
                    }

                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                if($lista)
                {
                  foreach($lista as $fila)
                  {
                    $id=$fila->id;
                    echo "<tr  id='".$id."' data-json='".json_encode($fila)."'>";

                      echo '<td>';

                      echo '<i class="fa fa-fw fa-pencil text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Editar"></i>';
                      if($nombre == "Departamento"){
                        echo '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="borrarDepart('.$id.')"></i>';
                      }
                      if($nombre == "Arbol"){                        ;
                        echo '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="borrarArbol('.$id.')"></i>';
                      }
                      if($nombre == "Manzana"){
                        echo '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="borrarManzana('.$id.')"></i>';
                      }
                      if($nombre == "Calle"){
                        echo '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="borrarCalles('.$id.')"></i>';
                      }

                      echo '</td>';
                      echo '<td>'.$fila->nombre.'</td>';
                      if($nombre == "Calle"){
                        echo '<td>'.$fila->depa_nombre.'</td>';
                      }
                      if($nombre == "Manzana"){
                        echo '<td>'.$fila->depa_nombre.'</td>';
                        echo '<td>'.$fila->arge_nombre.'</td>';                              
                      }
                      if(isset($fila->apellido))
                      {
                        echo '<td>'.$fila->apellido.'</td>';
                        echo '<td>'.$fila->direccion.'</td>';
                        echo '<td>'.$fila->telefono.'</td>';
                      }
                    echo '</tr>';
                  }
                }
                ?>
              </tbody> 
            </table>
              
         
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  </body>
  <script>
  
  $(document).ready(function() {
        $('#tabla_lista').DataTable({
            responsive: true,
            language: {
                url: '<?php base_url() ?>lib/bower_components/datatables.net/js/es-ar.json' //Ubicacion del archivo con el json del idioma.
            }
        });
    });

                    
  function Nuevo(nombre)
  {
    switch(nombre)
    {
      case 'Arbol':
        linkTo('Arbol/Nuevo');
      break;

      case 'Censista':
        linkTo('Censista/Nuevo');
      break;
      case 'Departamento':
        linkTo('Departamento/Nuevo');
      break;
      case 'Calle':
        linkTo('Calle/Nuevo');
      break;
      case 'Manzana':
       linkTo('Manzana/Nuevo');
      break;
      default:
      break;
    }
  }

  function borrarDepart(id){
 
    $.ajax({
      type: 'POST',
      data: { id:id },
      url: 'Departamento/eliminar', 
      success: function(result){
        if(result < 300){
          linkTo('Departamento');
        }else{
          alert('No se pudo eliminar el Departamento...');
        }            	
      }
    });
  }

  function borrarArbol(id){    
   
    $.ajax({
      type: 'POST',
      data: { id:id },
      url: 'Arbol/borrar', 
      success: function(result){
        if(result < 300){
          linkTo('Arbol');
        }else{
          alert('No se pudo eliminar la especie...');
        }            	
      }
    });  
  }

  function borrarManzana(id){
    $.ajax({
      type: 'POST',
      data: { id:id },
      url: 'Manzana/borrar', 
      success: function(result){
        if(result < 300){
          linkTo('Manzana');
        }else{
          alert('No se pudo eliminar la manzana...');
        }            	
      }
    });
  }
  
  function borrarCalles(id){    
   
   $.ajax({
     type: 'POST',
     data: { id:id },
     url: 'Calle/borrar', 
     success: function(result){
       if(result < 300){
         linkTo('Calle');
       }else{
         alert('No se pudo eliminar la especie...');
       }            	
     }
   });  
  }

 // levanta modal editar y lo llena
  $(document).off('click', '.fa-pencil').on('click', '.fa-pencil', function() {

      nombre= '<?php echo $nombre?>';
      row = $(this).parents('tr').attr('data-json');
      info = JSON.parse(row);

      if (nombre == 'Departamento'){
        $("#nomDeptoArb").val(info.nombre);
        $("#idDeptoArbEditar").val(info.id);
        $("#modal_editar").modal("show");
      }
      if(nombre == 'Arbol'){
        $("#nomDeptoArb").val(info.nombre);
        $("#idDeptoArbEditar").val(info.id);
        $("#modal_editar").modal("show");
      }
      if(nombre == 'Manzana'){
        $("#Depto_id_ed").val(info.depa_id);
        $("#Depto_ed").val(info.depa_nombre);
        $("#manz_nom_editar").val(info.nombre);
        $("#manz_id_editar").val(info.id);
        $("#ar_editar_nom").val(info.arge_nombre);
        //fillSelectArea();
        $("#modal_editar_Mzanas_Calles").modal("show");
      }

      if(nombre == 'Calle'){
        $("#Depto_ed").val(info.depa_nombre);
        $("#calle_nom_editar").val(info.nombre);
        $("#calle_id_editar").val(info.id);
        $("#modal_editar_Mzanas_Calles").modal("show");
      }


  });


  </script>
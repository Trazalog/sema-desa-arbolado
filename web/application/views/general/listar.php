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
                  //if(isset($lista[0]->apellido)){
                    //echo '<th>Apellido</th>';
                    //echo '<th>Direccion</th>';
                    //echo '<th>Telefono</th>';
                  //}?>
                </tr>
              </thead>
              <tbody>
                <?php
                //var_dump($lista);
                if($lista)
                {
                      foreach($lista as $fila)
                      {
                                            
                          $id=$fila->id;
                          echo '<tr  id="'.$id.'" data-json:'.json_encode($fila).'>';

                            echo '<td>';
                            //echo '<i class="fa fa-fw fa-pencil text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Editar" onclick=linkTo("general/Etapa/editar?id='.$id.'")></i>';
                            // echo '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="seleccionar(this)"></i>';
                            
                            // var_dump($nombre);
                            if($nombre == "Departamento"){
                              echo '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="borrarDepart('.$id.')"></i>';
                            }
                            if($nombre == "Arbol"){
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
  
  
  $('#tabla_lista').dataTable();
 
                    
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


  </script>
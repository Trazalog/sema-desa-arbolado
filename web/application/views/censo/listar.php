<div class="box"> 
      <div class="box-header">
          <h3 class="box-title"><?php echo $titulo;?></h3>
            
        </div><!-- /.box-header -->
        <div class="box-body">
        <form role="form" id="formulario">
            <div class="form-group" style="width:40%" >
                     <label  class="form-label">Censo:</label>
                    <select  name="select"  id="Nombre" class="form-control" onchange="ActualizaCenso()">
                        <option value="" disabled selected>-Seleccione Censo-</option>
                        <?php
                        foreach($censos as $fila)
                        {
                           echo '<option value="'.$fila->id.'">'.$fila->nombre.'</option>' ;
                        }
                        ?>
                     </select>
                    </div>
                    
     <div id="divcensos">
        <div class="row" style="margin-top:25px">
            <div class="col-xs-12">
                <table id="censos" class="table">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>Departamento</th>
                            <th>Area Geografica</th>
                            <th>Manzana</th>
                            <th>Calles</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($censosarmados as $fila)
                    {
                        echo "<tr id='".$fila->id." data-json='".json_encode($fila)."'>";
                        echo "<th>";
                        echo '<i class="fa fa-fw fa-pencil text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Editar"></i>';
                        echo '<i class="fa fa-fw fa-plus text-light-blue asignar_censista" style="cursor: pointer; margin-left: 15px;" title="Asignar Censista" data-toggle="modal"></i>';
                        echo '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="seleccionar(this)"></i>';
                        echo "</th>";
                        echo "<th>".$fila->nombredepartamento."</th>";
                        echo "<th>".$fila->nombreareageo."</th>";
                        echo "<th>".$fila->nombremanzana."</th>";
                        if(count($fila->calles)!=0)
                        {
                            echo "<th><i class='fa fa-check-square'></i></th>";
                        }else{
                            echo "<th></th>";
                        }
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
     </div>
            <div class="row">
                <div class="col-xs-10">
                </div>
                <div class="col-xs-2">
                    <button type="button" class="btn btn-primary btn-block" onclick="Guardar('<?php echo $nombre;?>')">Aceptar</button>
                </div>
            </div>
    </form>
            
         
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  </body>
  <script>
  tablaCensos=$('#censos').DataTable();
  function ActualizaCenso()
  {
      id = document.getElementById('Nombre').value;
      tablaCensos.clear().draw();
      censos='<?php echo json_encode($censosarmados)?>';
      censos = JSON.parse(censos);
      for(i=0;i<censos.length;i++)
      {
          if(id == censos[i].idcenso)
          {
          tr="";
          tr+="<tr id='"+censos[i].id+" data-json='"+JSON.stringify(censos[i])+"'>";
          tr+= "<th></th>";
          tr+= "<th>"+censos[i].nombredepartamento+"</th>";
          tr+= "<th>"+censos[i].nombreareageo+"</th>";
          tr+= "<th>"+censos[i].nombremanzana+"</th>";
          if(censos[i].calles.length !=0)
          {
            tr+= "<th><i class='fa fa-check-square'></i></th>";
           }else{
            tr+= "<th></th>";
             }
          tr+= "</tr>";
          tablaCensos.row.add($(tr)).draw();
      }
    }
  }
  </script>
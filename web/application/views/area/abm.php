<?php $this->load->view('area/modal_calles')?>
<div class="box"> 
      <div class="box-header">
          <h3 class="box-title"><?php echo $titulo;?></h3>
            
        </div><!-- /.box-header -->
        <div class="box-body">
        <form role="form" id="formulario">
            <div class="form-group" style="width:40%" >
                    <label  class="form-label">Departamento:</label>
                    <select  name="select"  id="Nombre" class="form-control">
                        <option value="" disabled selected>-Seleccione Departamento-</option>
                        <?php
                        foreach($departamentos as $fila)
                        {
                           echo '<option value="'.$fila->id.'">'.$fila->nombre.'</option>' ;
                        }
                        ?>
                     </select>
                    </div>
                    <div class="form-group" style="width:40%" >
                     <label  class="form-label">Area geografica:</label>
                    <input type="text" class="form-control" placeholder="Inserte nombre del Area">
                    </div>
                    <div class="row">
                    <label  class="form-label" style="margin-left:15px">Manzana:</label>
                  <div class="col-md-6 col-xs-12 input-group" style="margin-left:15px">
                 
                <input type="text" id="manzana" class="form-control" placeholder="Inserte Nombre Manzana"autocomplete="off">
                <span class="input-group-btn">
                    <button class='btn btn-primary' 
                    onclick='AgregarManzana()'>
                    Agregar</button>
                    </span> 
            </div>
        </div>
        <div class="row" style="margin-top:25px">
            <div class="col-xs-12">
                <table id="manzanas_asignadas" class="table">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>Manzana</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    
            <div class="row">
                <div class="col-xs-10">
                </div>
                <div class="col-xs-2">
                    <button type="button" class="btn btn-primary btn-block" onclick="Guardar()">Aceptar</button>
                </div>
            </div>
    </form>
            
         
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  </body>
  <script>
  var manzanasAsignadas=$('#manzanas_asignadas').DataTable();
  $(document).ready(function() {
    $('#formulario').bootstrapValidator({
        message: 'Este Valor no es valido',
        fields: {
            select: {
                message: 'El Nombre ingresado no es valido',
                validators: {
                    notEmpty: {
                        message: 'Seleccione algun Valor'
                    }
                }
            },
            texto: {
                message: 'El Nombre ingresado no es valido',
                validators: {
                    notEmpty: {
                        message: 'Ingreso algun Valor'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'El nombre solo puede usar caracteres alfabeticos o numericos'
                    }
                }
            }
        }
    });
});
  
function Guardar(nombre)
  {
    $('#formulario').bootstrapValidator('validate');
    estado= $('#formulario').data('bootstrapValidator').isValid();
    if(estado)
    {
        console.log('ok');
    }
}
function checkTabla(idtabla, idrecipiente, json, acciones)
{
  lenguaje = <?php echo json_encode($lang)?>;
  if(document.getElementById(idtabla)== null)
  {
    armaTabla(idtabla,idrecipiente,json,lenguaje,acciones);
  }
}
function MuestraCalles()
{
    if(document.getElementById('checkcalles').checked)
    {
        document.getElementById('divcalles').hidden = false;
    }else{
        document.getElementById('divcalles').hidden = true;
    }
}

function AgregarManzana()
{
    manzana={};
    manzana.nombre = document.getElementById('manzana').value;
    manzana.id=0;
    calles='[]';
    tr="";
    tr+="<tr data-json='"+JSON.stringify(manzana)+"' data-calles=''>";
    tr+="<td><i class='fa fa-fw fa-minus text-light-blue manzanas_asignadas_borrar' style='cursor: pointer; margin-left: 15px;' title='Eliminar'></i>";
    tr+="<i class='fa fa-fw fa-plus text-light-blue manzanas_asignadas_calle' style='cursor: pointer; margin-left: 15px;' title='Asignar Calles'></i>";
    tr+="<i class='fa fa-fw fa-search text-light-blue manzanas_asignadas_ver' style='cursor: pointer; margin-left: 15px;' title='Ver Calles'></i></td>";
    tr+="<td>"+manzana.nombre+"</td></tr>";
    manzanasAsignadas.row.add($(tr)).draw();
    document.getElementById('manzana').value="";
}
$(document).off('click','.manzanas_asignadas_borrar').on('click', '.manzanas_asignadas_borrar', function()
  {
    var tableRow = manzanasAsignadas.row($(this).parents('tr'));
        manzanasAsignadas.row( tableRow ).remove().draw();
} );
$(document).off('click','.manzanas_asignadas_calle').on('click', '.manzanas_asignadas_calle', function()
  {
    checkTabla("tablacalles","modalcalles",`<?php echo json_encode($calles);?>`,"Add");
    TrActual= $(this).parents('tr');
    $('#modal_calles').modal('show');
} );
  </script>
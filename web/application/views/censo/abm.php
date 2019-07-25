<?php $this->load->view('censo/modal_areas')?>
<?php $this->load->view('censo/modal_departamentos')?>
<div class="box"> 
      <div class="box-header">
          <h3 class="box-title"><?php echo $titulo;?></h3>
            
        </div><!-- /.box-header -->
        <div class="box-body">
        <form role="form" id="formulario">
            <div class="form-group" style="width:40%" >
                     <label  for="Nombre" class="form-label">Nombre Censo:</label>
                    <input type="text" name="texto"  id="Nombre" <?php if($accion == 'Editar'){echo ('value="'.$etapa->lote.'"');}?> class="form-control" placeholder="Inserte nombre del Censo" />
                    </div>
             <div class="form-group" style="width:40%" >
                 <label  for="Nombre" class="form-label">Seleccione Fecha:</label>
                 <input type="date" name="texto"  id="Fecha" class="form-control" />
             </div>
             <div class="row">
             <label style="margin-left:15px"for="">Departamento:</label>
            <div class="col-md-6 col-xs-12 input-group" style="margin-left:15px">
                <input list="departamentos" id="inputdepartamentos" placeholder="Seleccione departamento" class="form-control" autocomplete="off" onchange="AgregarDepartamentoInput()">
                <datalist id="departamentos">
                <?php foreach($departamentos as $fila)
                {
                    echo  "<option data-json='".json_encode($fila)."'value='".$fila->nombre."'>";
                }
                    ?>
                </datalist>
                <span class="input-group-btn">
                    <button class='btn btn-primary' 
                   data-toggle="modal" data-target="#modal_departamentos">
                    <i class="glyphicon glyphicon-search"></i></button>
                    </span> 
            </div>
        </div>
        <div class="row">
        <label for="" style="margin-left:15px">Area:</label>
            <div class="col-md-6 col-xs-12 input-group" style="margin-left:15px">
                <input list="areas" id="inputareas" class="form-control" autocomplete="off" placeholder="Inserte Area" onchange="AgregarAreaInput()">
                <datalist id="areas">
                <?php foreach($areas as $fila)
                {
                    echo  "<option data-json='".json_encode($fila)."'value='".$fila->nombre."'>";
                }
                    ?>
                </datalist>
                <span class="input-group-btn">
                    <button class='btn btn-primary' 
                    data-toggle="modal" data-target="#modal_areas">
                    <i class="glyphicon glyphicon-search"></i></button>
                    </span> 
            </div>
        </div>
        <div class="row" style="margin-top:25px">
            <div class="col-xs-12">
                <table class="table" id="tablaareasasignadas">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>Area Geografica</th>
                            <th>Departamento</th>
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
  TablaAsignadas = $('#tablaareasasignadas').DataTable();
  $('#tablaareas').DataTable();
  $('#tabladepartamentos').DataTable();
  $(document).ready(function() {
    $('#formulario').bootstrapValidator({
        message: 'Este Valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            texto: {
                message: 'El Nombre ingresado no es valido',
                validators: {
                    notEmpty: {
                        message: 'Ingrese algun Valor'
                    }
                }
            }
        }
    });
});
  
function Guardar()
  {
    $('#formulario').bootstrapValidator('validate');
    estado= $('#formulario').data('bootstrapValidator').isValid();
    
    if(estado)
    {
        data = {};
        data.nombre = document.getElementById('Nombre').value;
        data.fecha = document.getElementById('Fecha').value;
        data= JSON.stringify(data);
        $.ajax({
        type: 'POST',
        data: { data:data },
        url: 'Censo/Guardar_Nuevo', 
        success: function(result){
            linkTo('Censo');
        }
        });
        
    }    
}
function AgregarArea(area)
{
    tr="";
    tr+="<tr data-json='"+JSON.stringify(area)+"'>";
    tr+="<td><i class='fa fa-fw fa-minus text-light-blue tablas_asignadas_borrar' style='cursor: pointer; margin-left: 15px;' title='Eliminar'></i>";
    tr+="<i class='fa fa-fw fa-plus text-light-blue tablas_asignadas_calle' style='cursor: pointer; margin-left: 15px;' title='Asignar Calles'></i>";
    tr+="<i class='fa fa-fw fa-search text-light-blue tablas_asignadas_ver' style='cursor: pointer; margin-left: 15px;' title='Ver Calles'></i></td>";
    tr+="<td>"+area.nombre+"</td>"
    tr+="<td>"+area.departamento+"</td></tr>";
    TablaAsignadas.row.add($(tr)).draw();
}
$(document).off('click','.tablas_asignadas_borrar').on('click', '.tablas_asignadas_borrar', function()
  {
    var tableRow = TablaAsignadas.row($(this).parents('tr'));
        TablaAsignadas.row( tableRow ).remove().draw();
} );
function AgregarAreaInput()
{
ban = $("#areas option[value='" + $('#inputareas').val() + "']").length;
if(ban == 0)
{
    alert('todo mal mono');
}else{
    area = JSON.parse($("#areas option[value='" + $('#inputareas').val() + "']").attr('data-json'));
   AgregarArea(area);
    }
}
function AgregarDepartamentoInput()
{
ban = $("#departamentos option[value='" + $('#inputdepartamentos').val() + "']").length;
if(ban == 0)
{
    alert('todo mal mono');
}else{
    departamento = JSON.parse($("#departamentos option[value='" + $('#inputdepartamentos').val() + "']").attr('data-json'));
    areas ='<?php echo json_encode($areas)?>';
    areas = JSON.parse(areas);
   for(i=0;i<areas.length;i++)
   {
       if(departamento.id == areas[i].iddepartamento)
       {
          
           AgregarArea(areas[i]);
       }
   }
    }
}
  </script>
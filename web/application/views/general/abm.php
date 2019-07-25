<div class="box"> 
      <div class="box-header">
          <h3 class="box-title"><?php echo $titulo;?></h3>
            
        </div><!-- /.box-header -->
        <div class="box-body">
        <form role="form" id="formulario">
            <div class="form-group" style="width:40%" >
                     <label  for="Nombre" class="form-label"><?php echo $nombre;?>:</label>
                    <input type="text" name="texto"  id="Nombre" <?php if($accion == 'Editar'){echo ('value="'.$etapa->lote.'"');}?> class="form-control" placeholder="Inserte nombre del <?php echo $nombre;?>" />
                    </div>
                    <?php if($nombre == 'Censista'){?>
                        <div class="form-group" style="width:40%">
                            <label  class="form-label">Apellido:</label>
                            <input type="text" id="Apellido"   name="texto" <?php if($accion == 'Editar'){echo ('value="'.$etapa->lote.'"');}?> class="form-control" placeholder="Inserte Apellido" />
                        </div>
                        <div class="form-group" style="width:40%">
                            <label  class="form-label" >Direccion:</label>
                            <input type="text" id="Direccion"  name="texto" <?php if($accion == 'Editar'){echo ('value="'.$etapa->lote.'"');}?> class="form-control" placeholder="Inserte Direccion" />
                        </div>
                        <div class="form-group" style="width:40%" >
                            <label  class="form-label">Telefono:</label>
                            <input type="number" id="Telefono" name="texto" <?php if($accion == 'Editar'){echo ('value="'.$etapa->lote.'"');}?> class="form-control" placeholder="Inserte Telefono" />
                        </div>

                    <?}?>
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
  $(document).ready(function() {
    nombre= '<?php echo $nombre?>';
    if(nombre = 'Censista')
    {
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
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'El nombre solo puede usar caracteres alfabeticos o numericos'
                    }
                }
            }
        }
    });
}else{
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
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'El nombre solo puede usar caracteres alfabeticos o numeros'
                    }
                }
            }
        }
    });
}
});
  
function Guardar(nombre)
  {
    $('#formulario').bootstrapValidator('validate');
    estado= $('#formulario').data('bootstrapValidator').isValid();
    if(estado)
    {
        datonombre = document.getElementById('Nombre').value
        switch(nombre)
        {
        case 'Arbol':
        $.ajax({
        type: 'POST',
        data: { datonombre:datonombre },
        url: 'Arbol/Guardar_Nuevo', 
        success: function(result){
            linkTo('Arbol');
        }
        });
        
        break;
        case 'Area geografica':
        $.ajax({
        type: 'POST',
        data: { datonombre:datonombre },
        url: 'Area/Guardar_Nuevo', 
        success: function(result){
            console.log(result);
            linkTo('Area');
        }
        });
        
        break;
        case 'Censista':
        apellido = document.getElementById('Apellido').value
        direccion = document.getElementById('Direccion').value
        telefono = document.getElementById('Telefono').value
        $.ajax({
        type: 'POST',
        data: { datonombre:datonombre, apellido:apellido, direccion: direccion, telefono:telefono },
        url: 'Censista/Guardar_Nuevo', 
        success: function(result){
            console.log(result);
            linkTo('Censista');
        }
        });
        break;
        case 'Departamento':
        $.ajax({
        type: 'POST',
        data: { datonombre:datonombre },
        url: 'Departamento/Guardar_Nuevo', 
        success: function(result){
            console.log(result);
            linkTo('Departamento');
        }
        });
        break;
        case 'Calle':
        $.ajax({
        type: 'POST',
        data: { datonombre:datonombre },
        url: 'Calle/Guardar_Nuevo', 
        success: function(result){
            console.log(result);
            linkTo('Calle');
        }
        });
        break;
        case 'Manzana':
        $.ajax({
        type: 'POST',
        data: { datonombre:datonombre },
        url: 'Manzana/Guardar_Nuevo', 
        success: function(result){
            console.log(result);
            linkTo('Manzana');
        }
            });
        break;
        default:
        break;
        }
    }
}
  </script>
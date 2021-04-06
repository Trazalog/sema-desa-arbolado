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

										<!-- departamentos -->
										<?php  if($nombre == 'Calle'){?>
											<label for="">Departamento:</label>
											<div class="col-md-6 col-xs-12 input-group" >
											<input list="departamentos" id="inputdepartamentos" placeholder="Seleccione departamento" class="form-control" autocomplete="off">										
											<!-- <input list="departamentos" id="id_inputdepartamentos" placeholder="id_departamentopo" class="form-control" autocomplete="off" onchange="AgregarDepartamentoInput()">-->
											<datalist id="departamentos"> 
                        <?php foreach($departamentos as $fila)
                          {
                              echo  "<option data-json='".json_encode($fila)."' value='".$fila->nombre."' data-id='".$fila->id."'   >";							
                          }											
                        ?>
											</datalist>
										<!-- <span class="input-group-btn">
												<button class='btn btn-primary' 
											data-toggle="modal" data-target="#modal_departamentos">
												<i class="glyphicon glyphicon-search"></i></button>
                    </span>  -->
            </div>

                    <?php } ?>

                    <!-- area -->
										<?php  if($nombre == 'Manzana'){?>     

                          <label for="" style="margin-left:10px">Area:</label>
                          <div class="col-md-6 col-xs-12 input-group" >
                          <!-- <div class="col-md-12  input-group" style="margin-left:15px"> -->
                              <!-- <input list="areas" id="argeo" class="form-control" autocomplete="off"
                                  placeholder="Seleccione Area" onchange="AgregarAreaInput()"> -->
                              <input list="areas" id="argeo" class="form-control" autocomplete="off"
                                  placeholder="-Seleccione Area-">
                              <datalist id="areas">
                                <?php    
                                  foreach($areas as $fila)
                                  {
                                    echo  "<option data-json='".json_encode($fila)."'value='".$fila->nombre."'>";
                                  }
                                ?>
                              </datalist>
                              <!-- <span class="input-group-btn">
                                  <button class='btn btn-primary' data-toggle="modal" data-target="#modal_areas">
                                      <i class="glyphicon glyphicon-search"></i></button>
                              </span> -->
                          </div>

                    <?php } ?> 
                    
                    
            <div class="row">
                <div class="col-xs-10">
                </div>
                <div class="col-xs-2">
                    <button type="button" class="btn btn-primary btn-block" onclick="Guardar('<?php echo $nombre;?>')">Guardar</button>
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
                          regexp: /[A-Za-z]/,
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
  // toma id de departamento al cambiar
    var depaId = 0;
    $('#inputdepartamentos').on('change', function() {
      var nombreDepa = this.value;
      var json = $('#departamentos').find('[value="' + nombreDepa + '"]').attr('data-json');
      json = JSON.parse(json);
      depaId = json.id;     
    }); 
  
    var areaId = 0;
    $('#argeo').on('change', function() {
      var nombre = this.value;
      var json = $('#areas').find('[value="' + nombre + '"]').attr('data-json');
      json = JSON.parse(json);
      areaId = json.arge_id;
    }); 

    // guarda nuevo segun nombre
    function Guardar(nombre){

      $('#formulario').bootstrapValidator('validate');
      estado= $('#formulario').data('bootstrapValidator').isValid();
      if(estado)
      {
          datonombre = document.getElementById('Nombre').value;	

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
          
          //TODO:REVISAR MODELO
          case 'Calle':
          
                alert(depaId);

                $.ajax({
                  type: 'POST',
                  data: { datonombre:datonombre,
                          depaId: depaId },
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
                  data: { datonombre:datonombre,
                          argeo: areaId},
                  url: 'Manzana/Guardar_Nuevo', 
                  success: function(result){
                  if(result){
                    linkTo('Manzana');
                  }else{
                    alert("Error en guardado de Manzana...");
                  }
                    
                  }
                });
                break;
          default:
          break;
          }
      }
    }
  </script>
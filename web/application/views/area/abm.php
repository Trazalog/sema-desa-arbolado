<?php $this->load->view('area/modal_calles')?>
<?php $this->load->view('censo/modal_areas')?>
<div class="box"> 
      <div class="box-header bg-green ">
          <h3 class="box-title"><?php echo $titulo;?></h3>
            
        </div><!-- /.box-header -->
        <div class="box-body">


         <!-- /// ----------------------------------- FORMULARIO ----------------------------------- /// -->

         
        <form role="form" id="formulario">

            <!-- /// ____________________________ FORMULARIO GRUPO ____________________________ /// -->
            
            <div class="form-group"  >
            <div class="col-md-4">           
            

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

            </div>
            

            <!-- ____________________________ AREA GEOGRAFICA  ____________________________ -->
            <div class="col-md-4">

                <div class="form-group"  >      
                        <label  class="form-label">Area geografica:</label>
                        
                        <!--<input type="text" class="form-control" placeholder="Inserte nombre del Area"> -->                                 
                        
                        <input list="areas" id="inputareas" class="form-control" autocomplete="off" placeholder="Seleccione Area" onchange="AgregarAreaInput()">
								<datalist id="areas">
								<?php foreach($areas as $fila)
								{
									echo  "<option data-json='".json_encode($fila)."'value='".$fila->nombre."'>";
								}
									?>
								</datalist>
								 
                    </div>
                        
                </div>

                <!-- ____________________________ MANZANA  ____________________________ -->

                <div class="form-group"  >
                        <label  class="form-label" style="margin-left:15px">Manzana:</label>
                    <div class="col-md-4  input-group" style="margin-left:15px">
                </div> 

                    <!-- ____________________________ MANZANA  ____________________________ -->
                
                    <div class="form-group"  > 
                        <div class="col-md-4">
                        <input type="text" id="manzana" class="form-control" placeholder="Inserte Nombre Manzana"autocomplete="off">
                        </div>
                        
                        <div class="col-md-12">

							<hr>					 
                               
                            
                            <span class="input-group-btn">
                                <button class='btn btn-primary pull-right ' 
                                onclick='AgregarManzana()'>
                                Agregar</button>
                            </span>
                         </div> 
                            
                    
                </div>
                <div class="col-md-12">   
                <hr>
                </div>
                
            

            
            </div>

            <!-- /// ____________________________ FORMULARIO GRUPO 2 ____________________________ /// -->

            
        
        <!--<div class="row">
                <div class="col-xs-10">
                </div>
                <div class="col-xs-2">
                    <button type="button" class="btn btn-primary btn-block" onclick="Guardar()">Acepzczxtar</button>
                </div>
        </div>-->


        </div>

        <div class="box-body table-scroll">
        
                <table id="manzanas_asignadas" class="table">
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>Manzana</th>
                            <th>Area Geografica</th>
                            <th>Departamento</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
  
            
    </form>

        <!-- /// ----------------------------------- FORMULARIO ----------------------------------- /// -->
            
         
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  </body>




  <!-- ///////////////////////////////////////// SCRIPT /////////////////////////////////////////-->


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

//<!--________________________________________ GUARDAR ________________________________________-->

  
function Guardar(nombre)
  {
    $('#formulario').bootstrapValidator('validate');
    estado= $('#formulario').data('bootstrapValidator').isValid();
    if(estado)
    {
        console.log('ok');
    }
}

//<!--________________________________________ CHECK TABLA ________________________________________-->


function checkTabla(idtabla, idrecipiente, json, acciones)
{
  lenguaje = <?php echo json_encode($lang)?>;
  if(document.getElementById(idtabla)== null)
  {
    armaTabla(idtabla,idrecipiente,json,lenguaje,acciones);
  }
}

//<!--________________________________________ MOSTRAR CALLE ________________________________________-->

function MuestraCalles()
{
    if(document.getElementById('checkcalles').checked)
    {
        document.getElementById('divcalles').hidden = false;
    }else{
        document.getElementById('divcalles').hidden = true;
    }
}

//<!--________________________________________ AGREGAR MANZANA ________________________________________-->

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

  <!-- ///////////////////////////////////////// SCRIPT /////////////////////////////////////////-->
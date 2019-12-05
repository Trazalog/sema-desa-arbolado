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
            <div class="col-md-6"> 

            <label  class="form-label">Area geografica:</label>
                        
                        <!--<input type="text" class="form-control" placeholder="Inserte nombre del Area"> -->                                 
                        
                        <input  id="inputareas" class="form-control" autocomplete="off" placeholder="Inserte nombre de Area">
								
								 
                    </div>
            
                      
            

                    

                    

            </div>
            

            <!-- ____________________________ AREA GEOGRAFICA  ____________________________ -->
            <div class="col-md-6">

                <div class="form-group"  >      
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

                <!-- ____________________________ MANZANA  ____________________________ -->

                <!-- <div class="form-group"  >
                        <label  class="form-label" style="margin-left:15px">Manzana:</label>
                    <div class="col-md-4  input-group" style="margin-left:15px">
                </div>  -->

                    <!-- ____________________________ MANZANA  ____________________________ -->
                
                    <!-- <div class="form-group"  > 
                        <div class="col-md-4">
                        <input type="text" id="manzana" class="form-control" placeholder="Inserte Nombre Manzana"autocomplete="off">
                        </div>
                         -->
                        <div class="col-md-12">

							<hr>					 
                               
                            
                            <span class="input-group-btn">
                                <button class='btn btn-primary pull-right ' 
                                onclick='AgregarArea()'>
                                Agregar</button>
                            </span>
                         </div> 
                            
                    
               
                
            

            
            </div>

            <!-- /// ____________________________ FORMULARIO GRUPO 2 ____________________________ /// -->

            
        
        

        </div>

    
        
       
        
        
            
    </form>
    

        <!-- /// ----------------------------------- FORMULARIO ----------------------------------- /// -->
            
         
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  </body>


  <!-- /// ----------------------------------- FORMULARIO ----------------------------------- /// -->

  <div class="box">  

    <div class="row" style="margin-top:25px">

            <div class="box-body table-scroll">
            
                <div class="col-md-12">
                    <table id="manzanas_asignadas" class="table">
                        <thead bgcolor="#eeeeee" color="#fff" align="center"> 
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

                 <!-- _________________SEPARADOR_________________ -->

                <div class="col-md-12">
                <hr>
                 </div>

                  <!-- _________________SEPARADOR_________________ -->


    

                <div class="col-md-12"> <button type="button" class="btn btn-primary pull-right" onclick="Guardar_Nuevo()">GUARDAR</button> </div>

            </div>
            </div>


    
</div>







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

  
// function Guardar(nombre)
//   {
//     $('#formulario').bootstrapValidator('validate');
//     estado= $('#formulario').data('bootstrapValidator').isValid();
//     if(estado)
//     {
//         console.log('ok');
//     }
// }

//<!--________________________________________ GUARDAR NUEVO ________________________________________-->


function Guardar_Nuevo() {


    // variables array

    var arrayarge = []
    var arrayarea;

    // _________________________________
   
    //Extraer de la Tabla cada JSON

     $('#manzanas_asignadas tbody tr').each(function() {
        var json = JSON.parse(this.dataset.json);
        arrayarge.push(json);
    });

    console.log(arrayarge);

    // _________________________________

    // Armado de JSON

    // var datosArea = JSON.parse('{ "_post_area": {"nombre": "' + $('#inputareas').val() + '", "depa_id": "' + $("#Nombre") 
    //     .val() + '"}}');

        
    

    arrayarea = JSON.parse(arrayarge[0]);

     // _________________________________

    // AJAX 

     $.ajax({
        type: 'POST',
        dataType: "json",
        data: {
            data: arrayarge [0]
        },
        url: 'Area/Guardar_Nuevo',

          
        success: function(result) {
            // var arge_id = JSON.parse(result).respuesta.arge_id;
            // agregarAreaCenso(cens_id, array);
        },
        error: function() {
            alert('Error');
        }
    });   



   //console.log(array);



    // // Ajax
    
    // $.ajax({
    //     type: 'POST',
    //     dataType: "json",
    //     data: {
    //         data: {array},
    //     },
    //     url: '',

    //     success: function(result) {
    //         var arge_id = JSON.parse(result).respuesta.depa_id;
    //         agregarArea(depa_id, array);
    //     },
    //     error: function() {
    //         alert('Error');
    //     }
    // });

    
    // // console.log(array);






    // var array = [];
    // var arrayareas = [];

    // $('#manzanas_asignada').each(function() {
    //     var json = JSON.parse(this.dataset.json);
    //     array.push(json);
    // });
    // var datosArea = JSON.parse('{ "_post_area": {"nombre": "' + $('#inputareas').val() + '", "depa_id": "' + $("#Nombre") + '", "manz_id": "' + $("#manzana")
    //     .val() + '"}}');
    
    // arrayarea.push(datosArea);

    // $.ajax({
    //     type: 'POST',
    //     data: {
    //         data: arrayarea[0]
    //     },
    //     url: '',
    //     success: function(result) {
    //         var cens_id = JSON.parse(result).respuesta.arge_id;
    //         agregarArea(arge_id, array);
    //     },
    //     error: function() {
    //         alert('Error');
    //     }
    // });
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

//<!--________________________________________ AGREGAR EN TABLA ________________________________________-->


function AgregarArea()

{

    // Varaibles de datos de los campos a listar

    var data = {};
    data.area = $('#inputareas').val();
    data.departamento = $('#Nombre').find('option:selected').html();
    data.depa_id = $('#Nombre').val();
    // data.manzana = $('#manzana').val();

    //console.log(data);
    
    tr="";
    tr+="<tr data-json='"+JSON.stringify(data)+"' data-calles=''>";
    tr+="<td><i class='fa fa-fw fa-minus text-light-blue manzanas_asignadas_borrar' style='cursor: pointer; margin-left: 15px;' title='Eliminar'></i>";
    tr+="<i class='fa fa-fw fa-plus text-light-blue manzanas_asignadas_calle' style='cursor: pointer; margin-left: 15px;' title='Asignar Calles'></i>";
    tr+="<i class='fa fa-fw fa-search text-light-blue manzanas_asignadas_ver' style='cursor: pointer; margin-left: 15px;' title='Ver Calles'></i></td>";
    tr+="<td>"+data.area+"</td><td>"+data.departamento+"</td></tr>";
    manzanasAsignadas.row.add($(tr)).draw();

    // Limpiar Campos
    data.area = $('#inputareas').val('');
    data.departamento = $('#Nombre').val('');
    // data.manzana = $('#manzana').val('');
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
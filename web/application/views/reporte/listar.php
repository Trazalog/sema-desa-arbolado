<style>
.dt-button {
  padding: 0;
  border: none;
}
    #WindowLoad {
        position: fixed;
        top: 0px;
        left: 0px;
        z-index: 3200;
        filter: alpha(opacity=65);
        -moz-opacity: 65;
        opacity: 0.65;
        background: #ffffff;
    	}
</style>

<div class="box"> 
      <div class="box-header bg-green">
          <h3 class="box-title"><?php echo $titulo?></h3>
            
        </div><!-- /.box-header -->
        <div class="box-body">

        <!-- /// ----------------------------------- FORMULARIO ----------------------------------- /// -->
        
        <div class="row">
        <form action="" id="form">
            <div class="form-group col-md-12" style="width:30%">
                <label for="censo_select">Censo:</label>
                <select name="select" id="censo_select" class="form-control" required>
										<option value="" disabled selected>-Seleccione Censo-</option>
										<?php foreach($censos as $fila)
											{
												echo  "<option value='".$fila->id."'>".$fila->nombre.'</option>';    
											} 
										?> 
                </select>

            </div>
        </div>    
        <div class="row">
              <div class="col-md-2" style="width:15%">

                <label for="example-date-input" class="col-6 col-form-label">Fecha Desde:</label>
                <input class="form-control" type="date" id="fec_desde" id="example-date-input" required>

              </div>

              <div class="col-md-2" style="width:15%">
                
              <label for="example-date-input" class="col-6 col-form-label">Fecha Hata:</label>
                <input class="form-control" type="date" id="fec_hasta" id="example-date-input" required>
 
                </div>
                <div class="col-md-2">
                 <label class="col-6 col-form-label">Departamento:</label>
                        <div class="input-group date" id="carg" class="col-md-2">
                            <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                                <select class="form-control" id="departamento" multiple="multiple" data-live-search="true" title="Seleccione Departamento" data-actions-box="true"  style="width: 50%;" data-style="btn-success" required>
                            
                                    <?php
                                          foreach($departamentos as $fila)
                                          {
                                            echo '<option value="'.$fila->id.'">'.$fila->nombre.'</option>' ;
                                          }
                                    ?>
                                </select>
                        </div>
                  </div>
                 
                 <div class="col-md-3" style="width:20%">
                 <label for="" style="margin-left:10px">Area:</label>
                      <div class="input-group date" id="carg" class="col-md-2">
                      <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                          <select class="form-control" id="area" multiple="multiple"  data-live-search="true"  title="Seleccione Area"  data-actions-box="true" style="width: 500%;" data-style="btn-success" required>
                                <?php    
                                  foreach($areas as $fila)
                                  {
                                    echo '<option value="'.$fila->idArea.'">'.$fila->departamento."- ".$fila->nombreArea.'</option>' ;
                                  }
                                ?>
                          </select>
                      </div>
                 </div> 

                 <div class="col-md-3">
                 <label for="" style="margin-left:10px">Manzana:</label>
                          <div class="col-md-6 col-xs-12 input-group" >
                            <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                          <select class="form-control" id="manzana" multiple="multiple"  data-live-search="true"  title="Seleccione Manzana"  data-actions-box="true" style="width: 500%;" data-style="btn-success" required>
                                <?php    
                                  foreach($manzanas as $fila)
                                  {
                                    echo '<option value="'.$fila->id.'">'.$fila->depa_nombre."- ".$fila->nombre.'</option>' ;
                                  }
                                ?>
                         </select>
                          </div>
                 </div>

                <div class="col-md-12">
              
                <br>
                <div class="col-md-12">

                </div>
                <div class="col-md-10"> </div>
                <div class="col-md-2">
                <br>
                <button id="btn_buscar_filtros" type="submit" class="btn btn-success waves-effect waves-light mt-2" style="margin-top: 1rem;">Listar Coincidencias</button>
                 
                </div>
              
                <div class="col-xs-12">
                <hr>
                 </div>
        </div> 
        </form>      
          <div class="row">
          <div class="col-md-12 table-responsive" id="cargar_tabla"></div>
             
          </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  </body>

<script>
    $('select').selectpicker();

function jsRemoveWindowLoad() {
        // eliminamos el div que bloquea pantalla
        $("#WindowLoad").remove();

    }
$( document ).ready(function() {
    $("#WindowLoad").remove();
    $(this).click(jsShowWindowLoad('Se esta Generando la Información'));
    setTimeout(() => {
        jsRemoveWindowLoad();
    }, 10000);
});

function jsShowWindowLoad(mensaje) {
        //eliminamos si existe un div ya bloqueando
        jsRemoveWindowLoad();

        //si no enviamos mensaje se pondra este por defecto
        if (mensaje === undefined) mensaje = "Procesando la información<br/>Espere por favor";

        //centrar imagen gif
        height = 20; //El div del titulo, para que se vea mas arriba (H)
        var ancho = 0;
        var alto = 0;

        //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
        if (window.innerWidth == undefined) ancho = window.screen.width;
        else ancho = window.innerWidth;
        if (window.innerHeight == undefined) alto = window.screen.height;
        else alto = window.innerHeight;

        //operación necesaria para centrar el div que muestra el mensaje
        var heightdivsito = alto / 2 - parseInt(height) / 2; //Se utiliza en el margen superior, para centrar

        //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
        imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div  style='color:#1C2833;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje + "</div><img  src='<?php echo base_url(); ?>assets/img/Isologo.png'></div>";

        //creamos el div que bloquea grande------------------------------------------
        div = document.createElement("div");
        div.id = "WindowLoad"
        div.style.width = ancho + "px";
        div.style.height = alto + "px";
        $("body").append(div);

        //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
        input = document.createElement("input");
        input.id = "focusInput";
        input.type = "text"

        //asignamos el div que bloquea
        $("#WindowLoad").append(input);

        //asignamos el foco y ocultamos el input text
        $("#focusInput").focus();
        $("#focusInput").hide();

        //centramos el div del texto
        $("#WindowLoad").html(imgCentro);

    }
    function validar() {
 //obteniendo el valor que se puso en el campo text del formulario
 var miCampoTexto = document.getElementById("miCampo").value;
 //la condición
 if (miCampoTexto.length == 0 || /^\s+$/.test(miCampoTexto)) {
     alert('El campo de texto esta vacio!');
     return false;
 }
      }   

      



$("#btn_buscar_filtros").click(function(e){
//  $("#form").validate();
   
        var censo_select = $("#censo_select").val();
        var fec_desde = $("#fec_desde").val();
        var fec_hasta = $("#fec_hasta").val();
        var departamento = $("#departamento").val();
        var area = $("#area").val();
        var manzana = $("#manzana").val();

        console.log(censo_select)
        console.log(fec_desde)
        console.log(fec_hasta)
        console.log(departamento)
       var url = "Reporte/buscar_por_filtro_listar?cens_id="+censo_select+"&fec_desde="+fec_desde+"&fec_hasta="+fec_hasta+"&departamento="+departamento+"&area="+area+"&manzana="+manzana;
       
       console.log(url)
        $("#WindowLoad").remove();
        $(this).click(jsShowWindowLoad('Se esta Generando la Información'));
        $.ajax({
                type: 'POST',
                data: {censo_select, fec_desde, fec_hasta, departamento, area, manzana},
                url: 'index.php/Reporte/buscar_por_filtros',
                success: function(data) {
                  debugger;
                    $("#cargar_tabla").load("<?php echo base_url(); ?>"+url+"");
                },
                error: function(data) {
                    alert('Error');
                },
                complete : function(data) {
                    setTimeout(() => {
                        jsRemoveWindowLoad();
                    }, 9000);
                    
                }
            });

          });

$(document).ready(function() {
$("#form").validate({
    rules: {
      censo_select : {
        required: true
        
      },
      fec_desde: {
        required: true
      },
      fec_hasta: {
        required: true
	  },
	  departamento : {
        required: true        
	  },
	  area : {
        required: true
	  },
	  manzana : {
        required: true
	  }

     
    },
    messages : {
      censo_select: {
			required: "Debe seleccionar Censo"
      },
      fec_desde: {
        required: "Debe seleccionar Fecha"

      },
      fec_hasta: {
        required: "Debe seleccionar Fecha"
	  },
	  departamento: {
        required: "Debe seleccionar Departamento"
	  },
	  area: {
        required: "Debe seleccionar Area"
	  },
	  manzana: {
      required: "Debe seleccionar Manzana"
	  }
    }
  });
});

</script>




</div>
</div>
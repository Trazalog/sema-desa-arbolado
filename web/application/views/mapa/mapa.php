<?php $this->load->view('mapa/modal_detalles')?>
<div class="box"> 
  <div class="box-header">
    <h3 class="box-title">Mapa:</h3>
  </div><!-- /.box-header -->
  <div class="box-body" style="height: 500px; width:1000px">
    <div id="map" style="height: 100%"></div>
  </div><!-- /.box-body -->

  <!-- <a class='frm-open' href='#' data-info='$o->info_id'>$o->info_id - $o->nombre $o->descripcion</a> -->

  <a class='frm-open' href='#' data-form='2'>Formulario</a>

</div><!-- /.box -->

<script>
    detectarForm();
</script>

<script>
    var map;
    puntos = '<?php echo json_encode($puntos)?>';
    puntos = JSON.parse(puntos);

    console.log(puntos);

   // console.log(puntos[0].squares.square[0].trees.tree[0]);



    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -31.5361, lng: -68.5264},
      zoom: 8
    });

    
    //console.log(puntos)

    for(i=0;i<puntos.length;i++){   //i      

        for(j=0;j<puntos[i].squares.square.length;j++){    //j
          
            for(k=0;k<puntos[i].squares.square[j].trees.tree.length;k++){    //k               

              // console.log('---------------------------------------------------------------');
              // console.log(puntos[i].squares.square[j].trees.tree[k].lat);


              var marker = new google.maps.Marker({                       

                          position:  {lat: parseFloat(puntos[i].squares.square[j].trees.tree[k].lat), 
                                      lng: parseFloat(puntos[i].squares.square[j].trees.tree[k].long)},
                          map: map,
                          title: 'Hello World!',
                          idarbol :puntos[i].squares.square[j].trees.tree[k].id,
                          tipo: puntos[i].squares.square[j].trees.tree[k].name,
                          direccion: puntos[i].squares.square[j].trees.tree[k].street_name + ' ' + puntos[i].squares.square[j].trees.tree[k].number
                        });
                      
                        
              google.maps.event.addListener(marker, 'click', function() {
                    var marker = this;
                  
                    var contentString = '<div id="content">'+
                        '<div id="siteNotice">'+
                        '</div>'+
                        '<h4 class="firstHeading">'+marker.direccion+'</h4><br>'+
                        '<p> Tipo: '+marker.tipo+'</p>'+
                        '<button onclick="Detalles('+marker.idarbol+')"class="btn btn-success">Detalles</button>'+
                        '</div>';
                    var infowindow = new google.maps.InfoWindow({
                                            content: contentString
                                          });
                  infowindow.open(map,marker);
              });
          
            }  

        }              



    }


    function Detalles(id){
      $.ajax({
        type: 'POST',
        data: {id:id},
        url: 'Mapa/getDetalle', 
        success: function(result){
          data = JSON.parse(result);
          
         
          console.log('data ' + data);
          
          
          
          
          document.getElementById('direccion').innerHTML = 'Direccion: <b>'+data.calle+' '+data.numero+' '+data.barrio+'</b>';
          if(data.taza == 'si')
          {
            document.getElementById('especie').innerHTML = 'Especie del arbol: <b>'+data.tipoarbol+'</b>';
            document.getElementById('fuste').innerHTML = 'Fuste: <b>'+data.fuste+'</b>';
            document.getElementById('alineacion').innerHTML = 'Alineacion del arbol: <b>'+data.alineacion+'</b>';
            document.getElementById('raices').innerHTML = 'RAices del arbol: <b>'+data.raices+'</b>';
            document.getElementById('taza').innerHTML = 'Especie del arbol: <b>'+data.tipotaza+'</b>'
            document.getElementById('cavidad').innerHTML = 'Cavidad de las raices: <b>'+data.cavidad+'</b>';
            document.getElementById('alttotal').innerHTML = 'Altura del arbol: <b>'+data.alttotal+'</b>';
            document.getElementById('altfuste').innerHTML = 'Altura del fuste: <b>'+data.altfuste+'</b>';
            document.getElementById('copa').innerHTML = 'Altura de la copa: <b>'+data.copa+'</b>';
            document.getElementById('circ').innerHTML = 'Circunferencia: <b>'+data.circ+'</b>';
            document.getElementById('ramas').innerHTML = 'Estado de las ramas: <b>'+data.ramas+'</b>';
            document.getElementById('follaje').innerHTML = 'Follaje: <b>'+data.follaje+'</b>';
            document.getElementById('cables').innerHTML = 'Interfiere con el cableado: <b>'+data.cables+'</b>';
            document.getElementById('acequias').innerHTML = 'Estado de la acequia: <b>'+data.acequia+'</b>';
            document.getElementById('estado').innerHTML = 'Estado del arbol: <b>'+data.estado+'</b>';
            document.getElementById('observacion').innerHTML = 'Observacion: <b>'+data.observaciones+'</b>';
            document.getElementById('tazadiv').hidden = false;
          }else{
            document.getElementById('tazadiv').hidden = true;
          }
          document.getElementById('observacion').innerHTML = 'Observacion: <b>'+data.observaciones+'</b>';
          $('#modal_detalles').modal('show');
        }

      })
    }
    
  </script>
  </body>
  
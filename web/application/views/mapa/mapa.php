<?php $this->load->view('mapa/modal_detalles')?>
<div class="box"> 
  <div class="box-header">
    <h3 class="box-title">Mapa:</h3>
    <select name="select" id="censo_id">
      <option value="-1" selected>Seleccione un Censo...</option>
      <option value="1">Censo 1</option> 
      <option value="2">Censo 2</option>
      <option value="3">Censo 3</option>
    </select>
  </div><!-- /.box-header -->
  <div class="box-body" style="height: 500px; width:1000px">
    <div id="map" style="height: 100%"></div>
  </div><!-- /.box-body -->

  <!-- <a class='frm-open' href='#' data-info='$o->info_id'>$o->info_id - $o->nombre $o->descripcion</a> -->

  <a class='frm-open' href='#' data-form='2'>Formulario</a>

</div><!-- /.box -->


<script>

    // inicializo el mapa
    var map;              
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -31.5361, lng: -68.5264},
      zoom: 8
    });

    var markers=[];

    // Selecciono censo para poblar mapa
    $('#censo_id').change( function(){
      //WaitingOpen();
      var cens_id = this.value;
      renderCenso(cens_id);
    });

    function setMapOnAll(map) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
      markers = [];
    }

    function renderCenso(cens_id){
      
      //  TODO: VER TECNICAS DE CLUSTERING EN GOOGLE MAPS
      if(markers)
        setMapOnAll(null);        
      
      $.ajax({
          type: 'POST',
          data: {cens_id:cens_id},
          url: 'Mapa/getArbolesCensoId', 
          success: function(result){
            
            data = JSON.parse(result);
            
            if(data.puntos != null){                          

              for(i=0;i<data.puntos.length;i++){   //i      

                  for(j=0;j<data.puntos[i].squares.square.length;j++){    //j
                    
                      for(k=0;k<data.puntos[i].squares.square[j].trees.tree.length;k++){    //k

                        var marker= new google.maps.Marker({                       

                                    position:  {lat: parseFloat(data.puntos[i]['squares']['square'][j]['trees']['tree'][k]['lat']), 
                                                lng: parseFloat(data.puntos[i]['squares']['square'][j]['trees']['tree'][k]['long'])}, 
                                    map: map,
                                    title: 'Hello World!',                             
                                    info_id :data.puntos[i].squares.square[j].trees.tree[k].info_id,
                                    tipo: data.puntos[i].squares.square[j].trees.tree[k].name,
                                    direccion: data.puntos[i].squares.square[j].trees.tree[k].street_name + ' ' + data.puntos[i].squares.square[j].trees.tree[k].number
                                  });
                        
                        markers.push( marker);                              
                                  
                        google.maps.event.addListener(marker, 'click', function() {
                                          var marker = this;                          
                                          var contentString = '<div id="content">'+
                                              '<div id="siteNotice">'+
                                              '</div>'+
                                              '<h4 class="firstHeading">'+marker.direccion+'</h4><br>'+
                                              '<p> Tipo: '+marker.tipo+'</p>'+
                                              '<button onclick="Detalles('+marker.info_id+')"class="btn btn-success">Detalles</button>'+
                                              '</div>';
                                          var infowindow = new google.maps.InfoWindow({
                                                                  content: contentString
                                                                });
                                        infowindow.open(map,marker);
                        });
                    
                      }  
                  }     
              }
            }  
          },
          
      })   
    }      


    function Detalles(id){

      $.ajax({
        type: 'POST',
        data: {id:id},
        url: 'Mapa/getDetalle', 
        success: function(result){
          
          $('#modal_detalles').find('.modal-body').html(result.html);
          $('#modal_detalles').modal('show');
          $('.modal-body > form').find('input, textarea, button, select').attr('disabled','disabled');
          $('#read_only').attr('disabled');
          $('.frm-save').hide();
        },
        dataType: 'json'
      })
    }
    
  </script>
  </body>
  
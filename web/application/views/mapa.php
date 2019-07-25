<div class="box"> 
      <div class="box-header">
          <h3 class="box-title">Mapa:</h3>
        </div><!-- /.box-header -->
        <div class="box-body" style="height: 500px; width:1000px">
        <div id="map" style="height: 100%"></div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      <script>
    var map;
      
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -31.5361, lng: -68.5264},
        zoom: 8
      });
      marker = new google.maps.Marker({
          position:  {lat: -31.5361, lng: -67.5264},
          map: map,
          title: 'Hello World!'
        });
      
        marker =  new google.maps.Marker({
          position:  {lat: -31.5361, lng: -68.5264},
          map: map,
          title: 'Hello World!'
        });
      
    
  </script>
  </body>
  
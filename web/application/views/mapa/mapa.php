<style>
    .center {
        text-align: center;
    }
</style>
<?php $this->load->view('mapa/modal_detalles') ?>
<div class="box">
    <div class="box-header bg-green">



        <h3 class="box-title">Mapa:</h3>





    </div><!-- /.box-header -->

    <div class="form-group">

        <!-- ____________________________ ESPACIO ___________________________ -->

        <div>
            <br>
        </div>

        <!-- ____________________________ ESPACIO ___________________________ -->


        <div class="col-md-12">
            <div class="form-group col-md-3">
                <label for="censo_id">Censo</label>
                <select name="select" id="censo_id" class="form-control">
                    <option value="-1" selected>Seleccione censo</option>
                    <option value="1">Censo 1</option>
                    <option value="2">Censo 2</option>
                    <option value="3">Censo 3</option>
                </select>
            </div>
        </div>


        <!-- ____________________________ LINEA ___________________________ -->

        <div>
            <hr>
        </div>

        <!-- ____________________________ LINEA ___________________________ -->


        <div class="box-body">

            <div class="col-md-12">


                <div id="map" class="z-depth-1-half map-container" style="height: 500px">


                    <div id="map" style="height: 100%"></div>


                </div>

            </div>


        </div><!-- /.box-body -->

        <!-- <a class='frm-open' href='#' data-info='$o->info_id'>$o->info_id - $o->nombre $o->descripcion</a>

        <a class='frm-open' href='#' data-form='2'>Formulario</a> -->

    </div><!-- /.box -->


    <script>
        // inicializo el mapa
        // var map;
        // map = new google.maps.Map(document.getElementById('map'), {
        //     center: {
        //         lat: -31.5361,
        //         lng: -68.5264
        //     },
        //     zoom: 8
        // });
        // var map = L.map('map').setView([-31.5367, -68.5257], 13); //Coordenadas y Zoom inicial
        /* Capa de mosaicos */

        var streets = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 24, //0-24
            id: 'mapbox/streets-v11', //Mapbox Streets, Stamen, Thunderforest
            accessToken: 'pk.eyJ1IjoidGluY2hvZ2JjIiwiYSI6ImNrNTJpcndzZjE3MjYzbHRlMzl5Y3ZhOXEifQ.D9gyjKwgDRkTOJFkI-UtUw'
        });
        var satelital = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 24, //0-24
            id: 'mapbox/satellite-streets-v11', //Mapbox Streets, Stamen, Thunderforest
            accessToken: 'pk.eyJ1IjoidGluY2hvZ2JjIiwiYSI6ImNrNTJpcndzZjE3MjYzbHRlMzl5Y3ZhOXEifQ.D9gyjKwgDRkTOJFkI-UtUw'
        });
        var map = L.map('map', {
            center: [-31.5367, -68.5257],
            zoom: 13,
            layers: [streets, satelital]
        });
        var baseMaps = {
            "Calles": streets,
            "<span style=''>Satelital</span>": satelital //el último es la capa predeterminada
        };
        var marcador = [];

        // var markers = [];

        // Selecciono censo para poblar mapa
        $('#censo_id').change(function() {
            //WaitingOpen();
            $(".leaflet-marker-pane, .leaflet-shadow-pane").html('');
            var cens_id = this.value;
            renderCenso(cens_id);
        });

        // function setMapOnAll() {
        //     for (var i = 0; i < markers.length; i++) {
        //         markers[i].setMap(map);
        //     }
        //     markers = [];
        // }

        function renderCenso(cens_id) {

            //  TODO: VER TECNICAS DE CLUSTERING EN GOOGLE MAPS
            // if (markers)
            //     setMapOnAll(null);            
            // $(".leaflet-shadow-pane").html('');            

            $.ajax({
                type: 'POST',
                data: {
                    cens_id: cens_id
                },
                url: 'Mapa/getArbolesCensoId',
                success: function(result) {
                    data = JSON.parse(result);

                    if (data.puntos != null) {
                        for (var i = 0; i < data.puntos.length; i++) { //i  
                            if (typeof data.puntos[i].squares.square !== 'undefined') {
                                var length_i = data.puntos[i].squares.square.length;
                            } else {
                                var length_i = 0;
                            }

                            for (var j = 0; j < length_i; j++) { //j
                                if (typeof data.puntos[i].squares.square[j].trees.tree !== 'undefined') {
                                    var length_j = data.puntos[i].squares.square[j].trees.tree.length;
                                } else {
                                    var length_j = 0;
                                }

                                for (var k = 0; k < length_j; k++) { //k                                    

                                    // var marker = new google.maps.Marker({

                                    //     position: {
                                    //         lat: parseFloat(data.puntos[i]['squares']['square'][j][
                                    //             'trees'
                                    //         ][
                                    //             'tree'
                                    //         ][k]['lat']),
                                    //         lng: parseFloat(data.puntos[i]['squares']['square'][j][
                                    //             'trees'
                                    //         ][
                                    //             'tree'
                                    //         ][k]['long'])
                                    //     },
                                    //     map: map,
                                    //     title: 'Hello World!',
                                    //     info_id: data.puntos[i].squares.square[j].trees.tree[k].info_id,
                                    //     tipo: data.puntos[i].squares.square[j].trees.tree[k].name,
                                    //     direccion: data.puntos[i].squares.square[j].trees.tree[k]
                                    //         .street_name + ' ' + data.puntos[i].squares.square[j].trees
                                    //         .tree[k].number
                                    // });                                   
                                    var info_id = data.puntos[i].squares.square[j].trees.tree[k].info_id;
                                    var tipo = data.puntos[i].squares.square[j].trees.tree[k].name;
                                    var direccion = data.puntos[i].squares.square[j].trees.tree[k].street_name + ' ' + data.puntos[i].squares.square[j].trees.tree[k].number;
                                    var lat = parseFloat(data.puntos[i]['squares']['square'][j][
                                        'trees'
                                    ][
                                        'tree'
                                    ][k]['lat']);
                                    var lng = parseFloat(data.puntos[i]['squares']['square'][j][
                                        'trees'
                                    ][
                                        'tree'
                                    ][k]['long']);
                                    var marker = L.marker([lat, lng]).bindPopup('<div id="content">' +
                                        '<div id="siteNotice">' +
                                        '</div>' +
                                        '<h4 class="firstHeading center">' + direccion +
                                        '</h4><br>' + '<div class="center"><img src="assets/img/ejemplo_arbol.jpg"></div>' +
                                        '<p> Tipo: ' + tipo + '</p>' +
                                        '<div class="center"><button onclick="Detalles(' + info_id +
                                        ')"class="btn btn-success">Detalles</button></div>' +
                                        '</div>').addTo(map);
                                    // marcador.push(marker);
                                    // markers.push(marker);
                                    // marker.bindPopup(
                                    //     "<b>Info_id: </b>" + data.puntos[i].squares.square[j].trees.tree[k].info_id +
                                    //     "<br><b>Tipo: </b>" + data.puntos[i].squares.square[j].trees.tree[k].name +
                                    //     "<br><b>Dirección: </b>" + data.puntos[i].squares.square[j].trees.tree[k].street_name + ' ' +
                                    //     data.puntos[i].squares.square[j].trees.tree[k].number
                                    // );
                                    // markers.push(marker);
                                    // marcadores.push(marker);
                                    // marcador.push(marker);


                                    // google.maps.event.addListener(marker, 'click', function() {
                                    //     var marker = this;
                                    //     var contentString = '<div id="content">' +
                                    //         '<div id="siteNotice">' +
                                    //         '</div>' +
                                    //         '<h4 class="firstHeading">' + marker.direccion +
                                    //         '</h4><br>' +
                                    //         '<p> Tipo: ' + marker.tipo + '</p>' +
                                    //         '<button onclick="Detalles(' + marker.info_id +
                                    //         ')"class="btn btn-success">Detalles</button>' +
                                    //         '</div>';
                                    //     var infowindow = new google.maps.InfoWindow({
                                    //         content: contentString
                                    //     });
                                    //     infowindow.open(map, marker);
                                    // });

                                    /* Evento: PopUp coordenadas */
                                    // var popup = L.popup();

                                    // function onMarkerClick(e) {
                                    //     var marker = this;
                                    //     var contentString = '<div id="content">' +
                                    //         '<div id="siteNotice">' +
                                    //         '</div>' +
                                    //         '<h4 class="firstHeading">' + direccion +
                                    //         '</h4><br>' +
                                    //         '<p> Tipo: ' + tipo + '</p>' +
                                    //         '<div style="text-align: center;"><button onclick="Detalles(' + info_id +
                                    //         ')"class="btn btn-success">Detalles</button></div>' +
                                    //         '</div>';
                                    //     marker.bindPopup(contentString);
                                    //     // marker.bindPopup(
                                    //     //     "<b>Info_id: </b>" + data.puntos[i].squares.square[j].trees.tree[k].info_id +
                                    //     //     "<br><b>Tipo: </b>" + data.puntos[i].squares.square[j].trees.tree[k].name +
                                    //     //     "<br><b>Dirección: </b>" + data.puntos[i].squares.square[j].trees.tree[k].street_name + ' ' +
                                    //     //     data.puntos[i].squares.square[j].trees.tree[k].number
                                    //     // );
                                    // }
                                    // marker.on('click', onMarkerClick);
                                    // marker.bindPopup('<div id="content">' +
                                    //     '<div id="siteNotice">' +
                                    //     '</div>' +
                                    //     '<h4 class="firstHeading">' + direccion +
                                    //     '</h4><br>' +
                                    //     '<p> Tipo: ' + tipo + '</p>' +
                                    //     '<div style="text-align: center;"><button onclick="Detalles(' + info_id +
                                    //     ')"class="btn btn-success">Detalles</button></div>' +
                                    //     '</div>');
                                    // markers.push(marker);
                                    // marcadores.push(marker);
                                    // marcador.push(marker);

                                }
                            }
                        }
                        // marcadores = L.layerGroup(marcador);
                        // L.control.layers(baseMaps, overlayMaps).addTo(map);
                    }
                },

            })

            // if (markers)
            //     setMapOnAll();
        }

        // var marcadores = L.layerGroup(marcador);
        // var overlayMaps = {
        //     "Marcadores": marcadores
        // };

        // L.control.layers(baseMaps, overlayMaps).addTo(map);
        L.control.layers(baseMaps).addTo(map);


        function Detalles(id) {

            $.ajax({
                type: 'POST',
                data: {
                    id: id
                },
                url: 'Mapa/getDetalle',
                success: function(result) {

                    $('#modal_detalles').find('.modal-body').html(result.html);
                    $('#modal_detalles').modal('show');
                    $('.modal-body > form').find('input, textarea, button, select').attr('disabled',
                        'disabled');
                    $('#read_only').attr('disabled');
                    $('.frm-save').hide();
                },
                dataType: 'json'
            })
        }
    </script>
    </body>
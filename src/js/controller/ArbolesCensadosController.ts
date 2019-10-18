import '../app';
require('bootstrap');
import * as $ from 'jquery';
import Vue from 'vue';
import MainHeader from '../../../component/main-header.vue';
import VeeValidate, { Validator } from 'vee-validate';
import * as es from 'vee-validate/dist/locale/es';
import {User} from "../model/User";
import {Session} from "../model/Session";
Validator.localize('es', es);
Vue.use(VeeValidate, {
    locale: 'es'
});

/* importante que sea global */
let map: any;

let vue: any = Vue;
new vue ({
    el: '#mainArbolesCensados',
    components: {
        // @ts-ignore
        MainHeader
    },
    data: {
        infoWindow: null,
        my_tree_array: [],
        my_position: {
            lat: null,
            lng: null
        }
    },
    mounted(){
        this.initMap();
        this.getMyTrees();

        // Remove loading
        $(".se-pre-con").fadeOut("slow");
    },
    methods: {
        searchAndGetParamFromURL(param: string){

            let searchParams = new URLSearchParams(window.location.search);
            let response = null;

            switch (param) {

                case "selected_area": response = searchParams.get('selected_area'); break;

                case "area_id": response = searchParams.get('area_id'); break;

                case "selected_square": response = searchParams.get('selected_square'); break;

                case "square_id": response = searchParams.get('square_id'); break;

                case "current_lat": response = searchParams.get('current_lat'); break;

                case "current_lng": response = searchParams.get('current_lng'); break;

                case "selected_street": response = searchParams.get('selected_street'); break;

                case "calleOtra": response = searchParams.get('calleOtra'); break;

                case "number": response = searchParams.get('number'); break;

                case "neighborhood": response = searchParams.get('neighborhood'); break;

                case "taza": response = searchParams.get('taza'); break;

                case "cens_id": response = searchParams.get('cens_id'); break;
            }

            return response;
        },
        initMap (){
            map = new google.maps.Map(document.getElementById('mapArbolesCensados'), {
                center:  {lat: -31.5375000, lng: -68.5363900},
                zoom: 8,
                mapTypeControl:false,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [
                    {
                        featureType: "poi",
                        stylers: [
                            { visibility: "off" }
                        ]
                    }
                ]
            });

            this.infoWindow = new google.maps.InfoWindow;

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {

                    let pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    let currentPosMarker = new google.maps.Marker({
                        position:pos,
                        icon: {url:"https://maps.google.com/mapfiles/ms/icons/green-dot.png"},
                        map: map,
                        title: 'Mi ubicación actual'
                    });
                    // map.setCenter(pos);  LO OCULTO PORQUE YA NO QUIERO CENTRAR EL MAPA EN LA UBICACION ACTUAL, SINO EN EL CENTRO DE LOS ARBOLES CENSADOS
                    console.log('Current position: ' + JSON.stringify(pos));

                }, function() {
                    this.handleLocationError(true, this.infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                this.handleLocationError(false, this.infoWindow, map.getCenter());
            }

        },

        handleLocationError(browserHasGeolocation, infoWindow, pos) {
            if ((pos.lat!==null)&&(pos.lng!==null)){
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: El servicio de geolocalizacion ha fallado.' :
                'Error: Su navegador no soporta geolocalizacion.');
            infoWindow.open(map);}else{
                console.log('no se puede crear el inforWindow porque faltan datos de posición');
            }
        },
        getMyTrees (){
            User.getTree().then((response) => {

                console.log(response.data);

                let selected_area = this.searchAndGetParamFromURL("selected_area");
                let selected_square = this.searchAndGetParamFromURL("selected_square");

                let tree_count = response.data.tree_list.data.area[selected_area].square[selected_square].tree.length;

                for (let i = 0; i < tree_count; i++){
                        try {

                            let latAux = response.data.tree_list.data.area[selected_area].square[selected_square].tree[i].position.lat;
                            let lngAux = response.data.tree_list.data.area[selected_area].square[selected_square].tree[i].position.lng;
                            let addresAux = response.data.tree_list.data.area[selected_area].square[selected_square].tree[i].street + ' - ' + response.data.tree_list.data.area[selected_area].square[selected_square].tree[i].number;


                            //console.log('Antes del parse' + latAux + ' ---- ' + lngAux);
                            if (latAux != null && lngAux != null) {
                                let positionAux = response.data.tree_list.data.area[selected_area].square[selected_square].tree[i].position;
                                let nameAux = response.data.tree_list.data.area[selected_area].square[selected_square].tree[i].name;
                                let treeIDAux = response.data.tree_list.data.area[selected_area].square[selected_square].tree[i].id;
                                this.my_tree_array.push(positionAux);
                                this.addMapMarker(positionAux, nameAux, latAux, lngAux, addresAux, treeIDAux);

                                /*This is for getting new map center*/
                                this.setNewCenter(tree_count);

                                /*this is for draw area and square name into page title*/
                                let areaName = response.data.tree_list.data.area[selected_area].name;
                                let squareName = response.data.tree_list.data.area[selected_area].square[selected_square].name;
                                document.getElementById("page-title").innerHTML = 'Árboles censados para ' + areaName + ', ' + squareName;
                            } else {
                                console.log('No se considera el marcador porque la longitud o latitud son nulas')
                            }
                        } catch (e) {

                        }
                }
            })
                .catch((err)=>{
                    console.log("error: " + err);

                    Session.invalidate();

                    window.location.replace("/");
                });
        },
        addMapMarker(position, nameAux, lat, lng, address, treeIDAux){
            //console.log('Position dentro de addMapMarker: ' + position);
            //if ((position.lat!==null)&&(position.lng!==null)){
            if ((lat!=null)&&(lng!=null)){
            console.log('Latitude: '+ lat + 'Longitude: ' + lng);
            let markerAux = new google.maps.Marker({
                //position: { lat: position.lat, lng:  position.lng },
                position: new google.maps.LatLng(lat, lng),
                map: map,
                icon: {url:"https://maps.google.com/mapfiles/ms/icons/red-dot.png"},
                title: nameAux,
            });
            this.addMarkerInfoWindow(markerAux, position, nameAux, address,treeIDAux);
            }else{console.log('los datos de posición para este marcador no existen o son nulos, se omite su creación.')}
        },

        addMarkerInfoWindow(marker, position, treeName, treeAdress, treeIDAux){

            let contentString = '<div id="content">'+
                '<span style="position:relative; float:right"><a href="domicilioACensar.html?arbol_id='+ treeIDAux +
                '&selected_area='+ this.searchAndGetParamFromURL("selected_area") +
                '&area_id='+ this.searchAndGetParamFromURL("area_id") +
                '&selected_square='+ this.searchAndGetParamFromURL("selected_square") +
                '&square_id='+ this.searchAndGetParamFromURL("square_id") +
                '&cens_id='+ this.searchAndGetParamFromURL("cens_id") +'"><i class="far fa-edit pl-1" style="color:#18BC9C"></i></a></span>'+
                '<h6 id="firstHeading" class="map-tooltip-heading">'+
                 treeName+
                '</h6>'+
                '<div>'+
                '<p><b>'+
                treeAdress +
            '</div>';

            let infoWindowAux = new google.maps.InfoWindow({
                content: contentString
            });
            marker.addListener('click', function() {
                infoWindowAux.open(map, marker);
            });
        },

        setNewCenter(elements){
          let latArrayAux=[];
          let lngArrayAux=[];
          let qElements = elements;
          for (let i = 0; i < qElements; i++) {
                let auxLatValue = this.my_tree_array[i].lat;
                let auxLngValue = this.my_tree_array[i].lng;
                if ((auxLatValue!==null) && (auxLngValue!==null)){
                latArrayAux.push(auxLatValue);
                lngArrayAux.push(auxLngValue);
          }else{console.log('lat or pos null')}
            }
          console.log('ARREGLO DE LATITUDES EN SETNEWCENTER ' + latArrayAux);
          console.log('ARREGLO DE LONGITUDES EN SETNEWCENTER ' + lngArrayAux)
          let maxLat = Math.max.apply(null,latArrayAux);
          let minLat = Math.min.apply(null,latArrayAux);
          let avgLat = (maxLat + minLat)/2;
          let maxLng = Math.max.apply(null,lngArrayAux);
          let minLng = Math.min.apply(null,lngArrayAux);
          let avgLng = (maxLng + minLng)/2;
          let newCenter = {lat:avgLat,lng:avgLng};
          map.setCenter(newCenter);
          map.setZoom(4);
        },

        setParamsAndRedirect(selected_area: string, area_id: string, selected_square: string, square_id: string, cens_id: string){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {

                    window.location.replace("domicilioACensar.html?" +
                        "selected_area=" + selected_area +
                        "&area_id=" + area_id +
                        "&selected_square=" + selected_square +
                        "&square_id=" + square_id +
                        "&current_lat=" + position.coords.latitude +
                        "&current_lng=" + position.coords.longitude +
                        "&cens_id=" + cens_id);
                });
            }
        },

        selectedParams() {
            this.setParamsAndRedirect(this.searchAndGetParamFromURL("selected_area"), this.searchAndGetParamFromURL("area_id"), this.searchAndGetParamFromURL("selected_square"), this.searchAndGetParamFromURL("square_id"), this.searchAndGetParamFromURL("cens_id"));
        },

        goBack(){
            window.location.replace("manzanasCensadas.html?" +
                "selected_area=" + this.searchAndGetParamFromURL("selected_area") +
                "&area_id=" + this.searchAndGetParamFromURL("area_id") +
                "&cens_id=" + this.searchAndGetParamFromURL("cens_id"));
        }
    }
});
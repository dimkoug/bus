$(document).ready(function() {
  var mapOptions;
  var marker;
  var marker4;
  var address;
  var map;
  var markers=[];
  var markers_ar= new Array();
  var marker_arr2 = [];
  var center1;
  var geocoder;
  var geocoder2;
  var service;
  var service2;
  var dist1;
  var category1;
  var placeLoc;
  var marker2;
  var image;
  var busloc;
  var busbounds;
  var busbounds2;
  var bus1="";
  var station1;
  var loca;
  var pos1;
  var radius;
  var latitude = 37.950902;
  var user_lat;
  var user_lng;
  var longitude = 23.641103;
  var infowindow = new google.maps.InfoWindow();
  var infowindow2 = new google.maps.InfoWindow();
  geocoder = new google.maps.Geocoder();
  geocoder2 = new google.maps.Geocoder();
  var outputDiv = document.getElementById('res');
  mapOptions = {
  center: new google.maps.LatLng(latitude,longitude),
  zoom: 15,
  mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map"), mapOptions);
  center1=new google.maps.LatLng(latitude,longitude);
  var input = document.getElementById("address");
  var autocomplete = new google.maps.places.Autocomplete(input);
  $("#bus").click(function(e){
    service = new google.maps.places.PlacesService(map);
    service2 = new google.maps.places.PlacesService(map);
    address = $("#address").val();
    geocoder.geocode( { 'address': address}, function(results, status) {
      outputDiv.innerHTML="";
    if (status == google.maps.GeocoderStatus.OK) {
      mapOptions = {
        center: results[0].geometry.location,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
     
    
      map = new google.maps.Map(document.getElementById("map"), mapOptions);
      image='/public/img/user2.png';
      marker = new google.maps.Marker({
        position: results[0].geometry.location,
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        title: 'My location',
        icon: image
      });
      busloc = new google.maps.Circle({
        map: map,
        clickable: false,
        editable:true,
        // metres
        radius: 600,
        fillColor: '#fff',
        fillOpacity: .6,
        strokeColor: '#13adec',
        strokeOpacity: .4,
        strokeWeight: .8
      });
      busloc.bindTo('center', marker, 'position');
       user_lat = busloc.getCenter().lat();
      user_lng = busloc.getCenter().lng();
      google.maps.event.addListener(marker, 'drag', function(ev){
      markers.length = 0;
      loca = null;
      pos1 = null;
      for (var p=0;p<marker_arr2.length;p++){
        marker_arr2[p].setMap(null);
      }
      busbounds=busloc.getBounds();
      
    });
    google.maps.Circle.prototype.contains = function(latLng) {
      return this.getBounds().contains(latLng) && google.maps.geometry.spherical.computeDistanceBetween(this.getCenter(), latLng) <= this.getRadius();
    }
    google.maps.event.addListener(marker, 'dragend', function(ev){
         user_lat = busloc.getCenter().lat();
      user_lng = busloc.getCenter().lng();
      radius= busloc.getRadius();
      $.ajax({
        url: '/fstation',
        type: 'post',
        data: {'radius':radius,'lat':user_lat,'lng':user_lng},
        datatype: 'json',
        success: function(data) {
          if(data.message=="error"){
            //console.info("error");
          }
          else{
            markers.length = 0;
            markers_ar.length = 0;
            marker_arr2.length = 0;
            var content = ""; 
            //console.info("ok");
            for (i = 0; i < data.length; i++) { 
              loca= new google.maps.LatLng(data[i].lat, data[i].lng);
              name =data[i].name;
              station_id =data[i].station_id;
              if(markers.length<data.length){
                  markers.push([loca,name,station_id]);
              }
            }
            //console.info(markers);
            for (var j = 0; j < markers.length; j++) {
              station1 = markers[j][2];
              //var image2='http://bus.findpoi-gis.com/img/pin_bus.png';
              //var skia2='http://bus.findpoi-gis.com/img/skia_pin_bus.png';
              marker2 = new google.maps.Marker({
                position: markers[j][0]
              });
              if(markers_ar.length<data.length){
                markers_ar.push([marker2,station1]);
              }
            }
          }
          //console.info(markers_ar);
          for (var t = 0; t < markers_ar.length; t++) {
            var pos1 =markers_ar[t][0].getPosition();
            station = markers_ar[t][1];
            if(busloc.contains(pos1)) {
              addmarker(pos1,station);
            }
          } 
        } 
      });
    });
    google.maps.event.addListener(busloc, 'radius_changed', function(ev){
      for (var p=0;p<marker_arr2.length;p++){
        marker_arr2[p].setMap(null);
      }
      radius=busloc.getRadius();
        user_lat = busloc.getCenter().lat();
      user_lng = busloc.getCenter().lng();
      busbounds2=busloc.getBounds();
      goBus();
    });
    function goBus(){
      $.ajax({
        url: '/fstation',
        type: 'post',
        data: {'radius':radius,'lat':user_lat,'lng':user_lng},
        datatype: 'json',
        success: function(data) {
          if(data.message=="error"){
            //console.info("error");
          }
          else{
            markers.length = 0;
            markers_ar.length = 0;
            marker_arr2.length = 0;
            var content = ""; 
            //console.info("ok");
            for (i = 0; i < data.length; i++) { 
              loca= new google.maps.LatLng(data[i].lat, data[i].lng);
              name =data[i].name;
              station_id =data[i].station_id;
              if(markers.length<data.length){
                markers.push([loca,name,station_id]);
              }
            }
            //console.info(markers);
            var bus1="";
            var station1;
            for (var j = 0; j < markers.length; j++) {
              station1 = markers[j][2];
              //var image2='http://bus.findpoi-gis.com/img/pin_bus.png';
              //var skia2='http://bus.findpoi-gis.com/img/skia_pin_bus.png';
              marker2 = new google.maps.Marker({
                position: markers[j][0]

              });
              if(markers_ar.length<data.length){
                markers_ar.push([marker2,station1]);
              }
            }
          }
          //console.info(markers_ar);
          for (var t = 0; t < markers_ar.length; t++) {
            var pos1 =markers_ar[t][0].getPosition();
            station = markers_ar[t][1];
            if(busbounds2.contains(pos1)) {
              addmarker(pos1,station);
            }
          } 
        } 
      });
    } 
  }
else {
alert("error");
outputDiv.innerHTML="Not propper address format: " + status;
}
});

var marker_arr2 = [];
function addmarker(pos1,station){
var markerOptions4 = {  
map: map,  
position: pos1

};  
marker4 = new google.maps.Marker(markerOptions4);
google.maps.event.addListener(marker4, 'click', (function(marker4) {
return function() {
load_content(map,this,infowindow,station);  
}
})(marker4));
marker_arr2.push(marker4)
}
});

function load_content(map,marker,infowindow,station){

$.ajax({
url: '/fbus',
type: 'post',
data: {'station':station},
datatype: 'json',
success: function(data) {
var content="";
var a="";
content +='<div id="content">'+
'<div id="siteNotice">'+
'</div>'+'<h3 id="firstHeading" class="firstHeading">Στάση '+data[0].station+'</h3>'+'<div id="bodyContent">'+
'<p><b>Λεωφορεία</b></br>';
for(var k=0;k<data.length;k++){
//a = '<a href="http://bus.findpoi-gis.com/operations/fbus_v.php?bus_id='+data[k].bus_id+'" target="_blank">'+data[k].busname+'</a>';
a = data[k].busname + ' '+data[k].longname;
content +=  a +
'</p>'+
'</div>'+
'</div>'; 
}
infowindow.setContent(content);
infowindow.open(map, marker);
}
});
} 











}); 
$(document).ready(function() {
  var mapOptions;
  var marker;
  var markers=[];
   var marker_arr2=[];
  var map;
  var outputDiv = document.getElementById('output');
  var center1;
  var placeLoc;
  var marker2;
  var bus1;
  var bus2;
  var lat1;
  var lng;
  var stopname;
  var image;
  var i;
 var infowindow = new google.maps.InfoWindow();
  var infowindow2 = new google.maps.InfoWindow();
  
   var latitude = 37.950902;
      var longitude = 23.641103;
    mapOptions = {
      center: new google.maps.LatLng(latitude,longitude),
      zoom: 12,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    center1=new google.maps.LatLng(latitude,longitude);

	$("#bus1").change(function() {
		bus1= $("#bus1").val();
		

	});

	$("#bus2").change(function() {
		bus2= $("#bus2").val();
		

	});
 $('#myForm').ajaxForm({
        // dataType identifies the expected content type of the server response 
        dataType:  'json',
 
        // success identifies the function to invoke when the server response 
        // has been received 
        success:   processJson
    });

function processJson(data) {
	outputDiv.innerHTML = '';
	if(data.length==0){
outputDiv.innerHTML = 'Δεν υπάρχουν κοινές στάσεις λεωφορείων';



	}
	
	markers.length = 0;
	//marker_arr2.length = 0
	if(marker_arr2.length>0){
		for (t = 0; t < marker_arr2.length; t++) {
		marker_arr2[t].setMap(null);
	}
marker_arr2.length = 0;


	}
	//alert(marker_arr2.length);
	for (i = 0; i < data.length; i++) {
		loca= new google.maps.LatLng(data[i].lat, data[i].lng);
		stopname =data[i].stopname;
		markers.push([loca,stopname]);
		//addmarker(loca,name);
	}
	console.info(markers);
	for(var j=0;j< markers.length;j++){
		addmarker(markers[j][0].lat(),markers[j][0].lng(),markers[j][1]);



	}


}


function addmarker(lat,lng,stopname){
		var loca= new google.maps.LatLng(lat,lng);
		var markerOptions4 = {
			map: map,
			position: loca,
			title:stopname
               
       };
       
       var marker4 = new google.maps.Marker(markerOptions4);
       infowindow = new google.maps.InfoWindow();
       infowindow.setMap(null);
 google.maps.event.addListener(marker4, 'click', (function(marker4) {
						return function() {
						
						infowindow.setContent(stopname);
						infowindow.open(map, marker4);
						};
					})(marker4, i));


		marker_arr2.push(marker4);
	}
     



});
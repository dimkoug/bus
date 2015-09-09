$(document).ready(function(){
	 $('input').addClass("form-control");
    $('select').addClass("form-control");
    $('textarea').addClass("form-control");
    $('span').append("</br>");
    $('input:submit').removeClass("form-control");
    $('input:submit').addClass("btn btn-success");
    $('#sub').hide();
    $('#id_user').val('{{user}}');
   
	var mapOptions;
	var map;
	var marker;
	var infowindow = new google.maps.InfoWindow();
	geocoder = new google.maps.Geocoder();
	var city;
	var street_name;
	var street_number;
	var street_po;
	var address;
  geocoder2 = new google.maps.Geocoder();
     var latitude = 37.950902;
      var longitude = 23.641103;
        mapOptions = {
      center: new google.maps.LatLng(latitude,longitude),
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    center1=new google.maps.LatLng(latitude,longitude);
    $("#loc").click(function(e){
    city = $('#id_city').val();
    street_name =  $('#id_street_name').val();
	street_number = $('#id_street_number').val();
	street_po  = $('#id_street_po').val();
   address = city + ","+street_name+","+street_number+","+street_po;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        
             mapOptions = {
      center: results[0].geometry.location,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
         
          
          marker = new google.maps.Marker({
          position: results[0].geometry.location,
          map: map,
          draggable:false,
          animation: google.maps.Animation.DROP,
          title: 'Τοποθεσία ακινήτου'
          
      });
      var lng = parseFloat(results[0].geometry.location.lng()).toFixed(6);
      
      var lat = parseFloat(results[0].geometry.location.lat()).toFixed(6);
      $("#id_lng").val(lng);
       $("#id_lat").val(lat);
    $('#sub').show();

        

    
   
 
      }
       else {
          alert("error");
          outputDiv.innerHTML="Not propper address format: " + status;
        }
    });
  });
   


});
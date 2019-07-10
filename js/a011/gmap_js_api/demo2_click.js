
jQuery(()=>{
	var map1 = jQuery('#map1')

	var map = new google.maps.Map( map1[0], {
		center: new google.maps.LatLng(26.698820, 127.933059 ),
		zoom: 15 ,
	});
	
	map.addListener( "click", function ( argument ) {
		console.log( argument ) ;
		var latLng = argument.latLng;
		var lat = latLng.lat();
		var lng = latLng.lng();
		var place_id = argument.placeId;
		
		jQuery('#latLng').html(lat + ', ' + lng);
		jQuery('#lng').html(lng);
		
		if(place_id == null) place_id = '';
		jQuery('#place_id').html(place_id);

	}) ;
	
});
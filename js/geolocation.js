$(window).load(function(){
	initialize() 
})

function initialize() {
	$.ajax({
		dataType: 'json',
		url : WEB_ROOT+"/ajax/geolocation.php",
		type: "POST",
		data: {"type":"datas"},		
		beforeSend: function(){
			$("#loader_gif").show();
		},
		success: function (response) {

			var marcadores = response;
			var map = new google.maps.Map(document.getElementById('map_canvas'), {
				zoom: 4,
				center: new google.maps.LatLng(16.748211, -93.105762),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			var infowindow = new google.maps.InfoWindow();
			var marker, i;
			for (i = 0; i < marcadores.length; i++) {
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
					map: map
				});
				google.maps.event.addListener(marker, 'click', (function (marker, i) {
					return function () {
						infowindow.setContent(marcadores[i][0]);
						infowindow.open(map, marker);
					}
				})(marker, i));
			}
		},
	});
}
// google.maps.event.addDomListener(window, 'load', initialize);
		
		
		
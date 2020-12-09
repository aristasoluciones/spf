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
				zoom: 8,
				center: new google.maps.LatLng(16.748211, -93.105762),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			var infowindow = new google.maps.InfoWindow();
			var marker, i;
			for (i = 0; i < marcadores.length; i++) {
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
					map: map,
					icon: {
						path: google.maps.SymbolPath.CIRCLE,
						fillColor: marcadores[i][4],
						fillOpacity: 1,
						strokeColor: 'black',
						strokeOpacity: 0.9,
						strokeWeight: 1,
						scale: 4
					}
				});
				google.maps.event.addListener(marker, 'click', (function (marker, i) {
					return function () {
						infowindow.setContent(marcadores[i][3]);
						infowindow.open(map, marker);
					}
				})(marker, i));
			}
		},
	});
}
// google.maps.event.addDomListener(window, 'load', initialize);



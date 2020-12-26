var CustomerMaps =  function(){
    return {
        init : function (element) {
            if(!element.length)
                return;

            var currentLaLn = [16.748211,-93.105762];
            var map = new google.maps.Map(document.getElementById(element),{
                zoom: 8,
                center: new google.maps.LatLng(16.748211,  -93.105762),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            if($("#latLng").length)
            {

                var currentLatLng = $("#latLng").val();
                if(currentLatLng!="")
                    currentLaLn = currentLatLng.split(",");
            }
            var position =  new google.maps.LatLng(currentLaLn[0],  currentLaLn[1]);
            var marker = new google.maps.Marker({ position, map, draggable:true, title:"Arrastrar" });
            function setLatLngInput(lat,lng){
                if($("#latLng").length)
                    $("#latLng").val(lat + "," + lng);

                position =  new google.maps.LatLng(lat,  lng);
                marker.setPosition(position);

            }
            function moveBus(latLng,marker, map) {
                marker.setPosition( latLng );
                map.panTo(latLng);
                setLatLngInput(latLng.lat(),latLng.lng());
            }
            google.maps.event.addListener(marker, "drag", function (event) {
                setLatLngInput(event.latLng.lat(),event.latLng.lng());
            });
        }
    };
}();
$(function(){
    if($("#map").length)
    CustomerMaps.init("map");
});

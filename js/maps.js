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
           /* map.addListener("click",function (e) {
                moveBus(e.latLng, marker, map);
            });*/
            function setLatLngInput(lat,lng){
                if($("#latLng").length)
                    $("#latLng").val(lat + "," + lng);

            }
            function moveBus(latLng,marker, map) {
                marker.setPosition( latLng );
                map.panTo(latLng);
                setLatLngInput(latLng.lat(),latLng.lng());
            }
            google.maps.event.addListener(marker,"drag",function (event) {
                console.log(event);
                setLatLngInput(event.latLng.lat(),event.latLng.lng());
            });
            map.addListener('center_changed', function() {
                window.setTimeout(function() {
                    map.panTo(marker.getPosition());
                }, 3000);
            });

        }
    };
}();
$(function(){
    if($("#map").length)
    CustomerMaps.init("map");
});
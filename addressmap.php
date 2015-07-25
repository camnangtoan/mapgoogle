<!DOCTYPE html> 
<html> 
<head> 
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
    <title>Address map </title> 
    <div id="map" style="visibility:hidden;display:none">
        <iframe id="google_map"  width="450" height="300" frameborder="0" scrrolling="no" marginheight="0" marwidth="0" src="https://maps.google.co.uk?output=embed"></iframe>
    </div>
    <script src="js/geoPosition.js"></script>
    <style>
        #map_canvas { margin: 0; padding: 0; height: 400px;width: 600px;border: solid 1px; }
    </style>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script><input type="text" id="address" size="30"><br><input type="text" id="lat" size="10"><input type="text" id="lng" size="10">
    <div id="map_canvas"></div>
    <script> 
        var toadox,toadoy;
        var loadmap= function (){
            var success = function (pos){
                var lat     = pos.coords.latitude,
                    long    = pos.coords.longitude;
                    document.getElementById('lat').value=toadox  = lat;
                    document.getElementById('lng').value=toadoy = long;

            };
            var error = function (){
                alert('Geolocation not supported')
            };
            if(geoPosition.init()){
                geoPosition.getCurrentPosition(success, error);
            }
            return  false;
        }
        //thuc hien lay toa do luc ban dau
        loadmap();

        var map;
        var geocoder;
        var mapOptions = { 
            center: new google.maps.LatLng(0.0, 0.0), 
            zoom: 2,
            mapTypeId: google.maps.MapTypeId.ROADMAP 
        };

        function initialize() {
            var myOptions = {
                            center: new google.maps.LatLng(toadox, toadoy),
                            zoom: 15,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
           
            geocoder = new google.maps.Geocoder();
            var map = new google.maps.Map(
                            document.getElementById("map_canvas"),
                            myOptions
                        );
            //hien thi ra dia chi luc ban dau
            placeMarker(myOptions.center);
            google.maps.event.addListener(map, 'click', function(event) {
                placeMarker(event.latLng);
            });

            var marker;
            function placeMarker(location) {
                if(marker){ //on vérifie si le marqueur existe
                    marker.setPosition(location); //on change sa position
                }else{
                    marker = new google.maps.Marker({ //on créé le marqueur
                        position: location, 
                        map: map
                    });
                }
                document.getElementById('lat').value=location.lat();
                document.getElementById('lng').value=location.lng();
                getAddress(location);
            }

            function getAddress(latLng) {
                geocoder.geocode( 
                    {'latLng': latLng},
                    function(results, status) {
                        if(status == google.maps.GeocoderStatus.OK) {
                            if(results[0]) {
                                document.getElementById("address").value = results[0].formatted_address;
                            }
                            else {
                                document.getElementById("address").value = "No results";
                            }
                        }
                        else {
                            document.getElementById("address").value = status;
                        }
                    }
                );
            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head> 
<body > 
</body> 
</html> 
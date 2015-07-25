<!DOCTYPE html>
<html>
    <head>
        <title>
            Geolocation
        </title>
    </head>
    <body >
        <a href="#" id="get_location">Lấy vị trí hiện tại của tôi trên bản đồ </a>
        <div id="map">
            <iframe id="google_map" width="450" height="300" frameborder="0" scrrolling="no" marginheight="0" marwidth="0" src="https://maps.google.co.uk?output=embed"></iframe>
        </div>
        <script src="js/geoPosition.js"></script>
        <script>
           
            document.getElementById('get_location').onclick=function (){
                var success = function (pos){
                    var lat     = pos.coords.latitude,
                        long    = pos.coords.longitude,
                        coords  = lat+ ',' +long;
                        alert(coords);
                    
                };
                var error = function (){
                    alert('Geolocation not supported')
                };
                if(geoPosition.init()){
                    geoPosition.getCurrentPosition(success, error);
                }

                return false;
            }

        </script>
    </body>
</html>

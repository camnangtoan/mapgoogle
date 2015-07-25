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
        <script src="js/Modernizr.js"></script>
        <script>
            if(!Modernizr.geolocation){
                alert('Khu vục không được hỗ trợ');
            }else{
                
            
                var c   =   function (pos){
                     var lat     =   pos.coords.latitude,
                       long     =   pos.coords.longitude,
                       acc      =   pos.coords.accuracy,
                       coords   =   lat+ ', ' +long;
                    document.getElementById('google_map').setAttribute('src','https://maps.google.co.uk/?q='+ coords +'&z=60&output=embed');  

                }
                var e   =   function (error){
                    if(error.code === 1){
                        alert('Bạn không kết nối mạng, hoặc mạng có vấn đề không xác định được khu vục của bạn');
                    }
                    if(error.code === 3){
                        alert('Kết nối mạng chậm');
                    }
                }  
                document.getElementById('get_location').onclick=function (){
                    navigator.geolocation.getCurrentPosition(c, e, { 
                        enableHighAccuracy: true,
                        //maximumAge: 100000,
                        //timeout: 1

                    });

                    return false;
                }
            }
        </script>
    </body>
</html>

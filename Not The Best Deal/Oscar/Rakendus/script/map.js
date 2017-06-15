var schools;
var schoolname;
var geocoder;
window.onload = initMap();



        function initMap() {
                schoolname = location.search.substring(12);
                console.log(schoolname);
                getSchools();
        }
        //Võtab andmebaasist kooli andmed
        function getSchools(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    schools = JSON.parse(xhttp.responseText);
                    console.log(JSON.parse(xhttp.responseText));
                    console.log('loaded');
                    addinfo();
                    //loadMap();
                    
                }
            };
            xhttp.open("GET", '../Php/getinfo.php?school='+schoolname, true);
            xhttp.send();
        }

        //Kuvab kooli nime ja muu ingo
        function addinfo(){

            document.getElementById("name").innerHTML = schools[0].name;
            document.getElementById("website").innerHTML = schools[0].webpage;
            document.getElementById("address").innerHTML = schools[0].county+", "+schools[0].parish+", "+schools[0].address;
            loadMap();
        }

        //Laeb googlemapsi kaardi
        function loadMap(){
            
            //proovib leida aadressi kauadu asukohta
            var countysql = schools[0].county;
            var parishsql = schools[0].parish;
            var aadresssql = schools[0].address;
        

            geocoder = new google.maps.Geocoder();
            aadress =  decodeURIComponent(schoolname);
            
            console.log(aadress);
            geocoder.geocode( { 'address': aadress}, function(results, status) {

                if (status == google.maps.GeocoderStatus.OK) {
                    latitude = results[0].geometry.location.lat();
                    longitude = results[0].geometry.location.lng();
                    console.log("lat: "+latitude+" long: "+longitude);

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 17,
                        center: {lat: latitude, lng: longitude}
                    });
                    
                    var marker = new google.maps.Marker({
                        position: {lat: latitude, lng: longitude},
                        map: map
                    });
                //kui aadressi kaudu ei suutnud koordinaate leida siis proovib leida nime järgi 
                } else {
                    console.log("uus katse");
                    //alert('Geocode was not successful for the following reason: ' + status);
                    aadress = countysql+", "+parishsql+", "+aadresssql;
                    makeMarker();
                }
            });
    }
    
    //Nime järgi asukoha leidmise funktsioon
    function makeMarker (){
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode( { 'address': aadress}, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                latitude = results[0].geometry.location.lat();
                longitude = results[0].geometry.location.lng();
                console.log("lat: "+latitude+" long: "+longitude);

                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 17,
                    center: {lat: latitude, lng: longitude}
                });
                
                var marker = new google.maps.Marker({
                    position: {lat: latitude, lng: longitude},
                    map: map
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
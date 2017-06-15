var latitude;
var longitude;
var m = 0;

window.onload = initMap();

function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: 59.4387631, lng: 24.771704099999965}
        });

        var geocoder = new google.maps.Geocoder();

        //aadresside array
        var address = ["Narva mnt 25, Kesklinna linnaosa", "Raua 6, 10124 Tallinn", "Estonia puiestee 6, 10141 Tallinn"];
        for (i = 0; i < address.length; i++) {
            //console.log(address[i]);
            geocoder.geocode( { 'address': address[i]}, function(results, status) {

                if (status == google.maps.GeocoderStatus.OK) {
                    latitude = results[0].geometry.location.lat();
                    longitude = results[0].geometry.location.lng();
                    //console.log(latitude+" "+longitude);
                    //alert(latitude);
                    var marker = new google.maps.Marker({
                        position: {lat: latitude, lng: longitude},
                        map: map
                    });
                    console.log(address[m]);
                    var contentString = address[m];
                    var infowindow = new google.maps.InfoWindow();
                    bindInfoWindow(marker, map, infowindow, contentString);
                    m++;
                }
            });


                //var infowindow = new google.maps.InfoWindow();
            // bindInfoWindow(marker, map, infowindow, contentString);


            /* var infowindow = new google.maps.InfoWindow();
                //var contentString = address[i];
                google.maps.event.addListener(marker,'click', (function(marker,contentString,infowindow){
                return function() {
            infowindow.setContent(contentString);
            infowindow.open(map,marker);
            };
                })(marker,contentString,infowindow)); */

                /*
                var infowindow = new google.maps.InfoWindow({
                content: contentString
                });

                marker.addListener('click', function() {
                infowindow.open(map, marker);
                });
                */

        }

    function bindInfoWindow(marker, map, infowindow, html) {
        marker.addListener('click', function() {
            infowindow.setContent(html);
            infowindow.open(map, this);
        });
    }
}

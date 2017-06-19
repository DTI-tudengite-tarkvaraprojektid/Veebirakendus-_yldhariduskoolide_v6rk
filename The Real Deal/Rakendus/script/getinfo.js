var schools;
var schoolname;
var geocoder;
var regID;
var people;
var startYear;
var principals;
var addchange;
var namechange;
//See käivitub lehe laadimisel
window.onload = function(){
                //Aadressi realt saadakse kooli nimi
                schoolname = decodeURIComponent(location.search.substring(12));
                console.log(schoolname);
                getRegID();
        }
        //Selle funktsiooniga saadakse vastava kooli id
        function getRegID(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        regID = JSON.parse(xhttp.responseText);
                        console.log(JSON.parse(xhttp.responseText));
                        console.log('loaded');
                        getSchools();
                }
            };
            xhttp.open("GET", '../Php/getregnr.php?school='+schoolname, true);
            xhttp.send();               
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
            xhttp.open("GET", '../Php/getinfo.php?REG_ID='+regID, true);
            xhttp.send();
        }
        //Kuvab kooli nime ja muu info
        function addinfo(){
            var name = schools[0].name;
            var website =  schools[0].webpage;
            var address = schools[0].county+", "+schools[0].parish+", "+schools[0].address;
            var openyear = schools[0].openyear;
            if(name === "DEFAULT"){
                name = "---";
            }
            if(website === "DEFAULT"){
                website = "---";
            }
            if(address === "DEFAULT"){
                address = "---";
            }
            document.getElementById("name").innerHTML = name;
            //console.log(schools[0].webpage);
            document.getElementById("website").innerHTML = website;
            document.getElementById("address").innerHTML = address;
            document.getElementById("openyear").innerHTML = openyear;
            loadMap();
        }
        //Laeb googlemapsi kaardi
        function loadMap(){          
            //proovib leida aadressi kauadu asukohta
            var countysql = schools[0].county;
            var parishsql = schools[0].parish;
            var aadresssql = schools[0].address;
            geocoder = new google.maps.Geocoder();
            aadress =  schoolname;
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
    getprincipals();   
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
    //Võetakse andmebaasist igal aastal olnud õpilaste arvud
    function getPeople(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                people = JSON.parse(xhttp.responseText);
                console.log(JSON.parse(xhttp.responseText));
                console.log('loaded');
                startYear = people[0]; 
                people.shift();
                console.log(people);  
                loadDia();
        }
     };
        xhttp.open("GET", '../Php/getpeopleinfo.php?regid='+regID, true);
        xhttp.send();          
    }
    //kuvatakse õpilaste arvud diagrammil
    function loadDia(){
        Highcharts.chart('container1', {

        title: {
            text: schoolname,
        },
        /*subtitle: {
            text: 'Source: thesolarfoundation.com'
        },*/
        yAxis: { 
            title: {
                text: 'Õpilaste arv',              
            }
        },
        /*legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },*/
        plotOptions: {
            series: {
                pointStart: startYear
            }
        },
        series: [{
            name: "Õpilaste arv",
            color: '#b71234',
            data: people
        }, ]

    });
}
//Andmebaasist võetakse kõikide direktorite nimed ja nende tööl olnud aastad
function getprincipals(){
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                              principals = JSON.parse(xhttp.responseText);
                              console.log("tired: "+JSON.parse(xhttp.responseText));
                              console.log('loaded');    
                              printprincipals();   
                      }
                  };
                  xhttp.open("GET", '../Php/getprincipals.php?REG_ID='+regID, true);
                  xhttp.send();                      
}
//Kuvatakse direktorite andmed lehele
function printprincipals(){
        for (i = 0; i < principals.length; i++) { 
                  var ul = document.getElementById("principals");
                  var li = document.createElement("li");
                  var children = ul.children.length + 1;
                  li.setAttribute("id", "principalelement"+children);
                  var principal = principals[i].start+"-"+principals[i].end+"   "+principals[i].principal;
                  li.appendChild(document.createTextNode(principal));
                  ul.appendChild(li);
        }
    getaddchange();
}
//Andmebaasist võetakse aadressi muutused
function getaddchange(){
    var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                              addchange = JSON.parse(xhttp.responseText);
                              console.log("tired: "+JSON.parse(xhttp.responseText));
                              console.log('loaded');    
                              printaddchange();
                      }
                  };
                  xhttp.open("GET", '../Php/getaddchange.php?REG_ID='+regID, true);
                  xhttp.send();
}
//Kuvatakse aadressi muutused lehele
function printaddchange(){
    for (i = 0; i < addchange.length; i++) { 
                  var ul = document.getElementById("addchange");
                  var li = document.createElement("li");
                  var children = ul.children.length + 1;
                  li.setAttribute("id", "addelement"+children);
                  var add = addchange[i].year+" "+addchange[i].address;
                  li.appendChild(document.createTextNode(add));
                  ul.appendChild(li);
    }
    
    getnamehange();
}
//Andmebaassit võtakse nimede muutused
function getnamehange(){
    var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                              namechange = JSON.parse(xhttp.responseText);
                              console.log("tired: "+JSON.parse(xhttp.responseText));
                              console.log('loaded');    
                              printnamehange();
                      }
                  };
                  xhttp.open("GET", '../Php/getnamechange.php?REG_ID='+regID, true);
                  xhttp.send();
}
//Kuvatakse nimede muutused lehele
function printnamehange(){
    for (i = 0; i < namechange.length; i++) { 
                  var ul = document.getElementById("namechange");
                  var li = document.createElement("li");
                  var children = ul.children.length + 1;
                  li.setAttribute("id", "nameelement"+children);
                  var name = namechange[i].year+" "+namechange[i].name;
                  li.appendChild(document.createTextNode(name));
                  ul.appendChild(li);
    }
    
    getPeople();
}

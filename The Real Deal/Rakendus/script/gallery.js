var picUrl = [];
var id;
var schoolname;

window.onload = function(){
  getID();
  getSchool();
  document.getElementById("backBTN").onclick = function(){
    location.href = "koolileht.html?schoolname="+schoolname;
  };
};
//id kättesaamine vastava kooli piltide laadimiseks
function getID(){
  var url = window.location.href;
  var params = url.split('?');
  var idLong = params[1];
  id = idLong.substring(3);
  getPics();
}
//koolinime saamine selleks, et "tagasi" nupp viiks õigele lehele
function getSchool(){
  var url = window.location.href;
  var params = url.split('&');
  schoolname = params[1].substring(11);
  console.log(schoolname);
}
//andmebaasist antud kooli galerii laadimine
function getPics(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            picUrl = JSON.parse(xhttp.responseText);
            console.log(JSON.parse(xhttp.responseText));
            console.log('loaded');
            displayImages();
       }
    };
    xhttp.open("GET", '../Php/getpics.php?REG_ID='+id, true);
    xhttp.send();
}
//kooli galerii kuvamine 
displayImages = function(){
  var container = document.getElementById('slider2');
  for (var i = 0; i < picUrl.length; i++) {
    var img = document.createElement('img');
    img.src = picUrl[i].link;
    container.appendChild(img);
  }
};

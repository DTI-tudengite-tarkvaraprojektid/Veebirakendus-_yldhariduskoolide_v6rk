var people;
var schoolName;
var startYear = 1920;
var regID;
window.onload = function(){
            // get school data
            console.log('started loading....');
            schoolName = decodeURI(location.search.substring(12));
            console.log(schoolName);
            getRegID();           
}

function getRegID(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                regID = JSON.parse(xhttp.responseText);
                console.log(JSON.parse(xhttp.responseText));
                console.log('loaded');
                getPeople();
        }
     };
    xhttp.open("GET", '../Php/getregnr.php?school='+schoolName, true);
    xhttp.send();
        
}

function getPeople(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                people = JSON.parse(xhttp.responseText);
                console.log(JSON.parse(xhttp.responseText));
                console.log('loaded');
                loadDia();
        }
     };
    xhttp.open("GET", '../Php/getpeopleinfo.php?regid='+regID, true);
    xhttp.send();
        
}

function loadDia(){
    Highcharts.chart('container1', {

    title: {
        text: schoolName,
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
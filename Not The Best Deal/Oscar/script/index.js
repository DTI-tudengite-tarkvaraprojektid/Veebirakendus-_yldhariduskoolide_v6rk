var schoolName = "Tallinna 21. kool";
var startYear = 1940;
var studentCount = [200, 300, 500, 542, 532, 789, 231, 293, 542, 261,200, 300, 500, 542, 532, 789, 231, 293, 542, 261,200, 300, 500, 542, 532, 789,
        231, 293, 542, 261,200, 300, 500, 542, 532, 789, 231, 293, 542, 261,200, 300, 500, 542, 532, 789, 231, 293, 542, 261,200, 300, 500, 542,
        532, 789, 231, 293, 542, 261,200, 300, 500, 542, 532, 789, 231, 293, 542, 261];
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
        data: studentCount
    }, ]

});

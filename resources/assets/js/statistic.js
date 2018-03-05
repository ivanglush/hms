

//var Chart = require('chart.js');

var usedDays = $('#used_days').data("used-days");
var unusedDays = $('#unused_days').data("unused-days");
var year = $('#year').data("year");

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["Использованные", "Неиспользованные"],
        datasets: [{
            label: "Дни отпуска",
            backgroundColor: ["#3cba9f", "#c45850"],
            data: [usedDays, unusedDays]
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Дни отпуска за ' + year + ' год'
        }
    }
});
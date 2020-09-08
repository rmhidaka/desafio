/* globals Chart:false, feather:false */

(function () {
    'use strict'
    var pedidos = window.parent.allPedidos(false);
    //var clientes = window.parent.allClientes();
    feather.replace()

    // Graphs
    var ctx = document.getElementById('myChart')
    // eslint-disable-next-line no-unused-vars
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                'Novos',
                'Pendentes',
                'Entregues'
            ],
            datasets: [{
                data: [
                    24003,
                    23489,
                    24092
                ],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#CCC',
                borderWidth: 4,
                pointBackgroundColor: '#CCC'
            },
            {
                data: [
                    15339,
                    21345,
                    18483
                ],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });

    var ctxpie = document.getElementById('chart-pie');
    var options = {};


    var str = JSON.stringify(pedidos, null, 2)
    console.log(str);

    var data = {
        datasets: [{
            data: [pedidos.novos, pedidos.pendentes, pedidos.entregues],
            backgroundColor: ["#4c484b", "#6c757d", "#343a40"]
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'Novo',
            'Entregue',
            'Pendente'
        ],
    };
    var myPieChart = new Chart(ctxpie, {
        type: 'doughnut',
        data: data,
        options: options
    });



}())


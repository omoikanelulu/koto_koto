@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>指定期間のグラフ</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            /* canvas要素の高さを調整 */
            #graph {
                max-height: 100%;
            }
        </style>
    </head>

    <body>
        <h1>指定期間のグラフ</h1>
        <canvas id="graph"></canvas>
        <script>
            const graphData = @json($graphData);
            const labels = Object.keys(graphData);
            const goodThingOrders = labels.map(date => graphData[date].good_thing_order);
            const badThingOrders = labels.map(date => -graphData[date].bad_thing_order);

            const ctx = document.getElementById('graph').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Good Thing Order',
                            data: goodThingOrders,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            stack: 'stack1',
                        },
                        {
                            label: 'Bad Thing Order',
                            data: badThingOrders,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            stack: 'stack1',
                        },
                    ],
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                        x: {
                            min: -30, // この項目の-と+を逆にしたい
                            max: 30,
                            beginAtZero: true,
                            grid: {
                                drawOnChartArea: false,
                                drawTicks: false,
                                drawBorder: false,
                                borderColor: 'rgba(0, 0, 0, 0.1)',
                                borderWidth: 1,
                                zeroLineColor: 'rgba(0, 0, 0, 0.1)',
                                zeroLineWidth: 1,
                            },
                        },
                    },
                },
            });
        </script>
    </body>

    </html>
@endsection

@extends('layouts.app')

@section('content')

    <head>
        {{-- チャートを作成するchart.jsを読み込む --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            /* canvas要素の高さを調整 */
            #user_chart {
                max-height: 100%;
                max-width: 100%;
            }
        </style>
    </head>

    {{-- グラフの棒の幅を固定したいが、手間がかかるようなので未着手 --}}

    <body>
        <h1>{!! $const['title'] !!}</h1>

        {{-- グラフの描画 --}}
        <canvas id="user_chart"></canvas>
        <script>
            const graphData = @json($graphData);
            const labels = Object.keys(graphData);
            const goodThingOrders = labels.map(date => graphData[date].good_thing_order);
            const badThingOrders = labels.map(date => -graphData[date].bad_thing_order);
            const ctx = document.getElementById('user_chart').getContext('2d');
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
                    responsive: true,
                    indexAxis: 'y',
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                        x: {
                            min: -30,
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
        {{-- 戻るボタン --}}
        <div class="">
            <a href="{{ route('graph.index_chart') }}">
                <button type="button" class="btn btn-sm btn-secondary">{!! $const['back'] !!}</button>
            </a>
        </div>

    </body>
@endsection

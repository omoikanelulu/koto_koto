@extends('layouts.app')

@section('content')
    @push('head')
        {{-- チャートを作成するchart.jsを読み込む --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            /* canvas要素の高さを調整 */
            #user_chart {
                /* min-height: 200px; */
                /* max-width: 100%; */
                max-width: 100%;
            }
        </style>
    @endpush

    <div>
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
                            // イイコトの表示設定
                            label: '{{ $const['good_thing_order'] }}',
                            data: goodThingOrders,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            stack: 'stack1',
                            categoryPercentage: 1.0, // カテゴリー全体の幅の割合を指定
                            barPercentage: 0.8, // 個々のカテゴリー内での棒の幅の割合を指定
                            maxBarThickness: 50, // バーの最大太さを設定
                            minBarThickness: 20, // バーの最小太さを設定
                        },
                        {
                            // ヤナコトの表示設定
                            label: '{{ $const['bad_thing_order'] }}',
                            data: badThingOrders,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            stack: 'stack1',
                            categoryPercentage: 1.0, // カテゴリー全体の幅の割合を指定
                            barPercentage: 0.8, // 個々のカテゴリー内での棒の幅の割合を指定
                            maxBarThickness: 50, // バーの最大太さを設定
                            minBarThickness: 20, // バーの最小太さを設定
                        },
                    ],
                },
                options: {
                    responsive: true,
                    indexAxis: 'y',
                    plugins: {
                        title: {
                            display: true,
                            text: 'キモチの推移',
                            font: {
                                size: 20,
                            }
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                        x: {
                            // 推奨値、指定した値を超える場合は、その値が表示されるまで拡大される
                            suggestedMin: -10,
                            suggestedMax: 10,
                            beginAtZero: true,
                            grid: {
                                drawOnChartArea: false,
                                drawTicks: false,
                                drawBorder: false,
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

    </div>
@endsection

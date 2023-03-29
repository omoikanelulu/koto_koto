<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Logs</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* canvas要素の高さを調整 */
        #today_chart {
            max-height: 100%;
            max-width: 100%;
        }
    </style>
</head>

<body>
    <canvas id="today_chart"></canvas>
    <script>
        const graphData = @json($graphData);
        const labels = Object.keys(graphData);
        const goodThingOrders = labels.map(date => graphData[date].good_thing_order);
        const badThingOrders = labels.map(date => -graphData[date].bad_thing_order);

        const ctx = document.getElementById('today_chart').getContext('2d');
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
                        stack: 'stack1', // データセットのスタック名を設定
                    },
                    {
                        label: 'Bad Thing Order',
                        data: badThingOrders,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        stack: 'stack1', // データセットのスタック名を設定
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
                        min: -3, // x軸の最小値を-3に設定
                        max: 3, // x軸の最大値を3に設定
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

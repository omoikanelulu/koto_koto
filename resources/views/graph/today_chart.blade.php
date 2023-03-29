<!DOCTYPE html>
<html lang="ja">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* canvas要素の高さを調整 */
        #today_chart {
            height: 400px;
            width: 400px;
        }
    </style>
</head>

<body>
    <canvas id="today_chart"></canvas>
    <script>
        const graphData = @json($graphData);
        const labels = ['Good Thing Order', 'Bad Thing Order'];
        const goodThingOrders = graphData.reduce((total, currentValue) => total + currentValue.good_thing_order, 0);
        const badThingOrders = graphData.reduce((total, currentValue) => total + currentValue.bad_thing_order, 0);

        const ctx = document.getElementById('today_chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: [goodThingOrders, badThingOrders],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        });
    </script>
</body>

</html>

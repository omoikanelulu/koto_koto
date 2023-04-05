<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* canvas要素の高さを調整 */
        #today_chart_container {
            max-height: 200px;
            max-width: 200px;
        }

        #today_chart {
            display: block;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center">
        <div id="today_chart_container">
            <canvas id="today_chart"></canvas>
        </div>
    </div>
    <script>
        const graphData = @json($graphData);
        const graphDataArray = Object.values(graphData).map(value => value);
        const labels = ['Good Thing Order', 'Bad Thing Order'];
        const goodThingOrders = graphDataArray.reduce((total, currentValue) => total + currentValue.good_thing_order, 0);
        const badThingOrders = graphDataArray.reduce((total, currentValue) => total + currentValue.bad_thing_order, 0);
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

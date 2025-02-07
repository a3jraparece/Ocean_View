@extends('admin.layout')
@section('title', 'Ocean View')
@section('css', '/css/admin/dashboard.css')
@section('content')

    <div class="dashboard-header">
        <h2>Dashboard</h2>
        <div class="tabs">
            <button id="tabs1" onclick="">Daily</button>
            <button id="tabs2">Monthly</button>
            <button id="tabs3">Yearly</button>
        </div>
    </div>

    <div class="dashboard">
        <div class="stats-container">
            <div class="stat-box">
                <h3>Today's Profit</h3>
                <p>P402,123</p>
            </div>
            <div class="stat-box">
                <h3>Profit for the Last 30 days</h3>
                <p>P12,063,390</p>
            </div>
            <div class="stat-box">
                <h3>Total Number of Contributors</h3>
                <p>57</p>
            </div>
        </div>

        <div class="graph-container">
            <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
        </div>

        <div class="bottom-section">
            <div class="ranking">
                <h3>Resort's Contribution Ranking</h3>
                <table>
                    <tr>
                        <th>Ranking</th>
                        <th>Resort</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td class="gold">1</td>
                        <td>Punta Verde Resort</td>
                        <td>P76,056</td>
                    </tr>
                    <tr>
                        <td class="silver">2</td>
                        <td>Friday Beach Resort</td>
                        <td>P73,056</td>
                    </tr>
                    <tr>
                        <td class="bronze">3</td>
                        <td>Bravo Beach Resort</td>
                        <td>P70,056</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Coco Beach</td>
                        <td>P69,056</td>
                    </tr>
                </table>
            </div>
            <div class="recent-profits">
                <h3>Recent Profits</h3>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Resort</th>
                        <th>Customer Name</th>
                        <th>Profit</th>
                    </tr>
                    <tr>
                        <td>09/10/2024</td>
                        <td>Punta Verde Resort</td>
                        <td>Alex Aparece</td>
                        <td>900</td>
                    </tr>
                    <tr>
                        <td>09/09/2024</td>
                        <td>Friday Beach Resort</td>
                        <td>Aldren Luga</td>
                        <td>700</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script>
        const labels = [
            'Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5',
            'Day 6', 'Day 7', 'Day 8', 'Day 9', 'Day 10',
            'Day 11', 'Day 12', 'Day 13', 'Day 14', 'Day 15',
            'Day 16', 'Day 17', 'Day 18', 'Day 19', 'Day 20'
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Profit (in pesos)',
                backgroundColor: '#007bff',
                borderColor: '#0056b3',
                data: [
                    200000, 400000, 600000, 700000, 800000,
                    900000, 600000, 500000, 300000, 700000,
                    800000, 900000, 400000, 600000, 800000,
                    900000, 1000000, 850000, 750000, 950000
                ],
                fill: false,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Profit Trend (Last 30 Days)'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Day'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Profit (in pesos)'
                        }
                    }]
                }
            }
        };
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, config);
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

@endsection

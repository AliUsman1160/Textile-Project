@extends('layout.app')

@section('style')
    <style>
        .top-cards {
            border-radius: 10px;
            border-left: 3px solid #0a043c;
        }

        .graph-card {
            border-radius: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <div class="card mt-3 top-cards">
                    <div class="card-body">
                        <h5>Current Month Sale</h5>
                        <h3><b>Rs. {{ $totalsale }}</b></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="card mt-3 top-cards">
                    <div class="card-body">
                        <h5>Current Month Purchase</h5>
                        <h3><b>Rs. {{ $totalpurchase }}</b></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4">
                <div class="card mt-3 top-cards">
                    <div class="card-body">
                        <h5>Current Month Profit</h5>
                        <h3><b>Rs. {{ $totalprofit > 0 ? $totalprofit : "-" }}</b></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-lg-4 col-sm-6">
                <div class="card ">
                    <div class="card-header main-color">Sales</div>
                    <div class="card-body">
                        <canvas id="salesChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card ">
                    <div class="card-header main-color">Purchase</div>
                    <div class="card-body">
                        <canvas id="purchaseChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card ">
                    <div class="card-header main-color">Profit</div>
                    <div class="card-body">
                        <canvas id="profitChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>
    <script>
        function createBarChart(chartId, label, data, backgroundColor, borderColor) {
            var ctx = document.getElementById(chartId).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($data['labels']) !!},
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        createBarChart('salesChart', 'Sales', {!! json_encode($data['salesData']) !!}, 'rgba(75, 192, 192, 0.2)', 'rgba(75, 192, 192, 1)');
        createBarChart('purchaseChart', 'Purchase', {!! json_encode($data['purchaseData']) !!}, 'rgba(255, 99, 132, 0.2)', 'rgba(255, 99, 132, 1)');
        createBarChart('profitChart', 'Profit', {!! json_encode($data['profitData']) !!}, 'rgba(255, 206, 86, 0.2)', 'rgba(255, 206, 86, 1)');
    </script>
@endsection

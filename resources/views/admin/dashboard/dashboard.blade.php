@extends('admin.layout.layout')

@section('title','Dashboard')

@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-4 ms-5 d-flex justify-content-center" style="padding:0 60px;margin-top: 100px;">
                <div class="card card-body" style="background-color:rgb(140, 157, 245);border:2px solid black;box-shadow: 2px 5px 5px rgb(0, 0, 0,0.4);user-select: none;">
                    <h5 class="text-center">Total Sale</h5>
                    <div class="d-flex justify-content-between">
                        <span>This Year :</span>
                        <span>150000 Kyats</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Last Year :</span>
                        <span>200000 Kyats</span>
                    </div>
                </div>
            </div>
            <div class="col-3 ms-5" style="padding:0 60px;margin-top: 100px;">
                <div class="card card-body" style="background-color:rgb(152, 180,199 );border:2px solid black;box-shadow: 2px 5px 5px rgb(0, 0, 0,0.4);user-select: none;">
                    <h5 class="text-center">Total View</h5>
                    <div class="d-flex justify-content-between">
                        <span>This Year :</span>
                        <span>100</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Last Year :</span>
                        <span>200</span>
                    </div>
                </div>
            </div>
            <div class="col-3 ms-5" style="padding:0 60px;margin-top: 100px;">
                <div class="card card-body" style="background-color:rgba(57, 37, 78, 0.5);border:2px solid black;box-shadow: 2px 5px 5px rgb(0, 0, 0,0.4);user-select: none;">
                    <h5 class="text-center">Total User Acc</h5>
                    <span class="mt-2 text-center h5">50</span>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6" style="padding:0 50px">
                <div class="card card-body">
                    <span class="text-center h5 text-decoration-underline">Sale</span>
                    <canvas id="sale_chart"></canvas>
                </div>
            </div>
            <div class="col-6" style="padding:0 50px">
                <div class="">
                    <span class="d-flex justify-content-center h5 text-decoration-underline">View</span>
                    <canvas id="view_chart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        //chart
        let ctx = document.getElementById('sale_chart');
        let ctx1 = document.getElementById('view_chart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'This Year',
                    data: [10000, 20000, 10000, 20000, 30000, 10000, 40000, 5000, 25000, 42000, 19000, 50000],
                    borderWidth: 1,
                    backgroundColor: 'rgba(0,0,0,0.6)'
                }, {
                    label: 'Last Year',
                    data: [31000, 10000, 50000, 4000, 20000, 60000, 50000, 55000, 65000, 45000, 39000, 45000],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.5)',
                        yAlign: 'bottom', //mean tooltip triangle part align
                        displayColors: false, // hide color of tooltip
                    }
                }
            }
        });

        //view chart
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: [
                    'This Year',
                    'Last Year',
                    'Other'
                ],
                datasets: [{
                    label: 'views',
                    data: [50, 30, 200 - 80],
                    backgroundColor: [
                        'rgb(140, 157, 245)',
                        'rgb(152, 180,199 )',
                        'rgb(0,0 ,0,0.5 )'
                    ],
                    hoverOffset: 4,
                    weight: 0.5
                }],

            },
            options: {
                aspectRatio: 2,
                cutout: 70,
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.5)',
                        yAlign: 'bottom', //mean tooltip triangle part align
                        displayColors: false, // hide color of tooltip
                    }
                }
            }
        })
    </script>
@endsection

@extends('layouts.app')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script src="/themes/js/chart-js-config.js"></script>
@endsection

@section('content')
<div class="row dash-row">
    <div class="col-xl-4">
        <div class="stats stats-primary">
            <h3 class="stats-title"> Total Sold </h3>
            <div class="stats-content">
                <div class="stats-icon">
                    <i class="fa fa-user"></i>
                </div>
                <div class="stats-data">
                    <div class="stats-number">{{number_format($sold->qty)}}</div>
                    <div class="stats-change">
                        <span class="stats-percentage">+25%</span>
                        <span class="stats-timeframe">from last month</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="stats stats-success ">
            <h3 class="stats-title"> Revenue </h3>
            <div class="stats-content">
                <div class="stats-icon">
                    <i class="fa fa-cart-arrow-down"></i>
                </div>
                <div class="stats-data">
                    <div class="stats-number">₱ {{number_format($revenue->total_net, 2)}}</div>
                    <div class="stats-change">
                        <span class="stats-percentage">+17.5%</span>
                        <span class="stats-timeframe">from last month</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="stats stats-danger">
            <h3 class="stats-title"> Open Order Items </h3>
            <div class="stats-content">
                <div class="stats-icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <div class="stats-data">
                    <div class="stats-number">{{number_format($open->open)}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card spur-card">
            <div class="card-header">
                <div class="spur-card-icon">
                    <i class="fa fa-chart-bar"></i>
                </div>
                <div class="spur-card-title"> Best Selling Chart </div>
                <div class="spur-card-menu">
                    <div class="dropdown show">
                        <a class="spur-card-menu-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body spur-card-body-chart">
                <canvas id="spurChartjsBar"></canvas>
                
                <script>
                    var chartLabel = [], chartValue = [];
                    @foreach($charts as $chart)
                    chartLabel.push(`{{$chart->name}}`);
                    chartValue.push(`{{$chart->total}}`);
                    @endforeach
                    var ctx = document.getElementById("spurChartjsBar").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: chartLabel,
                            datasets: [{
                                label: 'Blue',
                                data: chartValue,
                                backgroundColor: window.chartColors.primary,
                                borderColor: 'transparent'
                            }]
                        },
                        options: {
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card spur-card">
            <div class="card-header">
                <div class="spur-card-icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <div class="spur-card-title"> Order Lists </div>
            </div>
            <div class="card-body ">
                <div class="notifications">
                    @foreach($lists as $list)
                    <a href="{{route('orders.edit', $list->id)}}" class="notification">
                        <div class="notification-icon">
                            <i class="fa fa-inbox"></i>
                        </div>
                        <div class="notification-text">
                            {{$list->customer->name}} - ({{$list->items->sum('qty')}} item orders)
                        </div>
                        <span class="notification-time">{{date('M d, Y',strtotime($list->date_ordered))}}</span>
                    </a>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('landlord.admin.admin-master')

@section('title')
    {{__('Google Analytics')}}
@endsection

@section('style')
    <style>
        .landlord_recent_orders .card .card-body {
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="col-12 grid-margin stretch-card landlord_recent_orders">
        <div class="card">
            <div class="card-body landlord_card_body">
                <h4 class="card-title mb-5">{{__('Google Analytics')}}</h4>
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <div class="chart-wrapper margin-top-40">
                            <h2 class="chart-title">{{__("Amount Per Month In")}} {{date('Y')}}</h2>
                            <canvas id="monthlyRaised"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="chart-wrapper margin-top-40">
                            <h2 class="chart-title">{{__("Amount Per Day In Last 30Days")}}</h2>
                            <div>
                                <canvas id="monthlyRaisedPerDay"></canvas>
                            </div>
                        </div>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/common/js/chart.js')}}"></script>
    <script>
        $.ajax({
            url: '{{route('landlord.admin.home.chart.data.month')}}',
            type: 'POST',
            async: false,
            data: {
                _token : "{{csrf_token()}}"
            },
            success: function (data) {
                labels = data.labels;
                chartdata = data.data;
                new Chart(
                    document.getElementById('monthlyRaised'),
                    {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '{{__('Amount Received')}}',
                                backgroundColor:  '#039cda',
                                borderColor: '#039cda',
                                data: chartdata,
                                barThickness: 15,
                                hoverBackgroundColor: '#fc3c68',
                                borderRadius: 5,
                                hoverBorderColor: '#fc3c68',
                                minBarLength: 50,
                                indexAxis: "x",
                                pointStyle: 'star',
                            }],
                        }
                    }
                );
            }
        });
        $.ajax({
            url: '{{route('landlord.admin.home.chart.data.by.day')}}',
            type: 'POST',
            async: false,
            data: {
                _token : "{{csrf_token()}}"
            },
            success: function (data) {
                labels = data.labels;
                chartdata = data.data;
                new Chart(
                    document.getElementById('monthlyRaisedPerDay'),
                    {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '{{__('Amount Received')}}',
                                backgroundColor: '#F86048',
                                borderColor: '#fd861d',
                                data: data.data,
                            }]
                        }
                    }
                );
            }
        });
    </script>
@endsection

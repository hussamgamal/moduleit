@extends('Common::admin.layout.page')
@section('page')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        @foreach ($counters as $count)
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-{{ $count['type'] }}">
                    <div class="inner">
                        <h3>{{ $count['count'] }}</h3>

                        <p>{{ $count['title'] }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas {{ $count['icon'] }}"></i>
                    </div>
                    <a href="{{ $count['url'] }}" class="small-box-footer mlink">@lang('More') <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        @endforeach
    </div>


    @if (isset($sales))
        <div class="col-sm-12 col-md-12">
            <!-- solid sales graph -->
            <div class="card bg-gradient-info">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-th mr-1"></i>
                        @lang('Aqars')
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas class="chart" id="line-chart"
                        style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card -->


        </div>
        <script>
            // The Calender
            $('#calendar').datetimepicker({
                format: 'L',
                inline: true
            });

            $('.knob').knob();

            // Sales graph chart
            var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');
            //$('#revenue-chart').get(0).getContext('2d');
            var sales = JSON.parse("{{ json_encode($sales) }}");
            console.log(sales);
            var salesGraphChartData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'إجمالى المبيعات',
                    fill: false,
                    borderWidth: 2,
                    lineTension: 0,
                    spanGaps: true,
                    borderColor: '#efefef',
                    pointRadius: 3,
                    pointHoverRadius: 7,
                    pointColor: '#efefef',
                    pointBackgroundColor: '#efefef',
                    data: sales
                }]
            }

            var salesGraphChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: '#efefef',
                        },
                        gridLines: {
                            display: false,
                            color: '#efefef',
                            drawBorder: false,
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 5000,
                            fontColor: '#efefef',
                        },
                        gridLines: {
                            display: true,
                            color: '#efefef',
                            drawBorder: false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            var salesGraphChart = new Chart(salesGraphChartCanvas, {
                type: 'line',
                data: salesGraphChartData,
                options: salesGraphChartOptions
            });
        </script>
    @endif
@endsection

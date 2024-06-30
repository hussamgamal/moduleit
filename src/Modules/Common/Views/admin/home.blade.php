@extends('Common::admin.layout.page')
@section('page')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        @foreach ($counters as $count)
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box text-white bg-{{ $count['type'] }}">
                    <div class="inner">
                        <h3>{{ $count['count'] }}</h3>

                        <p>{{ $count['title'] }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion fas {{ $count['icon'] }}"></i>
                    </div>
                    <a href="{{ $count['url'] }}" style="color:white !important;" class="small-box-footer mlink">@lang('More') <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{__('Last Clients')}}</h6>
                </div>
                <div class="card-content">
                    <div class="table-responsive mt-1">
                        <table class="table table-hover-animation mb-0">
                            <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('name')}}</th>
                                <th>{{__('phone')}}</th>
                                <th>{{__('image')}}</th>
                                <th>{{__('Created At')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($users) > 0)
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{@$user->mobile}}</td>
                                        <td>
                                            <img class="media-object rounded-circle" src="{{$user->image}}" alt="Avatar" height="50" width="50">
                                        </td>
                                        <td>{{date('Y-m-d',strtotime($user->created_at))}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">{{__('No Data')}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{__('Last Orders')}}</h6>
                </div>
                <div class="card-content">
                    <div class="table-responsive mt-1">
                        <table class="table table-hover-animation mb-0">
                            <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('username')}}</th>
                                <th>{{__('phone')}}</th>
                                <th>{{__('total')}}</th>
                                <th>{{__('Created At')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($latest_orders) > 0)
                                @foreach($latest_orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->user?->name}}</td>
                                        <td>{{$order->user?->mobile}}</td>
                                        <td>{{@$order->total}}</td>
                                        <td>{{date('Y-m-d',strtotime($order->created_at))}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">{{__('No Data')}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{__('Last Products')}}</h6>
                </div>
                <div class="card-content">
                    <div class="table-responsive mt-1">
                        <table class="table table-hover-animation mb-0">
                            <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('name')}}</th>
                                <th>{{__('price')}}</th>
                                <th>{{__('image')}}</th>
                                <th>{{__('Created At')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($latest_products) > 0)
                                @foreach($latest_products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->title}}</td>
                                        <td>{{@$product->price}}</td>
                                        <td>
                                            <img class="media-object rounded-circle" src="{{$product->image}}" alt="Avatar" height="50" width="50">
                                        </td>
                                        <td>{{date('Y-m-d',strtotime($product->created_at))}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">{{__('No Data')}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{__('Last Services')}}</h6>
                </div>
                <div class="card-content">
                    <div class="table-responsive mt-1">
                        <table class="table table-hover-animation mb-0">
                            <thead>
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('name')}}</th>
                                <th>{{__('image')}}</th>
                                <th>{{__('Created At')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($latest_services) > 0)
                                @foreach($latest_services as $service)
                                    <tr>
                                        <td>{{$service->id}}</td>
                                        <td>{{$service->title}}</td>
                                        <td>
                                            <img class="media-object rounded-circle" src="{{$service->image}}" alt="Avatar" height="50" width="50">
                                        </td>
                                        <td>{{date('Y-m-d',strtotime($service->created_at))}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">{{__('No Data')}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if (isset($sales))
            <div class="col-sm-12 col-md-12">
                <!-- solid sales graph -->
                <div class="card bg-gradient-info">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-th mr-1"></i>
                            @lang('Orders')
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
            <script src="{{ url('assets/admin') }}/plugins/chart.js/Chart.min.js"></script>
            <script>
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
    </div>
@endsection

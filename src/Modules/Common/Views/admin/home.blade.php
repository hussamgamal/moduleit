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

@endsection

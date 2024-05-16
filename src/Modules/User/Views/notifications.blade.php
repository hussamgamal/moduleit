@extends('Common::index')

@section('page')
    <!-- Start Notifications -->
    <main class="notifications_page__ default_page__ top_small_padding">
        <div class="container">
            <div class="page_head_wrapper flex_display with_icon__">
                <figure class="icon__ loading-omd">
                    <img class="lazy-omd img-om"
                        data-src="{{ url('assets/web') }}/images/shapes/notification_page_title_icon.svg" alt="..." />
                </figure>
                <div>
                    <h1 class="page_main_title__">@lang('Notifications')</h1>
                    <h5 class="page_sub_title__">@lang('Show all notification for you')</h5>
                </div>
            </div>

            @forelse ($rows as $row)
                <a href="#" class="notification_block__ {{ $row->not_seen ? 'not_read' : '' }}">
                    <figure class="figure__ icon__">
                        <img class="img-om" src="{{ url('assets/web') }}/images/shapes/notification_block_icon.svg"
                            alt="..." />
                    </figure>

                    <div class="title_wrapper">
                        <h3 class="title__">{{ $row->title }}</h3>
                        <h4 class="date_wrapper__">
                            <span class="date__">{{ $row->info['date'] }}</span>
                            <span class="titme__">{{ $row->info['time'] }}</span>
                        </h4>
                    </div>

                    <p class="parag__">{{ $row->text }}</p>
                </a>
            @empty
                <div style="padding-top:50px" class="empty_list_wrapper mix permits_filter_item under_approval tools_permit">
                    <figure class="figure__ loading-omd center">
                        <img class="lazy-omd img-om" data-src="{{ url('assets/web') }}/images/shapes/empty_permit.svg"
                            alt="..." />
                    </figure>
                    <h2 class="title__">لا توجد لديك إشعارات في الوقت الحالي</h2>
                </div>
            @endforelse

        </div>
    </main>
    <!-- End Notifications -->
@stop

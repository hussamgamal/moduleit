@extends('Common::index')
@section('title', __('Payments'))

@section('page')
    <main class="daily_visits_page default_page__">
        <div class="container">
            <div class="page_head_wrapper center__">
                <h1 class="page_main_title__">@lang('Payments')</h1>
            </div>

            <ul class="mixitup_controls_wrapper__ center__ with_margin">
                @foreach ($user->payments as $row)
                    <a href="#" class="permits_mixItUp_filter_control filter" data-filter=".pay_{{ $row->id }}">
                        {{ $row->title }}
                    </a>
                @endforeach
            </ul>
            @if ($user->payments()->count())
                <div class="mixitup_box_list column_dir" id="permits_mix_box_list">
                    @foreach ($user->payments as $row)
                        <div class=" mix permits_filter_item pay_{{ $row->id }}">
                            <figure class="figure__ loading-omd center with_background_shape ">
                                <img class="lazy-omd img-om"
                                    data-src="{{ url('assets/web') }}/images/shapes/payment_page_icon.svg" alt="..." />
                            </figure>
                            <p class="parag__">{{ $row->content ?? $row->title }}</p>

                            <div class="price__ with_background center__ payment_price_style">
                                {{ $row->total }}
                                <div class="currency__">
                                    @lang('SR')
                                </div>
                            </div>
                            @if ($row->status == 'pending_review')
                                <a style="background: orange" href="#!" class="link__ main_link booking_link center__">
                                    @lang('Pending Review')
                                </a>
                            @else
                                <a href="{{ route('payments.pay', $row->cryptedId) }}"
                                    class="link__ main_link booking_link center__">
                                    @lang('Pay fees')
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <figure class="figure__ loading-omd center with_background_shape greyColor">
                    <img class="lazy-omd img-om" data-src="{{ url('assets/web') }}/images/shapes/payment_page_icon.svg"
                        alt="..." />
                </figure>
                <p class="parag__">لا يوجد لديك رسوم سنوية للسداد</p>
            @endif
        </div>
    </main>
@stop

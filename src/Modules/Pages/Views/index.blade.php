@extends('Common::index')

@section('page')
    <!-- start of about-us -->
    <section class="about-us">
        <div class="container">
            <div class="row">
                <div class="col-md wow fadeInRight" data-wow-duration="1s" data-wow-delay=".3s">
                    <div class="right">
                        <h2 class="title">
                            @lang('Know more ... About our message')
                            <br>
                            @lang('Which')
                            <span>@lang('We Follow')</span>
                        </h2>
                        <p>
                            {{ app_setting('our_message_text') }}
                        </p>
                        <div class="row">
                            @foreach ($our_messages as $row)
                                <div class="col-md-6">
                                    <div class="features">
                                        <div class="photo">
                                            <img src="{{ $row->image }}">
                                        </div>
                                        <div class="words">
                                            <h2>{{ $row->title }}</h2>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="services">
                            <ul class="list-group list-group-horizontal">
                                <li class="list-group-item">
                                    <a href="{{ route('aqars.index', ['for' => 'sale']) }}">@lang('For Sale')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('aqars.index', ['for' => 'rent']) }}">@lang('For Rent')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('aqars.marketing') }}">@lang('Real Estate Marketing')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('projects.index') }}">@lang('Our Projects')</a>
                                </li>
                            </ul>
                        </div>
                        {{-- <a href="#" class="more">
                            @lang('More')
                            <i class="fa fa-arrow-left"></i>
                        </a> --}}
                    </div>
                </div>
                <div class="col-md wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                    <div class="left">
                        {{ dd(url(app_setting('our_message_image'))) }}
                        <img src="{{ url(app_setting('our_message_image')) }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of about-
@stop

@extends('Common::index')
@section('title', $title)

@section('page')
    <!-- start of about -->
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
                                    <a href="#">@lang('For Sale')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">@lang('For Rent')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">@lang('Real Estate Marketing')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">@lang('Our Projects')</a>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('pages.show', 'about') }}" class="more">
                            @lang('More')
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".3s">
                    <div class="left">
                        <img src="{{ url(app_setting('our_message_image')) }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of about -->
    <!-- start of managment -->
    <section class="managment">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="right">
                        <img src="{{ url(app_setting('manage_aqar_image')) }}" alt="">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="words">
                        <div class="child1">
                            <h2>@lang('Do you want to request property management')
                                <br>
                                <span>@lang('Your')</span>
                            </h2>
                            <p>
                                {{ app_setting('manage_aqar_text') }}
                            </p>
                        </div>
                        <div class="child2">
                            <a href="{{ route('contactus', ['type' => 'manage_request']) }}">
                                @lang('Order Now')
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of managment -->

    @include('Services::component')

    @include('Projects::component')

    @include('Contactus::component')
@stop

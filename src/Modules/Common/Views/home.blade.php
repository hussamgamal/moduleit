@extends('Common::index')
@section('title', __('Home'))
<!-- Start intro -->
@section('page')
    <!-- Start Home Slider Section -->

    <main class="home_slider_section__">
        <div class="swiper-container home_slider__">
            <div class="swiper-wrapper">
                @foreach ($sliders as $row)
                    <div class="swiper-slide">
                        <figure class="figure__ loading-omd asp-om">
                            <img class="img-om lazy-omd" data-src="{{ $row->image }}" alt="..." />
                        </figure>

                        <div class="slider_container__">
                            <h1 class="title__">
                                {{ $row->title }}
                            </h1>
                            <p class="parag__">{{ $row->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="arrow_pagination_wrapper__">
            <div class="arrow-sec center__">
                <div class="home_swiper_buttons swiper-button-prev"></div>
                <div class="home_swiper_buttons swiper-button-next"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </main>

    <!-- End Home Slider Section -->

    <!-- Start About Us Section -->
    <section class="about_us_section default_section__">
        <div class="container">
            <div class="row row_modify with_row_gap">
                <div class="col-lg-6 aos-init aos-animate" data-aos="fade-left">
                    <div class="section_head_wrapper__">
                        <h2 class="section_main_title__">@lang('About us')</h2>
                    </div>

                    <p class="about_us_main_parag__">{{ app_setting('about_title') }}
                    </p>
                    <p class="parag__">{{ app_setting('about_text') }}</p>
                    <a href="{{ route('pages.show', 'about') }}" class="link__ about_us_section_link__">
                        @lang('See more')
                        <img class="icon__" src="{{ url('assets/web') }}/images/shapes/about_us_section_link_arrow.svg"
                            alt="..." />
                    </a>
                </div>

                <div class="col-lg-6 aos-init aos-animate" data-aos="fade-right">
                    <div class="main_img_wrapper__">
                        <figure class="figure__ about_us_photo_figure__ loading-omd asp-om">
                            <img class="img-om lazy-omd" data-src="{{ app_setting('about_image') }}" alt="..." />
                        </figure>
                    </div>
                </div>
            </div>

            <div class="video_block__ about_us_video_block__ aos-init aos-animate" data-aos="fade-up">
                <div class="row row_modify with_row_gap reverse_dir_column_small_size">
                    <div class="col-lg-6">
                        <div class="video_block_description_wrapper__">
                            <figure class="icon__">
                                <img class="img-om" src="{{ url('assets/web') }}/images/logo.png" alt="..." />
                            </figure>

                            <h4 class="title__">{{ app_setting('video_title') }}</h4>
                            <p class="parag__">{{ app_setting('video_text') }}</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <a data-fancybox="selected_visuals_card__" href="{{ app_setting('video_image') }}"
                            class="selected_visuals_card__">
                            <figure class="figure__ loading-omd asp-om">
                                <img class="lazy-omd img-om" data-src="{{ app_setting('video_image') }}" alt="..." />
                            </figure>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Us Section -->

    @include('Services::component')

    @include('Teams::component')

    @include('Services::healthy_component')

    <!-- Start Our Partners Section -->
    <section class="our_partners_section default_section__">
        <div class="container">
            <div class="section_head_wrapper__ center">
                <h2 class="section_main_title__ with_margin_bottom__">@lang('Partners')</h2>
                <h3 class="section_main_sub_title___">@lang('Get to know our success partners')</h3>
            </div>

            <div class="row row_modify with_row_gap">
                @foreach ($partners as $row)
                    <div class="col-lg-4 col__ aos-init aos-animate" data-aos-offset="-500" data-aos="zoom-in">
                        <div class="our_partners_card__">
                            <figure class="figure__ icon__ loading-omd center">
                                <img class="img-om lazy-omd" data-src="{{ $row->image }}" alt="..." />
                            </figure>

                            <h4 class="title__">{{ $row->name }}</h4>
                            <p class="parag__">{{ $row->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Our Partners Section -->

    <!-- Start Our Customers' Opinions Section -->
    <section class="our_customers_opinions_section default_section__">
        <div class="container">
            <div class="section_head_wrapper__ center">
                <h2 class="section_main_title__ with_margin_bottom__">
                    @lang('Our customers opinions')
                </h2>
                <h3 class="section_main_sub_title___">
                    @lang('You have a collection of opinions from our distinguished customers')
                </h3>
            </div>

            <div class="cards_wrapper__">
                <div class="row row_modify with_row_gap">
                    @foreach ($opinions as $row)
                        <div class="col-lg-6 aos-init aos-animate" data-aos-offset="-500" data-aos="fade-left">
                            <div class="customer_opinions_card__">
                                <div class="imgwrapper__">
                                    <figure class="figure__ loading-omd asp-om">
                                        <img class="img-om lazy-omd" data-src="{{ $row->image }}" alt="..." />
                                    </figure>
                                </div>
                                <div class="description_wrapper__">
                                    <div class="head_wrapper__">
                                        <h4 class="title__">{{ $row->name }}</h4>

                                        <div class="rating_wrapper__">
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="fa-solid fa-star {{ $row->rate >= $i ? 'active' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </div>

                                    <p class="parag__">{{ $row->content }}</p>

                                    <h5 class="loaction__">
                                        <img class="icon__"
                                            src="{{ url('assets/web') }}/images/shapes/customers_opinions_location_icon__.svg"
                                            alt="..." />
                                        {{ $row->location }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Our Customers' Opinions Section -->
@stop

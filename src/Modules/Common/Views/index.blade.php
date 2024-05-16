<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{ app_setting('title') }}
        @hasSection('title')
            | @yield('title')
        @endif
    </title>

    <link rel="website icon" href="{{ app_setting('logo') }}" />

    <link rel="stylesheet" href="{{ url('assets/web') }}/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/animate.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/bootstrap.min_.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/swiper.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/style.css" />
</head>

<body>
    <!-- start header  -->

    <header class="main_header__">
        <div class="fixed_header__">
            <div class="container">
                <div class="header_content__">
                    <a class="header_logo__" href="{{ url('/') }}">
                        <figure class="figure__">
                            <img src="{{ app_setting('logo') }}" alt="{{ app_setting('title') }}" />
                        </figure>
                    </a>

                    <nav class="nav-om" id="navbar-menu-om">
                        <button class="close-button__"></button>

                        <figure class="figure__ nav_logo__">
                            <img src="{{ app_setting('logo') }}" alt="{{ app_setting('title') }}" />
                        </figure>

                        <ul class="nav-list-om list-unstyled">
                            <li class="header_list_item__ active">
                                <a href="{{ url('/') }}">@lang('Home')</a>
                            </li>
                            <li class="header_list_item__">
                                <a class="" href="#about_us_section">@lang('About us')</a>
                            </li>

                            <li class="header_list_item__">
                                <a href="#programs">@lang('Plans')</a>
                            </li>
                            <li class="header_list_item__">
                                <a href="#menu">@lang('Menu')</a>
                            </li>
                            <li class="header_list_item__">
                                <a href="#calories_calculator">@lang('Calories Calculator')</a>
                            </li>
                            <li class="header_list_item__">
                                <a href="#our_partners_and_clients">@lang('Client Opinions')</a>
                            </li>
                            <li class="header_list_item__">
                                <a href="#cities">@lang('Cities')</a>
                            </li>
                            <li class="header_list_item__">
                                <a href="#contact_us">@lang('Send Consultation')</a>
                            </li>
                        </ul>

                        <ul class="toolbar_options__ list-unstyled">
                            @auth
                                <li class="block__ profile_link_item__">
                                    <a class="profile_link__ butt__" href="{{ route('profile') }}">
                                        <figure class="figure__">
                                            <img src="{{ url('assets/web') }}/images/shapes/profile_header_link.svg"
                                                alt="Profile" />
                                        </figure>
                                    </a>
                                </li>

                                <li class="block__ notification_link_item__">
                                    <a class="notification_link__ butt__" href="{{ route('notifications') }}">
                                        <figure class="figure__">
                                            <img src="{{ url('assets/web') }}/images/shapes/notification_header_link.svg"
                                                alt="Notifications" />
                                        </figure>
                                    </a>
                                </li>
                            @else
                                <li class="block__ sing_up_blocks_list_item__">
                                    <div class="sing-up-blocks">
                                        <a class="singup_link login_link" href="{{ route('login') }}">@lang('Login')</a>
                                        <a class="singup_link" href="{{ route('register') }}">
                                            @lang('New Account')
                                        </a>
                                    </div>
                                </li>
                            @endauth

                            <li class="block__ lang_list_item__">
                                <a class="lang_link__ butt__" href="{{ route('change_locale') }}">
                                    <figure class="figure__">
                                        <img src="{{ url('assets/web') }}/images/shapes/global.svg"
                                            alt="{{ app_setting('title') }}" />
                                    </figure>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <!-- start active nenu button in small sizes  -->
                    <button class="menu_button__ button__" id="menu-butt-activ-om">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars"
                            class="svg-inline--fa fa-bars fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
                            </path>
                        </svg>
                    </button>
                    <!-- end active nenu button in small sizes  -->
                </div>
            </div>
            <div class="overlay"></div>
        </div>
    </header>

    <!-- end header  -->

    @yield('page')


    <!-- start of footer -->

    <!-- Start Footer -->
    <footer class="footer_sec__">
        <div class="container">
            <div class="row row_modify with_row_gap">
                <div class="col-lg-4 col_start__">
                    <h3 class="footer_head__ second_margin_bottom__">@lang('Important Links')</h3>
                    <ul class="footer_list__ list-unstyled">
                        <li><a href="{{ url('/') }}">@lang('Home')</a></li>
                        {{-- <li><a href="{{ route('questions.index') }}">@lang('Questions')</a></li> --}}
                        <li><a href="{{ route('contactus') }}">@lang('Contact us') </a></li>
                        {{-- <li><a href="{{ route('jobs.index') }}">@lang('Jobs')</a></li> --}}
                        @foreach (footer_pages() as $row)
                            <li><a href="{{ $row->link }}">{{ $row->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-3 col_start__">
                    <div class="footer_info_wrapper">
                        <h3 class="footer_head__">@lang('Institution')</h3>
                        <h5 class="footer_info__">{{ app_setting('title') }}</h5>
                    </div>
                    <div class="footer_info_wrapper">
                        <h3 class="footer_head__">@lang('Commercial register')</h3>
                        <h5 class="footer_info__">{{ app_setting('commercial_id') }}</h5>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 col_start__">
                    <div class="footer_info_wrapper">
                        <h3 class="footer_head__">@lang('Tax number')</h3>
                        <h5 class="footer_info__">{{ app_setting('tax') }}</h5>
                    </div>
                    <div class="footer_info_wrapper">
                        <h3 class="footer_head__">@lang('Account number')</h3>
                        <h5 class="footer_info__">{{ app_setting('account_id') }}</h5>
                    </div>
                </div>
                <div class="col-lg-2 col_start__">
                    <h3 class="footer_head__">@lang('Follow us through')</h3>
                    <ul class="footer_socials__ list-unstyled">
                        @foreach (socials() as $row)
                            <li class="li__">
                                <a href="{{ $row->value }}" target="__blank" class="link__ twiter_link">
                                    <img class="img-om" src="./assets/images/socials/{{ $row->key }}.svg"
                                        alt="{{ $row->key }}" width="" height="" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="contacts_wrapper__">
                <a href="tel:920011852" class="footer_contact_block__">
                    <figure class="figure__ icon__ loading-omd">
                        <img class="lazy-omd img-om"
                            data-src="{{ url('assets/web') }}/images/shapes/footer_icons/call.svg"
                            alt="{{ app_setting('title') }}" />
                    </figure>

                    <div class="description_wrapper__">
                        <h5 class="title__">@lang('Message us via mobile')</h5>
                        <h6 class="sub_title__">
                            <a href="tel:{{ app_setting('mobile') }}">{{ app_setting('mobile') }}</a>
                        </h6>
                    </div>
                </a>
                <a href="#" class="footer_contact_block__">
                    <figure class="figure__ icon__ loading-omd">
                        <img class="lazy-omd img-om"
                            data-src="{{ url('assets/web') }}/images/shapes/footer_icons/whasapp.svg"
                            alt="{{ app_setting('title') }}" />
                    </figure>

                    <div class="description_wrapper__">
                        <h5 class="title__">@lang('Message us via whatsApp')</h5>
                        <h6 class="sub_title__">
                            <a href="https://wa.me/{{ app_setting('whatsapp') }}">{{ app_setting('whatsapp') }}</a>
                        </h6>
                    </div>
                </a>
                <a href="mailto:Gm@gymfood.com.sa" class="footer_contact_block__">
                    <figure class="figure__ icon__ loading-omd">
                        <img class="lazy-omd img-om"
                            data-src="{{ url('assets/web') }}/images/shapes/footer_icons/mail.svg"
                            alt="{{ app_setting('title') }}" />
                    </figure>

                    <div class="description_wrapper__">
                        <h5 class="title__">@lang('Message us via email')</h5>
                        <h6 class="sub_title__">{{ app_setting('email') }}</h6>
                    </div>
                </a>
            </div>

            <h4 class="copyrights_content___">
                <img class="copyright_icon__" src="{{ url('assets/web') }}/images/shapes/copyright.png"
                    alt="{{ app_setting('title') }}">
                @lang('All rights reserved') - جيم فود
            </h4>
        </div>
    </footer>

    <!-- End Footer -->

    <!-- start js include  -->
    <script src="{{ url('assets/web') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ url('assets/web') }}/js/jquery-ui.min.js"></script>
    <script src="{{ url('assets/web') }}/js/jquery.datepick-ar.js"></script>
    <script src="{{ url('assets/web') }}/js/jquery.fancybox.min.js"></script>
    <script src="{{ url('assets/web') }}/js/popper.min.js"></script>
    <script src="{{ url('assets/web') }}/js/swiper.min.js"></script>
    <script src="{{ url('assets/web') }}/js/bootstrap-select.min.js"></script>
    <script src="{{ url('assets/web') }}/js/bootstrap.min.js"></script>
    <!-- <script src="{{ url('assets/web') }}/js/chart.js"></script> -->
    <!-- <script src="{{ url('assets/web') }}/js/chart.min.js"></script> -->
    <script src="{{ url('assets/web') }}/js/dynamic-calendar.js"></script>
    <script src="{{ url('assets/web') }}/js/mixitup.min.js"></script>
    <script src="{{ url('assets/web') }}/js/plugin.js"></script>
</body>

</html>

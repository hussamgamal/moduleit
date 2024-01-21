<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @yield('metaTags')

    <title>{{ app_setting('title') }}
        @hasSection('title')
            | @yield('title')
        @endif
    </title>

    <link rel="icon" href="{{ app_setting('favicon') }}" type="image/png">

    <link rel="stylesheet" href="{{ url('assets/web') }}/css/all.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/animate.min.css" />
    <!-- ############ include only in Arabic pages ############  -->
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/bootstrap-rtl.min.css" />
    <!-- #######################################################  -->
    <!-- ########### include only in English pages ############  -->
    <!-- <link rel="stylesheet" href="{{ url('assets/web') }}/css/bootstrap.min.css"> -->
    <!-- #######################################################  -->
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/swiper.min.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/aos.css" />
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/style.css" />
</head>

<body>
    <!-- Start Side Links Section -->
    <section class="side_links_section">
        <ul class="links_wrapper__">
            @foreach (contacts() as $row)
                <li>
                    <a href="{{ $row->value }}" target="__blank" class="link__">
                        <img src="{{ url('assets/web') }}/images/socials/{{ $row->key }}.svg" alt="" />
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="arrow_button__">
            <i class="fa-solid fa-chevron-left"></i>
        </div>
    </section>
    <!-- End Side Links Section -->

    <!-- start header  -->

    <header class="main_header__">
        <div class="top_header__">
            <div class="container">
                <div class="lang_wrapper__">
                    <div class="lang__ dropdown__">
                        <a class="lang_link__ butt__" href="#!">
                            <figure class="figure__">
                                <img src="{{ url('assets/web') }}/images/shapes/global.svg" alt="" />
                            </figure>
                            {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                        </a>
                        <ul class="sub-menu__">
                            <li><a href="{{ route('change_locale') }}">العربية</a></li>
                            <li><a href="{{ route('change_locale') }}">English</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed_header__">
            <div class="container">
                <div class="header_content__">
                    <a class="header_logo__" href="{{ url('/') }}">
                        <figure class="figure__">
                            <img src="{{ url('assets/web') }}/images/logo.png" alt=".." />
                        </figure>
                    </a>

                    <nav class="nav-om" id="navbar-menu-om">
                        <button class="close-button__"></button>

                        <figure class="figure__ nav_logo__">
                            <img src="{{ url('assets/web') }}/images/logo.png" alt=".." />
                        </figure>

                        <ul class="nav-list-om list-unstyled">
                            <li>
                                <a href="{{ url('/') }}">@lang('Home')</a>
                            </li>
                            <li class="mega_menu__">
                                <a class="" href="{{ route('pages.show', 'about') }}">@lang('About us')</a>
                            </li>
                            <li>
                                <a href="{{ route('services.index') }}">@lang('Services')</a>
                            </li>
                            <li>
                                <a href="{{ route('teams.index') }}">@lang('Our Team')</a>
                            </li>
                            <li>
                                <a href="{{ route('services.healthy') }}">خدمات الرعاية الصحية</a>
                            </li>
                            <li>
                                <a href="{{ route('contactus') }}">@lang('Contact us')</a>
                            </li>
                            <li>
                                <a href="{{ route('jobs.index') }}">@lang('Jobs')</a>
                            </li>
                        </ul>

                        <ul class="toolbar_options__ list-unstyled">
                            <li class="block__ sing_up_blocks_list_item__">
                                <a class="link__ header_booking_link__" href="{{ route('contactus') }}">
                                    @lang('Book Now')
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

    <!-- Start Footer -->

    <footer class="footer_sec__">
        <div class="container">
            <div class="footer_content__">
                <div class="footer_block__">
                    <a class="footer_logo__" href="{{ url('/') }}">
                        <figure class="figure__">
                            <img src="{{ url('assets/web') }}/images/footer_logo.svg" alt=".." />
                        </figure>
                    </a>
                    <p class="footer_parag__">
                        @lang('A medical center for physical therapy and cupping with 10 years of experience and more than 100 doctors')
                    </p>
                </div>

                <div class="footer_block__">
                    <h4 class="footer_block_head__">@lang('Location')</h4>
                    <p class="footer_location_parag__">
                        <img class="icon__"
                            src="{{ url('assets/web') }}/images/shapes/customers_opinions_location_icon__.svg"
                            alt="..." />
                        <span class="parag_content__">
                            {{ app_setting('location') }}
                        </span>
                    </p>
                </div>

                <div class="fotter_links_block__ footer_block__">
                    <h4 class="footer_block_head__">@lang('Fast links')</h4>
                    <ul class="footer_list__ list-unstyled">
                        <li><a href="{{ url('/') }}">@lang('Home')</a></li>
                        <li>
                            <a href="{{ route('contactus') }}">@lang('Contact us') </a>
                        </li>
                        <li><a href="{{ route('services.index') }}">@lang('Services') </a></li>
                        <li><a href="{{ route('contactus') }}">@lang('Book Now')</a></li>
                    </ul>
                </div>

                <div class="footer_block__">
                    <h4 class="news_mail_title__">
                        @lang('Subscribe to our newsletter')
                    </h4>
                    <form action="{{ route('subscribe') }}">
                        <div class="news_mail_input__wrapper__">
                            <input required name="email" type="email" class="input__ none_border__"
                                placeholder="@lang('Enter Email')">
                            <button class="submit-button__">@lang('subscribe')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer_banks_icons_wrapper__">
            @foreach (payment_methods() as $row)
                <figure class="figure__ icon__">
                    <img src="{{ $row->image }}" alt="{{ $row->name }}" class="img-om">
                </figure>
            @endforeach
        </div>
    </footer>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body" style="text-align: center">
                    <p>{{ session('success') }}</p>
                </div>
            </div>

        </div>
    </div>


    <!-- End Footer -->

    <!-- start js include  -->
    <script src="{{ url('assets/web') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ url('assets/web') }}/js/jquery-ui.min.js"></script>
    <script src="{{ url('assets/web') }}/js/jquery.datepick-ar.js"></script>
    <script src="{{ url('assets/web') }}/js/jquery.fancybox.min.js"></script>
    <script src="{{ url('assets/web') }}/js/popper.min.js"></script>
    <script src="{{ url('assets/web') }}/js/swiper.min.js"></script>
    <script src="{{ url('assets/web') }}/js/swiper_props.js"></script>
    <script src="{{ url('assets/web') }}/js/bootstrap-select.min.js"></script>
    <script src="{{ url('assets/web') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('assets/web') }}/js/mixitup.min.js"></script>
    <script src="{{ url('assets/web') }}/js/aos.js"></script>
    <script src="{{ url('assets/web') }}/js/repeater.js"></script>
    <script src="{{ url('assets/web') }}/js/plugin.js"></script>
    <script>
        $(document).ready(function() {
            var link = "{{ request()->url() }}";
            $(".nav-list-om a[href='" + link + "']").closest('li').addClass('active');
        });
    </script>

    @if (session('success'))
        <script>
            $("#myModal").modal('show')
        </script>
    @endif
</body>

</html>

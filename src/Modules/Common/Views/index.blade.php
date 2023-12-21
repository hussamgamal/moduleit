<!DOCTYPE html>
<html>

<head>
    <title>{{ app_setting('title') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ url('assets/web') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/web') }}/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/web') }}/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/web') }}/css/hover.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/web') }}/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/web') }}/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/web') }}/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/web') }}/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/web') }}/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="{{ app_setting('favicon') }}" type="image/png">
    <!--
        <link href="{{ url('assets/web') }}/css/style-en.css" rel="stylesheet" type="text/css"/>
        -->
    <link href="{{ url('assets/web') }}/css/media.css" rel="stylesheet" type="text/css" />
    <!--
        <link href="{{ url('assets/web') }}/css/media-en.css" rel="stylesheet" type="text/css"/>
        -->
</head>

<body>
    <header>
        <!-- start of header -->
        <div class="{{ Route::currentRouteName() == 'home' ? 'top-header' : 'inline-header' }}">
            <div class="bg">
                @if (Route::currentRouteName() != 'login')
                    @include('Common::web.navbar')
                    <!-- end of navbar -->
                @endif
                @if (!in_array(Route::currentRouteName(), ['home', 'login']))
                    <!-- start of breadcramp -->
                    <div class="page-breadcramp">
                        <div class="container">
                            <div class="parent">
                                <div class="page-name">
                                    <h2>
                                        {{ $title ?? '' }}
                                    </h2>
                                </div>
                                <div class="pages">
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item">
                                            <a href="{{ url('/') }}">
                                                <i class="fa fa-home"></i>
                                                @lang('Home')
                                            </a>
                                        </li>
                                        <span>/</span>
                                        <li class="list-group-item">
                                            <a href="#">
                                                {{ $title ?? '' }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- start of breadcramp -->
                @endif
                @if (Route::currentRouteName() == 'home')
                    @include('Common::web.home.slider')
                @endif
                <!-- end of filtering -->

            </div>
        </div>
    </header>
    <!-- end of header -->

    @yield('page')


    <!-- start of footer -->



    <footer>
        <div class="footer">
            <div class="container">
                <div class="top">
                    <div class="parent">
                        <div class="child1">
                            <a href="#">
                                <img src="{{ app_setting('logo') }}">
                            </a>
                        </div>
                        <div class="child2">
                            <ul class="list-group list-group-horizontal">
                                <li class="list-group-item">
                                    <a href="{{ url('/') }}" class="active">@lang('Home')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('pages.show', 'about') }}">@lang('Aboutus')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('services.index') }}">@lang('Our Services')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('projects.index') }}">@lang('Our Projects')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('aqars.index') }}">@lang('Our Real Estates')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('aqars.marketing') }}">@lang('Real estate marketing')</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('contactus' , ['type' => 'manage_request']) }}">@lang('Manage request')</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="bottom-footer">

                    <div class="parent">
                        <div class="right">
                            <p>
                                @lang('All rights reserved for the site')
                                <a href="#">ABC Real Estate Co</a>
                            </p>
                        </div>
                        <div class="social-media">
                            <ul class="list-group list-group-horizontal">
                                @foreach (socials() as $row)
                                    <li class="list-group-item">
                                        <a href="{{ $row->value }}">
                                            <i class="fa fa-{{ $row->key }}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert_success" style="display: none">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert_success" style="border-left: solid 10px red;" style="display: none">
                {{ session('error') }}
            </div>
        @endif

    </footer>
    <!-- end of footer -->
    <script src="{{ url('assets/web') }}/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="{{ url('assets/web') }}/js/popper.min.js" type="text/javascript"></script>
    <script src="{{ url('assets/web') }}/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ url('assets/web') }}/js/owl.carousel.min.js" type="text/javascript"></script>
    <script src="{{ url('assets/web') }}/js/select2.js" type="text/javascript"></script>
    <script src="{{ url('assets/web') }}/js/wow.min.js" type="text/javascript"></script>
    <script src="{{ url('assets/web') }}/js/main.js" type="text/javascript"></script>
    <script>
        new WOW().init();
    </script>
    <script>
        $(".alert_success , .alert_error").slideDown();
        setTimeout(() => {
            $(".alert_success , .alert_error").fadeOut();
        }, 3000);

        $("form").submit(function() {
            if (check_required($(this))) {
                return true;
            }
            return false;
        });

        function check_required(form) {
            $('.requiredInp').removeClass('requiredInp');
            var inputs = form.find("[required]");
            var val = 0;
            inputs.each(function(key) {
                var tab = 0;
                if ($(this).val() == '') {
                    val = tab = 1;
                    $(this).addClass('requiredInp');
                } else if ($(this).attr('type') == 'checkbox' && inputs[key].checked == false) {
                    val = tab = 1;
                    $(this).parent().find('.checkmark').addClass('requiredInp');
                }
                if (tab == 1) {
                    var tab = $(this).closest('.tab-pane').attr('id');
                    if (tab) {
                        $("a[href='#" + tab + "']").addClass('requiredInp');
                    }
                }
            });
            if (val == 1) {
                if (!$('.contactsDiv').length) {
                    window.scrollTo({
                        top: $('.requiredInp:visible:first').offset().top - 10,
                        behavior: 'smooth',
                    });
                    return false;
                }
            }
            return true;
        }

        $(document).ready(function() {
            var current_el = $(".nav-item a[href='{{ url()->full() }}']");
            if (current_el.length) {
                $('.navbar-collapse .nav-item').removeClass('active');
                current_el.closest('.nav-item').addClass('active');
            }
        });
    </script>
</body>

</html>

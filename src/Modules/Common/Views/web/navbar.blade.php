<!-- start of navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class='container'>
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src='{{ app_setting('logo') }}'>
        </a>
        <div class="my-2 my-lg-0 mobile-login">
            <ul class="list-group list-group-horizontal area">
                @if (!auth()->check())
                    <li class="list-group-item">
                        <a href="{{ url('login') }}">
                            <img src="{{ url('assets/web') }}/images/login.png">
                        </a>
                    </li>
                @endif
                <li class="nav-item dropdown list-group-item">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ url('assets/web') }}/images/usa.png">
                        &nbsp;
                        EN
                        &nbsp; &nbsp;
                        <i class="fa fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('change_locale') }}">English</a>

                    </div>
                </li>


            </ul>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" id="nav-men"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>



        <div class="collapse navbar-collapse s-nav tran" id="s-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">@lang('Home')
                        {{-- <span class="sr-only">(current)</span> --}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pages.show', 'about') }}">@lang('Aboutus')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services.index') }}">@lang('Our Services')</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('projects.index') }}">@lang('Our Projects')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('aqars.index') }}">@lang('Our Real Estates')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('aqars.marketing') }}">
                        @lang('Real estate marketing')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contactus', ['type' => 'manage_request']) }}">
                        @lang('Manage request')
                    </a>
                </li>

            </ul>
            <div class="men-cl">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
            <div class="my-2 my-lg-0 front">
                <ul class="list-group list-group-horizontal area">

                    <li class="list-group-item">
                        @if (!auth()->check())
                            <a href="{{ url('login') }}">
                                <img src="{{ url('assets/web') }}/images/login.png">
                                @lang('Login')
                            </a>
                        @else
                            <a href="{{ url('logout') }}">
                                <img src="{{ url('assets/web') }}/images/login.png">
                                @lang('Logout')
                            </a>
                        @endif
                    </li>
                    <li class="nav-item dropdown list-group-item">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ url('assets/web') }}/images/usa.png">
                            &nbsp;
                            {{ app()->getLocale() == 'ar' ? 'ع' : 'EN' }}
                            &nbsp; &nbsp;
                            <i class="fa fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                                href="{{ route('change_locale') }}">{{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}</a>

                        </div>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</nav>

<header class="main_header__">
    <div class="top_header__">
        <img class="icon__" src="{{ url('assets/web') }}/images/shapes/header_shapes/sudia.svg"
            alt="{{ app_setting('logo') }}" />

        @lang('Delivery to any where in sudia')
    </div>
    <div class="fixed_header__">
        <div class="container">
            <div class="header_content__">
                <a class="header_logo__" href="{{ url('/') }}">
                    <figure class="figure__">
                        <img src="{{ url('assets/web') }}/images/logo.svg" alt="{{ app_setting('logo') }}" />
                    </figure>
                </a>

                <nav class="nav-om" id="navbar-menu-om">
                    <button class="close-button__"></button>

                    <figure class="figure__ nav_logo__">
                        <img src="{{ url('assets/web') }}/images/logo.svg" alt="{{ app_setting('logo') }}" />
                    </figure>

                    <ul class="nav-list-om small_size_only__ list-unstyled">
                        <li class="header_list_item__">
                            <a href="{{ url('/') }}">@lang('Home')</a>
                        </li>
                        @foreach (categories() as $row)
                            <li class="header_list_item__">
                                <a href="{{ $row->link }}">{{ $row->name }}</a>
                            </li>
                        @endforeach

                        <li class="header_list_item__" id="maintenance">
                            <a href="{{ route('agents.index', 'maintenance') }}">@lang('Maintenance')</a>
                        </li>
                        <li class="header_list_item__" id="distributors">
                            <a href="{{ route('agents.index', 'distributor') }}">@lang('Distributors')</a>
                        </li>
                        <li class="header_list_item__" id="aboutUs">
                            <a href="{{ route('pages.show', 'about') }}">@lang('About us')</a>
                        </li>
                    </ul>

                    <ul class="toolbar_options__ list-unstyled">
                        @auth
                            <li class="block__ dropdown__ info_link_item__">
                                <a class="info_link_block__" href="#!">
                                    @lang('Welcome')
                                    <span class="user_name__">{{ auth()->user()->name }}</span>
                                </a>
                                <ul class="sub-menu__">
                                    <li>
                                        <a class="my_requests" href="{{ route('orders.index') }}"> @lang('My Requests') </a>
                                    </li>
                                    <li>
                                        <a class="saved_addesess" href="{{ route('addresses.index') }}">
                                            @lang('Addresses')
                                        </a>
                                    </li>
                                    <li>
                                        <a class="profile"
                                            href="{{ route('users.show', 'profile') }}">@lang('Profile')</a>
                                    </li>
                                    <li>
                                        <button class="signout_link__ list_content__" data-toggle="modal"
                                            data-target="#sign_out_modal">
                                            @lang('Logout')
                                        </button>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="block__ sing_up_blocks_list_item__">
                                <div class="sing-up-blocks">
                                    <a class="singup_link" href="{{ route('register') }}">
                                        @lang('Create new account')
                                    </a>
                                    <a class="singup_link login_link" href="{{ route('login') }}">@lang('Login')</a>
                                </div>
                            </li>
                        @endauth

                        <li class="block__ header_cart_link__">
                            <a href="{{ url('cart') }}" class="link__ cart_link__">
                                <img class="icon__" src="{{ url('assets/web') }}/images/shapes/shopping_cart.svg"
                                    alt="{{ app_setting('logo') }}">
                                {{-- <span class="cart-cout cart-cout-total">{{ cart_count() }}</span> --}}
                            </a>
                        </li>

                        <li class="block__ lang__ dropdown__ small_size_only__">
                            <a class="lang_link__ butt__" href="#!">
                                <figure class="figure__">
                                    <img class="icon__"
                                        src="{{ url('assets/web') }}/images/shapes/header_lang_icon.svg"
                                        alt="{{ app_setting('logo') }}" />
                                </figure>
                                {{ app()->getLocale() == 'ar' ? 'English' : 'العربية (ar)' }}
                            </a>
                            <ul class="sub-menu__">
                                <li><a
                                        href="{{ app()->getLocale() == 'en' ? route('change_locale') : '#!' }}">العربية</a>
                                </li>
                                <li><a
                                        href="{{ app()->getLocale() == 'ar' ? route('change_locale') : '#!' }}">English</a>
                                </li>
                            </ul>
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
        <div class="bootom_header__">
            <div class="container">
                <div class="bootom_header_content__">
                    <nav class="nav-om" id="navbar-menu-om">
                        <ul class="nav-list-om list-unstyled">
                            <li class="header_list_item__">
                                <a href="{{ url('/') }}">@lang('Spare parts')</a>
                            </li>
                            @foreach (\Modules\Categories\Models\Category::where('nav', 1)->get() as $row)
                                <li class="header_list_item__">
                                    <a href="{{ $row->link }}">{{ $row->name }}</a>
                                </li>
                            @endforeach

                            <li class="header_list_item__" id="maintenance">
                                <a href="{{ route('agents.index', 'maintenance') }}">@lang('Maintenance')</a>
                            </li>
                            <li class="header_list_item__" id="distributors">
                                <a href="{{ route('agents.index', 'distributor') }}">@lang('Distributors')</a>
                            </li>
                            <li class="header_list_item__" id="aboutUs">
                                <a href="{{ route('pages.show', 'about') }}">@lang('About us')</a>
                            </li>
                        </ul>

                        <ul class="toolbar_options__ list-unstyled">
                            <li class="block__">
                                <div class="lang__ dropdown__">
                                    <a class="lang_link__ butt__" href="#!">
                                        <figure class="figure__">
                                            <img class="icon__"
                                                src="{{ url('assets/web') }}/images/shapes/header_lang_icon.svg"
                                                alt="{{ app_setting('logo') }}" />
                                        </figure>
                                        {{ app()->getLocale() == 'ar' ? 'English' : 'العربية (ar)' }}
                                    </a>
                                    <ul class="sub-menu__">
                                        <li><a
                                                href="{{ app()->getLocale() == 'en' ? route('change_locale') : '#!' }}">العربية</a>
                                        </li>
                                        <li><a
                                                href="{{ app()->getLocale() == 'ar' ? route('change_locale') : '#!' }}">English</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto-navbav">
        <!-- Messages Dropdown Menu -->
         <li class="nav-item">
            <a class="nav-link locale_nav" title="{{ app()->getLocale() == 'ar' ? 'English' : "العربية" }}"
                href="{{ route('change_locale') }}">
                @if(app()->getLocale() == 'en')
                <img src="{{ url('locale/ar.png') }}" alt="العربية">
                @else
                <img src="{{ url('locale/en.png') }}" alt="English">
                @endif
            </a>
        </li>
        @if(auth('admin')->check())
            @php
            $roles = auth('admin')->user()->role->roles ?? [];
            @endphp
            @if(in_array('Common' , $roles))
            <li class="nav-item dropdown">
                @php
                $messages = \Modules\Contactus\Models\Contactus::unseen()->latest()->take(7);
                @endphp
                <a class="nav-link dropdowntoggle" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    @if($messages->count())
                    <span class="badge badge-danger navbar-badge">{{ $messages->count() }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a class="dropdown-item dropdown-footer">
                        @lang('Contactus messages')
                    </a>
                    <div class="dropdown-divider"></div>
                    @forelse($messages->get() as $message)
                    <a href="{{ route('admin.contactus.show' , $message->id) }}" class="dropdown-item mlink">
                        <!-- Message Start -->
                        <div class="media">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    {{ $message->name }}
                                </h3>
                                <p class="text-sm">{{ mb_substr($message->message , 0 , 50) }} ....</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ $message->created_at }}
                                </p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    @empty
                    <p class="empty">@lang('No messages to be read')</p>
                    @endforelse
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.contactus.index') }}" class="dropdown-item dropdown-footer mlink">
                        @lang('Show all')
                    </a>
                </div>
            </li>
            @endif
        @endif
        <li class="nav-item dropdown">
            @php
                $notifications = auth('admin')->user()->unreadnotifications()->latest();
            @endphp
            <a class="nav-link dropdowntoggle notifications" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                @if($notifications->count())
                    <span class="badge badge-danger navbar-badge">{{ $notifications->count() }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a class="dropdown-item dropdown-footer">
                    @lang('Notification messages')
                </a>
                @forelse($notifications->get() as $notify)
                    <!-- Message Start -->
                        <div class="dropdown-divider"></div>
                    <a href="{{ @$notify->data['link'] }}" class="dropdown-item mlink">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    {{ $notify->data['title'][app()->getLocale()] }}
                                </h3>
                                <p class="text-sm">{{ $notify->data['message'][app()->getLocale()] }}</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ $notify->created_at->diffforhumans() }}
                                </p>
                            </div>
                        </div>
                    </a>
                    <!-- Message End -->
                @empty
                    <p class="empty">@lang('No notifications to be read')</p>
                @endforelse
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.notifications.page') }}" class="dropdown-item dropdown-footer mlink">
                    @lang('Show all')
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a title="@lang('Logout')" class="nav-link logout" href="{{ route('admin.logout') }}">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

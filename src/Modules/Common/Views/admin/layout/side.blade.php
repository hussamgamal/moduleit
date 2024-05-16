<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link mlink">
        <span class="brand-text font-weight-light">{{ app_setting('title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link mlink">
                        <i class="fa fa-home"></i>
                        <p>@lang('Homepage')</p>
                    </a>
                </li>
                @foreach (sidebar() as $title => $group)
                    <li class="nav-header">@lang($title)</li>
                    @foreach ($group as $links)
                        @if (is_object($links))
                            <?php $link = $links ?>
                            @include('Common::admin.layout.side_link')
                        @else
                            @foreach ($links as $link)
                                @include('Common::admin.layout.side_link')
                            @endforeach
                        @endif
                    @endforeach
                @endforeach

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

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
                @foreach (sidebar() as $role => $group)
                    @if (isset($group['link']))
                        <li class="nav-item">
                            <a href="{{ route('admin.' . $group['link']) }}" class="nav-link mlink">
                                <i class="{{ $group['icon'] }}"></i>
                                <p>{{ $group['title'] }}</p>
                            </a>
                        </li>
                    @else
                        <li class="nav-header">{{ $group['title'] }}</li>
                        @foreach ($group['links'] as $row)
                            <li class="nav-item has-treeview">
                                @if (isset($row['query']))
                                    <a href="{{ route('admin.' . $row['link'], $row['query']) }}" class="nav-link mlink">
                                    @else
                                        <a href="{{ $row['link'] != '#' ? route('admin.' . $row['link']) : '#' }}"
                                            class="nav-link {{ $row['link'] != '#' ? 'mlink' : '' }}">
                                @endif
                                <i class="nav-icon {{ $row['icon'] ?? '' }}"></i>
                                <p>
                                    {{ $row['title'] }}
                                    @if (isset($row['childs']))
                                        <i class="fas fa-angle-left right"></i>
                                    @endif
                                    @if (isset($row['count']))
                                        <span class="badge badge-info right">{{ $row['count'] }}</span>
                                    @endif
                                </p>
                                </a>
                                @if (isset($row['childs']))
                                    <ul class="nav nav-treeview">
                                        @foreach ($row['childs'] as $child)
                                            <li class="nav-item">
                                                <a href="{{ isset($child['query']) ? route('admin.' . $child['link'], $child['query']) : route('admin.' . $child['link']) }}"
                                                    class="nav-link mlink">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>{{ $child['title'] }}</p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

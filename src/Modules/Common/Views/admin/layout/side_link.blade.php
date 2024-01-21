<li class="nav-item has-treeview">
    @if (isset($link->query))
        <a href="{{ route('admin.' . $link->link, (array) $link->query) }}" class="nav-link mlink">
        @else
            <a href="{{ $link->link != '#' ? route('admin.' . $link->link) : '#' }}"
                class="nav-link {{ $link->link != '#' ? 'mlink' : '' }}">
    @endif
    <i class="nav-icon {{ $link->icon ?? '' }}"></i>
    <p>
        @lang($link->title)
        @if (isset($link->childs))
            <i class="fas fa-angle-left right"></i>
        @endif
        @if (isset($link->count))
            <span class="badge badge-info right">{{ $link->count }}</span>
        @endif
    </p>
    </a>
    @if (isset($link->childs))
        <ul class="nav nav-treeview">
            @foreach ($link->childs as $child)
                <li class="nav-item">
                    <a href="{{ isset($child->query) ? route('admin.' . $child->link, (array) $child->query) : route('admin.' . $child->link) }}"
                        class="nav-link mlink">
                        <i class="far fa-circle nav-icon"></i>
                        <p>@lang($child->title)</p>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>

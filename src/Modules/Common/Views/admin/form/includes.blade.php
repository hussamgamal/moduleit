@if (isset($includes) && count($includes))
    @foreach ($includes as $inc)
        @if (!str_contains($inc, 'script'))
            <div class="card includes">
                <div class="card-body">
                    @include($inc)
                </div>
            </div>
        @else
            @include($inc)
        @endif
    @endforeach
@endif

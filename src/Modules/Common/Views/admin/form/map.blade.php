@if (isset($has_map))
    <div class="card">
        <div class="card-body">
            @include('Common::components.map')
        </div>
    </div>
@endif
@if (isset($has_geoMap))
    <div class="card">
        <div class="card-body">
            @include('Common::components.mapGeo')
        </div>
    </div>
@endif

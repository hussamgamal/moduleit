<!-- map button -->
<div class="col-xs-12">
    <div class="flexSection">
        <!-- input -->
        <div class="inputSection postInput-section mapbox">
            <p class="inputHeader">
                {{ __('Location on map') }}
            </p>
            <div class="row">
                <div class="col-sm-6">
                    <input type="hidden" class="form-control map-lat"
                        value="{{ $model->location->lat ?? ($model->location['lat'] ?? '') }}" placeholder="latitude"
                        class="map-lat" name="{{ $latName ?? 'location[lat]' }}">
                </div>
                <div class="col-sm-6">
                    <input type="hidden" class="form-control map-lng"
                        value="{{ $model->location->lng ?? ($model->location['lng'] ?? '') }}" placeholder="longitude"
                        class="map-lng" name="{{ $lngName ?? 'location[lng]' }}">
                </div>
            </div>
            <input name="{{ $textName ?? 'location[text]' }}"
                value="{{ $model->location->text ?? ($model->location['text'] ?? '') }}"
                class="form-control input__ map-location" id="mapAddress" placeholder="{{ __('Enter your location') }}">
            <input type="hidden" class="locationBtn">
            <div class="map" style="height:300px;display:none;overflow:hidden;margin-top:10px"></div>
        </div>
    </div>
</div>
<!-- map -->

<script>
    // var map = document.getElementById('map');

    function initMap(mapDiv) {
        var mapBox = $(mapDiv).closest('.mapbox');
        var geocoder = new google.maps.Geocoder;
        var infoWindow = new google.maps.InfoWindow;
        // Set the Map
        var itemlat = parseFloat("{{ $model->location->lat ?? ($model->location['lat'] ?? '24.69023') }}");
        var itemlng = parseFloat("{{ $model->location->lng ?? ($model->location['lng'] ?? '46.685') }}");
        // $('.map').each(function(i , mapDiv){
        //     console.log($(mapDiv));
        var mapOptions = {
            center: {
                lat: itemlat,
                lng: itemlng
            },
            zoom: 7
        };
        var map = new google.maps.Map(mapDiv, mapOptions);
        // });

        // Set the Marker
        var marker = new google.maps.Marker({
            position: {
                lat: itemlat,
                lng: itemlng
            },
            map: map,
            icon: "{{ url('assets/placeholders/marker.png') }}",
            draggable: true,
            animation: google.maps.Animation.xo
        });

        // auth complete box
        var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(itemlat, itemlng),
            new google.maps.LatLng(itemlat, itemlng));

        var input = mapBox.find('.map-location');
        var options = {
            bounds: defaultBounds,
            types: ['establishment']
        };

        autocomplete = new google.maps.places.Autocomplete($('#mapAddress'), options);
        autocomplete.addListener('place_changed', fillInlocation);

        function fillInlocation() {
            marker.setPosition(autocomplete.getPlace().geometry.location);
            var lat = autocomplete.getPlace().geometry.location.lat();
            var lng = autocomplete.getPlace().geometry.location.lng();
            mapBox.find('.map-lat').val(lat);
            mapBox.find('.map-lng').val(lng);
            var center = new google.maps.LatLng(lat, lng);
            map.setCenter(center);
        }

        $(document).ready(function() {
            run_map();
        });

        function run_map() {
            // $('.mapbox').append('<a class="select_my_location" class="gpsBtn">@lang('Select my location')</a>');
            $(mapDiv).slideDown(100);

            setLocation(map, geocoder, marker);

            start_location(mapBox, map, marker, geocoder);


            google.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
                setLocation(map, geocoder, marker);
            });

            // Set location manually
            google.maps.event.addListener(marker, 'dragend', function() {
                setLocation(map, geocoder, marker);
            });

            google.maps.event.addListener(marker, 'center_changed', function() {
                setLocation(map, geocoder, marker);
            });
        }

        function setLocation(map, geocoder, marker) {
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            console.log(lat, lng);
            mapBox.find('.map-lat').val(lat);
            mapBox.find('.map-lng').val(lng);
            mapBox.find('.map-location').trigger('change');
            map.setZoom(map.getZoom() + 1);
            geocoder.geocode({
                'latLng': marker.getPosition()
            }, function(results, status) {
                if (results) {
                    mapBox.find('.map-location').val(results[0].formatted_address);
                }
            });
        }
        return mapOptions;
    }
    // initMap($('.map')[0]);
    var geocoder = new google.maps.Geocoder();
    $('.map').each(function(i, mapDiv) {
        var mapOptions = initMap($(mapDiv)[0]);
        var item = $(this).closest('.addresses_filter_item');
        mapOptions.zoom = 12;
        console.log(mapOptions);
        var map = new google.maps.Map($(mapDiv)[0], mapOptions);
        item.find('.area_id').change(function() {
            var address = "السعودية - " + item.find('.city_id').find('option:selected').html() + " - " +
                $(this).find('option:selected').html();
            console.log(address);
            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status === 'OK') {
                    map.setCenter(results[0].geometry.location);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        });
    });
</script>

@if (isset($model->location) && isset($model->location->lat) && isset($model->location->lng))
    <script>
        run_map();
        $(this).removeClass('openMap');

        function start_location(mapBox, map, marker, geocoder) {
            var myPosition = new google.maps.LatLng("{{ $model->location->lat }}", "{{ $model->location->lng }}");
            map.setCenter(myPosition);
            marker.setPosition(myPosition);
            geocoder.geocode({
                'latLng': myPosition
            }, function(results, status) {
                if (results) {
                    console.log(results);
                    mapBox.find('.map-location').val(results[0]['formatted_location']);
                }
            });
        }
    </script>
@else
    <script>
        function start_location(mapBox, map, marker, geocoder) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var myPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    map.setCenter(myPosition);
                    marker.setPosition(myPosition);
                    geocoder.geocode({
                        'latLng': myPosition
                    }, function(results, status) {
                        if (results) {
                            mapBox.find('.map-location').val(results[0]['formatted_location']);
                        }
                    });
                }, function() {
                    // handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                // handleLocationError(false, infoWindow, map.getCenter());
            }
        }
    </script>
@endif

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
                    <input type="hidden" class="form-control"
                        value="{{ $model->location->lat ?? ($model->location['lat'] ?? '') }}" placeholder="latitude"
                        id="map-lat" name="location[lat]">
                </div>
                <div class="col-sm-6">
                    <input type="hidden" class="form-control"
                        value="{{ $model->location->lng ?? ($model->location['lng'] ?? '') }}" placeholder="longitude"
                        id="map-lng" name="location[lng]">
                </div>
            </div>
            <input name="location[text]" value="{{ $model->location->text ?? ($model->location['text'] ?? '') }}"
                class="form-control openMap" id="map-location" placeholder="{{ __('Enter your location') }}">
            <input type="hidden" id="locationBtn">
            <div id="map" style="height:300px;display:none;overflow:hidden"></div>
        </div>
    </div>
</div>
<!-- map -->

<script>
    var mapDiv = document.getElementById('map');
    var geocoder = new google.maps.Geocoder;
    var infoWindow = new google.maps.InfoWindow;
    // Set the Map
    var itemlat = parseFloat("{{ $model->location->lat ?? ($model->location['lat'] ?? '24.69023') }}");
    var itemlng = parseFloat("{{ $model->location->lng ?? ($model->location['lng'] ?? '46.685') }}");
    var map = new google.maps.Map(mapDiv, {
        center: {
            lat: itemlat,
            lng: itemlng
        },
        zoom: 10
    });

    // Set the Marker
    var marker = new google.maps.Marker({
        position: {
            lat: itemlat,
            lng: itemlng
        },
        map: map,
        icon: "{{ url('placeholders/marker.png') }}",
        draggable: true,
        animation: google.maps.Animation.xo
    });

    //auth complete box
    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(itemlat, itemlng),
        new google.maps.LatLng(itemlat, itemlng));

    var input = document.getElementById('map-location');
    var options = {
        bounds: defaultBounds,
        types: ['establishment']
    };

    autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', fillInlocation);

    function fillInlocation() {
        marker.setPosition(autocomplete.getPlace().geometry.location);
        var lat = autocomplete.getPlace().geometry.location.lat();
        var lng = autocomplete.getPlace().geometry.location.lng();
        $('#map-lat').val(lat);
        $('#map-lng').val(lng);
        var center = new google.maps.LatLng(lat, lng);
        map.setCenter(center);
    }

    $(document).ready(function() {
        run_map();
    });

    function run_map() {
        // $('.mapbox').append('<a class="select_my_location" class="gpsBtn">@lang("Select my location")</a>');
        $('#map').slideDown(100);

        setLocation(map, geocoder, marker);

        start_location();


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
        console.log(lat , lng);
        $('#map-lat').val(lat);
        $('#map-lng').val(lng);
        $('#map-location').trigger('change');
        map.setZoom(map.getZoom() + 1);
        geocoder.geocode({
            'latLng': marker.getPosition()
        }, function(results, status) {
            if (results) {
                $('#map-location').val(results[0].formatted_address);
            }
        });
    }
</script>

@if (isset($model->location) && isset($model->location->lat) && isset($model->location->lng))
    <script>
        run_map();
        $(this).removeClass('openMap');

        function start_location() {
            var myPosition = new google.maps.LatLng("{{ $model->location->lat }}", "{{ $model->location->lng }}");
            map.setCenter(myPosition);
            marker.setPosition(myPosition);
            geocoder.geocode({
                'latLng': myPosition
            }, function(results, status) {
                if (results) {
                    $('#map-location').val(results[0]['formatted_location']);
                }
            });
        }
        console.log(itemlng);
    </script>
@else
    <script>
        function start_location() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var myPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    map.setCenter(myPosition);
                    marker.setPosition(myPosition);
                    geocoder.geocode({
                        'latLng': myPosition
                    }, function(results, status) {
                        if (results) {
                            $('#map-location').val(results[0]['formatted_location']);
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

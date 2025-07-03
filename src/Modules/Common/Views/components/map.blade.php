<?php $location = is_array($model->location) ? json_decode(json_encode($model->location)) : $model->location; ?>

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
                    <input type="hidden" class="form-control" value="{{ $location->lat ?? '' }}" placeholder="latitude"
                        id="map-lat" name="{{ $locationName ?? 'location' }}[lat]">
                </div>
                <div class="col-sm-6">
                    <input type="hidden" class="form-control" value="{{ $location->lng ?? '' }}"
                        placeholder="longitude" id="map-lng" name="{{ $locationName ?? 'location' }}[lng]">
                </div>
            </div>
            <input name="{{ $locationName ?? 'location' }}[text]"
                value="{{ $location?->text ? $location?->text ?? ($location['text'] ?? '') : '' }}"
                class="form-control input__ map-location" id="map-location"
                placeholder="{{ __('Enter your location') }}">
            <br>
            <input type="hidden" id="locationBtn">
            <div id="map" style="height:300px;display:none;overflow:hidden"></div>
        </div>
    </div>
</div>
<!-- map -->
<div class="modal fade notInside_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal_block__">
                <h2 class="title rating_title__">
                    <p class="parag_head__">@lang('Warning')</p>
                </h2>
                <p class="parag__">
                    {{ __('This point is not within its scope') }}
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    var mapDiv = document.getElementById('map');
    var geocoder = new google.maps.Geocoder;
    var infoWindow = new google.maps.InfoWindow;
    var polygon;
    // Set the Map
    var itemlat = parseFloat("{{ $location->lat ?? '24.69023' }}");
    var itemlng = parseFloat("{{ $location->lng ?? '46.685' }}");
    var map = new google.maps.Map(mapDiv, {
        center: {
            lat: itemlat,
            lng: itemlng
        },
        zoom: 14,
        streetViewControl: false,
    });

    // Set the Marker
    var marker = new google.maps.Marker({
        position: {
            lat: itemlat,
            lng: itemlng
        },
        map: map,
        icon: "{{ url('assets/marker.svg') }}",
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
    // autocomplete.addListener('center_changed', fillInlocation);
    var controlDiv = false;

    function addYourLocationButton(map, marker) {
        if (controlDiv == false) {
            controlDiv = document.createElement('div');

            firstChild = document.createElement('a');
            firstChild.style.display = 'block';
            firstChild.style.backgroundColor = '#fff';
            firstChild.style.border = 'none';
            firstChild.style.outline = 'none';
            firstChild.style.width = '40px';
            firstChild.style.height = '40px';
            firstChild.style.borderRadius = '2px';
            firstChild.style.boxShadow = '0 1px 4px rgba(0,0,0,0.3)';
            firstChild.style.cursor = 'pointer';
            firstChild.style.marginRight = '10px';
            firstChild.style.marginTop = '-50px';
            firstChild.style.padding = '10px';
            firstChild.title = 'Your Location';
            controlDiv.appendChild(firstChild);

            var secondChild = document.createElement('div');
            secondChild.style.width = '18px';
            secondChild.style.height = '18px';
            secondChild.style.backgroundImage =
                'url(https://maps.gstatic.com/tactile/mylocation/mylocation-sprite-1x.png)';
            secondChild.style.backgroundSize = '180px 18px';
            secondChild.style.backgroundPosition = '0px 0px';
            secondChild.style.backgroundRepeat = 'no-repeat';
            secondChild.id = 'you_location_img';
            firstChild.appendChild(secondChild);
        }

        google.maps.event.addListener(map, 'dragend', function() {
            $('#you_location_img').css('background-position', '0px 0px');
        });

        firstChild.addEventListener('click', function() {
            var imgX = '0';
            var animationInterval = setInterval(function() {
                if (imgX == '-18') imgX = '0';
                else imgX = '-18';
                $('#you_location_img').css('background-position', imgX + 'px 0px');
            }, 500);
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords
                        .longitude);
                    marker.setPosition(latlng);
                    map.setCenter(latlng);
                    clearInterval(animationInterval);
                    $('#you_location_img').css('background-position', '-144px 0px');
                });
            } else {
                clearInterval(animationInterval);
                $('#you_location_img').css('background-position', '0px 0px');
            }
        });

        controlDiv.index = 1;
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(controlDiv);
    }

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


        $('.map-location').bind("paste", function() {
            setTimeout(() => {
                console.log('-----------------', $(this).val());
                geoCodeAddress($(this).val());
            }, 500);
        });
        // $('.map-location').keyup(function() {
        //     geoCodeAddress($(this).val());
        // });

        function geoCodeAddress(address = null) {
            console.log('11111111111111111', address);
            if (!address) {
                var address = [
                    "السعودية",
                    $('.city_id,[name="city_id"],[name="governrate_id"]').find(
                        'option:selected').html(),
                    $('.area_id,[name="area_id"]').find('option:selected').html(),
                    // $('.street__,[name="address[street]"]').val(),
                    // $('.block__,[name="address[block]"]').val()
                ]
                address = address.join(" - ");
            } else {
                address = "السعودية - " + address;
            }
            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status === 'OK') {
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    setLocation(map, geocoder, marker);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    });


    function run_map() {
        // $('.mapbox').append('<a class="select_my_location" class="gpsBtn">@lang('Select my location')</a>');
        $('#map').slideDown(100);

        setLocation(map, geocoder, marker);
        addYourLocationButton(map, marker);

        start_location();


        google.maps.event.addListener(map, 'click', function(event) {
            marker.setPosition(event.latLng);
            setLocation(map, geocoder, marker);
        });

        // Set location manually
        google.maps.event.addListener(marker, 'dragend', function(event) {
            setLocation(map, geocoder, marker);
        });

        google.maps.event.addListener(marker, 'center_changed', function(event) {
            setLocation(map, geocoder, marker);
        });
    }

    function setLocation(map, geocoder, marker) {
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();
        $('#map-lat').val(lat);
        $('#map-lng').val(lng);
        $('#map-location').trigger('change');
        geocoder.geocode({
            'latLng': marker.getPosition(),
            'language': 'ar'
        }, function(results, status) {
            if (results) {
                map.setCenter(marker.getPosition());
                setTimeout(() => {
                    $('#map-location').val(results[0].formatted_address);
                }, 100);
            }
        });
    }

</script>

@if (isset($location) && isset($location->lat) && isset($location->lng))
    <script>
        run_map();
        $(this).removeClass('openMap');

        function start_location() {
            var myPosition = new google.maps.LatLng("{{ $location->lat }}", "{{ $location->lng }}");
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

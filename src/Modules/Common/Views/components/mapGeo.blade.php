<!-- map button -->
<div class="col-xs-12">
    <div class="flexSection">
        <!-- input -->
        <div class="inputSection postInput-section mapbox">
            <p class="inputHeader">
                {{ __('Location on map') }}
            </p>
            <input type="hidden" name="p_geometry" value="{{ json_encode($model->p_geometry) }}">
            <div id="map" style="height:300px;overflow:hidden;margin-top:10px"></div>
        </div>
    </div>
</div>
<!-- map -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script>
    $(document).ready(function() {
        const map = mapInstance();

        drawingManagerInstance(map);
    });

    function mapInstance() {
        var geocoder = new google.maps.Geocoder();

        var map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 24.811561441806496,
                lng: 46.7769763654552
            },
            zoom: 9,
        });

        geocoder.geocode({
            'address': "السعودية - {{ (\Modules\Areas\Models\Area::find(request('area_id')))?->name }}- {{ is_object($model?->name) ? $model?->name : '' }}"
        }, function(results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });

        return map;
    }




    function drawingManagerInstance(map) {
        const drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYLINE,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [
                    // google.maps.drawing.OverlayType.MARKER,
                    // google.maps.drawing.OverlayType.CIRCLE,
                    // google.maps.drawing.OverlayType.POLYGON,
                    google.maps.drawing.OverlayType.POLYLINE,
                    // google.maps.drawing.OverlayType.RECTANGLE,
                ],
            },
        });

        google.maps.event.addListener(drawingManager, 'polylinecomplete', function(polygon) {
            const coords = polygon.getPath().getArray().map(coord => {
                return {
                    lat: coord.lat(),
                    lng: coord.lng()
                }
            });
            $("[name='p_geometry']").val(JSON.stringify(coords));

            // SAVE COORDINATES HERE
        });
        drawingManager.setMap(map);
    }

    function drawPolygon(map, cordinates = null) {
        const polygonCoordinates = cordinates;
        const polygon = new google.maps.Polygon({
            path: polygonCoordinates,
            geodesic: true,
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
        });

        polygon.setMap(map);

        return polygon;
    }

    function detectPoint(polygon, lat, lng) {
        var point = new google.maps.LatLng(lat, lng);

        // Check if the point is inside the polygon
        var isInside = google.maps.geometry.poly.containsLocation(point, polygon);

        // Display the result
        var resultText = isInside ? 'Inside' : 'Outside';
        alert('Point is ' + resultText + ' the polygon.');
    }
</script>
@if ($model->p_geometry)
    <script>
        $(document).ready(function() {
            var map = mapInstance();
            drawingManagerInstance(map);
            var coordinates = '<?php echo json_encode($model->p_geometry); ?>';
            let old_coor = JSON.parse(coordinates).coordinates[0];
            let to_coor = old_coor.map(function(point) {
                return new google.maps.LatLng(point[1], point[0]);
            })
            drawPolygon(map, to_coor);
        });
    </script>
@endif

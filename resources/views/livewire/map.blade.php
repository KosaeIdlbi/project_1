<div>
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="ابحث عن عنوان..." wire:ignore>
    </div>

    <div id="map" style="height: 400px; width: 100%;" wire:ignore></div>

    <div class="mt-3 p-3 border rounded">
        <h5>الموقع المحدد:</h5>
        <p><strong>العنوان:</strong> <span id="displayAddress">{{ $address }}</span></p>
        <p><strong>الإحداثيات:</strong> <span id="displayCoords">{{ $latitude }}, {{ $longitude }}</span></p>
    </div>

    <!-- حقول النموذج -->
    <input type="hidden" wire:model="latitude" id="latInput">
    <input type="hidden" wire:model="longitude" id="lngInput">
    <input type="hidden" wire:model="address" id="addressInput">

    <script>
        document.addEventListener('livewire:load', function() {
            let map;
            let marker;
            let geocoder;
            let autocomplete;

            // تهيئة الخريطة
            function initMap() {
                const initialPosition = {
                    lat: {{ $latitude }},
                    lng: {{ $longitude }}
                };

                map = new google.maps.Map(document.getElementById('map'), {
                    center: initialPosition,
                    zoom: {{ $zoom }},
                });

                geocoder = new google.maps.Geocoder();

                marker = new google.maps.Marker({
                    position: initialPosition,
                    map: map,
                    draggable: true,
                    animation: google.maps.Animation.DROP
                });

                // تحديث عند تحريك الماركر
                marker.addListener('dragend', function() {
                    updateLocation(marker.getPosition());
                });

                // تحديث عند النقر على الخريطة
                map.addListener('click', function(event) {
                    marker.setPosition(event.latLng);
                    updateLocation(event.latLng);
                });

                // تفعيل البحث التلقائي
                const searchInput = document.getElementById('searchInput');
                autocomplete = new google.maps.places.Autocomplete(searchInput);
                autocomplete.bindTo('bounds', map);

                autocomplete.addListener('place_changed', function() {
                    const place = autocomplete.getPlace();
                    if (!place.geometry) return;

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }

                    marker.setPosition(place.geometry.location);
                    updateLocation(place.geometry.location, place.formatted_address);
                });
            }

            // تحديث الموقع
            function updateLocation(position, customAddress = null) {
                const lat = position.lat();
                const lng = position.lng();

                document.getElementById('displayCoords').textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;

                if (customAddress) {
                    document.getElementById('displayAddress').textContent = customAddress;
                    @this.set('address', customAddress);
                } else {
                    geocoder.geocode({
                        'location': position
                    }, function(results, status) {
                        if (status === 'OK' && results[0]) {
                            const address = results[0].formatted_address;
                            document.getElementById('displayAddress').textContent = address;
                            @this.set('address', address);
                        }
                    });
                }

                @this.set('latitude', lat);
                @this.set('longitude', lng);
                @this.updatedLocation(lat, lng, customAddress);
            }

            // تحميل الخريطة بعد تحميل الـ API
            window.initMap = initMap;
        });
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&libraries=places&callback=initMap" async
        defer></script>
</div>

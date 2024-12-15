@include('Layout.Header')

<section class="nftmax-adashboard nftmax-show">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12 nftmax-main__column">
                <div class="nftmax-body">
                    <div class="nftmax-dsinner">
                        <div class="nftmax mg-top-40">
                            <div class="nftmax">
                                <div class="nftmax-_content">
                                    <form action="{{ route('centres.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Name :</label>
                                            <input type="text" id="nom" name="nom" class="form-control" required value="{{ old('nom') }}">
                                            @error('nom')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="localisation" class="form-label">Address :</label>
                                            <input type="text" id="localisation" name="localisation" class="form-control" required value="{{ old('localisation') }}">
                                            @error('localisation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="map" class="form-label">Select Location on Map:</label>
                                            <div id="map" style="height: 300px;"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="numero_telephone" class="form-label">Phone :</label>
                                            <input type="text" id="numero_telephone" name="numero_telephone" class="form-control" value="{{ old('numero_telephone') }}">
                                            @error('numero_telephone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email :</label>
                                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description :</label>
                                            <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="site_web" class="form-label">Web Site :</label>
                                            <input type="url" id="site_web" name="site_web" class="form-control" value="{{ old('site_web') }}">
                                            @error('site_web')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="type_dechet" class="form-label">Type de Déchet :</label>
                                            <div id="type_dechet" class="form-control">
                                                @foreach(['PLASTIC', 'WOOD', 'PAPER', 'METAL', 'GLASS', 'E-WASTE', 'ORGANIC_WASTE', 'TEXTILES', 'TIRES', 'CONSTRUCTION_WASTE'] as $type)
                                                    <label>
                                                        <input type="checkbox" name="type_dechet[]" value="{{ $type }}" {{ is_array(old('type_dechet')) && in_array($type, old('type_dechet')) ? 'checked' : '' }}> {{ ucfirst(strtolower($type)) }}
                                                    </label><br>
                                                @endforeach
                                            </div>
                                            @error('type_dechet')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="logo" class="form-label">Logo :</label>
                                            <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
                                            @error('logo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Initialize the map
    var map = L.map('map').setView([48.8566, 2.3522], 13); // Default coordinates (Paris)

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Variable to hold marker
    var marker;

    // Function to set the marker and update the address input
    function setMarker(lat, lng, address) {
        // Remove existing marker if any
        if (marker) {
            map.removeLayer(marker);
        }

        // Add a new marker
        marker = L.marker([lat, lng]).addTo(map);
        document.getElementById('localisation').value = address || `${lat}, ${lng}`;
    }

    // Get user's current location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            // Center the map on user's location
            map.setView([lat, lng], 13);

            // Set marker at user's location
            setMarker(lat, lng, 'You are here');
        }, function() {
            console.error('Unable to retrieve your location');
        });
    } else {
        console.error('Geolocation is not supported by this browser.');
    }

    // Event on map click
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Get the address from the coordinates
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
            .then(response => response.json())
            .then(data => {
                setMarker(lat, lng, data.display_name);
            })
            .catch(err => {
                console.error('Error fetching address:', err);
                setMarker(lat, lng);
            });
    });
</script>

@include('Layout.Footer')

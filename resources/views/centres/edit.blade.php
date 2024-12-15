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
                                    <h1 class="mt-5 text-center">Edit Recycling Center</h1>

                                    <form action="{{ route('centres.update', $centre->id) }}" method="POST" class="mt-4"enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Name :</label>
                                            <input type="text" id="nom" name="nom" class="form-control" value="{{ $centre->nom }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="localisation" class="form-label">Address :</label>
                                            <input type="text" id="localisation" name="localisation" class="form-control" value="{{ $centre->localisation }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="map" class="form-label">Select Location on Map:</label>
                                            <div id="map" style="height: 300px;"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="numero_telephone" class="form-label">Phone :</label>
                                            <input type="text" id="numero_telephone" name="numero_telephone" class="form-control" value="{{ $centre->numero_telephone }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email :</label>
                                            <input type="email" id="email" name="email" class="form-control" value="{{ $centre->email }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description :</label>
                                            <textarea id="description" name="description" class="form-control" rows="4" required>{{ $centre->description }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="site_web" class="form-label">Web Site :</label>
                                            <input type="url" id="site_web" name="site_web" class="form-control" value="{{ $centre->site_web }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="type_dechet" class="form-label">Type de Déchet :</label>
                                            <div id="type_dechet" class="form-control">
        @php
            // Décodez le type_dechet pour permettre la sélection multiple
            $selectedDechets = is_array($centre->type_dechet) ? $centre->type_dechet : json_decode($centre->type_dechet, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $selectedDechets = [];
            }
        @endphp

        <label>
            <input type="checkbox" name="type_dechet[]" value="PLASTIC" {{ in_array('PLASTIC', $selectedDechets) ? 'checked' : '' }}> Plastic
        </label><br>
        <label>
            <input type="checkbox" name="type_dechet[]" value="WOOD" {{ in_array('WOOD', $selectedDechets) ? 'checked' : '' }}> Wood
        </label><br>
        <label>
            <input type="checkbox" name="type_dechet[]" value="PAPER" {{ in_array('PAPER', $selectedDechets) ? 'checked' : '' }}> Paper
        </label><br>
        <label>
            <input type="checkbox" name="type_dechet[]" value="METAL" {{ in_array('METAL', $selectedDechets) ? 'checked' : '' }}> Metal
        </label><br>
        <label>
            <input type="checkbox" name="type_dechet[]" value="GLASS" {{ in_array('GLASS', $selectedDechets) ? 'checked' : '' }}> Glass
        </label><br>
        <label>
            <input type="checkbox" name="type_dechet[]" value="E-WASTE" {{ in_array('E-WASTE', $selectedDechets) ? 'checked' : '' }}> E-Waste
        </label><br>
        <label>
            <input type="checkbox" name="type_dechet[]" value="ORGANIC_WASTE" {{ in_array('ORGANIC_WASTE', $selectedDechets) ? 'checked' : '' }}> Organic Waste
        </label><br>
        <label>
            <input type="checkbox" name="type_dechet[]" value="TEXTILES" {{ in_array('TEXTILES', $selectedDechets) ? 'checked' : '' }}> Textiles
        </label><br>
        <label>
            <input type="checkbox" name="type_dechet[]" value="TIRES" {{ in_array('TIRES', $selectedDechets) ? 'checked' : '' }}> Tires
        </label><br>
        <label>
            <input type="checkbox" name="type_dechet[]" value="CONSTRUCTION_WASTE" {{ in_array('CONSTRUCTION_WASTE', $selectedDechets) ? 'checked' : '' }}> Construction Waste
        </label><br>
    </div>

                                        </div>
                                        <div class="mb-3">
    <label for="logo" class="form-label">Logo :</label>
    @if($centre->logo)
        <div>
            <img src="{{ asset('storage/' . $centre->logo) }}" alt="Current Logo" style="max-width: 150px; margin-bottom: 10px;">
        </div>
    @endif
    <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
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

<!-- Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Initialize the map
    var map = L.map('map').setView([33.8869, 9.5375], 7);
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

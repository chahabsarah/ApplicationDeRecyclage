@include('Layout.Header')
<section class="nftmax-adashboard nftmax-show" >


    @if($centre->logo)
        <img src="{{ asset('storage/' . $centre->logo) }}" alt="{{ $centre->nom }} logo" style="max-height: 300px;width:98.4%;margin-left:10px;">
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12 nftmax-main__column">
                <div class="nftmax-body">
                    <!-- Dashboard Inner -->
                    <div class="nftmax-dsinner">

                        <!-- FunFacts -->
                        <div class="nftmax mg-top-40">
                            <!-- NFTMax Single -->
                            <div class="nftmax">

                                <div class="nftmax-_content">



                                <button id="openEmailPopup" style="margin-top: 10px; background-color: #5356FB; color: white; border: none; padding: 10px 20px; border-radius: 5px;">
        Send Email
    </button>
    <div id="emailPopup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); width: 400px;">
        <h3>Compose Email</h3>
        <form action="{{ route('send.email') }}" method="POST">
            @csrf
            <textarea name="email_body" rows="5" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;" placeholder="Enter your message"></textarea>
            <input type="hidden" name="email" value="{{ $centre->email }}">
            <button type="submit" style="margin-top: 10px; background-color: #5356FB; color: white; border: none; padding: 10px 20px; border-radius: 5px;">
                Send
            </button>
            <button type="button" id="closePopup" style="margin-top: 10px; background-color: #ddd; color: black; border: none; padding: 10px 20px; border-radius: 5px;">
                Cancel
            </button>
        </form>
    </div>

    <script>
        document.getElementById("openEmailPopup").addEventListener("click", function() {
            document.getElementById("emailPopup").style.display = "block";
        });

        document.getElementById("closePopup").addEventListener("click", function() {
            document.getElementById("emailPopup").style.display = "none";
        });
    </script>
<div>
    @php
        $selectedDechets = is_array($centre->type_dechet) ? $centre->type_dechet : json_decode($centre->type_dechet, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $selectedDechets = [];
        }

        // Types de déchets disponibles avec icônes
        $dechetsDisponibles = [
            'PLASTIC' => ['label' => 'Plastic', 'icon' => 'plastic.png'],
            'WOOD' => ['label' => 'Wood', 'icon' => 'bois.png'],
            'PAPER' => ['label' => 'Paper', 'icon' => 'papier.png'],
            'METAL' => ['label' => 'Metal', 'icon' => 'metal.png'],
            'GLASS' => ['label' => 'Glass', 'icon' => 'glass.png'],
            'E-WASTE' => ['label' => 'E-Waste', 'icon' => 'electronic-waste.png'],
            'ORGANIC_WASTE' => ['label' => 'Organic Waste', 'icon' => 'organic_waste.png'],
            'TEXTILES' => ['label' => 'Textiles', 'icon' => 'textile.png'],
            'TIRES' => ['label' => 'Tires', 'icon' => 'pneu.png'],
            'CONSTRUCTION_WASTE' => ['label' => 'Construction Waste', 'icon' => 'c_waste.png'],
        ];
    @endphp

    <ul style="list-style: none; padding: 10px; display: flex; flex-wrap: wrap;justify-content:space-evenly;">
        @foreach($dechetsDisponibles as $key => $details)
            @if(in_array($key, $selectedDechets))
                <li style="margin-right: 20px; text-align: center;background-color:white;border-style:solid;border-radius:10%;padding:10px;border-color:#5356FB;">
                    <!-- Display icon with label -->
                    <img src="{{ asset('assets/waste/' . $details['icon']) }}" alt="{{ $details['label'] }} icon" style="width: 50px; height: 50px;">
                    <p style="color:black;">{{ $details['label'] }}</p>
                </li>
            @endif
        @endforeach
    </ul>
</div>
                                   <div class="info-container">
                                        <div class="info-box">
                                            <p><strong>Address:</strong> {{ $centre->localisation }}</p>
                                            <p><strong>Phone:</strong> {{ $centre->numero_telephone }}</p>
                                            <p><strong>Email:</strong> {{ $centre->email }}</p>
                                            <p><strong>Web Site:</strong> <a href="{{ $centre->site_web }}" target="_blank">{{ $centre->site_web }}</a></p>
                                        </div>

                                        <div class="description-box">
                                            <p><strong>Description:</strong> {{ $centre->description }}</p>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End of nftmax-body -->
            </div> <!-- End of col -->
        </div> <!-- End of row -->
    </div> <!-- End of container -->
</section>

@include('Layout.Footer')
<style>
    .info-container {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin-top: 20px;
    }

    .info-box, .description-box {
        background-color: #f9f9f9; /* Light grey background for a modern look */
        border: 1px solid #ddd; /* Light border */
        border-radius: 8px; /* Rounded corners */
        padding: 20px; /* Padding for content */
        flex: 1; /* Make both divs take equal width */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    .info-box a {
        color: #5356FB; /* Link color for modern style */
        text-decoration: none;
    }

    .info-box a:hover {
        text-decoration: underline;
    }

    .info-box p, .description-box p {
        color: #333; /* Text color */
        font-family: 'Arial', sans-serif; /* Modern font */
        margin: 5px 0;
    }
</style>

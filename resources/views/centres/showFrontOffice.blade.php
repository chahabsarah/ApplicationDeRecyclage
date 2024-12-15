@extends('layout.layout')

@section('content')

<!-- Start Hero Section -->
<x-hero subTitle='Modern & Beautiful Travel Theme' />



<!-- Waste Types Section -->
<div>
    @php
        $selectedDechets = is_array($centre->type_dechet) ? $centre->type_dechet : json_decode($centre->type_dechet, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $selectedDechets = [];
        }

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
                    <img src="{{ asset('assets/waste/' . $details['icon']) }}" alt="{{ $details['label'] }} icon" style="width: 50px; height: 50px;">
                    <p style="color:black;">{{ $details['label'] }}</p>
                </li>
            @endif
        @endforeach
    </ul>
</div>

<!-- Other Information Section -->
<section>
<div class="container">
    <div class="row align-items-center">
        <!-- Logo Section -->
        <div class="col-lg-6 col-md-6">
            @if($centre->logo)
                <img src="{{ asset('storage/' . $centre->logo) }}" alt="{{ $centre->nom }} logo" style="max-height: 300px;width:98.4%;margin-left:10px;border-radius:10%;">
            @endif
        </div>

        <!-- Description Section -->
        <div class="col-lg-6 col-md-6">
            <div class="cs_iconbox cs_style_5  cs_radius_5 text-center">
                <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Description</h2>
                <p class="cs_iconbox_subtitle mb-0" style="text-align:justify;">{{ $centre->description }}</p>
            </div>
        </div>
    </div>
</div>
    <div class="cs_height_140 cs_height_lg_80"></div>
    <div class="container">
        <div class="row cs_gap_y_40">
            <div class="col-lg-3 col-md-6">
                <div class="cs_iconbox cs_style_5 cs_gray_bg cs_radius_5 text-center">
                    <div class="cs_iconbox_icon cs_accent_bg cs_white_color cs_center cs_radius_5" style="background-color:#5356FB;">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Address</h2>
                    <p class="cs_iconbox_subtitle mb-0">{{ $centre->localisation }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="cs_iconbox cs_style_5 cs_gray_bg cs_radius_5 text-center">
                    <div class="cs_iconbox_icon cs_accent_bg cs_white_color cs_center cs_radius_5" style="background-color:#5356FB;">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Phone</h2>
                    <p class="cs_iconbox_subtitle mb-0">+216 {{ $centre->numero_telephone }} <br><br><br></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="cs_iconbox cs_style_5 cs_gray_bg cs_radius_5 text-center">
                    <div class="cs_iconbox_icon cs_accent_bg cs_white_color cs_center cs_radius_5" style="background-color:#5356FB;">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Email</h2>
                    <p class="cs_iconbox_subtitle mb-0">{{ $centre->email }} <br><br><br></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="cs_iconbox cs_style_5 cs_gray_bg cs_radius_5 text-center">
                    <div class="cs_iconbox_icon cs_accent_bg cs_white_color cs_center cs_radius_5" style="background-color:#5356FB;">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <h2 class="cs_iconbox_title cs_fs_24 cs_semibold">Web Site</h2>
                    <p class="cs_iconbox_subtitle mb-0">{{ $centre->site_web }} <br><br><br></p>
                </div>
            </div>
        </div>
    </div>
    <div class="cs_height_140 cs_height_lg_80"></div>
</section>

@endsection

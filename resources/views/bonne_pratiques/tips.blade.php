@extends('layout.layout')

@section('content')

    <!-- Start Hero Section -->
    <x-hero subTitle='Modern & Beautiful Travel Theme' img='assets1/images/tour_header_bg.jpeg' title='Popular Tours Packagess' />
    <!-- End Hero Section -->

  

<section class="nftmax-adashboard nftmax-show">
    <div class="container">
        <div class="row">
            <h1 class="mt-5 text-center">Bonnes Pratiques</h1>
            @foreach($bonne_pratiques as $pratique)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        @if($pratique->picture)
                            <img src="{{ asset('storage/' . $pratique->picture) }}" class="card-img-top" alt="{{ $pratique->title }}">
                        @else
                            <img src="default_image_url.jpg" class="card-img-top" alt="Default Image"> <!-- Use a default image if none exists -->
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $pratique->title }}</h5>
                            <p class="card-text">{{ Str::limit($pratique->description, 100) }}</p> <!-- Limit description length -->
                            <a href="{{ route('bonne_pratiques.show', $pratique->id) }}" class="btn btn-primary">Voir Détails</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>





    
  @endsection

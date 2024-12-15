@extends('layout.layout')

@section('content')

<x-hero subTitle='Modern & Beautiful Travel Theme' />

<section class="nftmax-adashboard nftmax-show" style="margin-top:80px">
    <div class="container">
        <div class="row">
            <div class="nftmax-main__column">
                <div class="nftmax-body">
                    <div class="nftmax-dsinner">
                        <div class="trending-action">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="id1" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <div class="row nftmax-gap-sq30">
                                                @foreach($collectes as $collecte)
                                                <div class="col-lg-4 col-md-6 col-12 mb-4"> <!-- Ajout de mb-4 ici pour l'espacement -->
                                                    <!-- Marketplace Single Item -->
                                                    <div class="trending-action__single trending-action__single--v2">
                                                        <div class="nftmax-trendmeta">
                                                            <div class="nftmax-trendmeta__main">
                                                                <div class="nftmax-trendmeta__author">
                                                                    <div class="nftmax-trendmeta__img">
                                                                        <img src="{{ asset('storage/' . $collecte->centreDeRecyclage->logo) }}" alt="Recycling Center Logo">
                                                                    </div>
                                                                    <div class="nftmax-trendmeta__content">
                                                                        <span class="nftmax-trendmeta__small">Recycling center</span>
                                                                        <h4 class="nftmax-trendmeta__title">{{ $collecte->centreDeRecyclage->nom ?? 'Unknown Center' }}</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="nftmax-trendmeta__author">
                                                                    <div class="nftmax-trendmeta__content">
                                                                        <span class="nftmax-trendmeta__small">Sponsors</span>
                                                                        <h4 class="nftmax-trendmeta__title">Sponsors.logo</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="trending-action__head">
                                                            <div class="trending-action__badge"><span>{{ $collecte->type_dechet }}</span></div>
                                                            <div class="trending-action__button v2">
                                                                <a href="{{ route('collectes.showFluxDeDonneesFrontOffice', $collecte->id) }}" class="trending-action__btn follow-icon" title="Suivre">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
                                                            </div>
                                                            @if($collecte->image)
                                                                <img src="{{ asset('storage/' . $collecte->image) }}" alt="Image de la collecte" style="max-height:180px">
                                                            @else
                                                                Aucune image
                                                            @endif
                                                        </div>
                                                        <div class="trending-action__body trending-marketplace__body">
                                                            <h2 class="trending-action__title"><a href="{{url('/show')}}">{{ $collecte->nom }}</a></h2>
                                                            <div class="nftmax-currency">
                                                                <div class="nftmax-currency__main">
                                                                    <div class="nftmax-currency__icon"></div>
                                                                    <div class="nftmax-currency__content">
                                                                        <h4 class="nftmax-currency__content-title">{{ $collecte->etat }}</h4>
                                                                        <p class="nftmax-currency__content-sub">{{ $collecte->poids_contenu }} KG</p>
                                                                    </div>
                                                                </div>
                                                                <a href="{{ route('collectes.showFrontOffice', $collecte->id) }}" class="nftmax-btn nftmax-btn__secondary radius">
                                                                    <i class="fa-solid fa-arrow-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

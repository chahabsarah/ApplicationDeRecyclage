@extends('layout.layout')

@section('content')

<!-- Start Hero Section -->
<x-hero subTitle='Modern & Beautiful Travel Theme' />

<section >
    <div class="container">
        <div class="row">
            <div class="">
                <div class="nftmax-body">
                    <div class="nftmax-dsinner">

                        <div class="nftmax mg-top-40">
                            <div class="nftmax">

                                <div class="nftmax-_content">
                            <h1 class="mt-10 text-center">Best Practice</h1>

                            <!-- Search Bar -->
                            <div class="mb-4">
                                <form action="{{ route('bonne_pratiques.indexFrontOffice') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request()->get('search') }}">
                                        <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mb-4 text-center">
                                <a href="{{ route('bonne_pratiques.exportPDF') }}" class="btn btn-danger mx-2">Convertir en PDF</a>
                            </div>

                            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                            <!-- Cards Display -->
                            <div class="row">
                                @foreach($bonne_pratiques as $pratique)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            <img src="{{ $pratique->picture ? asset('storage/' . $pratique->picture) : asset('path/to/default/image.jpg') }}" class="card-img-top" alt="Image">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $pratique->title }}</h5>
                                                <p class="card-text">{{ $pratique->description }}</p>
                                                <!-- Category Tag -->
                                                <span class="badge bg-success">{{ $pratique->category }}</span>
                                            </div>
                                            <div class="card-footer text-center">
                                                <a href="{{ route('bonne_pratiques.show', $pratique->id) }}" class="btn btn-info">More</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                <nav>
                                    <ul class="pagination">
                                        @if ($bonne_pratiques->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $bonne_pratiques->previousPageUrl() }}">Previous</a>
                                            </li>
                                        @endif

                                        @for ($i = 1; $i <= $bonne_pratiques->lastPage(); $i++)
                                            <li class="page-item {{ $i == $bonne_pratiques->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $bonne_pratiques->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        @if ($bonne_pratiques->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $bonne_pratiques->nextPageUrl() }}">Next</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">Next</a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div> <!-- End of nftmax mg-top-40 -->
                    </div> <!-- End of nftmax-dsinner -->
                </div> <!-- End of nftmax-body -->
            </div> <!-- End of col-lg-9 -->
        </div> <!-- End of row -->
    </div> <!-- End of container -->
</section>
@endsection

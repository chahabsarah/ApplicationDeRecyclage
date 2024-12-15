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
                            <h1 class="mt-4 text-center">Best Practice</h1>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Détails de la bonne pratique -->
                            <div class="card mb-4">
                                <div class="card-body d-flex align-items-start">
                                    <img src="{{ $bonnePratique->picture ? asset('storage/' . $bonnePratique->picture) : asset('path/to/default/image.jpg') }}"
                                         alt="Image"
                                         class="rounded"
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                    <div class="ms-3">
                                        <h2 class="card-title">{{ $bonnePratique->title }}</h2>
                                        <p class="card-text">{{ Str::limit($bonnePratique->description, 100, '...') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Affichage des commentaires -->
                            <h3 class="mt-4">Comments</h3>
                            @foreach($comments as $comment)
                                <div class="card mb-3">
                                    <div class="card-body d-flex align-items-start">
                                        <img src="{{ $comment->photo ? asset('storage/' . $comment->photo) : asset('path/to/default/user.png') }}"
                                             alt="Commentaire Photo"
                                             class="rounded-circle me-3"
                                             style="width: 50px; height: 50px;">
                                        <div>
                                            <h5 class="card-title">{{ $comment->nom }}</h5>
                                            <p class="card-text">{{ $comment->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Formulaire d'ajout de commentaire -->
                            <h3 class="mt-4">New comment?</h3>
                            <form action="{{ route('commentaires.store', $bonnePratique->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Name</label>
                                    <input type="text" name="nom" id="nom" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input type="file" name="photo" id="photo" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-bottom: 100px;">Publish</button>
                                </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

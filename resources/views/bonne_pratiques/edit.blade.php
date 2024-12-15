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
                                    <h1 class="mt-5 text-center">Edit Best Practice</h1>
                                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif how toadd this!
                                    <form action="{{ route('bonne_pratiques.update', $bonnePratique->id) }}" method="POST" class="mt-4" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="title" class="form-label">Titre :</label>
                                            <input type="text" id="title" name="title" class="form-control" value="{{ $bonnePratique->title }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description :</label>
                                            <textarea id="description" name="description" class="form-control" rows="4" required>{{ $bonnePratique->description }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="category" class="form-label">Catégorie :</label>
                                            <input type="text" id="category" name="category" class="form-control" value="{{ $bonnePratique->category }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="picture" class="form-label">Image :</label>
                                            <input type="file" id="picture" name="picture" class="form-control" accept="image/*">
                                            <small class="form-text text-muted">Laissez vide si vous ne souhaitez pas changer l'image actuelle.</small>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
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

@include('Layout.Footer')

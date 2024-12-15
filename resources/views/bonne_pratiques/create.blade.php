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

                                    <h1 class="mt-5 text-center">New Best Practice ?</h1>
                                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                                    <form action="{{ route('bonne_pratiques.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title :</label>
                                            <input type="text" id="title" name="title" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description :</label>
                                            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="category" class="form-label">Category :</label>
                                            <input type="text" id="category" name="category" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="picture" class="form-label">Image :</label>
                                            <input type="file" id="picture" name="picture" class="form-control" accept="image/*">
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

@include('Layout.Footer')

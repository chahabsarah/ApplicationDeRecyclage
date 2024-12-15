@include('Layout.Header')

<!-- NFTmax Dashboard -->
<section class="nftmax-adashboard nftmax-show" style="min-height: 100vh">

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-0ZnAy3WXyHAcB8wjU/a4ot/9R8QRQPEtU/F8fEqDOkXjms2BuN4YzKb1YoI6IHTAkxQsmZZa3LbHkZVcvl8Nqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container">
        <div class="row">

            @include('Layout.Footer')



            @include('categories.bootstrap')
            <title>Document</title>




            <div class="container my-4">
                <div class="row">

                    <h2 class="mb-4">Categories</h2>

                    <button type="button" class="btn btn-primary col-auto mb-3 ml-auto" data-toggle="modal"
                        data-target="#addCategoryModal">
                        Add Category
                    </button>

                </div>


                <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" style="margin-top: 20%"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="categoryName" name="name">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if ($categories->isEmpty())
                    <div class="alert alert-info" role="alert">
                        No categories available.
                    </div>
                @else
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body nftmax-collection__single ">
                                        <h5 class="card-title">{{ $category->name }}</h5>
                                        <p class="card-text">
                                            <!-- You can add more information about the category if needed -->
                                            This category has {{ $category->claims->count() }} claims.
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <form class="row" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger col-lg-3 col-12 ml-auto mr-1 btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this categorie?');">Delete
                                            </button>
                                        </form>
                                        {{-- <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">View Claims</a> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

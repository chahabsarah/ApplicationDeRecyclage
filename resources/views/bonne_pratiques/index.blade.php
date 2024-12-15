@include('Layout.Header')

<section class="nftmax-adashboard nftmax-show">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12 nftmax-main__column">
                <div class="nftmax-body">
                    <!-- Dashboard Inner -->
                    <div class="nftmax-dsinner">
                        <!-- FunFacts -->
                        <div class="nftmax mg-top-40">
                            <div class="nftmax">
                                <div class="nftmax-_content">
                                    <h1 class="mt-5 text-center">Best Practice</h1>

                                    <!-- Search Bar -->
                                    <form action="{{ route('bonne_pratiques.index') }}" method="GET" class="mb-4">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" placeholder="Rechercher une bonne pratique" value="{{ request('search') }}">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i> Search
                                            </button>
                                        </div>
                                    </form>

                                    <!-- Add New Button -->
                                    <div class="text-center mb-4">
                                        <a href="{{ route('bonne_pratiques.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> New Best practice ?
                                        </a>
                                    </div>

                                    <!-- Bonnes Pratiques Table -->
                                    <table class="table table-responsive table-bordered table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Titre</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bonne_pratiques as $pratique)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('bonne_pratiques.show', $pratique->id) }}" class="text-info">
                                                            {{ $pratique->title }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $pratique->description }}</td>
                                                    <td>{{ $pratique->category }}</td>
                                                    <td>
                                                        @if($pratique->picture)
                                                            <img src="{{ asset('storage/' . $pratique->picture) }}" alt="Image" style="width: 50px; height: auto;">
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('bonne_pratiques.edit', $pratique->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('bonne_pratiques.destroy', $pratique->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Pagination -->
                                    <div class="d-flex justify-content-center mt-4">
                                        <nav>
                                            <ul class="pagination pagination-lg">
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

                                </div>
                            </div>
                        </div> <!-- End of nftmax-funfact -->

                    </div> <!-- End of nftmax-dsinner -->
                </div> <!-- End of nftmax-body -->
            </div> <!-- End of col -->
        </div> <!-- End of row -->
    </div> <!-- End of container -->
</section>

@include('Layout.Footer')

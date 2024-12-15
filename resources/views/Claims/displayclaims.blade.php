<div class="nftmax-body">
    <!-- Dashboard Inner -->
    <div class="nftmax-dsinner">
        <!-- End All Notification Heading -->
        <div class="nftmax-chatbox">
            <div class="row">
                <div class="col-12">
                    <div class="nftmax-chatbox__sidebar">
                        <div class="nftmax-chatbox__first-group">
                            <!-- Title -->
                            <div class="text-center mb-4">
                                        <a href="{{ route('claimsPdf') }}" class="btn btn-success">
                                            <i class="fas fa-file-pdf"></i> Download PDF
                                        </a>
                                    </div>
                            <h4 class="nftmax-chatbox__title">Search</h4>
                            <!-- Chatbox Form -->
                            <div class="nftmax-header__form nftmax-chatbox__search">

                                <form class="nftmax-header__form-inner" action="{{ route('claims.search') }}"
                                    method="GET">
                                    <button class="search-btn" type="submit">
                                        <i class="fa-solid fa-magnifying-glass-minus"></i>
                                    </button>
                                    <input name="s" value="" type="text"
                                        placeholder="Search items, collections...">
                                </form>


                            </div>
                        </div>

                        <!-- Chatbox List -->
                        <ul class="nftmax-chatbox__list">
                            <!-- Single List -->
                            @foreach ($claims as $cl)
                                <li class="row">
                                    <div class="row">

                                        <div class="nftmax-chatbox__author-img col-auto">
                                            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                                alt="#">
                                            <span class="nftmax-chatbox__author-online"></span>
                                        </div>

                                        <div class="col-3">
                                            <h4 class="nftmax-chatbox__author-title">
                                                {{ $cl->username }} </h4>
                                            <p class="nftmax-chatbox__author-desc">{{ $cl->categories->name }}
                                            </p>
                                        </div>

                                        <div class="text-center col-6">
                                            <p class="nftmax-chatbox__author-title">{{ $cl->description }}
                                            </p>
                                        </div>


                                        <div class="col-2 ml-auto py-auto">
                                            <form action="{{ route('claims.destroy', $cl->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this claim?');">Delete
                                                </button>
                                            </form>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#editModal{{ $cl->id }}">
                                                Update
                                            </button>
                                        </div>
                                    </div>

                                </li>

                                <div class="modal fade mt-5" style="margin-top: 10%!important" id="editModal{{ $cl->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel{{ $cl->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $cl->id }}">Edit
                                                    Claim</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('claims.update', $cl->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT') <!-- This will send a PUT request -->
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input type="text" name="username" id="username"
                                                            class="form-control" value="{{ $cl->username }}" required>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" id="description" class="form-control" required>{{ $cl->description }}</textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Update Claim</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- End Single List -->
                        </ul>
                    </div>
                </div>



            </div>
        </div>

    </div>
</div>

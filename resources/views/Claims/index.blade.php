
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
@include('claims.bootstrap')

<div class="container">



    <div class="row mt-5">

        <button type="button" class="btn btn-primary col-auto ml-auto nftmax-main__column" data-toggle="modal"
            data-target="#exampleModalCenter">
            Post claim
        </button>

        <div class="col-12 nftmax-main__column">
            @include('Claims.displayclaims')
        </div>

    </div>

    <div class="row">

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Submit your claim here</h5>
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
                        <form action="{{ url('claims') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="categorySelect">First Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                        placeholder="First name">
                                </div>
                                <div class="col">
                                    <label for="categorySelect">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                        placeholder="Last name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="categorySelect">Category</label>
                                <select class="form-control" name="categories_id" id="categorySelect">
                                    <option value="">Select a category</option> <!-- Placeholder option -->
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div>
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

@endsection

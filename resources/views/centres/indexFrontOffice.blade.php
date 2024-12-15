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
                                    <div class="table-responsive" style="margin-top:40px;">
                                        <table class="table table-bordered table-striped" style="width:100%;">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Logo</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Website</th>
                                                    <th>Waste Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($centres as $centre)
                                                <tr>
                                                    <td>
                                                        <div>
                                                            @if($centre->logo)
                                                                <img src="{{ asset('storage/' . $centre->logo) }}" alt="Logo" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
                                                            @else
                                                                N/A
                                                            @endif
                                                        </div>

                                                    </td>

                                                    <td>
                                                        <a href="{{ route('centres.showFrontOffice', $centre->id) }}">
                                                            {{ $centre->nom }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $centre->localisation }}</td>
                                                    <td>{{ $centre->numero_telephone }}</td>
                                                    <td>{{ $centre->email }}</td>
                                                    <td><a href="{{ $centre->site_web }}" target="_blank">{{ $centre->site_web }}</a></td>
                                                    <td>
                                                        @if($centre->type_dechet)
                                                            <ul>
                                                                @php
                                                                    // Vérifie si c'est un tableau ou une chaîne JSON
                                                                    $dechets = is_array($centre->type_dechet) ? $centre->type_dechet : json_decode($centre->type_dechet, true);

                                                                    // Si json_decode échoue, utilisez un tableau vide
                                                                    if (json_last_error() !== JSON_ERROR_NONE) {
                                                                        $dechets = [];
                                                                    }
                                                                @endphp

                                                                @foreach($dechets as $dechet)
                                                                    <li>{{ $dechet }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> <!-- End of table-responsive -->

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

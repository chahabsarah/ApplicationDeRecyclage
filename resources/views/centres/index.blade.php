@include('Layout.Header')

<section class="nftmax-adashboard nftmax-show">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12 nftmax-main__column">
                <div class="nftmax-body">
                    <!-- Dashboard Inner -->
                    <div class="nftmax-dsinner">
                    <div class="welcome-cta__button">
											<a href="{{ route('centres.create') }}"  class="nftmax-btn nftmax-btn__bordered bg radius">New Center</a>
								</div>

                        <!-- FunFacts -->
                        <div class="nftmax mg-top-40">
                            <!-- NFTMax Single -->
                            <div class="nftmax">

                                <div class="nftmax-_content">
                                    <!-- <h1 class="mt-5 text-center">Recycling Centers</h1> -->

                                    <div class="text-center mb-4">
                                        <a href="{{ route('generatePDF') }}" class="btn btn-success">
                                            <i class="fas fa-file-pdf"></i> Download PDF
                                        </a>
                                    </div>

                                    <!-- Table responsive wrapper -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Logo</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Website</th>
                                                    <th>Waste Type</th>
                                                    <th>QR Code</th>
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

                                                        <div style="display: flex; gap: 10px;">
                                                            <!-- Lien vers l'édition -->
                                                            <a href="{{ route('centres.edit', $centre->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>

                                                            <!-- Formulaire pour la suppression -->
                                                            <form action="{{ route('centres.destroy', $centre->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this center?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                                                    <i class="fas fa-trash" style="color:red;"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('centres.show', $centre->id) }}">
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
                                                    <td>
    {!! QrCode::size(100)->backgroundColor(255, 0, 160)->generate($centre->nom . ' - ' . $centre->localisation) !!}
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

@include('Layout.Footer')

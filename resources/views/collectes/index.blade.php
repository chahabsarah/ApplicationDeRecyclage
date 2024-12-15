@include('Layout.Header')
<!-- NFTmax Dashboard -->
<section class="nftmax-adashboard nftmax-show">
				<div class="container">
					<div class="row">
						<div class="col-lg-9 col-12 nftmax-main__column">
							<div class="nftmax-body">
								<!-- Dashboard Inner -->
								<div class="nftmax-dsinner">

                                <div class="welcome-cta__button">
											<a href="{{ route('collectes.create') }}" class="nftmax-btn nftmax-btn__bordered bg radius">New Collect</a>
								</div>

									<!-- Marketplace Bar -->
									<div class="nftmax-marketplace__bar mg-top-50 mg-btm-40">
										<div class="nftmax-marketplace__bar-inner">
											<!-- Marketplace Tab List -->
											<div class="list-group nftmax-marketplace__bar-list" id="list-tab" role="tablist">
												<a class="list-group-item active" data-bs-toggle="list" href="#id1" role="tab">Explore</a>
												<a class="list-group-item" data-bs-toggle="list" href="#id2" role="tab">RECOVERED</a>
												<a class="list-group-item" data-bs-toggle="list" href="#id3" role="tab">SORTING</a>
												<a class="list-group-item" data-bs-toggle="list" href="#id4" role="tab">RECYCLING</a>
												<a class="list-group-item" data-bs-toggle="list" href="#id5" role="tab">RECYCLING_COMPLETED</a>
                                                <a class="list-group-item" data-bs-toggle="list" href="#id5" role="tab">DISTRIBUTION</a>

											</div>
											<!-- End Marketplace Tab List -->


										</div>
									</div>

									<!-- Welcome CTA -->
									<div class="trending-action">
										<div class="row">
											<div class="col-12">
												<div class="tab-content" id="nav-tabContent">
													<!-- Single Tab -->
													<div class="tab-pane fade show active" id="id1" role="tabpanel" aria-labelledby="nav-home-tab">
														<div class="row nftmax-gap-sq30">
                                                        @foreach($collectes as $collecte)
                                                        <div class="col-lg-4 col-md-6 col-12">
																<!-- Marketplace Single Item -->
																<div class="trending-action__single trending-action__single--v2">
																	<div class="nftmax-trendmeta">
																		<div class="nftmax-trendmeta__main">
																			<div class="nftmax-trendmeta__author">
																				<div class="nftmax-trendmeta__img">
                                                                                <img src="{{ asset('storage/' . $collecte->centreDeRecyclage->logo) }}" alt="Recycling Center Logo">
																				</div>
																				<div class="nftmax-trendmeta__content">
																					<span class="nftmax-trendmeta__small">Recycling center</span>
                                                                                    <h4 class="nftmax-trendmeta__title">{{ $collecte->centreDeRecyclage->nom ?? 'Unknown Center' }}</h4>
                                                                                    </div>
																			</div>
																			<div class="nftmax-trendmeta__author">
																				<div class="nftmax-trendmeta__content">
																					<span class="nftmax-trendmeta__small">Sponsors</span>
																					<h4 class="nftmax-trendmeta__title">Sponsors.logo</h4>
																				</div>

																			</div>
																		</div>
																	</div>
																	<!-- Trending Head -->
																	<div class="trending-action__head">
																		<div class="trending-action__badge"><span>{{ $collecte->type_dechet }}</span></div>

																		<div class="trending-action__button v2">
																			<a href="{{ route('collectes.show_flux_de_donnees', $collecte->id) }}" class="trending-action__btn follow-icon" title="Suivre">
    <i class="fa-solid fa-eye"></i>
</a>
                                                                            <a href="{{ route('collectes.edit', $collecte->id) }}" class="trending-action__btn"><i class="fa-solid fa-pen"></i></a>
                                                                            <a href="{{ route('collectes.destroy', $collecte->id) }}"
   class="trending-action__btn"
   onclick="event.preventDefault();
   if(confirm('Êtes-vous sûr de vouloir supprimer cette collecte ?')) {
       document.getElementById('delete-form-{{ $collecte->id }}').submit();
   }">
   <i class="fa-solid fa-trash"></i>
</a>

<!-- Delete form (hidden) -->
<form id="delete-form-{{ $collecte->id }}" action="{{ route('collectes.destroy', $collecte->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

																		</div>
                                                                        @if($collecte->image)
                <img src="{{ asset('storage/' . $collecte->image) }}" alt="Image de la collecte"  style="max-height:180px">
            @else
                Aucune image
            @endif
																	</div>
																	<!-- Trending Body -->
																	<div class="trending-action__body trending-marketplace__body">
																		<h2 class="trending-action__title"><a href="{{url('/show')}}">{{ $collecte->nom }}</a></h2>
																		<div class="nftmax-currency">
																			<div class="nftmax-currency__main">
																				<div class="nftmax-currency__icon">
                                                                                </div>
																				<div class="nftmax-currency__content">
																					<h4 class="nftmax-currency__content-title">{{ $collecte->etat }}</h4>
																					<p class="nftmax-currency__content-sub">{{ $collecte->poids_contenu }} KG</p>
																				</div>
																			</div>
                                                                            <a href="{{ route('collectes.show', $collecte->id) }}" class="nftmax-btn nftmax-btn__secondary radius">
     <i class="fa-solid fa-arrow-right"></i>
</a>
																		</div>
																	</div>
																</div>
																<!-- End Marketplace Item -->
															</div>
															@endforeach
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
									<!-- End Welcome CTA -->
								</div>
								<!-- End Dashboard Inner -->
							</div>
						</div>
@include('Layout.Footer')


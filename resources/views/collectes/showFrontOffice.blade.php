@extends('layout.layout')

@section('content')

<x-hero subTitle='Modern & Beautiful Travel Theme' />

<section class="nftmax-adashboard nftmax-show" style="margin-top:80px">
    <div class="container">
        <div class="row">
            <div class="nftmax-main__column">
                <div class="nftmax-body">
                    <div class="nftmax-dsinner">
                        <div class="trending-action">
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="id1" role="tabpanel" aria-labelledby="nav-home-tab">
                                            <div class="row nftmax-gap-sq30">
                                            <section class="nftmax-adashboard nftmax-show">
				<div class="container">
					<div class="row">
						<div class="col-xxl-9 col-12 nftmax-main__column">
							<div class="nftmax-body">
								<!-- Dashboard Inner -->
								<div class="nftmax-dsinner">
									<!-- Dashboard Slider -->
									<div class="dashboard-banner nftmax-bg-cover mg-top-40" style="background-image:url('../../assets/img/banner-bg.png')">
										<div class="row">
											<div class="col-12">
												<div class="dashboard-banner__main">
													<div class="dashboard-banner__column dashboard-banner__column--one">
														<!-- Dashboard Content -->
														<div class="dashboard-banner__content">
                                                        <p class="dashboard-banner__text nftmax-lspacing">ID : {{ $collecte->id }}</p>

															<h2 class="dashboard-banner__title nftmax-font-regular nftmax-lspacing">{{ $collecte->nom }}</h2>
														</div>

														<div class="nftmax-header__author nftmax-header__author-two ">
															<div class="nftmax-header__author-img"><img src="{{ asset('storage/' . $collecte->centreDeRecyclage->logo) }}" alt="yyy"></div>
															<div class="nftmax-header__author-content ">
																<h4 class="nftmax-header__author-title nftmax-header__author-title--two nftmax-lspacing">Recycling center : {{ $collecte->centreDeRecyclage->nom ?? 'Unknown Center' }}</h4>
																<p class="nftmax-header__author-text nftmax-header__author-text--two"><a href="#" class="nftmax-font-regular nftmax-lspacing"> Waste type : {{ $collecte->type_dechet }}</a></p>
															</div>
														</div>

														<div class="dashboard-banner__bids">
															<div class="dashboard-banner__bid">
																<div class="dashboard-banner__group">
																	<p class="dashboard-banner__group-small">Current State</p>
																	<h3 class="dashboard-banner__group-title">{{ $collecte->etat}}</h3>
																</div>
																<div class="dashboard-banner__middle-border"></div>
                                                                <div class="dashboard-banner__group">
																	<p class="dashboard-banner__group-small"> Waste weight</p>
																	<h3 class="dashboard-banner__group-title" >{{ $collecte->poids_contenu}} KG</h3>
																</div>
															</div>
														</div>

													</div>
                                                    <div class="dashboard-banner__column dashboard-banner__column--two">
                                                        <div class="dashboard-banner__slider">
															<div class="dashboard-banner__single-slider">
                                                            @if($collecte->image)
                <img src="{{ asset('storage/' . $collecte->image) }}" alt="Image de la collecte" >
            @else
                Aucune image
            @endif
															</div>
                                                        </div>
													</div>
												</div>
											</div>
										</div>
									</div>


                                    <div class="col-xxl-12 col-12 nftmax-main__sidebar" style="margin:20px;">
							<div class="nftmax-sidebar mg-top-40">
								<div class="row">
									<div class="col-xxl-12 col-xl-6 col-12 nftmax-sidebar__widget">
										<!-- NFTMax Single Sidebar -->
										<div class="nftmax-sidebar__single">
											<!-- Sidebar Heading -->


											<div class="tab-content" id="nav-tabContent">
												<!-- Single Tab -->
												<div class="tab-pane fade show active" id="side__one" role="tabpanel" aria-labelledby="side__one">
													<!-- Platform List -->
													<div class="nftmax-sidebar__charts nftmax-sidebar__charts--v1">

													</div>
												</div>
												<div class="tab-pane fade show" id="side__one_weekly" role="tabpanel" aria-labelledby="side__one">
													<!-- Platform List -->
													<div class="nftmax-sidebar__charts nftmax-sidebar__charts--v1">

													</div>
												</div>
												<div class="tab-pane fade show" id="side__one_monthly" role="tabpanel" aria-labelledby="side__one">
													<!-- Platform List -->
													<div class="nftmax-sidebar__charts nftmax-sidebar__charts--v1">

													</div>
												</div>


												<!-- End Single Tab -->
											</div>
										</div>
										<!-- End NFTMax Single Sidebar -->
									</div>

									<div class="col-xxl-12 col-xl-6 col-12 nftmax-sidebar__widget">
										<!-- NFTMax Single Sidebar -->
										<div class="nftmax-sidebar__single">


											<div class="tab-content" id="nav-tabContent">
												<!-- Single Tab -->
												<div class="tab-pane fade show active" id="side__two" role="tabpanel" aria-labelledby="side__two">

												</div>
												<div class="tab-pane fade show" id="side__two_BTC" role="tabpanel" aria-labelledby="side__two">

												</div>
												<!-- End Single Tab -->
											</div>
										</div>
										<!-- End NFTMax Single Sidebar -->
									</div>


								</div>
							</div>
						</div>

					</div>
				</div>
			</section>




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

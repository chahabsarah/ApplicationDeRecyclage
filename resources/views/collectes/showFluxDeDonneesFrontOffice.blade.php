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
            <div class="col-lg-12 col-12 nftmax-main__column">
                <div class="nftmax-body">
                    <div class="nftmax-dsinner">
                        <div class="nftmax mg-top-40">
                            <div class="nftmax">
                                <div class="nftmax-_content">

                                    <h3>Discover the exciting journey each collection embarks on through its dynamic phases!</h3>

                                    <!-- Check if $collecte and fluxDeDonnees exist -->
                                    @if(isset($collecte) && $collecte->fluxDeDonnees && $collecte->fluxDeDonnees->phases->count() > 0)
                                        <!-- Progress Bar -->
                                        <div class="progress-bar-wrapper">
                                            @foreach($collecte->fluxDeDonnees->phases as $phase)
                                                <div class="progress-bar-step {{ $loop->iteration <= 1 ? 'visited' : '' }}" id="progress-step-{{ $loop->iteration }}">
                                                    <div class="progress-step-number">{{ $loop->iteration }}</div>
                                                </div>
                                                <h6>{{ $phase->etat }}</h6>
                                            @endforeach
                                        </div>

                                        <!-- Stepper Content -->
                                        <div class="stepper-wrapper">
                                            @foreach($collecte->fluxDeDonnees->phases as $phase)
                                                <div class="stepper-item" id="step-{{ $loop->iteration }}" style="{{ $loop->first ? '' : 'display: none;' }}">


                                                    <div class="step-details">

                                                        @if($phase->output_images)
                                                            <!-- Bootstrap Carousel for Images -->
                                                            <div id="carouselPhase{{ $loop->iteration }}" class="carousel slide" data-bs-ride="carousel">
                                                            <p><strong >{{ $phase->output_description }}</strong> </p>

                                                                <div class="carousel-inner">
                                                                    @foreach($phase->output_images as $image)
                                                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                                            <img src="{{ asset('storage/output_images/' . $image) }}" alt="Image de l'output" class="d-block w-100" style="max-width: 600px;margin:0 auto; border-radius:10%;">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <div style="display:flex; justify-content:space-around;">
                                                                <button     style="background: linear-gradient(134.38deg, #f539f8, #c342f9 43.55%, #5356fb 104.51%);"
                                                                type="button" data-bs-target="#carouselPhase{{ $loop->iteration }}" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <div class="stepper-navigation mt-3" >
                                                                    <button class="btn bg radius" style="background-color:blue!important; color:white;padding:13px;" id="prevBtn" onclick="changeStep(-1)">Previous</button>
                                                                    <button class="btn bg radius" style="background-color:green!important; color:white;padding:13px;" id="nextBtn" onclick="changeStep(1)">Next</button>
                                                                </div>
                                                                <button     style="background: linear-gradient(134.38deg, #f539f8, #c342f9 43.55%, #5356fb 104.51%);"
                                                                type="button" data-bs-target="#carouselPhase{{ $loop->iteration }}" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
</div>

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>


                                    @else
                                        <!-- Message when no phases are available -->
                                        <p>not available ! try later</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let currentStep = 1;
    const totalSteps = {{ isset($collecte->fluxDeDonnees) ? $collecte->fluxDeDonnees->phases->count() : 0 }};

    function changeStep(stepChange) {
        console.log(`Current Step: ${currentStep}, Step Change: ${stepChange}`);

        if (totalSteps === 0) return;

        // Hide the current step
        document.getElementById('step-' + currentStep).style.display = 'none';
        document.getElementById('progress-step-' + currentStep).classList.add('visited');

        // Update the step counter
        currentStep += stepChange;

        // Ensure currentStep stays within bounds
        if (currentStep < 1) {
            currentStep = 1;
        } else if (currentStep > totalSteps) {
            currentStep = totalSteps;
        }

        // Show the new step
        document.getElementById('step-' + currentStep).style.display = 'block';

        // Highlight progress bar step
        document.getElementById('progress-step-' + currentStep).classList.add('visited');

        // Enable or disable the previous button
        document.getElementById('prevBtn').disabled = currentStep === 0;

        // Enable or disable the next button
        document.getElementById('nextBtn').disabled = currentStep === totalSteps;

        console.log(`Updated Step: ${currentStep}`);
    }
</script>

<style>
/* Stepper Progress Bar */
.progress-bar-wrapper {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.progress-bar-step {
    position: relative;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
}

.progress-bar-step.visited {
    background-color: #0d6efd; /* Bootstrap primary color */
    color: white;
}

.progress-bar-step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 100%;
    transform: translateY(-50%);
    width: 100%;
    height: 4px;
    background-color: #ccc;
    z-index: -1;
}

.progress-bar-step.visited:not(:last-child)::after {
    background-color: #0d6efd;
}

.progress-step-number {
    font-weight: bold;
    font-size: 14px;
    color: #fff;
}

/* Stepper Content */
.stepper-wrapper {
    margin-bottom: 30px;
}

.stepper-item {
    position: relative;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    margin-bottom: 20px;
}

.step-counter {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-bottom: 10px;
}

.step-name {
    font-size: 16px;
}

.step-details {
    text-align: left;
}

/* Carousel Styling */
.carousel-inner img {
    max-height: 400px;
    object-fit: contain;
}
</style>

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

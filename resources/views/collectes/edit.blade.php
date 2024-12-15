@include('Layout.Header')

<section class="nftmax-adashboard nftmax-show">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12 nftmax-main__column">
                <div class="nftmax-body">
                    <!-- Dashboard Inner -->
                    <div class="nftmax-dsinner">
                        <!-- All Notification Heading -->
                        <div class="nftmax-inner__heading">
                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                            <h2 class="nftmax-inner__page-title">Edit Collect: {{ $collecte->nom }}</h2>
                        </div>
                        <!-- End All Notification Heading -->

                        <div class="nftmax__item">
                            <form action="{{ route('collectes.update', $collecte->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-12">
                                        <div class="nftmax__item-box">
                                            <div class="row nftmax-pcolumn">
                                                <!-- Logo (Image) Upload section -->
                                                <div class="col-xxl-5 col-lg-5 col-12 nftmax-pcolumn__one">
                                                <label for="output_description" class="nftmax__item-label">Image</label>

                                                    <div class="nftmax__file-top">
                                                        <div class="nftmax__file-upload">
                                                            <div class="upload-files">
                                                                <div class="body" id="drop">
                                                                    <img class="nftmax__file-upload--img" src="../../assets/img/upload.png" alt="Upload Image">
                                                                    <p class="pointer-none nftmax__file-text"><b><a href="#" id="triggerFile">Browse</a></b></p>
                                                                    <input type="file" name="image" id="fileInput" class="form-control-file" accept="image/*" style="display: none;">
                                                                </div>

                                                                <div class="nftmax__file-updated">
                                                                    <div class="divider">
                                                                        <span>LOGO</span>
                                                                    </div>
                                                                    <div class="list-files"></div>
                                                                    <button class="importar">UPDATE IMAGE</button>
                                                                </div>

                                                                <!-- Display current image -->
                                                                @if ($collecte->image)
                                                                    <img src="{{ asset('storage/' . $collecte->image) }}" alt="Image" width="200" style="border-radius:50%;margin-left:60px;" class="mt-2">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Form inputs -->
                                                <div class="col-xxl-7 col-lg-7 col-12 nftmax-pcolumn__two">
                                                    <div class="nftmax__item-form--main">
                                                        <div class="nftmax__item-form--group ntfmax__item-form--radio">
                                                            <div class="ntfmax__item-radio--inner">
                                                                <div class="nftmax__item-form--group">
                                                                    <label for="nom" class="nftmax__item-label">Name</label>
                                                                    <input type="text" name="nom" class="nftmax__item-input" value="{{ $collecte->nom }}" placeholder="Enter collection name" required>
                                                                </div>

                                                                <div class="nftmax__item-form--group">
                                                                    <label for="etat" class="nftmax__item-label">State</label>
                                                                    <select name="etat" class="nftmax__item-input" required>
                                                                        @foreach(App\Enums\EtatCollecte::getValues() as $etat)
                                                                            <option value="{{ $etat }}" {{ $collecte->etat == $etat ? 'selected' : '' }}>{{ $etat }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="nftmax__item-form--group">
                                                                    <label for="type_dechet" class="nftmax__item-label">Waste Type</label>
                                                                    <select name="type_dechet" class="nftmax__item-input" required>
                                                                        @foreach(App\Enums\TypeDechet::getValues() as $type)
                                                                            <option value="{{ $type }}" {{ $collecte->type_dechet == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="nftmax__item-form--group">
                                                                    <label for="poids_contenu" class="nftmax__item-label">Content Weight (kg)</label>
                                                                    <input type="number" step="0.01" name="poids_contenu" class="nftmax__item-input" value="{{ $collecte->poids_contenu }}" placeholder="Enter weight">
                                                                </div>

                                                                <div class="nftmax__item-form--group">
                                                                    <label for="centre_de_recyclage" class="nftmax__item-label">Recycling Center</label>
                                                                    <select name="centre_de_recyclage_id" id="centre_de_recyclage" class="nftmax__item-input" required>
                                                                        @foreach($centres as $centre)
                                                                            <option value="{{ $centre->id }}" {{ $collecte->centre_de_recyclage_id == $centre->id ? 'selected' : '' }}>
                                                                                {{ $centre->nom }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <label for="output_description" class="nftmax__item-label">Output Images</label>
                                                                <div class="nftmax__file-upload">
                                                                    <div class="upload-files">
                                                                        <div class="body" id="outputDrop">
                                                                        @if($collecte->output && is_array($collecte->output) && count($collecte->output) > 0)
            <div class="output-images">
                @foreach ($collecte->output as $image)
                    <img src="{{ asset('storage/output_images/' . $image) }}" alt="Image de l'output" width="100" style="margin: 5px;">
                @endforeach
            </div>
        @else
            Aucune image
        @endif
                                                                            <p class="pointer-none nftmax__file-text"><b><a href="#" id="outputTriggerFile">Browse</a></b></p>
                                                                            <input type="file" name="output[]" id="outputFileInput" class="form-control-file" accept="image/*" multiple style="display: none;">
                                                                        </div>

                                                                        <div class="nftmax__file-updated">
                                                                            <div class="divider">
                                                                                <span>OUTPUT IMAGES</span>
                                                                            </div>
                                                                            <div class="list-files-output"></div>
                                                                            <button class="importar">UPDATE OUTPUT IMAGES</button>
                                                                        </div>


                                                                    </div>
                                                                </div>

                                                                <!-- Output description section -->
                                                                <div class="nftmax__item-form--group">
                                                                    <label for="output_description" class="nftmax__item-label">Output Description</label>
                                                                    <textarea name="output_description" class="nftmax__item-input" placeholder="Enter output description">{{ $collecte->output_description }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit button -->
                                            <div class="nftmax__item-button--group">
                                                <button type="submit" class="nftmax__item-button--single nftmax-btn nftmax-btn__bordered bg radius">Update Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- End of nftmax__item -->
                    </div> <!-- End of nftmax-dsinner -->
                </div> <!-- End of nftmax-body -->
            </div> <!-- End of col -->
        </div> <!-- End of row -->
    </div> <!-- End of container -->
</section>

@include('Layout.Footer')

<script>
    // Logo upload trigger
    document.getElementById('triggerFile').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('fileInput').click();
    });

    // Output image upload trigger
    document.getElementById('outputTriggerFile').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('outputFileInput').click();
    });

    // Update logo file list
    document.getElementById('fileInput').addEventListener('change', function() {
        const files = this.files;
        const fileList = document.querySelector('.list-files');
        fileList.innerHTML = '';
        for (let i = 0; i < files.length; i++) {
            const listItem = document.createElement('div');
            listItem.textContent = files[i].name;
            fileList.appendChild(listItem);
        }
    });

    // Update output file list
    document.getElementById('outputFileInput').addEventListener('change', function() {
        const files = this.files;
        const fileList = document.querySelector('.list-files-output');
        fileList.innerHTML = '';
        for (let i = 0; i < files.length; i++) {
            const listItem = document.createElement('div');
            listItem.textContent = files[i].name;
            fileList.appendChild(listItem);
        }
    });
</script>

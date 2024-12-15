@include('Layout.Header')

<section class="nftmax-adashboard nftmax-show">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12 nftmax-main__column">
                <div class="nftmax-body">
                    <div class="nftmax-dsinner">
                        <div class="nftmax-inner__heading">
                            <h2 class="nftmax-inner__page-title">Create new collect</h2>
                        </div>

                        <div class="nftmax__item">
                            <form action="{{ route('collectes.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="nftmax__item-box">
                                            <div class="row nftmax-pcolumn">
                                                <div class="col-xxl-5 col-lg-5 col-12 nftmax-pcolumn__one">
                                                    <div class="nftmax__file-top">
                                                        <div class="nftmax__file-upload">
                                                            <div class="upload-files">
                                                                <div class="body" id="drop">
                                                                    <img class="nftmax__file-upload--img" src="../../assets/img/upload.png" alt="hh">
                                                                    <p class="pointer-none nftmax__file-text"><b>Drop Image to upload <br> or <a href="#" id="triggerFile">Browse</a></b></p>
                                                                    <input type="file" name="image" id="fileInput" class="form-control-file" accept="image/*" style="display: none;">
                                                                </div>
                                                                <div class="nftmax__file-updated">
                                                                    <div class="divider">
                                                                        <span><AR>IMAGE</AR></span>
                                                                    </div>
                                                                    <div class="list-files"></div>
                                                                    <button class="importar">UPDATE IMAGE</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-7 col-lg-7 col-12 nftmax-pcolumn__two">
                                                    <div class="nftmax__item-form--main">
                                                        <div class="nftmax__item-form--group">
                                                            <label for="nom" class="nftmax__item-label">Name</label>
                                                            <input type="text" name="nom" class="nftmax__item-input" placeholder="Enter collection name" required>
                                                            @error('nom')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="nftmax__item-form--group">
                                                            <label for="etat" class="nftmax__item-label">State</label>
                                                            <select name="etat" class="nftmax__item-input" required>
                                                                <option value="" disabled selected>Select state</option>
                                                                @foreach(App\Enums\EtatCollecte::getValues() as $etat)
                                                                    <option value="{{ $etat }}">{{ $etat }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('etat')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="nftmax__item-form--group">
                                                            <label for="type_dechet" class="nftmax__item-label">Waste Type</label>
                                                            <select name="type_dechet" class="nftmax__item-input" required>
                                                                <option value="" disabled selected>Select waste type</option>
                                                                @foreach(App\Enums\TypeDechet::getValues() as $type)
                                                                    <option value="{{ $type }}">{{ $type }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('type_dechet')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="nftmax__item-form--group">
                                                            <label for="poids_contenu" class="nftmax__item-label">Content Weight (kg)</label>
                                                            <input type="number" step="0.01" name="poids_contenu" class="nftmax__item-input" placeholder="Enter weight">
                                                            @error('poids_contenu')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="nftmax__item-form--group">
                                                            <label for="centre_de_recyclage" class="nftmax__item-label">Recycling Center</label>
                                                            <select name="centre_de_recyclage_id" id="centre_de_recyclage" class="nftmax__item-input" required>
                                                                <option value="" disabled selected>Select recycling center</option>
                                                                @foreach($centres as $centre)
                                                                    <option value="{{ $centre->id }}" {{ (isset($collecte) && $collecte->centre_de_recyclage_id == $centre->id) ? 'selected' : '' }}>
                                                                        {{ $centre->nom }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('centre_de_recyclage_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nftmax__item-button--group">
                                                    <button class="nftmax__item-button--single nftmax-btn nftmax-btn__bordered bg radius " type="submit">Create Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('Layout.Footer')

<script>
    document.getElementById('triggerFile').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('fileInput').click();
    });

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
</script>

@extends('layouts.master')
{{-- <script src='//pchen66.github.io/js/three/three.min.js'></script>
<script src='//pchen66.github.io/js/panolens/panolens.min.js'></script>

<style>
    .image-container {
        height: 20rem;
        width: 20rem;
        object-fit: cover;
    }

    .image-container:before {
        content: attr(data-image);
    }
</style> --}}
@section('content')

@section('breadcrumb')
Project Type / Create
@endsection

<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="card-title">Create Project Type</h4>
                        </div>
                    </div>
                    @if(session('error'))
                    <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('projectType.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Project Selected</label>
                                        <select id="countries" name="id_project" required
                                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5">
                                            <option selected>Choose Project Type</option>
                                            @foreach ($projectId as $tj)
                                            <option value="{{ $tj->id }}">{{$tj->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('id_project')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name"
                                            class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                                            required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Small Description</label>
                                        <input type="text" id="small_description" name="small_description"
                                            class="form-control @error('small_description') is-invalid @enderror"
                                            placeholder="Small Description" required>
                                        @error('small_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Image</label>
                                        <div class="grid grid-cols-6">
                                            <img id="image_display" class="object-cover"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{asset('assets/img/no-photo.png')}}" alt="image description">
                                        </div>
                                        <input type="file" name="image" id="file_input"
                                            class="form-control mt-2 @error('image') is-invalid @enderror" />
                                        <small class="text-muted">Please choose an image to upload.</small>
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Image 360°</label>
                                        <br>
                                        <small class="text-muted">Please choose an image to upload.</small>
                                        <div class="grid grid-cols-6 test">
                                            <div class='image-container' id="panoramaImage"></div>
                                        </div>
                                        <br>
                                        <input type="file" name="image_360" id="file_input7"
                                            class="form-control mt-2 @error('image_360') is-invalid @enderror" />
                                        @error('image_360')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Luas Bangunan</label>
                                        <input type="text" id="luas_bangunan" name="luas_bangunan"
                                            class="form-control @error('luas_bangunan') is-invalid @enderror"
                                            placeholder="Luas bangunan" required>
                                        @error('luas_bangunan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Luas Tanah</label>
                                        <input type="text" id="luas_tanah" name="luas_tanah"
                                            class="form-control @error('luas_tanah') is-invalid @enderror"
                                            placeholder="Luas Tanah" required>
                                        @error('luas_tanah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fondasi</label>
                                        <input type="text" id="fondasi" name="fondasi"
                                            class="form-control @error('fondasi') is-invalid @enderror"
                                            placeholder="Fondasi" required>
                                        @error('fondasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Dinding</label>
                                        <input type="text" id="dinding" name="dinding"
                                            class="form-control @error('dinding') is-invalid @enderror"
                                            placeholder="Dinding" required>
                                        @error('dinding')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Plafon</label>
                                        <input type="text" id="plafon" name="plafon"
                                            class="form-control @error('plafon') is-invalid @enderror"
                                            placeholder="Plafon" required>
                                        @error('plafon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Kamar Tidur</label>
                                        <input type="text" id="kamar_tidur" name="kamar_tidur"
                                            class="form-control @error('kamar_tidur') is-invalid @enderror"
                                            placeholder="Kamar Tidur" required>
                                        @error('kamar_tidur')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Kamar Mandi</label>
                                        <input type="text" id="kamar_mandi" name="kamar_mandi"
                                            class="form-control @error('kamar_mandi') is-invalid @enderror"
                                            placeholder="Kamar Mandi" required>
                                        @error('kamar_mandi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Carport</label>
                                        <input type="text" id="carport" name="carport"
                                            class="form-control @error('carport') is-invalid @enderror"
                                            placeholder="Carport" required>
                                        @error('carport')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Air</label>
                                        <input type="text" id="air" name="air"
                                            class="form-control @error('air') is-invalid @enderror" placeholder="air"
                                            required>
                                        @error('air')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success" type="submit"><i
                                            class="bi bi-save mx-1"></i>Submit</button>
                                    <a href="/projectType" class="btn btn-info text-white"><i
                                            class="bi bi-arrow-return-left mx-1"></i>Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jquery')
<script>
    const fileInput = document.getElementById('file_input');
    const imageDisplay = document.getElementById('image_display');

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imageDisplay.src = e.target.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    });

</script>
{{-- <script type="text/javascript">
    const d = document;
    d.addEventListener('DOMContentLoaded', () => {
        const viewer = new PANOLENS.Viewer({
            'container': d.querySelector('.image-container')
        });

        const panoramaImage = d.getElementById('panoramaImage');
        const fileInput = d.getElementById('file_input7');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const imageUrl = e.target.result;
                panoramaImage.src = imageUrl;

                viewer.dispose();
                viewer.add(new PANOLENS.ImagePanorama(imageUrl));
            }

            reader.readAsDataURL(file);
        });
    });
</script> --}}
@endsection
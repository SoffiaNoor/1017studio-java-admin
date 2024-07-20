@extends('layouts.master')

@section('content')

@section('breadcrumb')
Project Type / Edit / {{$projectType->id}}
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
                            <h4 class="card-title">Edit Project Type</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('projectType.update', $projectType->id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Project Type Selected</label>
                                        <select id="id_project" name="id_project" required
                                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5">
                                            <option value="{{ $projectType->projectTypes->id }}" selected>
                                                {{$projectType->projectTypes->title}}
                                            </option>
                                            @foreach ($projectImageAll as $tj)
                                            @if ($tj->id != $projectType->projectTypes->id)
                                            <option value="{{ $tj->id }}">{{ $tj->title }}</option>
                                            @endif
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
                                        <input type="text" id="name" name="name" value="{{$projectType->name}}"
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
                                            value="{{$projectType->small_description}}"
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
                                            @if($projectType->image)
                                            <img id="image_display" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{asset($projectType->image)}}">
                                            @else
                                            <img id="image_display" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{ asset('assets/img/no-photo.png') }}">
                                            @endif
                                        </div>
                                        <input type="file"
                                            class="form-control mt-3 @error('image') is-invalid @enderror"
                                            id="file_input" name="image" value="">
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
                                        <label style="color:black"> Image 360</label>
                                        <div class="grid grid-cols-6">
                                            @if($projectType->image_360)
                                            <img id="image_display2" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{asset($projectType->image_360)}}">
                                            @else
                                            <img id="image_display2" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{ asset('assets/img/no-photo.png') }}">
                                            @endif
                                        </div>
                                        <input type="file"
                                            class="form-control mt-3 @error('image_360') is-invalid @enderror"
                                            id="file_input2" name="image_360" value="">
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
                                            value="{{$projectType->luas_bangunan}}"
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
                                            value="{{$projectType->luas_tanah}}"
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
                                        <input type="text" id="fondasi" name="fondasi" value="{{$projectType->fondasi}}"
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
                                        <input type="text" id="dinding" name="dinding" value="{{$projectType->dinding}}"
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
                                        <input type="text" id="plafon" name="plafon" value="{{$projectType->plafon}}"
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
                                            value="{{$projectType->kamar_tidur}}"
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
                                            value="{{$projectType->kamar_mandi}}"
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
                                        <input type="text" id="carport" name="carport" value="{{$projectType->carport}}"
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
                                        <input type="text" id="air" name="air" value="{{$projectType->air}}"
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
                                    <button class="btn btn-success text-white" type="submit"><i
                                            class="bi bi-save mx-1"></i>Save</button>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script>
    var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
</script>
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

    // const fileInput2 = document.getElementById('file_input2');
    // const imageDisplay2 = document.getElementById('image_display2');

    // fileInput2.addEventListener('change', function() {
    //     if (fileInput2.files.length > 0) {
    //         const reader2 = new FileReader();
    //         reader2.onload = function(e) {
    //             imageDisplay2.src = e.target.result;
    //         };
    //         reader2.readAsDataURL(fileInput2.files[0]);
    //     }
    // });

    const fileInput3 = document.getElementById('file_input3');
    const imageDisplay3 = document.getElementById('image_display3');

    fileInput3.addEventListener('change', function() {
        if (fileInput3.files.length > 0) {
            const reader3 = new FileReader();
            reader3.onload = function(e) {
                imageDisplay3.src = e.target.result;
            };
            reader3.readAsDataURL(fileInput3.files[0]);
        }
    });

    const fileInput7 = document.getElementById('file_input7');
    const imageDisplay7 = document.getElementById('image_display7');

    fileInput7.addEventListener('change', function() {
        if (fileInput7.files.length > 0) {
            const reader7 = new FileReader();
            reader7.onload = function(e) {
                imageDisplay7.src = e.target.result;
            };
            reader7.readAsDataURL(fileInput7.files[0]);
        }
    });
</script>
@endsection
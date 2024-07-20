@extends('layouts.master')
{{-- <script src='//pchen66.github.io/js/three/three.min.js'></script>
<script src='//pchen66.github.io/js/panolens/panolens.min.js'></script>

<style>
    .image-container {
        height: 40rem;
    }

    .image-container:before {
        content: attr(data-image);
    }
</style> --}}
@section('content')

@section('breadcrumb')
Project / Detail / {{$projectType->id}}
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
                            <h4 class="card-title">Detail Project {{$projectType->id}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Project Selected</label>
                                        <select id="countries" name="id_projectType" disabled
                                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5">
                                            <option selected>{{$projectType->projectTypes->title}}</option>
                                        </select>
                                        @error('id_projectType')
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
                                            disabled>
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
                                            placeholder="Small Description" disabled>
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
                                                src="{{ asset($projectType->image) }}" alt="image description">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Image 360°</label>
                                        <div class="grid grid-cols-6">
                                            @if($projectType->image_360)
                                            <div class='image-container'></div>
                                            @else
                                            <img class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{ asset('assets/img/no-photo.png') }}">
                                            @endif
                                        </div>
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
                                            placeholder="Luas bangunan" disabled>
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
                                            placeholder="Luas Tanah" disabled>
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
                                            placeholder="Fondasi" disabled>
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
                                            placeholder="Dinding" disabled>
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
                                            placeholder="Plafon" disabled>
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
                                            placeholder="Kamar Tidur" disabled>
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
                                            placeholder="Kamar Mandi" disabled>
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
                                            placeholder="Carport" disabled>
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
                                            disabled>
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
                                    <a href="{{ route('projectType.edit', $projectType->id) }}"
                                        class="btn btn-primary text-white" type="submit"><i
                                            class="bi bi-pencil mx-1"></i>Edit</a>
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
{{-- <script type="text/javascript">
    @if($projectType->image_360)

    const d = document;
    d.addEventListener('DOMContentLoaded', () => {
        const viewer = new PANOLENS.Viewer({
            'container': d.querySelector('.image-container')
        });

        const images = ['{{ asset($projectType->image_360) }}'];

        viewer.add(new PANOLENS.ImagePanorama(images[0]));

        d.querySelector('button').addEventListener('click', e => {
            e.target.dataset.index = 1 - e.target.dataset.index;
            let imgpath = images[Number(e.target.dataset.index)];
            viewer.dispose();
            viewer.add(new PANOLENS.ImagePanorama(imgpath));
        })
    })
    @else
    @endif
</script> --}}
@endsection
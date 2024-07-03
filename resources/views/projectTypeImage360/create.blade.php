@extends('layouts.master')
<script src='//pchen66.github.io/js/three/three.min.js'></script>
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
</style>
@section('content')

@section('breadcrumb')
Project Image / Create
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
                            <h4 class="card-title">Create Project Image 360</h4>
                        </div>
                    </div>
                    @if(session('error'))
                    <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('projectTypeImage360.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Project Selected</label>
                                        <select id="countries" name="id_project_type" required
                                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5">
                                            <option selected>Choose Project Type</option>
                                            @foreach ($projectId as $tj)
                                            <option value="{{ $tj->id }}">{{$tj->name}} - {{$tj->projectTypes->title}}</option>
                                            @endforeach
                                        </select>
                                        @error('id_project_type')
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
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success" type="submit"><i
                                            class="bi bi-save mx-1"></i>Submit</button>
                                    <a href="/projectTypeImage360" class="btn btn-info text-white"><i
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
<script type="text/javascript">
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
</script>
@endsection
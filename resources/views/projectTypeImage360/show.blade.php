@extends('layouts.master')
<script src='//pchen66.github.io/js/three/three.min.js'></script>
<script src='//pchen66.github.io/js/panolens/panolens.min.js'></script>

<style>
    .image-container {
        height: 40rem;
    }

    .image-container:before {
        content: attr(data-image);
    }
</style>
@section('content')

@section('breadcrumb')
    Project Type Image / Detail / {{$projectType->id}}
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
                            <h4 class="card-title">Detail Project Type Image 360 {{$projectType->id}}</h4>
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
                                        <label style="color:black">Project Type Selected</label>
                                        <select id="id_project_type" name="id_project_type" disabled
                                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5">
                                            <option value="{{ $projectType->id_project_type }}" selected disabled>
                                                {{$projectType->projectType->name}}</option>
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
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('projectTypeImage360.edit', $projectType->id) }}" class="btn btn-primary text-white"
                                        type="submit"><i class="bi bi-pencil mx-1"></i>Edit</a>
                                    <a href="/projectTypeImage" class="btn btn-info text-white"><i
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
<script type="text/javascript">
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
</script>
@endsection
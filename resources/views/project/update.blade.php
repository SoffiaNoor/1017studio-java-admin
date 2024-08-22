@extends('layouts.master')

@section('content')

@section('breadcrumb')
Project / Edit / {{$project->id}}
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
                            <h4 class="card-title">Edit Project</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('project.update', $project->id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="title" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="title" value="{{$project->title}}" required>
                                        @error('title')
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
                                            @if($project->image)
                                            <img id="image_display" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{asset($project->image)}}">
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black"> Header Image <span class="text-muted">(Image should be 3360px x 828px.)</span></label>
                                        <div class="grid grid-cols-6">
                                            @if($project->header_image)
                                            <img id="image_display2" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{asset($project->header_image)}}">
                                            @else
                                            <img id="image_display2" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{ asset('assets/img/no-photo.png') }}">
                                            @endif
                                        </div>
                                        <input type="file"
                                            class="form-control mt-3 @error('header_image') is-invalid @enderror"
                                            id="file_input2" name="header_image" value="">
                                        @error('header_image')
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
                                        <label>Description</label>
                                        <div id="editor1"></div>
                                        <textarea class="@error('description') is-invalid @enderror" name="description"
                                            style="display:none;">{{$project->description}}</textarea>
                                        @error('description')
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
                                        <label style="color:black">Siteplan</label>
                                        <div class="grid grid-cols-6">
                                            @if($project->siteplan)
                                            <img id="image_display3" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{asset($project->siteplan)}}">
                                            @else
                                            <img id="image_display3" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{ asset('assets/img/no-photo.png') }}">
                                            @endif
                                        </div>
                                        <input type="file"
                                            class="form-control mt-3 @error('siteplan') is-invalid @enderror"
                                            id="file_input3" name="siteplan" value="">
                                        @error('siteplan')
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
                                        <label>Location</label>
                                        <input type="text" name="location"
                                            class="form-control @error('location') is-invalid @enderror"
                                            placeholder="Location" value="{{$project->location}}">
                                        @error('location')
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
                                    <a href="/project" class="btn btn-info text-white"><i
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

    const fileInput2 = document.getElementById('file_input2');
    const imageDisplay2 = document.getElementById('image_display2');

    fileInput2.addEventListener('change', function() {
        if (fileInput2.files.length > 0) {
            const reader2 = new FileReader();
            reader2.onload = function(e) {
                imageDisplay2.src = e.target.result;
            };
            reader2.readAsDataURL(fileInput2.files[0]);
        }
    });

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
</script>

<!-- Include pell CSS and JS from CDN -->
<link rel="stylesheet" href="https://unpkg.com/pell/dist/pell.min.css">
<script src="https://unpkg.com/pell"></script>

<script>
    @foreach(['description'] as $fieldName)
        const editor = pell.init({
            element: document.getElementById('editor{{$loop->iteration}}'),
            onChange: function (html) {
                document.querySelector(`textarea[name="{{$fieldName}}"]`).value = html;
            },
            styleWithCSS: true,
            actions: [
                'bold',
                'italic',
                'underline',
                'strikethrough',
                'heading1',
                'heading2',
                'paragraph',
                'quote',
                'olist',
                'ulist',
                {
                    name: 'left',
                    icon: '<i class="fa fa-align-left" aria-hidden="true"></i>',
                    title: 'Left Align',
                    result: () => pell.exec('justifyLeft')
                },
                {
                    name: 'center',
                    icon: '<i class="fa fa-align-center" aria-hidden="true"></i>',
                    title: 'Center Align',
                    result: () => pell.exec('justifyCenter')
                },
                {
                    name: 'right',
                    icon: '<i class="fa fa-align-right" aria-hidden="true"></i>',
                    title: 'Right Align',
                    result: () => pell.exec('justifyRight')
                },
                {
                    name: 'justify',
                    icon: '<i class="fa fa-align-justify" aria-hidden="true"></i>',
                    title: 'Justify',
                    result: () => pell.exec('justifyFull')
                }
            ]
        });

        // Set initial content
        editor.content.innerHTML = `{!! $project[$fieldName] !!}`;
    @endforeach
</script>
@endsection
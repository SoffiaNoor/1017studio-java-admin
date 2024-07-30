@extends('layouts.master')

@section('content')

@section('breadcrumb')
Website Information
@endsection
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #e26111;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #e26111;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                @if(session('success'))
                <div class="alert alert-success m-2" style="color:white;font-weight:bold;background:#31a72b!important">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                    {{ session('error') }}
                </div>
                @endif
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title title">Website Information</h4>
                        <a class="btn btn-primary" href="{{ route('information.edit', $information->id) }}">
                            <i class="bi bi-pencil mx-1"></i>Change Profile
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="color:black">Header Logo</label>
                                    <div class="grid grid-cols-6">
                                        @if($information->logo_header)
                                        <div class="p-3 shadow-lg text-center"
                                            style="background-color: #3c2a22;border-radius:20px">
                                            <img id="image_display" class="object-contain items-center"
                                                style="width:auto;height:10rem;object-fit:cover"
                                                src="{{asset($information->logo_header)}}">
                                        </div>
                                        @else
                                        <img id="image_display" class="object-contain items-center"
                                            style="width:10rem;height:10rem;object-fit:cover"
                                            src="{{ asset('assets/img/no-photo.png') }}">
                                        @endif
                                    </div>
                                    <input type="file" class="form-control mt-3" id="file_input" name="logo_header"
                                        value="" disabled>
                                    @error('logo_header')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="color:black">Favicon Logo</label>
                                    <div class="grid grid-cols-6">
                                        @if($information->logo_favicon)
                                        <div class="p-3 shadow-lg text-center"
                                            style="background-color: #c7c7c7;border-radius:20px">
                                            <img id="image_display2" class="object-contain items-center"
                                                style="width:auto;height:10rem;object-fit:cover"
                                                src="{{asset($information->logo_favicon)}}">
                                        </div>
                                        @else
                                        <img id="image_display" class="object-contain items-center"
                                            style="width:10rem;height:10rem;object-fit:cover"
                                            src="{{ asset('assets/img/no-photo.png') }}">
                                        @endif
                                    </div>
                                    <input type="file" class="form-control mt-3" id="file_input2" name="logo_favicon"
                                        value="" disabled>
                                    @error('logo_favicon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="color:black">Company Logo</label>
                                    <div class="grid grid-cols-6">
                                        @if($information->logo_company)
                                        <div class="p-3 shadow-lg text-center"
                                            style="background-color: #c7c7c7;border-radius:20px">
                                            <img id="image_display3" class="object-contain items-center"
                                                style="width:auto;height:10rem;object-fit:cover"
                                                src="{{asset($information->logo_company)}}">
                                        </div>
                                        @else
                                        <img id="image_display3" class="object-contain items-center"
                                            style="width:10rem;height:10rem;object-fit:cover"
                                            src="{{ asset('assets/img/no-photo.png') }}">
                                        @endif
                                    </div>
                                    <input type="file" class="form-control mt-3" id="file_input3" name="logo_company"
                                        value="" disabled>
                                    @error('logo_company')
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
                                    <label>About Us Image</label>
                                    <div class="grid grid-cols-6">
                                        @if($information->image)
                                        <div class="p-3 shadow-lg text-center"
                                            style="background-color: #c7c7c7;border-radius:20px">
                                            <img id="image_display3" class="object-contain items-center"
                                                style="width:auto;height:10rem;object-fit:cover"
                                                src="{{asset($information->image)}}">
                                        </div>
                                        @else
                                        <img id="image_display3" class="object-contain items-center"
                                            style="width:10rem;height:10rem;object-fit:cover"
                                            src="{{ asset('assets/img/no-photo.png') }}">
                                        @endif
                                    </div>
                                    <input type="file" class="form-control mt-3" id="file_input3" name="image" value=""
                                        disabled>
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
                                    <label>Header Image</label>
                                    <div class="grid grid-cols-6">
                                        @if($information->header_image)
                                        <div class="p-3 shadow-lg text-center"
                                            style="background-color: #c7c7c7;border-radius:20px">
                                            <img id="image_display6" class="object-contain items-center"
                                                style="width:auto;height:10rem;object-fit:cover"
                                                src="{{asset($information->header_image)}}">
                                        </div>
                                        @else
                                        <img id="image_display6" class="object-contain items-center"
                                            style="width:10rem;height:10rem;object-fit:cover"
                                            src="{{ asset('assets/img/no-photo.png') }}">
                                        @endif
                                    </div>
                                    <input type="file" class="form-control mt-3" id="file_input6" name="header_image"
                                        value="" disabled>
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
                                    <label>Footer Image</label>
                                    <div class="grid grid-cols-6">
                                        @if($information->footer_image)
                                        <div class="p-3 shadow-lg text-center"
                                            style="background-color: #c7c7c7;border-radius:20px">
                                            <img id="image_display6" class="object-contain items-center"
                                                style="width:auto;height:10rem;object-fit:cover"
                                                src="{{asset($information->footer_image)}}">
                                        </div>
                                        @else
                                        <img id="image_display6" class="object-contain items-center"
                                            style="width:10rem;height:10rem;object-fit:cover"
                                            src="{{ asset('assets/img/no-photo.png') }}">
                                        @endif
                                    </div>
                                    <input type="file" class="form-control mt-3" id="file_input6" name="footer_image"
                                        value="" disabled>
                                    @error('footer_image')
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
                                    <label>Header Video (YouTube Link)</label>
                                    <div class="grid grid-cols-6">
                                        <div id="header_video_container">
                                            @if($information->header_video)
                                            <iframe width="100%" height="100%" id="header_video_display" type="hidden"
                                                src="https://www.youtube.com/embed/{{ $information->header_video }}?autoplay=1&loop=1&playlist={{ $information->header_video }}"
                                                frameborder="0" allow="autoplay; loop; encrypted-media"
                                                allowfullscreen></iframe>
                                            @else
                                            <img id="video_display2" class="object-contain items-center"
                                                style="width:20rem;height:10rem;object-fit:cover"
                                                src="{{ asset('assets/img/no-video.png') }}">
                                            @endif
                                        </div>
                                    </div>
                                    <input type="text"
                                        class="form-control mt-3 @error('header_video') is-invalid @enderror"
                                        id="header_video_input" placeholder="Enter YouTube Video Link"
                                        value="https://www.youtube.com/embed/{{ $information->header_video }}" disabled>
                                    <input type="hidden" id="header_video" name="header_video"
                                        value="{{$information->header_video}}" disabled>
                                    @error('header_video')
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
                                    <label>About Us Video (YouTube Link) (*optional)</label>
                                    <div class="grid grid-cols-6">
                                        <div id="video_container">
                                            @if($information->video)
                                            {!! $information->video !!}
                                            @else
                                            <img id="video_display" class="object-contain items-center"
                                                style="width:20rem;height:10rem;object-fit:cover"
                                                src="{{ asset('assets/img/no-video.png') }}">
                                            @endif
                                        </div>
                                    </div>
                                    <input type="text" class="form-control mt-3 @error('video') is-invalid @enderror"
                                        id="video" name="video" value="{{$information->video}}"
                                        placeholder="Enter YouTube Video Link" disabled>
                                    @error('video')
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
                                    <label>Company Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Company Name" value="{{$information->name}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="10" name="description" id="description" cols="80"
                                        class="form-control" placeholder="Company Description" value="Mike"
                                        disabled>{{$information->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Home Address"
                                        value="{{$information->address}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" placeholder="Country"
                                        value="{{$information->phone}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="url" name="instagram" id="instagram" class="form-control"
                                        placeholder="Put your instagram link here..."
                                        value="{{$information->instagram}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Youtube</label>
                                    <input type="url" name="youtube" id="youtube" class="form-control"
                                        placeholder="Put your youtube link here..." value="{{$information->youtube}}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="url" name="facebook" id="facebook" class="form-control"
                                        placeholder="Put your facebook link here..." value="{{$information->facebook}}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tiktok</label>
                                    <input type="url" name="tiktok" id="tiktok" class="form-control"
                                        placeholder="Put your tiktok link here..." value="{{$information->tiktok}}"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Google Map</label>
                                    <input type="text" class="form-control" placeholder="Home Address"
                                        value="{{$information->google_map}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Order Whatsapp Message</label>
                                    <input type="text" class="form-control" placeholder="I want to order..."
                                        value="{{$information->order_wa}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Maintenance</label>
                                </div>
                            </div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" id="maintenance" name="maintenance"
                                value="{{$information->maintenance}}" {{ $information->maintenance == 1 ? 'checked' : ''
                            }} disabled>
                            <span class="slider round"></span>
                        </label>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image" style="height: 300px">
                    <img src="{{asset($information->image)}}" alt="..." style="width:100%">
                </div>
                <div class="card-body">
                    <h5 class="title">{{$information->name}}</h5>
                    <p>{{$information->description}}
                    </p>
                </div>
                <hr>
                <div class="button-container px-5" style="background: #e06500">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                @if(!empty($information->youtube))
                                <div class="col-sm-3 py-2 px-2">
                                    <a href="{{$information->youtube}}" target="_blank">
                                        <img src="{{asset('assets/img/Logo yt.png')}}" style="width:20%" />
                                    </a>
                                </div>
                                @endif
                                @if(!empty($information->facebook))
                                <div class="col-sm-3 py-2 px-2">
                                    <a href="{{$information->facebook}}" target="_blank">
                                        <img src="{{asset('assets/img/Logo fb.png')}}" style="width:13%" />
                                    </a>
                                </div>
                                @endif
                                @if(!empty($information->tiktok))
                                <div class="col-sm-3 py-2 px-2">
                                    <a href="{{$information->tiktok}}" target="_blank">
                                        <img src="{{asset('assets/img/Logo tiktok.png')}}" style="width:20%" />
                                    </a>
                                </div>
                                @endif
                                @if(!empty($information->instagram))
                                <div class="col-sm-3 py-2 px-2">
                                    <a href="{{$information->instagram}}" target="_blank">
                                        <img src="{{asset('assets/img/Logo ig.png')}}" style="width:20%" />
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jquery')
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

    const fileInput6 = document.getElementById('file_input6');
    const imageDisplay6 = document.getElementById('image_display6');

    fileInput6.addEventListener('change', function() {
        if (fileInput6.files.length > 0) {
            const reader6 = new FileReader();
            reader6.onload = function(e) {
                imageDisplay6.src = e.target.result;
            };
            reader6.readAsDataURL(fileInput6.files[0]);
        }
    });
</script>
@endsection
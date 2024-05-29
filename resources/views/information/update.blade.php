@extends('layouts.master')

@section('content')

@section('breadcrumb')
Website Information / Edit
@endsection

<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        @if(session('success'))
        <div class="alert alert-success m-2" style="color:white;font-weight:bold">
          {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
          {{ session('error') }}
        </div>
        @endif
        <form method="POST" action="{{ route('information.update',$information->id)}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="card-title title">Website Information</h4>
              <div class="row mr-1">
                <div class="d-flex justify-content-between align-items-center">
                  <a href="/information" class="btn btn-info text-white"><i
                      class="bi bi-arrow-return-left mx-1"></i>Back</a>
                  <button class="btn btn-success" type="submit">
                    <i class="bi bi-pencil mx-1"></i>Save Changes
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label style="color:black">Header Logo</label>
                  <div class="grid grid-cols-6">
                    @if($information->logo_header)
                    <div class="p-3 shadow-lg text-center" style="background-color: #3c2a22;border-radius:20px">
                      <img id="image_display" class="object-contain items-center"
                        style="width:auto;height:10rem;object-fit:cover" src="{{asset($information->logo_header)}}">
                    </div>
                    @else
                    <div class="p-3 shadow-lg text-center" style="background-color: #c7c7c7;border-radius:20px">
                      <img id="image_display" class="object-contain items-center"
                        style="width:10rem;height:10rem;object-fit:cover" src="{{ asset('assets/img/no-photo.png') }}">
                    </div>
                    @endif
                  </div>
                  <input type="file" class="form-control mt-3 @error('logo_header') is-invalid @enderror"
                    id="file_input" name="logo_header" value="">
                  <small class="text-muted">Please choose an image to upload.</small>
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
                    <div class="p-3 shadow-lg text-center" style="background-color: #c7c7c7;border-radius:20px">
                      <img id="image_display2" class="object-contain items-center"
                        style="width:auto;height:10rem;object-fit:cover" src="{{asset($information->logo_favicon)}}">
                    </div>
                    @else
                    <div class="p-3 shadow-lg text-center" style="background-color: #c7c7c7;border-radius:20px">
                      <img id="image_display2" class="object-contain items-center"
                        style="width:10rem;height:10rem;object-fit:cover" src="{{ asset('assets/img/no-photo.png') }}">
                    </div>
                    @endif
                  </div>
                  <input type="file" class="form-control mt-3 @error('logo_favicon') is-invalid @enderror"
                    id="file_input2" name="logo_favicon" value="">
                  <small class="text-muted">Please choose an image to upload.</small>
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
                    <div class="p-3 shadow-lg text-center" style="background-color: #c7c7c7;border-radius:20px">
                      <img id="image_display3" class="object-contain items-center"
                        style="width:auto;height:10rem;object-fit:cover" src="{{asset($information->logo_company)}}">
                    </div>
                    @else
                    <div class="p-3 shadow-lg text-center" style="background-color: #c7c7c7;border-radius:20px">
                      <img id="image_display3" class="object-contain items-center"
                        style="width:10rem;height:10rem;object-fit:cover" src="{{ asset('assets/img/no-photo.png') }}">
                    </div>
                    @endif
                  </div>
                  <input type="file" class="form-control mt-3 @error('logo_company') is-invalid @enderror"
                    id="file_input3" name="logo_company" value="">
                  <small class="text-muted">Please choose an image to upload.</small>
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
                  <label style="color:black">About Us Image</label>
                  <div class="grid grid-cols-6">
                    @if($information->image)
                    <div class="p-3 shadow-lg text-center" style="background-color: #c7c7c7;border-radius:20px">
                      <img id="image_display4" class="object-contain items-center"
                        style="width:auto;height:10rem;object-fit:cover" src="{{asset($information->image)}}">
                    </div>
                    @else
                    <div class="p-3 shadow-lg text-center" style="background-color: #c7c7c7;border-radius:20px">
                      <img id="image_display4" class="object-contain items-center"
                        style="width:10rem;height:10rem;object-fit:cover" src="{{ asset('assets/img/no-photo.png') }}">
                    </div>
                    @endif
                  </div>
                  <input type="file" class="form-control mt-3 @error('image') is-invalid @enderror" id="file_input4"
                    name="image" value="">
                  <small class="text-muted">Please choose an image to upload.</small>
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
                  <label>About Us Video (YouTube Link)</label>
                  <div class="grid grid-cols-6">
                    <div id="video_container">
                      @if($information->video)
                      {!! $information->video !!}
                      @else
                      <img id="video_display" class="object-contain items-center"
                        style="width:20rem;height:10rem;object-fit:cover" src="{{ asset('assets/img/no-video.png') }}">
                      @endif
                    </div>
                  </div>
                  <input type="text" class="form-control mt-3 @error('video') is-invalid @enderror" id="video"
                    name="video" value="{{$information->video}}" placeholder="Enter YouTube Video Link">
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
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Company Name" value="{{$information->name}}">
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
                  <label>Description</label>
                  <textarea rows="10" name="description" id="description" cols="80"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Company Description">{{$information->description}}</textarea>
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
                  <label>Address</label>
                  <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                    placeholder="Home Address" value="{{$information->address}}">
                  @error('address')
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
                  <label>Phone</label>
                  <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    placeholder="Country" value="{{$information->phone}}">
                  @error('phone')
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
                  <label>Instagram</label>
                  <input type="url" name="instagram" id="instagram"
                    class="form-control @error('instagram') is-invalid @enderror"
                    placeholder="Put your instagram link here..." value="{{$information->instagram}}">
                  @error('instagram')
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
                  <label>Youtube</label>
                  <input type="url" name="youtube" id="youtube"
                    class="form-control @error('youtube') is-invalid @enderror"
                    placeholder="Put your youtube link here..." value="{{$information->youtube}}">
                  @error('youtube')
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
                  <label>Facebook</label>
                  <input type="url" name="facebook" id="facebook"
                    class="form-control @error('facebook') is-invalid @enderror"
                    placeholder="Put your facebook link here..." value="{{$information->facebook}}">
                  @error('facebook')
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
                  <label>Tiktok</label>
                  <input type="url" name="tiktok" id="tiktok" class="form-control @error('tiktok') is-invalid @enderror"
                    placeholder="Put your tiktok link here..." value="{{$information->tiktok}}">
                  @error('tiktok')
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
                  <label>Google Map</label>
                  <input type="text" name="google_map" class="form-control @error('google_map') is-invalid @enderror"
                    placeholder="Home Address" value="{{$information->google_map}}">
                  @error('google_map')
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
                  <label>Order Whatsapp Message</label>
                  <input type="text" class="form-control @error('order_wa') is-invalid @enderror" name="order_wa"
                    placeholder="I want to order..." value="{{$information->order_wa}}">
                  @error('order_wa')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-user">
      <div class="image">
        <img src="{{asset($information->image)}}" alt="..." style="width: 100%;">
      </div>
      <div class="card-body">
        <a href="#">
          <h5 class="title">{{$information->name}}</h5>
        </a>
        <p class="description">
          {{$information->slogan}}
        </p>
        <iframe data-aos="fade-up" data-aos-duration="1000" src="{{$information->google_map}}" width="100%" height="300"
          style="border:0; max-width: 100%; height: 500;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
      <hr>
      <div class="button-container">
        <a href="{{$information->google_map}}" target="__" class="btn btn-neutral btn-icon btn-round btn-lg">
          <i class="bi bi-house-door-fill"></i>
        </a>
        <a href="{{$information->link_wa}}" target="__" class="btn btn-neutral btn-icon btn-round btn-lg">
          <i class="bi bi-telephone-fill"></i>
        </a>
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

    const fileInput4 = document.getElementById('file_input4');
    const imageDisplay4 = document.getElementById('image_display4');

    fileInput4.addEventListener('change', function() {
        if (fileInput4.files.length > 0) {
            const reader4 = new FileReader();
            reader4.onload = function(e) {
                imageDisplay4.src = e.target.result;
            };
            reader4.readAsDataURL(fileInput4.files[0]);
        }
    });

    document.getElementById('video').addEventListener('input', function () {
        var youtubeLink = this.value.trim();
        var videoContainer = document.getElementById('video_container');

        if (youtubeLink === '') {
            videoContainer.innerHTML = '<img id="video_display" class="object-contain items-center" style="width:20rem;height:10rem;object-fit:cover" src="{{ asset('assets/img/no-video.png') }}">';
        } else {
            var videoId = extractVideoId(youtubeLink);
            if (videoId) {
                videoContainer.innerHTML = '<iframe id="video_display" width="560" height="315" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe>';
            } else {
                videoContainer.innerHTML = '<p class="text-danger">Invalid YouTube link</p>';
            }
        }
    });

    function extractVideoId(url) {
        var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);
        if (match && match[2].length === 11) {
            return match[2];
        } else {
            return null;
        }
    }
</script>
@endsection
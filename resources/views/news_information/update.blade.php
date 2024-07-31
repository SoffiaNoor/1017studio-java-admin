@extends('layouts.master')

@section('content')

@section('breadcrumb')
News Information / Edit
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
    background-color: #2196F3;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
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
    <div class="col-md-12">
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
        <form method="POST" action="{{ route('news_information.update',$news_information->id)}}"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="card-title title">News Information</h4>
              <div class="row mr-1">
                <div class="d-flex justify-content-between align-items-center">
                  <a href="/news_information" class="btn btn-info text-white"><i
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
              <div class="col-md-12">
                <div class="form-group">
                  <label style="color:black">Header Image</label>
                  <div class="grid grid-cols-6">
                    @if($news_information->header_image)
                    <div class="p-3 shadow-lg text-center" style="background-color: #c7c7c7;border-radius:20px">
                      <img id="image_display" class="object-contain items-center"
                        style="width:auto;height:10rem;object-fit:cover"
                        src="{{asset($news_information->header_image)}}">
                    </div>
                    @else
                    <div class="p-3 shadow-lg text-center" style="background-color: #c7c7c7;border-radius:20px">
                      <img id="image_display" class="object-contain items-center"
                        style="width:10rem;height:10rem;object-fit:cover" src="{{ asset('assets/img/no-photo.png') }}">
                    </div>
                    @endif
                  </div>
                  <input type="file" class="form-control mt-3 @error('header_image') is-invalid @enderror"
                    id="file_input" name="header_image" value="">
                  <small class="text-muted">Please choose an image to upload.</small>
                  @error('header_image')
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
</script>
@endsection
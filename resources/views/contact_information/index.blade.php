@extends('layouts.master')

@section('content')

@section('breadcrumb')
Contact Information
@endsection

<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
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
                        <h4 class="card-title title">Contact Information</h4>
                        <a class="btn btn-primary"
                            href="{{ route('contact_information.edit', $contact_information->id) }}">
                            <i class="bi bi-pencil mx-1"></i>Change Contact Information
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Header Image</label>
                                    <div class="grid grid-cols-6">
                                        @if($contact_information->header)
                                        <div class="p-3 shadow-lg text-center"
                                            style="background-color: #c7c7c7;border-radius:20px">
                                            <img id="image_display3" class="object-contain items-center"
                                                style="width:40rem;height:10rem;object-fit:cover"
                                                src="{{asset($contact_information->header)}}">
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
                                    <label>Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        placeholder="Title Contact" value="{{$contact_information->title}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>File Brochure</label>

                                @if($contact_information->file)
                                <input type="text" name="file" id="file" class="form-control"
                                    placeholder="File Brochure" value="{{ basename($contact_information->file) }}"
                                    disabled>
                                <a href="{{ asset($contact_information->file) }}" target="_blank"
                                    class="btn btn-primary">View File</a>
                                @else
                                <p>No file uploaded</p>
                                @endif

                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </form>
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
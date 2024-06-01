@extends('layouts.master')

@section('content')

@section('breadcrumb')
    Contact / Detail / {{$contact->id}}
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
                            <h4 class="card-title">Detail Contact {{$contact->id}}</h4>
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
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="First name" value="{{$contact->name}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" id="subject" name="subject" class="form-control"
                                            placeholder="Subject" value="{{$contact->subject}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Handphone</label>
                                        <input type="number" id="handphone" name="handphone" class="form-control"
                                            placeholder="Phone number" value="{{$contact->handphone}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea rows="4" cols="80" class="form-control" id="message" name="message"
                                            placeholder="Here can be your description" disabled>{{$contact->message}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="/contact" class="btn btn-info text-white"><i
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

@endsection
@extends('layouts.master')

@section('content')

@section('breadcrumb')
News
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">News List</h4>
                            <a class="btn btn-primary" href="/news/create">
                                <i class="bi bi-plus-circle mx-1"></i>Add New News
                            </a>
                    </div>
                    @if (count($news) > 0)
                    <div class="card-body">
                        @if (count($errors) > 0)
                        <div
                            class="alert alert-danger shadow border-radius-xl p-2 border-none text-white font-weight-bolder flex flex-col ">
                            <strong>Sorry ! There were some problems with your input.</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success shadow border-radius-xl" style="background:#31a72b!important">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class=" text-indigo">
                                    <th style="font-weight:500">
                                        No.
                                    </th>
                                    <th style="font-weight:500">
                                        Title
                                    </th>
                                    <th style="font-weight:500">
                                        Image
                                    </th>
                                    <th style="font-weight:500">
                                        Description
                                    </th>
                                    <th style="font-weight:500">
                                        Tampilkan
                                    </th>
                                    <th class="text-right" style="font-weight:500">
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($news as $c)
                                    <tr>
                                        <td>
                                            {{ ($news->currentPage() - 1) * $news->perPage() +
                                            $loop->iteration }}
                                        </td>
                                        <td>
                                            {!! substr($c->title,0,30).'...' !!}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($c->image)
                                                    <img class="object-contain items-center" style="width:8rem;height:8rem;object-fit:cover" src="{{asset($c->image)}}">
                                                @else
                                                    <img class="object-contain items-center" style="width:8rem;height:8rem;object-fit:cover" src="{{ asset('assets/img/no-photo.png') }}">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            {!! substr($c->description,0,200).'...' !!}
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" id="maintenance" name="maintenance"
                                                    value="{{$c->is_show}}" {{ $c->is_show == 1 ? 'checked' : ''
                                                }} disabled>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('news.show', $c->id) }}"><i
                                                    class="now-ui-icons ui-1_zoom-bold"></i></a>
                                            <a href="{{ route('news.edit', $c->id) }}"><i
                                                    class="bi bi-pencil mx-3"></i></a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{$c->id}}"><i class="bi bi-trash3"></i></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{$c->id}}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content" style="border-radius:1.3rem;border:none">
                                                        <div class="modal-header" style="border-bottom: none">
                                                            <h5 class="modal-title font-weight-bolder"
                                                                id="deleteModalLabel">
                                                                Delete Confirmation
                                                            </h5>
                                                            <button type="button"
                                                                style="border:none;background:transparent;"
                                                                data-bs-dismiss="modal" aria-label="Close"><i
                                                                    class="bi bi-x-lg"></i></button>
                                                        </div>
                                                        <div class="modal-body text-sm text-left">
                                                            Are you sure want to delete <span
                                                                class="font-weight-bolder">{{$c->name}}</span>?
                                                        </div>
                                                        <div class="modal-footer" style="border-top:none">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">No</button>
                                                            <form action="{{ route('news.destroy', $c->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end pt-4">
                                    @if ($news->currentPage() > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $news->previousPageUrl() }}" tabindex="-1"
                                            style="color:#dc3545">
                                            <i class="fa fa-angle-left"></i>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="javascript:;" tabindex="-1" style="color:#dc3545">
                                            <i class="fa fa-angle-left"></i>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    @endif

                                    @for ($i = 1; $i <= $news->lastPage(); $i++)
                                        <li class="page-item {{ $i == $news->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $news->url($i) }}"
                                                style="color:#dc3545;{{ $i == $news->currentPage() ? 'color:white;background-color:#dc3545;border:#dc3545' : '' }}">
                                                {{ $i }}
                                            </a>
                                        </li>
                                        @endfor

                                        @if ($news->currentPage() < $news->lastPage())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $news->nextPageUrl() }}"
                                                    style="color:#dc3545">
                                                    <i class="fa fa-angle-right"></i>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                            @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="javascript:;" style="color:#dc3545">
                                                    <i class="fa fa-angle-right"></i>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                            @endif
                                </ul>
                            </nav>
                        </div>
                        @else
                        <div class="alert alert-info shadow border-radius-xl font-weight-bolder text-white"
                            style="background: linear-gradient(to right, #252525 0%, #1a1919 60%, #0f0f0f 100%);">
                            The table is still empty.
                        </div>
                        @endif
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
@endsection
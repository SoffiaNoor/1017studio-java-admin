@extends('layouts.master')

@section('content')

@section('breadcrumb')
Project Type
@endsection

<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Project Type List</h4>
                        <a class="btn btn-primary" href="/projectType/create">
                            <i class="bi bi-plus-circle mx-1"></i>Add New Project Type
                        </a>
                    </div>
                    @if (count($projectType) > 0)
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
                                        Name
                                    </th>
                                    <th style="font-weight:500">
                                        Small Description
                                    </th>
                                    <th style="font-weight:500">
                                        Project ID
                                    </th>
                                    <th style="font-weight:500">
                                        Image
                                    </th>
                                    <th class="text-right" style="font-weight:500">
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($projectType as $c)
                                    <tr>
                                        <td>
                                            {{ ($projectType->currentPage() - 1) * $projectType->perPage() +
                                            $loop->iteration }}
                                        </td>
                                        <td>
                                            {{$c->name}}
                                        </td>
                                        <td>
                                            {{ Str::limit(strip_tags($c->small_description), 20) }}
                                        </td>
                                        <td>

                                            {{$c->projectTypes->title}}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($c->image)
                                                <img class="object-contain items-center"
                                                    style="width:8rem;height:8rem;object-fit:cover"
                                                    src="{{ $c->image }}">
                                                @else
                                                <img class="object-contain items-center"
                                                    style="width:8rem;height:8rem;object-fit:cover"
                                                    src="{{ asset('assets/img/no-photo.png') }}">
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('projectType.show', $c->id) }}"><i
                                                    class="now-ui-icons ui-1_zoom-bold"></i></a>
                                            <a href="{{ route('projectType.edit', $c->id) }}"><i
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
                                                                class="font-weight-bolder">{{$c->title}}</span>?
                                                        </div>
                                                        <div class="modal-footer" style="border-top:none">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">No</button>
                                                            <form action="{{ route('projectType.destroy', $c->id) }}"
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
                                    @if ($projectType->currentPage() > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $projectType->previousPageUrl() }}" tabindex="-1"
                                            style="color:#c1510c">
                                            <i class="fa fa-angle-left"></i>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="javascript:;" tabindex="-1" style="color:#c1510c">
                                            <i class="fa fa-angle-left"></i>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    @endif

                                    @for ($i = 1; $i <= $projectType->lastPage(); $i++)
                                        <li class="page-item {{ $i == $projectType->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $projectType->url($i) }}"
                                                style="color:#c1510c;{{ $i == $projectType->currentPage() ? 'color:white;background-color:#c1510c;border:#c1510c' : '' }}">
                                                {{ $i }}
                                            </a>
                                        </li>
                                        @endfor

                                        @if ($projectType->currentPage() < $projectType->lastPage())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $projectType->nextPageUrl() }}"
                                                    style="color:#c1510c">
                                                    <i class="fa fa-angle-right"></i>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                            @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="javascript:;" style="color:#c1510c">
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
                            style="background: linear-gradient(to right, #322924 0%, #392a20 60%, #291b13 100%);">
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
@extends('layouts.master')

@section('content')

@section('breadcrumb')
Users
@endsection

<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Users List</h4>
                        <a class="btn btn-primary" href="/register">
                            <i class="bi bi-plus-circle mx-1"></i>Add New Account
                        </a>
                    </div>
                    @if (count($user) > 0)
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
                                        Photo Profile
                                    </th>
                                    <th style="font-weight:500">
                                        Name
                                    </th>
                                    <th style="font-weight:500">
                                        Email
                                    </th>
                                    <th class="text-right" style="font-weight:500">
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($user as $c)
                                    <tr>
                                        <td>
                                            {{ ($user->currentPage() - 1) * $user->perPage() +
                                            $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($c->photo_profile)
                                                <img class="object-contain items-center"
                                                    style="width:4rem;height:4rem;object-fit:cover;border-radius:50%"
                                                    src="{{ $c->photo_profile }}">
                                                @else
                                                <img class="object-contain items-center"
                                                    style="width:4rem;height:4rem;object-fit:cover;border-radius:50%"
                                                    src="{{ asset('assets/img/no-photo.png') }}">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            {{$c->name}}
                                        </td>
                                        <td>
                                            {{$c->email}}
                                        </td>
                                        @if(Auth::id() == $c->id)
                                        <td class="text-right">
                                            <a href="{{ route('user.show', $c->id) }}"><i
                                                    class="now-ui-icons ui-1_zoom-bold"></i></a>
                                            <a href="{{ route('user.edit', $c->id) }}"><i
                                                    class="bi bi-pencil mx-3"></i></a>
                                        </td>
                                        @else
                                        <td>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end pt-4">
                                    @if ($user->currentPage() > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $user->previousPageUrl() }}" tabindex="-1"
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

                                    @for ($i = 1; $i <= $user->lastPage(); $i++)
                                        <li class="page-item {{ $i == $user->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $user->url($i) }}"
                                                style="color:#c1510c;{{ $i == $user->currentPage() ? 'color:white;background-color:#c1510c;border:#c1510c' : '' }}">
                                                {{ $i }}
                                            </a>
                                        </li>
                                        @endfor

                                        @if ($user->currentPage() < $user->lastPage())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $user->nextPageUrl() }}"
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
                            style="background: linear-gradient(to right, #141e30 0%, #141e30ed 60%, #2b3547 100%);">
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
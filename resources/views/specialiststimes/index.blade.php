@extends('layouts.app')
@section('content')
    <div class="container-fluid main-container">
    @extends('config.log')
    <!--header-->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Panel de Horas de Especialista 
                </div>
                <h2 class="page-title">
                    Horas de Especialista
                </h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <form action="{{ route('specialiststimes.create') }}" method="POST">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Crear nuevo timesheet 
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form class="d-flex flex-row form-inline py-2 col-5 gap-2 mb-4" action="{{ route('specialiststimes.index') }}" method="GET">
        <input class="form-control mr-sm-2" type="search" name="name" placeholder="Buscar por nombre" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0 col-3" type="submit">Buscar</button>
    </form>
    <!--table uers-->
    <div class="table-responsive">
        <table class="table table-vcenter">
            <thead>
            <tr>
                <th class="no-sort">#</th>
                <th>Nombre</th>
                <th>Id de Especialista</th>
                <th>Fecha y Hora de Inicio</th>
                <th>Fecha y Hora de Fin</th>
                <th class="no-sort">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($specialiststimes as $specialiststime)
                <tr>
                    <td>{{ $specialiststime->id }}</td>
                    <td>{{ $specialiststime->user_name }}</td>
                    <td>{{ $specialiststime->specialist_id }}</td>
                    <td>{{ $specialiststime->start_date }}</td>
                    <td>{{ $specialiststime->end_date }}</td>
                    <td>
                        <div class="btn-group btn-group-sm gap-2" role="group">
                            <form action="{{ route('specialiststimes.edit', $specialiststime) }}" method="POST">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn btn-dark btn-md">Editar</button>
                            </form>
                            <form action="{{ route('specialiststimes.destroy', $specialiststime) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-red btn-md">Borrar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example" class="mt-4">
            <ul class="pagination gap-2">
                <li class="btn btn-dark btn-sm"><a class="text-white" href="{{ route('specialiststimes.index', ['page' => ($specialiststimes->currentPage()-1)]) }}">Anterior</a></li>
                @for ($i = 1; $i <= $specialiststimes->lastPage(); $i++)
                    <li class="btn btn-dark btn-sm bg-dark {{ ($i == $specialiststimes->currentPage()) ? ' active' : '' }}"><a class="page-link bg-dark" href="{{ route('specialiststimes.index', ['page' => $i]) }}">{{ $i }}</a></li>
                @endfor
                <li class="btn btn-dark btn-sm"><a class="text-white" href="{{ route('specialiststimes.index', ['page' => ($specialiststimes->currentPage()+1)]) }}">Siguiente</a></li>
            </ul>
        </nav>
    </div>
    </div>
@endsection

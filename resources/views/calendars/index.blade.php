@extends('layouts.app')
@section('content')
    <div class="container-fluid main-container">
    @extends('config.log')
    <!--header-->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Calendario 
                </div>
                <h2 class="page-title">
                   Calendario de Sesiones 
                </h2>
            </div>
        </div>
    </div>
    <form class="d-flex flex-row form-inline py-2 col-5 gap-2 mb-4" action="{{ route('calendars.index') }}" method="GET">
        <input class="form-control mr-sm-2" type="date" name="date" placeholder="Buscar por mes" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0 col-3" type="submit">Buscar</button>
    </form>
    <h2>Items del Calendario</h2>
    <ul>
        <li class="flex items-center gap-2">
            <p>Sesiones
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                   <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                   <path d="M16 3l0 4"></path>
                   <path d="M8 3l0 4"></path>
                   <path d="M4 11l16 0"></path>
                   <path d="M8 15h2v2h-2z"></path>
                </svg>
            </p>
        </li>
    </ul>
    <!--table uers-->
    <div  class="table-responsive">
        <div id="calendar-container" class="flex flex-col gap-y-2">

        </div>
    </div>
    @include('config.calendars')
@endsection

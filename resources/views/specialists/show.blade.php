@extends('layouts.app')
@section('content')
    <div class="container-fluid main-container">
    @if ($specialist)
        @extends('config.log')
        <!--header-->
        <div class="page-header mb-4">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Especialista 
                    </h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <form action="{{ route('specialists.index') }}" method="POST">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-specialists-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                                    <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                                    <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                    <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                                </svg>
                                Volver a la lista de Especialistas 
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flex-column flex-md-row">
            <div class="col-12 col-md-6">
                <div class="form-group my-2 ">
                    <label for="is_active">El especialista esta activo?</label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" name="is_active" {{  $specialist->is_active ? 'checked' : '' }} readonly>
                        <label class="form-check-label" for="is_active">Si</label>
                    </div>
                </div>
                <div class="form-group my-2">
                    <label for="user_id" class="my-2">Usuario 
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                           <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                           <path d="M15 19l2 2l4 -4"></path>
                        </svg>
                    </label>
                    <input type="hidden" id="user_id" name="user_id" value="{{ $specialist->user_id }}" readonly>
                    <div class="row g-2">
                        <div class="col">
                            <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_name" name="user_name" value="{{ $specialist->user->name }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <h3>Servicios
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brain" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M15.5 13a3.5 3.5 0 0 0 -3.5 3.5v1a3.5 3.5 0 0 0 7 0v-1.8"></path>
                           <path d="M8.5 13a3.5 3.5 0 0 1 3.5 3.5v1a3.5 3.5 0 0 1 -7 0v-1.8"></path>
                           <path d="M17.5 16a3.5 3.5 0 0 0 0 -7h-.5"></path>
                           <path d="M19 9.3v-2.8a3.5 3.5 0 0 0 -7 0"></path>
                           <path d="M6.5 16a3.5 3.5 0 0 1 0 -7h.5"></path>
                           <path d="M5 9.3v-2.8a3.5 3.5 0 0 1 7 0v10"></path>
                        </svg>
                    </h3>

                    <div class="row g-2">
                        <div class="col">
                            <input type="text" class="form-control @error('services') is-invalid @enderror" id="service_name" name="service_name" value="{{ $specialist->service->name }}">
                        </div>
                    </div>
                    <ul id="service-list" class="list-group mt-2"></ul>

                    <div id="services-container" class="my-2">
                    </div>
                </div>
                <div class="form-group my-2">
                    <label for="sex" class="my-2">Género</label>
                    <select class="form-control @error('sex') is-invalid @enderror" id="sex" name="sex">
                        <option value="M" class="{{ $specialist->sex == "M" ? 'selected': 'hidden'}}">Masculino</option>
                        <option value="F" class="{{ $specialist->sex == "F" ? 'selected': 'hidden'}}">Femenino</option>
                        <option value="O" class="{{ $specialist->sex == "O" ? 'selected': 'hidden'}}">Otro</option>
                    </select>
                </div>
                <div class="form-group my-2">
                    <label for="type_document" class="my-2">Tipo de Documento</label>
                    <select class="form-control @error('type_document') is-invalid @enderror" id="type_document" name="type_document" readonly>
                        <option value="DNI" class="{{ $specialist->type_document == "DNI" ? 'selected': 'hidden'}}">DNI</option>
                        <option value="PASSPORT" class="{{ $specialist->type_document == "PASSPORT" ? 'selected': 'hidden'}}">Pasaporte</option>
                    </select>
                </div>
                <div class="form-group my-2">
                    <label for="document_id" class="my-2">Número de Documento</label>
                    <input type="number" class="form-control @error('document_id') is-invalid @enderror" id="document_id" name="document_id" value={{ $specialist->document_id }} readonly>
                </div>
                <div class="form-group my-2">
                    <label for="phone_number" class="my-2">Número de Teléfono</label>
                    <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ $specialist->phone_number }}" readonly>
                </div>
                <div class="form-group my-2">
                    <label for="address" class="my-2">Dirección</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" readonly>{{ $specialist->address }}</textarea>
                </div>

                <div class="form-group my-2">
                    <label for="birthdate" class="my-2">Fecha de Nacimiento</label>
                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate" 
                    value={{ $specialist->birthdate }} readonly>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group my-2">
                    <div>
                        <label for="profile_image" class="my-2">Imagen de Perfil</label>
                    </div>
                    @if($specialist->profile_image) 
                        <div>
                            <img src="{{env('BACKEND_URL_IMAGE')}}{{ $specialist->profile_image }}" class="rounded float-start" style="height: 200px;" alt="Profile Image">
                        </div>
                    @else
                        <div>
                            <label for="profile_image" class="my-2">No hay imagen de perfil previamente cargada</label>
                        </div>
                    @endif
                </div>
                <div class="form-group my-2">
                    <label for="evaluated_rate" class="my-2">Estrellas valuadas</label>
                    <input type="number" min="0" max="5" class="form-control @error('evaluated_rate') is-invalid @enderror" id="evaluated_rate" name="evaluated_rate" value={{$specialist->evaluated_rate)}} readonly>
                </div>
                <div class="form-group my-2">
                    <label for="summary" class="my-2">Resumen para mostrar en la Pagina</label>
                    <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" readonly>{{ $specialist->summary }}</textarea>
                </div>
                <div class="form-group mt-4">
                    <h3>Educación
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-books" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                           <path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                           <path d="M5 8h4"></path>
                           <path d="M9 16h4"></path>
                           <path d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z"></path>
                           <path d="M14 9l4 -1"></path>
                           <path d="M16 16l3.923 -.98"></path>
                        </svg>
                    </h3>
                    <div id="educations-container" class="my-2">
                    </div>
                </div>

                <div class="form-group mt-4">
                    <h3>Experiencia
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-factory-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M3 21h18"></path>
                           <path d="M5 21v-12l5 4v-4l5 4h4"></path>
                           <path d="M19 21v-8l-1.436 -9.574a.5 .5 0 0 0 -.495 -.426h-1.145a.5 .5 0 0 0 -.494 .418l-1.43 8.582"></path>
                           <path d="M9 17h1"></path>
                           <path d="M14 17h1"></path>
                        </svg>
                    </h3>
                    <div id="experiences-container" class="my-2">
                    </div>
                </div>

                <div class="form-group mt-4">
                    <h3>Premios 
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-award-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M19.496 13.983l1.966 3.406a1.001 1.001 0 0 1 -.705 1.488l-.113 .011l-.112 -.001l-2.933 -.19l-1.303 2.636a1.001 1.001 0 0 1 -1.608 .26l-.082 -.094l-.072 -.11l-1.968 -3.407a8.994 8.994 0 0 0 6.93 -3.999z" stroke-width="0" fill="currentColor"></path>
                           <path d="M11.43 17.982l-1.966 3.408a1.001 1.001 0 0 1 -1.622 .157l-.076 -.1l-.064 -.114l-1.304 -2.635l-2.931 .19a1.001 1.001 0 0 1 -1.022 -1.29l.04 -.107l.05 -.1l1.968 -3.409a8.994 8.994 0 0 0 6.927 4.001z" stroke-width="0" fill="currentColor"></path>
                           <path d="M12 2l.24 .004a7 7 0 0 1 6.76 6.996l-.003 .193l-.007 .192l-.018 .245l-.026 .242l-.024 .178a6.985 6.985 0 0 1 -.317 1.268l-.116 .308l-.153 .348a7.001 7.001 0 0 1 -12.688 -.028l-.13 -.297l-.052 -.133l-.08 -.217l-.095 -.294a6.96 6.96 0 0 1 -.093 -.344l-.06 -.271l-.049 -.271l-.02 -.139l-.039 -.323l-.024 -.365l-.006 -.292a7 7 0 0 1 6.76 -6.996l.24 -.004z" stroke-width="0" fill="currentColor"></path>
                        </svg>
                    </h3>
                    <div id="awards-container" class="my-2">
                    </div>
                </div>
            </div>
        </div>
        </div>
    @else
        <div class="row mt-3">
            <div class="row-5">
                <div class="alert alert-danger" role="alert">
                    "Hubo un error al intentar traer la información del Especialista"
                </div>
                <a href={{ route('specialists.index') }} class="btn btn-primary">Voler a la lista de Especialistas</a>
            </div>
        </div>
    @endif
@endsection

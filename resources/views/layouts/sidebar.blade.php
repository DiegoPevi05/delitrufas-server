<div class="page">
    <!-- Sidebar -->
    <aside class="navbar navbar-vertical navbar-expand-sm navbar-dark" style="width: 280px;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark">
                <a href="#">
                    <img src="{{env('BACKEND_URL_IMAGE')}}/LogoPink.jpeg" style="width: 50px; height: 50px; border-radius: 50%;" alt="Tabler" class="navbar-brand-image">
                </a>
            </h1>
            <div class="collapse navbar-collapse" id="sidebar-menu">
                <ul class="navbar-nav pt-lg-3">
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('home') }}>
                          <span class="nav-link-title">
                            Inicio
                          </span>
                        </a>
                    </li>
                    @if (Auth::user() && Auth::user()->role == 'ADMIN')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">
                      <span class="nav-link-title">
                        Usuarios
                      </span>
                        </a>
                    </li>
                    @endif

                    @if (Auth::user() && (Auth::user()->role == 'ADMIN' || Auth::user()->role == 'MODERATOR'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('services.index') }}">
                          <span class="nav-link-title">
                            Servicios 
                          </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('discountcodes.index') }}">
                          <span class="nav-link-title">
                            Codigo de Descuento 
                          </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('specialists.index') }}">
                          <span class="nav-link-title">
                             Especialistas
                          </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('specialiststimes.index') }}">
                          <span class="nav-link-title">
                             Hojas de Tiempos de Especialistas
                          </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('meets.index') }}">
                          <span class="nav-link-title">
                             Sesiones
                          </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('meethistories.index') }}">
                          <span class="nav-link-title">
                             Sesiones Facturadas
                          </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('zooms.index') }}">
                          <span class="nav-link-title">
                             Actualizar Zoom Credenciales
                          </span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('calendars.index') }}">
                      <span class="nav-link-title">
                        Calendario 
                      </span>
                        </a>
                    </li>
                    <li class="nav-item mt-auto">
                        <a class="nav-link mt-auto" href="{{ route('home') }}">
                            <img src="{{env('BACKEND_URL_IMAGE')}}/LogoPink.jpeg" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong>{{ Auth::user()->name }}</strong>
                        </a>
                    </li>
                    <li class="w-full mb-2 items-center">
                        <a class="btn btn-primary w-full" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                          <span class="nav-link-title">
                            Salir
                          </span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
</div>

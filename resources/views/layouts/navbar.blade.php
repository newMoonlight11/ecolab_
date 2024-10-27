<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        @auth
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        @endauth
        <div class="offcanvas offcanvas-start bg-white" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasNavbarLabel"><img src="{{ asset('images/ecolab_blue1.png') }}" style="height: 25px;">
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav flex-column">
                    @auth
                        @if (Auth::user()->hasRole('admin'))
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('clase-residuos.index') }}">{{ __('Clases residuos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('familias.index') }}">{{ __('Familias') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('item_movimiento.index') }}">{{ __('Items movimientos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('laboratorios.index') }}">{{ __('Laboratorios') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('marcas.index') }}">{{ __('Marcas') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('movimientos.index') }}">{{ __('Movimientos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('reactivos.index') }}">{{ __('Reactivos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('residuos.index') }}">{{ __('Residuos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('residuo-laboratorios.index') }}">{{ __('Stock de residuos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('stock_reactivos.index') }}">{{ __('Stock de reactivos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('tipo_movimiento.index') }}">{{ __('Tipos de movimientos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('unidads.index') }}">{{ __('Unidades') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">{{ __('Usuarios') }}</a>
                            </li>
                        @elseif(Auth::user()->hasRole('general'))
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('prestamos') }}">{{ __('Préstamos') }}</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
        <a class="position-absolute top-2 start-50 translate-middle-x" href="{{ url('/home') }}">
            <img src="{{ asset('images/ecolab_blue1.png') }}" alt="Ecolab" style="height: 25px;">
        </a>
        <div class="dropdown ms-auto me-3">
            @auth
                <button class="btn btn-light bg-white dropdown-toggle" type="button" id="userMenu"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end bg-white" aria-labelledby="userMenu">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            @else
                <!-- Mostrar el link de inicio de sesión si el usuario no está autenticado -->
                <div class="d-flex me-0">
                    @if (Route::has('login'))
                        <a class="nav-link me-3 pb-2 pt-2" href="{{ route('login') }}">{{ __('Inicia sesión') }}</a>
                        <!-- Add margin end -->
                    @endif
                    <br>
                    @if (Route::has('register'))
                        <a class="nav-link pb-2 pt-2" href="{{ route('register') }}">{{ __('Regístrate') }}</a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>

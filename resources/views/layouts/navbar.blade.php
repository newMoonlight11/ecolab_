<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            {{-- {{ config('app.name', 'Ecolab') }} --}}
            <img src="{{ asset('images/ecolab_blue1.png') }}" alt="Ecolab" style="height: 25px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reactivos.index') }}">{{ __('Reactivos') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('familias.index') }}">{{ __('Familias') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('marcas.index') }}">{{ __('Marcas') }}</a>
                    </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Inicia sesión') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Regístrate') }}</a>
                        </li>
                    @endif
                @else
                    <div class="dropdown">
                        <button class="dropbtn"> {{ Auth::user()->name }}</button>
                        <div class="dropdown-content">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<header class="header" id="header">

    <nav class="nav container">
        <a href="#" class="nav__logo">
            {{-- Arts <i class='bx bxs-home-alt-2'></i> --}}
            ADM <img style="width: 40px;hieght:auto" src="{{asset('image/logo.png')}}" alt="">
        </a>
        <div class="nav__menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="#home" class="nav__link active-link">
                        <i class='bx bx-home-alt-2' ></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav__item">
                    <a href="#popular" class="nav__link">
                        <i class='bx bx-buildings' ></i>
                        <span>Redidences</span>
                    </a>
                </li>
                <li class="nav__item">
                    <a href="#value" class="nav__link">
                        <i class='bx bx-award' ></i>
                        <span>Value</span>
                    </a>
                </li>
                <li class="nav__item">
                    <a href="#contact" class="nav__link">
                        <i class='bx bx-phone'></i>
                        <span>Conatct</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <i class='bx bx-moon change-theme' id="theme-button"></i>

        {{-- <a href="#"  class="button nav__button">
            button
        </a> --}}
        <a href="#">
            @guest
            @if (Route::has('login'))
                    <a  class="button_inscr" href="{{ route('login') }}">{{ __('connexion') }}</a>
            @endif

            @if (Route::has('register'))
                    <a class="button_inscr" href="{{ route('register') }}">{{ __('inscrit') }}</a>
            @endif
        @else
        {{-- nav-item  --}}
            <div class="dropdown">
                <a id="navbarDropdown" class="user__name dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>


                @if (Auth::user()->type_user == 'admin')
                <a class="button_inscr dropdown-item" href="{{ route('admin') }}">
                    Dashboard
                </a>
                @else
                @if (Auth::user()->type_user == 'artisan')

                <a class="button_inscr dropdown-item" href="{{ route('artisan') }}">
                    Dashboard
                </a>

                @else

                    <a class="button_inscr dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    </a>

                @endif
                @endif
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                {{-- </div> --}}
            </div>
        @endguest
        </a>
    </nav>
</header>
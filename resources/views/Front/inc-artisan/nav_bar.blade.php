<div class="nav" id="navbar">
    <nav class="nav__container">
        <div>
            <a href="{{route('artisan')}}" class="nav__link nav__logo">
                <i class='bx bxs-disc nav__icon'></i>
                <span class="nav__logo-name">Artisan</span>
            </a>
            <div class="nav__list">
                <div class="nav__items">
                    <h3 style="margin-top: 2rem" class="nav__subtitle">
                        {{ Auth::user()->name }}
                    </h3>

                    <a href="{{route('artisan')}}" class="nav__link active">
                        <i class='bx bx-home nav__icon' ></i>
                        <span class="nav__name">Dashboard</span>
                    </a>

                    <div class="nav__dropdown">
                        <a href="#" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Profile</span>

                            <i class='bx bxs-chevron-down nav__icon nav__dropdown-icon' ></i>

                        </a>

                        <div class="nav__dropdown-collapse">
                            <div class="nav__dropdown-content">
                                <a href="#" class="nav__dropdown-item">Mot de pass</a>
                                <a href="#" class="nav__dropdown-item">Email</a>
                                <a href="#" class="nav__dropdown-item">Accounts</a>
                            </div>
                        </div>
    
                    </div>

                    <div class="nav__dropdown">
                        <a href="#" class="nav__link">
                            <i class='bx bx-briefcase nav__icon'></i>
                            <span class="nav__name">Services</span>
                        </a>

                            <i class='bx bxs-chevron-down nav__icon nav__dropdown-icon' ></i>

                        </a>

                        <div class="nav__dropdown-collapse">
                            <div class="nav__dropdown-content">
                                <a href="{{route('sevice')}}" class="nav__dropdown-item">Table services</a>
                                <a href="{{route('sevice.create')}}" class="nav__dropdown-item">Ajouter service</a>
                            </div>
                        </div>
    
                    </div>

                    {{-- <div class="nav__dropdown"> 
                        <a href="#" class="nav__link">
                            <i class='bx bx-category nav__icon' ></i>
                            <span class="nav__name">Categories</span>
                        </a>

                            <i class='bx bxs-chevron-down nav__icon nav__dropdown-icon' ></i>

                        </a>

                        <div class="nav__dropdown-collapse">
                            <div class="nav__dropdown-content">
                                <a href="{{route('categorie')}}" class="nav__dropdown-item">Table categorie</a>
                                <a href="{{route('categorie.create')}}" class="nav__dropdown-item">Ajouter categorie</a>
                            </div>
                        </div>
    
                    </div> --}}

                    <a href="{{url('/chatify')}}" class="nav__link">
                        <i class='bx bx-chat nav__icon' ></i>
                        <span class="nav__name">Messages</span>
                    </a>
                </div>
            </div>
        </div>

        <a class="nav__link nav__logout" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
            <i class='bx bx-log-out' ></i>
            <span class="nav__name">se déconnecter</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>
</div>
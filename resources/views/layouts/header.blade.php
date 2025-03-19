<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stagecentrum</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    <style>
    .navbar {
        padding: 0.8rem 1rem; 
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); 
    }

    .navbar a {
        font-weight: 500;
    }

    .form-inline .form-control {
        border-radius: 20px;
        padding: 0.5rem 1rem;
        max-width: 250px;
    }

    .dropdown-menu {
        border-radius: 8px;
        border: none;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

</style>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container">
                <a href="{{ url('/') }}" style="color: black; text-decoration: none; font-size: 1.25rem; font-weight: bold;">
                    Stagecentrum
                </a>

                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="d-flex flex-column flex-lg-row w-100 justify-content-end align-items-center">
                        <form action="{{ route('vacancies.search') }}" method="GET" class="form-inline my-2 my-lg-0 w-100 w-lg-auto">
                            <input class="form-control mr-sm-2" type="search" name="filter" placeholder="Zoek op een filter..." aria-label="Search">
                        </form>

                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            @if (Route::has('login'))
                                @auth
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="{{ route('profile.edit') }}">profiel</a>
                                            <div class="dropdown-divider"></div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Log uit</button>
                                            </form>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">Registreren</a>
                                        </li>
                                    @endif
                                @endauth
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        @yield('content')  
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
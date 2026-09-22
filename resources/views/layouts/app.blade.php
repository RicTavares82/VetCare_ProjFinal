<!doctype html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'VetCare')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="bi bi-heart-pulse"></i>
            VetCare
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMain"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        Início
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pets.index') }}">
                        Animais
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Consultas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Veterinários
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Serviços
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <small>
            &copy; {{ date('Y') }} VetCare
        </small>
    </div>
</footer>

</body>
</html>

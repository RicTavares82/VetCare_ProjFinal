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


            <ul class="navbar-nav ms-auto">

                @guest

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Login
                        </a>
                    </li>

                @endguest


                @auth

                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="bi bi-person-circle"></i>
                            {{ Auth::user()->name }}
                        </span>
                    </li>

                    <li class="nav-item">

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="nav-link btn btn-link"
                            >
                                <i class="bi bi-box-arrow-right"></i>
                                Sair
                            </button>

                        </form>

                    </li>

                @endauth

            </ul>

        </div>

    </div>
</nav>


<div class="container mt-3">

    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif

    @if (session('error'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif

</div>


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

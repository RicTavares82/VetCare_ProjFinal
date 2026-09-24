@extends('layouts.app')

@section('title', 'VetCare')

@section('content')

    <header class="bg-primary text-white py-5">

        <div class="container py-4">

            <div class="row align-items-center">

                <div class="col-lg-7">

                    <h1 class="display-4 fw-bold">
                        Cuidamos de quem faz parte da sua família
                    </h1>

                    <p class="lead">
                        A VetCare disponibiliza acompanhamento veterinário,
                        consultas e serviços para o bem-estar do seu animal.
                    </p>

                    <a href="{{ route('pets.index') }}"
                       class="btn btn-light btn-lg">

                        <i class="bi bi-heart"></i>
                        Os meus animais

                    </a>

                </div>

                <div class="col-lg-5 text-center d-none d-lg-block">

                    <i
                        class="bi bi-heart-pulse"
                        style="font-size: 10rem;">
                    </i>

                </div>

            </div>

        </div>

    </header>


    <div class="container py-5">

        <div class="text-center mb-5">

            <h2>
                Os nossos serviços
            </h2>

            <p class="text-muted">
                Alguns dos cuidados disponíveis na VetCare.
            </p>

        </div>


        <div class="row g-4">

            <div class="col-md-6 col-lg-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body text-center">

                        <i class="bi bi-clipboard2-pulse fs-1 text-primary"></i>

                        <h5 class="card-title mt-3">
                            Consultas
                        </h5>

                        <p class="card-text text-muted">
                            Consultas de rotina e acompanhamento do estado
                            de saúde do seu animal.
                        </p>

                    </div>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body text-center">

                        <i class="bi bi-shield-plus fs-1 text-primary"></i>

                        <h5 class="card-title mt-3">
                            Vacinação
                        </h5>

                        <p class="card-text text-muted">
                            Planos de vacinação adequados à espécie
                            e idade do animal.
                        </p>

                    </div>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="card h-100 shadow-sm">

                    <div class="card-body text-center">

                        <i class="bi bi-scissors fs-1 text-primary"></i>

                        <h5 class="card-title mt-3">
                            Cuidados
                        </h5>

                        <p class="card-text text-muted">
                            Serviços complementares para garantir
                            a saúde e bem-estar do seu animal.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        @guest

            <section class="mt-5">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-5">

                        <div class="row align-items-center">

                            <div class="col-md-8">

                                <h2>
                                    Já é cliente VetCare?
                                </h2>

                                <p class="text-muted mb-md-0">
                                    Inicie sessão para consultar os seus animais,
                                    consultas e informação clínica disponível.
                                </p>

                            </div>

                            <div class="col-md-4 text-md-end">

                                <a
                                    href="{{ route('login') }}"
                                    class="btn btn-primary"
                                >
                                    Iniciar sessão
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        @endguest

    </div>

@endsection

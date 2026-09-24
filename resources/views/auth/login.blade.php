@extends('layouts.app')

@section('title', 'Login - VetCare')

@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-5">

                <div class="card shadow-sm">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">

                            <i class="bi bi-heart-pulse fs-1 text-primary"></i>

                            <h1 class="h3 mt-2">
                                Iniciar sessão
                            </h1>

                            <p class="text-muted">
                                Aceda à sua conta VetCare.
                            </p>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('login.authenticate') }}"
                        >

                            @csrf


                            <div class="mb-3">

                                <label
                                    for="email"
                                    class="form-label"
                                >
                                    Email
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                >

                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            <div class="mb-3">

                                <label
                                    for="password"
                                    class="form-label"
                                >
                                    Palavra-passe
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    required
                                >

                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            <div class="form-check mb-4">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="remember"
                                    name="remember"
                                    value="1"
                                >

                                <label
                                    class="form-check-label"
                                    for="remember"
                                >
                                    Manter sessão iniciada
                                </label>

                            </div>


                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                            >
                                <i class="bi bi-box-arrow-in-right"></i>
                                Entrar
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

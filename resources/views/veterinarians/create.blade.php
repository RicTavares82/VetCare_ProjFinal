@extends('layouts.app')

@section('title', 'Novo Veterinário - VetCare')

@section('content')

    <div class="container py-5">

        <div class="mb-4">

            <h1 class="h2">
                Novo veterinário
            </h1>

            <p class="text-muted">
                Preencha os dados do veterinário.
            </p>

        </div>


        <div class="card shadow-sm">

            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route('veterinarians.store') }}"
                >

                    @csrf


                    <div class="mb-3">

                        <label for="name" class="form-label">
                            Nome
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                        >

                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-3">

                        <label for="email" class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                        >

                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-3">

                        <label for="phone" class="form-label">
                            Telefone
                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone') }}"
                        >

                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="form-check mb-4">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="active"
                            name="active"
                            value="1"
                            @checked(old('active', true))
                        >

                        <label
                            class="form-check-label"
                            for="active"
                        >
                            Veterinário ativo
                        </label>

                    </div>


                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-check-lg"></i>
                            Registar veterinário
                        </button>

                        <a
                            href="{{ route('veterinarians.index') }}"
                            class="btn btn-secondary"
                        >
                            Cancelar
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection

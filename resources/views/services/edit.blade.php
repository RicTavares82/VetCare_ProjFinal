
@extends('layouts.app')

@section('title', 'Editar Serviço - VetCare')

@section('content')

    <div class="container py-5">

        <div class="mb-4">

            <h1 class="h2">
                Editar serviço
            </h1>

            <p class="text-muted">
                {{ $service->name }}
            </p>

        </div>


        <div class="card shadow-sm">

            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route('services.update', $service) }}"
                >

                    @csrf
                    @method('PUT')


                    <div class="mb-3">

                        <label for="name" class="form-label">
                            Nome
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $service->name) }}"
                        >

                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-3">

                        <label for="description" class="form-label">
                            Descrição
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="form-control @error('description') is-invalid @enderror"
                        >{{ old('description', $service->description) }}</textarea>

                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-3">

                        <label for="price" class="form-label">
                            Preço (€)
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            id="price"
                            name="price"
                            class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price', $service->price) }}"
                        >

                        @error('price')
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
                            @checked(old('active', $service->active))
                        >

                        <label
                            class="form-check-label"
                            for="active"
                        >
                            Serviço ativo
                        </label>

                    </div>


                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-check-lg"></i>
                            Guardar alterações
                        </button>

                        <a
                            href="{{ route('services.show', $service) }}"
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

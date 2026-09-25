@extends('layouts.app')

@section('title', 'Editar Animal - VetCare')

@section('content')

    <div class="container py-5">

        <div class="mb-4">

            <h1 class="h2">
                Editar animal
            </h1>

            <p class="text-muted">
                {{ $pet->name }}
            </p>

        </div>


        <div class="card shadow-sm">

            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route('pets.update', $pet) }}"
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
                            value="{{ old('name', $pet->name) }}"
                        >

                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label for="user_id" class="form-label">
                                Tutor
                            </label>

                            <select
                                id="user_id"
                                name="user_id"
                                class="form-select @error('user_id') is-invalid @enderror"
                            >

                                @foreach ($users as $user)

                                    <option
                                        value="{{ $user->id }}"
                                        @selected(old('user_id', $pet->user_id) == $user->id)
                                    >
                                        {{ $user->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        <div class="col-md-6 mb-3">

                            <label for="species_id" class="form-label">
                                Espécie
                            </label>

                            <select
                                id="species_id"
                                name="species_id"
                                class="form-select @error('species_id') is-invalid @enderror"
                            >

                                @foreach ($species as $item)

                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old('species_id', $pet->species_id) == $item->id)
                                    >
                                        {{ $item->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('species_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label for="birth_date" class="form-label">
                                Data de nascimento
                            </label>

                            <input
                                type="date"
                                id="birth_date"
                                name="birth_date"
                                class="form-control @error('birth_date') is-invalid @enderror"
                                value="{{ old('birth_date', $pet->birth_date?->format('Y-m-d')) }}"
                            >

                            @error('birth_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        <div class="col-md-6 mb-3">

                            <label for="weight" class="form-label">
                                Peso (kg)
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                id="weight"
                                name="weight"
                                class="form-control @error('weight') is-invalid @enderror"
                                value="{{ old('weight', $pet->weight) }}"
                            >

                            @error('weight')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                    </div>


                    <div class="mb-3">

                        <label for="sex" class="form-label">
                            Sexo
                        </label>

                        <select
                            id="sex"
                            name="sex"
                            class="form-select @error('sex') is-invalid @enderror"
                        >

                            <option value="">
                                Selecione...
                            </option>

                            <option
                                value="Macho"
                                @selected(old('sex', $pet->sex) === 'Macho')
                            >
                                Macho
                            </option>

                            <option
                                value="Fêmea"
                                @selected(old('sex', $pet->sex) === 'Fêmea')
                            >
                                Fêmea
                            </option>

                        </select>

                        @error('sex')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-3">

                        <label for="description" class="form-label">
                            Observações
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            rows="4"
                        >{{ old('description', $pet->description) }}</textarea>

                        @error('description')
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
                            @checked(old('active', $pet->active))
                        >

                        <label
                            class="form-check-label"
                            for="active"
                        >
                            Animal ativo
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
                            href="{{ route('pets.show', $pet) }}"
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

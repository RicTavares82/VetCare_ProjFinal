@extends('layouts.app')

@section('title', 'Editar Consulta - VetCare')

@section('content')

    <div class="container py-5">

        <div class="mb-4">

            <h1 class="h2">
                Editar consulta
            </h1>

            <p class="text-muted">
                Consulta #{{ $appointment->id }}
            </p>

        </div>


        <div class="card shadow-sm">

            <div class="card-body">

                <form
                    method="POST"
                    action="{{ route('appointments.update', $appointment) }}"
                >

                    @csrf
                    @method('PUT')


                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label for="pet_id" class="form-label">
                                Animal
                            </label>

                            <select
                                id="pet_id"
                                name="pet_id"
                                class="form-select @error('pet_id') is-invalid @enderror"
                            >

                                @foreach ($pets as $pet)

                                    <option
                                        value="{{ $pet->id }}"
                                        @selected(old('pet_id', $appointment->pet_id) == $pet->id)
                                    >
                                        {{ $pet->name }} — {{ $pet->user->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('pet_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>


                        <div class="col-md-6 mb-3">

                            <label for="veterinarian_id" class="form-label">
                                Veterinário
                            </label>

                            <select
                                id="veterinarian_id"
                                name="veterinarian_id"
                                class="form-select @error('veterinarian_id') is-invalid @enderror"
                            >

                                @foreach ($veterinarians as $veterinarian)

                                    <option
                                        value="{{ $veterinarian->id }}"
                                        @selected(
                                            old(
                                                'veterinarian_id',
                                                $appointment->veterinarian_id
                                            ) == $veterinarian->id
                                        )
                                    >
                                        {{ $veterinarian->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('veterinarian_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                    </div>


                    <div class="mb-3">

                        <label for="appointment_date" class="form-label">
                            Data e hora
                        </label>

                        <input
                            type="datetime-local"
                            id="appointment_date"
                            name="appointment_date"
                            class="form-control @error('appointment_date') is-invalid @enderror"
                            value="{{ old(
                            'appointment_date',
                            $appointment->appointment_date->format('Y-m-d\TH:i')
                        ) }}"
                        >

                        @error('appointment_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-3">

                        <label for="reason" class="form-label">
                            Motivo
                        </label>

                        <input
                            type="text"
                            id="reason"
                            name="reason"
                            class="form-control @error('reason') is-invalid @enderror"
                            value="{{ old('reason', $appointment->reason) }}"
                        >

                        @error('reason')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-3">

                        <label for="status" class="form-label">
                            Estado
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select @error('status') is-invalid @enderror"
                        >

                            <option
                                value="Agendada"
                                @selected(
                                    old('status', $appointment->status) === 'Agendada'
                                )
                            >
                                Agendada
                            </option>

                            <option
                                value="Realizada"
                                @selected(
                                    old('status', $appointment->status) === 'Realizada'
                                )
                            >
                                Realizada
                            </option>

                            <option
                                value="Cancelada"
                                @selected(
                                    old('status', $appointment->status) === 'Cancelada'
                                )
                            >
                                Cancelada
                            </option>

                        </select>

                        @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-4">

                        <label class="form-label">
                            Serviços
                        </label>

                        <div class="card">

                            <div class="card-body">

                                @foreach ($services as $service)

                                    <div class="form-check mb-2">

                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="services[]"
                                            value="{{ $service->id }}"
                                            id="service_{{ $service->id }}"
                                            @checked(
                                                in_array(
                                                    $service->id,
                                                    old(
                                                        'services',
                                                        $appointment
                                                            ->services
                                                            ->pluck('id')
                                                            ->toArray()
                                                    )
                                                )
                                            )
                                        >

                                        <label
                                            class="form-check-label"
                                            for="service_{{ $service->id }}"
                                        >
                                            {{ $service->name }}

                                            @if ($service->price !== null)
                                                —
                                                {{ number_format(
                                                    (float) $service->price,
                                                    2,
                                                    ',',
                                                    '.'
                                                ) }} €
                                            @endif

                                        </label>

                                    </div>

                                @endforeach

                            </div>

                        </div>

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
                            href="{{ route('appointments.show', $appointment) }}"
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

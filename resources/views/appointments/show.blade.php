@extends('layouts.app')

@section('title', 'Consulta - VetCare')

@section('content')

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-start mb-4">

            <div>
                <h1 class="h2">
                    Consulta #{{ $appointment->id }}
                </h1>

                <p class="text-muted">
                    {{ $appointment->pet->name }}
                </p>
            </div>

            <div>

                @role('admin')
                <a
                    href="{{ route('appointments.edit', $appointment) }}"
                    class="btn btn-primary"
                >
                    <i class="bi bi-pencil"></i>
                    Editar
                </a>
                @endrole

                <a
                    href="{{ route('appointments.index') }}"
                    class="btn btn-outline-secondary"
                >
                    Voltar
                </a>

            </div>

        </div>


        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h2 class="h4 mb-4">
                            Informação da consulta
                        </h2>

                        <div class="row">

                            <div class="col-md-6">

                                <p>
                                    <strong>Animal:</strong><br>
                                    {{ $appointment->pet->name }}
                                </p>

                                <p>
                                    <strong>Tutor:</strong><br>
                                    {{ $appointment->pet->user->name }}
                                </p>

                                <p>
                                    <strong>Espécie:</strong><br>
                                    {{ $appointment->pet->species->name }}
                                </p>

                            </div>

                            <div class="col-md-6">

                                <p>
                                    <strong>Veterinário:</strong><br>
                                    {{ $appointment->veterinarian->name }}
                                </p>

                                <p>
                                    <strong>Data:</strong><br>
                                    {{ $appointment->appointment_date->format('d/m/Y H:i') }}
                                </p>

                                <p>
                                    <strong>Estado:</strong><br>

                                    @if ($appointment->status === 'Realizada')

                                        <span class="badge text-bg-success">
                                        Realizada
                                    </span>

                                    @elseif ($appointment->status === 'Agendada')

                                        <span class="badge text-bg-warning">
                                        Agendada
                                    </span>

                                    @else

                                        <span class="badge text-bg-secondary">
                                        {{ $appointment->status }}
                                    </span>

                                    @endif

                                </p>

                            </div>

                        </div>


                        <hr>


                        <p>
                            <strong>Motivo:</strong><br>
                            {{ $appointment->reason }}
                        </p>

                    </div>

                </div>


                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h2 class="h4 mb-4">
                            Serviços associados
                        </h2>

                        @forelse ($appointment->services as $service)

                            <div class="border-bottom pb-3 mb-3">

                                <div class="d-flex justify-content-between">

                                    <strong>
                                        {{ $service->name }}
                                    </strong>

                                    @if ($service->price !== null)

                                        <span>
                                        {{ number_format((float) $service->price, 2, ',', '.') }} €
                                    </span>

                                    @endif

                                </div>

                                @if ($service->description)

                                    <p class="text-muted mb-0 mt-1">
                                        {{ $service->description }}
                                    </p>

                                @endif

                            </div>

                        @empty

                            <p class="text-muted mb-0">
                                Não existem serviços associados a esta consulta.
                            </p>

                        @endforelse

                    </div>

                </div>


                <div class="card shadow-sm">

                    <div class="card-body">

                        <h2 class="h4 mb-4">
                            Notas
                        </h2>


                        @forelse ($appointment->notes->sortByDesc('created_at') as $note)

                            <div class="border-bottom pb-3 mb-3">

                                <div class="d-flex justify-content-between align-items-start">

                                    <div>

                                        <strong>
                                            {{ $note->user->name }}
                                        </strong>

                                        <small class="text-muted ms-2">
                                            {{ $note->created_at->format('d/m/Y H:i') }}
                                        </small>

                                    </div>


                                    @role('admin')

                                    <form
                                        method="POST"
                                        action="{{ route('notes.destroy', $note) }}"
                                        onsubmit="return confirm('Tem a certeza de que pretende eliminar esta nota?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Eliminar nota"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                    @endrole

                                </div>


                                <p class="mb-0 mt-2">
                                    {{ $note->body }}
                                </p>

                            </div>

                        @empty

                            <p class="text-muted">
                                Não existem notas associadas a esta consulta.
                            </p>

                        @endforelse


                        @role('admin')

                        <hr>

                        <h3 class="h5 mb-3">
                            Nova nota
                        </h3>

                        <form
                            method="POST"
                            action="{{ route('appointments.notes.store', $appointment) }}"
                        >

                            @csrf

                            <div class="mb-3">

                    <textarea
                        name="body"
                        rows="3"
                        class="form-control @error('body') is-invalid @enderror"
                        placeholder="Escreva uma nota..."
                    >{{ old('body') }}</textarea>

                                @error('body')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror

                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i class="bi bi-plus-lg"></i>
                                Adicionar nota
                            </button>

                        </form>

                        @endrole

                    </div>

                </div>

            </div>


            <div class="col-lg-4">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <h2 class="h5 mb-3">
                            Resumo
                        </h2>

                        <p class="mb-1">
                            <strong>Animal:</strong>
                        </p>

                        <p>
                            {{ $appointment->pet->name }}
                        </p>

                        <p class="mb-1">
                            <strong>Veterinário:</strong>
                        </p>

                        <p>
                            {{ $appointment->veterinarian->name }}
                        </p>

                        <p class="mb-1">
                            <strong>N.º de serviços:</strong>
                        </p>

                        <p class="fs-4 mb-0">
                            {{ $appointment->services->count() }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

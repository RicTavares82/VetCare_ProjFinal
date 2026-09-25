@extends('layouts.app')

@section('title', $pet->name . ' - VetCare')

@section('content')

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-start mb-4">

            <div>

            <span class="badge text-bg-primary mb-2">
                {{ $pet->species->name }}
            </span>

                <h1>
                    {{ $pet->name }}
                </h1>

                <p class="text-muted">
                    Animal #{{ $pet->id }}
                </p>

            </div>


            <div>

                @role('admin')

                <a
                    href="{{ route('pets.edit', $pet) }}"
                    class="btn btn-primary"
                >
                    <i class="bi bi-pencil"></i>
                    Editar
                </a>

                @endrole

                <a
                    href="{{ route('pets.index') }}"
                    class="btn btn-outline-secondary"
                >
                    Voltar
                </a>

            </div>

        </div>


        <div class="row g-4">

            <div class="col-lg-8">

                {{-- Informação do animal --}}
                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h2 class="h4 mb-4">
                            Informação do animal
                        </h2>

                        <div class="row">

                            <div class="col-md-6">

                                <p>
                                    <strong>Espécie:</strong><br>
                                    {{ $pet->species->name }}
                                </p>

                                <p>
                                    <strong>Sexo:</strong><br>
                                    {{ $pet->sex ?? '-' }}
                                </p>

                            </div>


                            <div class="col-md-6">

                                <p>
                                    <strong>Data de nascimento:</strong><br>

                                    {{ $pet->birth_date?->format('d/m/Y') ?? '-' }}
                                </p>

                                <p>
                                    <strong>Peso:</strong><br>

                                    @if ($pet->weight)
                                        {{ number_format((float) $pet->weight, 2, ',', '.') }} kg
                                    @else
                                        -
                                    @endif
                                </p>

                            </div>

                        </div>


                        <hr>


                        <h3 class="h6">
                            Observações
                        </h3>

                        <p class="mb-0">
                            {{ $pet->description ?: 'Sem observações.' }}
                        </p>

                    </div>

                </div>


                {{-- Consultas --}}
                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h2 class="h4 mb-4">
                            Consultas
                        </h2>


                        <div class="table-responsive">

                            <table class="table align-middle">

                                <thead>

                                <tr>
                                    <th>Data</th>
                                    <th>Veterinário</th>
                                    <th>Motivo</th>
                                    <th>Estado</th>
                                </tr>

                                </thead>


                                <tbody>

                                @forelse ($pet->appointments->sortByDesc('appointment_date') as $appointment)

                                    <tr>

                                        <td>
                                            {{ $appointment->appointment_date->format('d/m/Y H:i') }}
                                        </td>

                                        <td>
                                            {{ $appointment->veterinarian->name }}
                                        </td>

                                        <td>
                                            {{ $appointment->reason }}
                                        </td>

                                        <td>

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

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="4"
                                            class="text-center text-muted"
                                        >
                                            Não existem consultas registadas.
                                        </td>

                                    </tr>

                                @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>


                {{-- Notas --}}
                <div class="card shadow-sm">

                    <div class="card-body">

                        <h2 class="h4 mb-4">
                            Notas
                        </h2>


                        @forelse ($pet->notes->sortByDesc('created_at') as $note)

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
                                Não existem notas associadas a este animal.
                            </p>

                        @endforelse


                        @role('admin')

                        <hr>

                        <h3 class="h5 mb-3">
                            Nova nota
                        </h3>

                        <form
                            method="POST"
                            action="{{ route('pets.notes.store', $pet) }}"
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


            {{-- Coluna lateral --}}
            <div class="col-lg-4">

                <div class="card shadow-sm mb-4">

                    <div class="card-body">

                        <h2 class="h5 mb-3">
                            Tutor
                        </h2>

                        <p class="mb-1">

                            <i class="bi bi-person me-2"></i>

                            <strong>
                                {{ $pet->user->name }}
                            </strong>

                        </p>

                        <p class="text-muted mb-0">

                            <i class="bi bi-envelope me-2"></i>

                            {{ $pet->user->email }}

                        </p>

                    </div>

                </div>


                <div class="card shadow-sm">

                    <div class="card-body">

                        <h2 class="h5 mb-3">
                            Estado
                        </h2>


                        @if ($pet->active)

                            <span class="badge text-bg-success">
                            Ativo
                        </span>

                        @else

                            <span class="badge text-bg-secondary">
                            Inativo
                        </span>

                        @endif


                        <hr>


                        <p class="mb-1">
                            <strong>Consultas realizadas:</strong>
                        </p>

                        <p class="fs-4 mb-0">
                            {{ $pet->appointments->where('status', 'Realizada')->count() }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

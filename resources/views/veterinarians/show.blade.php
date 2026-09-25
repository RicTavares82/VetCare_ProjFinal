@extends('layouts.app')

@section('title', $veterinarian->name . ' - VetCare')

@section('content')

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-start mb-4">

            <div>

                <h1>
                    {{ $veterinarian->name }}
                </h1>

                <p class="text-muted">
                    Veterinário #{{ $veterinarian->id }}
                </p>

            </div>

            <div>

                <a
                    href="{{ route('veterinarians.edit', $veterinarian) }}"
                    class="btn btn-primary"
                >
                    <i class="bi bi-pencil"></i>
                    Editar
                </a>

                <a
                    href="{{ route('veterinarians.index') }}"
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
                            Informação do veterinário
                        </h2>

                        <p>
                            <strong>Nome:</strong><br>
                            {{ $veterinarian->name }}
                        </p>

                        <p>
                            <strong>Email:</strong><br>
                            {{ $veterinarian->email ?? '-' }}
                        </p>

                        <p>
                            <strong>Telefone:</strong><br>
                            {{ $veterinarian->phone ?? '-' }}
                        </p>

                    </div>

                </div>


                <div class="card shadow-sm">

                    <div class="card-body">

                        <h2 class="h4 mb-4">
                            Consultas
                        </h2>

                        <div class="table-responsive">

                            <table class="table align-middle">

                                <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Animal</th>
                                    <th>Motivo</th>
                                    <th>Estado</th>
                                </tr>
                                </thead>

                                <tbody>

                                @forelse ($veterinarian->appointments->sortByDesc('appointment_date') as $appointment)

                                    <tr>

                                        <td>
                                            {{ $appointment->appointment_date->format('d/m/Y H:i') }}
                                        </td>

                                        <td>
                                            {{ $appointment->pet->name }}
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
                                            Não existem consultas associadas a este veterinário.
                                        </td>

                                    </tr>

                                @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-4">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <h2 class="h5 mb-3">
                            Estado
                        </h2>

                        @if ($veterinarian->active)

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
                            <strong>Total de consultas:</strong>
                        </p>

                        <p class="fs-4 mb-0">
                            {{ $veterinarian->appointments->count() }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

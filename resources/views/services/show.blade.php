@extends('layouts.app')

@section('title', $service->name . ' - VetCare')

@section('content')

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-start mb-4">

            <div>

                <h1>
                    {{ $service->name }}
                </h1>

                <p class="text-muted">
                    Serviço #{{ $service->id }}
                </p>

            </div>

            <div>

                <a
                    href="{{ route('services.edit', $service) }}"
                    class="btn btn-primary"
                >
                    <i class="bi bi-pencil"></i>
                    Editar
                </a>

                <a
                    href="{{ route('services.index') }}"
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
                            Informação do serviço
                        </h2>

                        <p>
                            <strong>Nome:</strong><br>
                            {{ $service->name }}
                        </p>

                        <p>
                            <strong>Descrição:</strong><br>
                            {{ $service->description ?: 'Sem descrição.' }}
                        </p>

                        <p>
                            <strong>Preço:</strong><br>

                            @if ($service->price !== null)

                                {{ number_format(
                                    (float) $service->price,
                                    2,
                                    ',',
                                    '.'
                                ) }} €

                            @else

                                -

                            @endif

                        </p>

                    </div>

                </div>


                <div class="card shadow-sm">

                    <div class="card-body">

                        <h2 class="h4 mb-4">
                            Consultas associadas
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

                                @forelse ($service->appointments->sortByDesc('appointment_date') as $appointment)

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
                                            Este serviço ainda não está associado a consultas.
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

                        @if ($service->active)

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
                            <strong>Consultas associadas:</strong>
                        </p>

                        <p class="fs-4 mb-0">
                            {{ $service->appointments->count() }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

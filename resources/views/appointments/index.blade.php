@extends('layouts.app')

@section('title', 'Consultas - VetCare')

@section('content')

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h1 class="h2 mb-1">
                    Consultas
                </h1>

                <p class="text-muted mb-0">
                    Gestão e acompanhamento das consultas.
                </p>

            </div>


            @role('admin')

            <a
                href="{{ route('appointments.create') }}"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-lg"></i>
                Nova consulta
            </a>

            @endrole

        </div>


        <div class="card shadow-sm">

            <div class="card-body">

                <form
                    method="GET"
                    action="{{ route('appointments.index') }}"
                    class="row g-3 mb-4"
                >

                    <div class="col-md-9">

                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            placeholder="Pesquisar por animal..."
                            value="{{ request('search') }}"
                        >

                    </div>

                    <div class="col-md-3">

                        <button
                            type="submit"
                            class="btn btn-outline-primary w-100"
                        >
                            <i class="bi bi-search"></i>
                            Pesquisar
                        </button>

                    </div>

                </form>


                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                        <tr>
                            <th>#</th>
                            <th>Data</th>
                            <th>Animal</th>
                            <th>Tutor</th>
                            <th>Veterinário</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th class="text-end">
                                Ações
                            </th>
                        </tr>

                        </thead>


                        <tbody>

                        @forelse ($appointments as $appointment)

                            <tr>

                                <td>
                                    {{ $appointment->id }}
                                </td>

                                <td>
                                    {{ $appointment->appointment_date->format('d/m/Y H:i') }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $appointment->pet->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $appointment->pet->user->name }}
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


                                <td class="text-end">

                                    <a
                                        href="{{ route('appointments.show', $appointment) }}"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Ver"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>


                                    @role('admin')

                                    <a
                                        href="{{ route('appointments.edit', $appointment) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Editar"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route('appointments.destroy', $appointment) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Tem a certeza de que pretende eliminar esta consulta?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Eliminar"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                    @endrole

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center text-muted"
                                >
                                    Nenhuma consulta encontrada.
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="mt-4">

                    {{ $appointments->withQueryString()->links() }}

                </div>

            </div>

        </div>

    </div>

@endsection

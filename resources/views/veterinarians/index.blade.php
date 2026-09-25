@extends('layouts.app')

@section('title', 'Veterinários - VetCare')

@section('content')

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="h2 mb-1">
                    Veterinários
                </h1>

                <p class="text-muted mb-0">
                    Gestão dos veterinários da clínica.
                </p>
            </div>

            <a
                href="{{ route('veterinarians.create') }}"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-lg"></i>
                Novo veterinário
            </a>

        </div>


        <div class="card shadow-sm">

            <div class="card-body">

                <form
                    method="GET"
                    action="{{ route('veterinarians.index') }}"
                    class="row g-3 mb-4"
                >

                    <div class="col-md-9">

                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            placeholder="Pesquisar por nome ou email..."
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
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Estado</th>
                            <th class="text-end">
                                Ações
                            </th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse ($veterinarians as $veterinarian)

                            <tr>

                                <td>
                                    {{ $veterinarian->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $veterinarian->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $veterinarian->email ?? '-' }}
                                </td>

                                <td>
                                    {{ $veterinarian->phone ?? '-' }}
                                </td>

                                <td>

                                    @if ($veterinarian->active)

                                        <span class="badge text-bg-success">
                                        Ativo
                                    </span>

                                    @else

                                        <span class="badge text-bg-secondary">
                                        Inativo
                                    </span>

                                    @endif

                                </td>

                                <td class="text-end">

                                    <a
                                        href="{{ route('veterinarians.show', $veterinarian) }}"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Ver"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('veterinarians.edit', $veterinarian) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Editar"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('veterinarians.destroy', $veterinarian) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Tem a certeza de que pretende eliminar este veterinário?')"
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

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="6"
                                    class="text-center text-muted"
                                >
                                    Nenhum veterinário encontrado.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="mt-4">

                    {{ $veterinarians->withQueryString()->links() }}

                </div>

            </div>

        </div>

    </div>

@endsection

@extends('layouts.app')

@section('title', 'Animais - VetCare')

@section('content')

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="h2 mb-1">Animais</h1>

                <p class="text-muted mb-0">
                    Gestão dos animais registados na clínica.
                </p>
            </div>

            <a href="{{ route('pets.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Novo animal
            </a>

        </div>


        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>
        @endif


        <div class="card shadow-sm">

            <div class="card-body">

                <form method="GET"
                      action="{{ route('pets.index') }}"
                      class="row g-3 mb-4">

                    <div class="col-md-6">

                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            placeholder="Pesquisar animal..."
                            value="{{ request('search') }}"
                        >

                    </div>


                    <div class="col-md-3">

                        <select
                            name="species_id"
                            class="form-select">

                            <option value="">
                                Todas as espécies
                            </option>

                            @foreach ($species as $item)

                                <option
                                    value="{{ $item->id }}"
                                    @selected(request('species_id') == $item->id)
                                >
                                    {{ $item->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-3">

                        <button
                            type="submit"
                            class="btn btn-outline-primary w-100">

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
                            <th>Espécie</th>
                            <th>Tutor</th>
                            <th>Data nascimento</th>
                            <th>Estado</th>
                            <th class="text-end">Ações</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse ($pets as $pet)

                            <tr>

                                <td>{{ $pet->id }}</td>

                                <td>
                                    <strong>
                                        {{ $pet->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $pet->species->name }}
                                </td>

                                <td>
                                    {{ $pet->user->name }}
                                </td>

                                <td>
                                    {{ $pet->birth_date?->format('d/m/Y') ?? '-' }}
                                </td>

                                <td>

                                    @if ($pet->active)

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
                                        href="{{ route('pets.show', $pet) }}"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Ver">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a
                                        href="{{ route('pets.edit', $pet) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Editar">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form
                                        action="{{ route('pets.destroy', $pet) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Tem a certeza de que pretende eliminar este animal?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Eliminar">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Nenhum animal encontrado.
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="mt-4">

                    {{ $pets->withQueryString()->links() }}

                </div>

            </div>

        </div>

    </div>

@endsection

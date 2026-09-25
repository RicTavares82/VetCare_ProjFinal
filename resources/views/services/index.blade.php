@extends('layouts.app')

@section('title', 'Serviços - VetCare')

@section('content')

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h1 class="h2 mb-1">
                    Serviços
                </h1>

                <p class="text-muted mb-0">
                    Gestão dos serviços disponibilizados pela clínica.
                </p>

            </div>

            <a
                href="{{ route('services.create') }}"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-lg"></i>
                Novo serviço
            </a>

        </div>


        <div class="card shadow-sm">

            <div class="card-body">

                <form
                    method="GET"
                    action="{{ route('services.index') }}"
                    class="row g-3 mb-4"
                >

                    <div class="col-md-9">

                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            placeholder="Pesquisar serviço..."
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
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Estado</th>
                            <th class="text-end">
                                Ações
                            </th>
                        </tr>

                        </thead>


                        <tbody>

                        @forelse ($services as $service)

                            <tr>

                                <td>
                                    {{ $service->id }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $service->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $service->description ?? '-' }}
                                </td>

                                <td>

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

                                </td>

                                <td>

                                    @if ($service->active)

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
                                        href="{{ route('services.show', $service) }}"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Ver"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('services.edit', $service) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Editar"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('services.destroy', $service) }}"
                                        class="d-inline"
                                        onsubmit="return confirm('Tem a certeza de que pretende eliminar este serviço?')"
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
                                    Nenhum serviço encontrado.
                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="mt-4">

                    {{ $services->withQueryString()->links() }}

                </div>

            </div>

        </div>

    </div>

@endsection

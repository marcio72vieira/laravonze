@extends('layouts.admin')

@section('content')
    <div class="px-4 container-fluid">
        <div class="gap-2 mb-1 hstack">
            <h2 class="mt-3">Usuário</h2>
            <ol class="mt-3 mb-3 breadcrumb ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Usuários</li>
            </ol>
        </div>

        <div class="mb-4 shadow card border-light">
            <div class="gap-2 card-header hstack">
                <span>Listar</span>
                <span class="ms-auto">
                    @can('create-user')
                        <a href="{{ route('user.create') }}" class="btn btn-success btn-sm"><i
                                class="fa-regular fa-square-plus"></i> Cadastrar
                        </a>
                    @endcan
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th class="d-none d-md-table-cell">E-mail</th>
                            <th class="d-none d-md-table-cell">Papel</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($users as $user)
                            <tr>
                                <th>{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td class="d-none d-md-table-cell">{{ $user->email }}</td>
                                <td class="d-none d-md-table-cell">
                                    {{-- Outra forma de recuperar os papéis do usuário: $user->roles[0]->name --}}
                                    {{-- O forelse foi utilizado pois o usuári poderá ter mais de um papel --}}
                                    @forelse ($user->getRoleNames() as $role)
                                        {{ $role }}
                                    @empty
                                        {{ " - " }}
                                    @endforelse
                                </td>
                                <td class="flex-row d-md-flex justify-content-center">

                                    @can('show-user')
                                        <a href="{{ route('user.show', ['user' => $user->id]) }}"
                                            class="mb-1 btn btn-primary btn-sm me-1">
                                            <i class="fa-regular fa-eye"></i> Visualizar
                                        </a>
                                    @endcan

                                    @can('edit-user')
                                        <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                                            class="mb-1 btn btn-warning btn-sm me-1">
                                            <i class="fa-solid fa-pen-to-square"></i> Editar
                                        </a>
                                    @endcan

                                    @can('destroy-user')
                                        <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="mb-1 btn btn-danger btn-sm me-1"
                                                onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                                        </form>
                                    @endcan

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum usuário encontrado!</div>
                        @endforelse

                    </tbody>
                </table>

                    {{ $users->onEachSide(0)->links() }}

            </div>
        </div>
    </div>
@endsection

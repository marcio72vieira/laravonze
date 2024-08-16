@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Permissõe do Papel - {{ $role->name }}</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('role.index') }}" class="text-decoration-none">Papéis</a>
                </li>

                <li class="breadcrumb-item active">Permissões</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">

            <div class="card-header mb-1 hstack gap-2">
                <span>Listar</span>

                <span class="ms-auto">
                    @can('index-role')
                        <a href="{{ route('role.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0">
                            <i class="fa-solid fa-list-ul"></i> Listar
                        </a>
                    @endcan

                    {{-- @can('create-role')
                        <a href="{{ route('role.create') }}" class="btn btn-success btn-sm">
                            <i class="fa-regular fa-square-plus"></i> Cadastrar
                        </a>
                    @endcan --}}
                </span>
            </div>

            <div class="card-body">
                {{-- Mensagem sem uso de componente  @if (session('success')) <p style="background-color: green; color: white"> {{ session('success') }} </p> @endif --}}

                <x-alert />


                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">ID</th>
                            <th>Título</th>
                            <th>
                                {{-- Se o usuário autenticado for Super Administrador, exibe esta coluna --}}
                                @if(Auth::user()->hasRole('Super Admin'))
                                    Nome
                                @endif
                            </th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>


                        @forelse ($permissions as $permission)
                            <tr>
                                <td class="d-none d-sm-table-cell">{{ $permission->id }}</td>
                                <td>{{ $permission->title }}</td>
                                <td>
                                    {{-- Se o usuário autenticado for Super Administrador, exibe esta coluna --}}
                                    @if(Auth::user()->hasRole('Super Admin'))
                                        {{ $permission->name }}
                                    @endif
                                </td>
                                <td class="text-center">

                                    {{-- Explicando $rolePermissions ?? []: Se o array $rolePermissions for diferente de vazio utilize ele mesmo senão, coloca um array vazio[] --}}
                                    {{-- A expressão ternária $rolePermissions ?? [], significa que se o papel tiver permissão, utiliza ele mesmo, senão utiliza um array vazio --}}
                                    @if (in_array($permission->id, $rolePermissions ?? []))
                                        @can('update-role-permission')
                                            <a href="{{ route('role-permission.update', ['role' => $role->id, 'permission' => $permission->id])}}"><span class="badge text-bg-success">Liberado</span></a>
                                        @else
                                            <span class="badge text-bg-secondary">Liberado</span>
                                        @endcan
                                    @else
                                        @can('update-role-permission')
                                            <a href="{{ route('role-permission.update', ['role' => $role->id, 'permission' => $permission->id])}}"><span class="badge text-bg-danger">Bloqueado</span></a>
                                        @else
                                            <span class="badge text-bg-secondary">Bloqueado</span>
                                        @endcan
                                    @endif

                                    {{-- @can('index-role-permission')
                                        <a href="{{ route('role-permission.index', ['role' => $role->id]) }}" class="btn btn-info btn-sm me-1 mb-1 mb-md-0">
                                            <i class="fa-solid fa-list"></i> Permissões
                                        </a>
                                    @endcan

                                    @can('show-role')
                                        <a href="{{ route('role.show', ['role' => $role->id]) }}" class="btn btn-primary btn-sm me-1 mb-1 mb-md-0">
                                            <i class="fa-regular fa-eye"></i> Visualizar
                                        </a>
                                    @endcan

                                    @can('edit-role')
                                        <a href="{{ route('role.edit', ['role' => $role->id]) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-md-0">
                                            <i class="fa-regular fa-pen-to-square"></i> Editar
                                        </a>
                                    @endcan

                                    @can('destroy-role')
                                        <form action="{{ route('role.destroy', ['role' => $role->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"  class="btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza que deseja apagar este registro?')">
                                                <i class="fa-regular fa-trash-can"></i> Apagar
                                            </button>
                                        </form>
                                    @endcan --}}

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhuma permissão para o papel encontrada!
                            </div>
                        @endforelse


                    </tbody>
                </table>

            </div>

        </div>
    </div>



@endsection





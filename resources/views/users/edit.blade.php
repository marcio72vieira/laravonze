@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Usuário</h2>
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('user.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active">Usuário</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header hstack gap-2">
                <span>Editar</span>
                <span class="ms-auto d-sm-flex flex-row">

                    @can('index-user')
                        <a href="{{ route('user.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                            Listar
                        </a>
                    @endcan

                    @can('show-user')
                        <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-primary btn-sm me-1"><i
                                class="fa-regular fa-eye"></i> Visualizar
                        </a>
                    @endcan

                    @can('destroy-user')
                        <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm me-1"
                                onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                        </form>
                    @endcan

                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label for="name" class="form-label">Nome: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome completo"
                            value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">E-mail: </label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Melhor e-mail do usuário" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="col-12">
                        <label for="roles" class="form-label">Papel: </label>
                        <select name="roles" id="roles" class="form-select">
                            <option value="">Selecione</option>
                            @foreach ($roles as $role)
                                {{-- Se for Super Admin, "exibe" o papel "Super Admin"[Papeis: [Super Admin, Admin, Professor, Tutor, Aluno] --}}
                                @if ($role != "Super Admin")
                                    <option value="{{ $role }}" {{ old('roles', $userRoles) == $role ? 'selected' : '' }}>{{ $role }}</option>
                                @else
                                    {{-- Se o usuário autenticado for Super Admin "exibe" o papel de "Super Admin" --}}
                                    @if (Auth::user()->hasRole("Super Admin"))
                                        <option value="{{ $role }}" {{ old('roles', $userRoles) == $role || $userRoles == $role ? 'selected' : '' }}>{{ $role }}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-warning btn-sm">Salvar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

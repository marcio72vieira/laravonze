@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="ms-2 mt-3 me-3">Permissões</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ route('permission.index') }}">Permissõess</a>
                </li>
                <li class="breadcrumb-item active">Permissão</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">

            <div class="card-header mb-1 hstack gap-2">
                <span>Editar</span>

                <span class="ms-auto d-sm-flex flex-row">
                    @can('show-permission')
                        <a href="{{ route('permission.show', ['permission' => $permission->id]) }}" class="btn btn-primary btn-sm me-1">
                            <i class="fa-regular fa-eye"></i> Visualizar
                        </a>
                    @endcan

                    @can('destroy-permission')
                        <form method="POST" action="{{ route('permission.destroy', ['permission' => $permission->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm me-1"
                                onclick="return confirm('Tem certeza que deseja apagar este registro?')">
                                <i class="fa-regular fa-trash-can"></i> Apagar</button>
                        </form>
                    @endcan
                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <form action="{{ route('permission.update', ['permission' => $permission->id]) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label for="title" class="form-label">Título: </label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Título da página"
                            value="{{ old('title', $permission->title) }}">
                    </div>

                    <div class="col-12">
                        <label for="name" class="form-label">Nome: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome da página"
                            value="{{ old('name', $permission->name) }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-warning bt-sm">Salvar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

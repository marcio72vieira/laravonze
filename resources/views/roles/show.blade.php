@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Papel</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('role.index')}}" class="text-decoration-none">Papéis</a>
                </li>
                <li class="breadcrumb-item active">Papel</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header mb-1 hstack gap-2">
                <span>Visualizar</span>

                <span class="ms-auto d-sm-flex flex-row">
                    <a href="#" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0">
                        <i class="fa-solid fa-list"></i> Permissões
                    </a>

                    @can('index-course')
                        <a href="{{ route('role.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0">
                            <i class="fa-solid fa-list"></i> Listar
                        </a>
                    @endcan

                    @can('edit-course')
                        <a href="{{ route('role.edit',['role' => $role->id]) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-sm-0">
                            <i class="fa-regular fa-pen-to-square"></i> Editar
                        </a>
                    @endcan

                    @can('destroy-course')
                        <form action="#" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza que deseja apagar este registro?')">
                                <i class="fa-regular fa-trash-can"></i> Apagar
                            </button>
                        </form>
                    @endcan

                </span>
            </div>

            <div class="card-body">
                {{-- Mensagem sem uso de componente  @if (session('success')) <p style="background-color: green; color: white"> {{ session('success') }} </p> @endif --}}

                <x-alert />

                <dl class="row">
                    <dt class="col-sm-2">ID:</dt>
                    <dd class="col-sm-10">{{ $role->id }}</dd>

                    <dt class="col-sm-2">Nome:</dt>
                    <dd class="col-sm-10">{{ $role->name }}</dd>

                    <dt class="col-sm-2">Aplicação:</dt>
                    <dd class="col-sm-10">{{ $role->guard_name }}</dd>

                    <dt class="col-sm-2">Criado:</dt>
                    <dd class="col-sm-10">{{ \Carbon\Carbon::parse($role->created_at)->format('d/m/Y H:i:s') }}</dd>

                    <dt class="col-sm-2">Editado:</dt>
                    <dd class="col-sm-10">{{ \Carbon\Carbon::parse($role->updated_at)->format('d/m/Y H:i:s') }}</dd>
                </dl>

            </div>

        </div>
    </div>

@endsection




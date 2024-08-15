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
                <span>Cadastrar</span>

                <span class="ms-auto d-sm-flex flex-row">
                    @can('index-role')
                        <a href="{{ route('role.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0">
                            <i class="fa-solid fa-list-ul"></i> Listar
                        </a>
                    @endcan
                </span>
            </div>

            <div class="card-body">
                {{-- Mensagem sem uso de componente  @if (session('success')) <p style="background-color: green; color: white"> {{ session('success') }} </p> @endif --}}

                <x-alert />

                <form class="row g-3"  action="{{ route('role.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="col-12">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text"  name="name" id="name" class="form-control" placeholder="nome do papel" value="{{ old('name') }}">
                    </div>

                    <div class="col-12">
                        <label for="guard_name" class="form-label">Aplicação</label>
                        <input type="text"  name="guard_name" id="guard_name" class="form-control" placeholder="aplicação (web ou api)" value="{{ old('guard_name') }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-sm">Cadastar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection




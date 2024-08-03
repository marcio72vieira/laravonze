@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Aula</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Aula</li>
            </ol>
        </div>

        <div class="card mb-4">
            <div class="card-header mb-1 hstack gap-2">
                <span>Visualizar</span>

                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('classe.index', ['course' => $classe->course->id]) }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0">
                        Curso
                    </a>
                    <a href="{{ route('classe.edit', ['classe' => $classe->id]) }}" class="btn btn-warning btn-sm me-1 mb-1 mb-sm-0">
                        Editar
                    </a>

                    <form action="{{ route('classe.destroy', ['classe' => $classe->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
                    </form>
                </span>
            </div>

            <div class="card-body">
                {{-- Mensagem sem uso de componente  @if (session('success')) <p style="background-color: green; color: white"> {{ session('success') }} </p> @endif --}}

                <x-alert />

                <dl class="row">
                    <dt class="col-sm-2">ID:</dt>
                    <dd class="col-sm-10">{{ $classe->id }}</dd>

                    <dt class="col-sm-2">Nome:</dt>
                    <dd class="col-sm-10">{{ $classe->name }}</dd>

                    <dt class="col-sm-2">Descriçao:</dt>
                    <dd class="col-sm-10">{{ $classe->description }}</dd>

                    <dt class="col-sm-2">Ordem:</dt>
                    <dd class="col-sm-10">{{ $classe->order_classe }}</dd>

                    <dt class="col-sm-2">Curso:</dt>
                    <dd class="col-sm-10">{{ $classe->course->name }}</dd>

                    <dt class="col-sm-2">Criado:</dt>
                    <dd class="col-sm-10">{{ \Carbon\Carbon::parse($classe->created_at)->format('d/m/Y H:i:s') }}</dd>

                    <dt class="col-sm-2">Editado:</dt>
                    <dd class="col-sm-10">{{ \Carbon\Carbon::parse($classe->updated_at)->format('d/m/Y H:i:s') }}</dd>
                </dl>

            </div>

        </div>
    </div>

@endsection



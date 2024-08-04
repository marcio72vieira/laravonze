@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Aula</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('classe.index', ['course' => $classe->course->id]) }}" class="text-decoration-none">Curso</a>
                </li>
                <li class="breadcrumb-item active">Aula</li>
            </ol>
        </div>

        <div class="card mb-4">
            <div class="card-header mb-1 hstack gap-2">
                <span>Cadastrar</span>

                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('classe.index', ['course' => $classe->course->id]) }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0">
                        Listar Aulas
                    </a>
                </span>
            </div>

            <div class="card-body">
                {{-- Mensagem sem uso de componente  @if (session('success')) <p style="background-color: green; color: white"> {{ session('success') }} </p> @endif --}}

                <x-alert />
                
                <form class="row g-3" action="{{ route('classe.update', ['classe' => $classe->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label for="name_course" class="form-label">Curso</label>
                        <input type="text"  name="name_course" id="name_course" class="form-control" value="{{ $classe->course->name }}" disabled>
                    </div>

                    <div class="col-12">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text"  name="name" id="name" class="form-control" placeholder="nome da aula"  value="{{ old('name', $classe->name) }}" required>
                    </div>
                    
                    <div class="col-12">
                        <label for="description" class="form-label">Preço</label>
                        <textarea type="text"  name="description" id="description" class="form-control" placeholder="descrição da aula" required>{{ old('description', $classe->description) }}</textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection



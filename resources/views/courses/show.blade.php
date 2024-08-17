@extends('layouts.admin')

@section('content')
    <div class="px-4 container-fluid">
        <div class="gap-2 mb-1 hstack">
            <h2 class="mt-3">Curso</h2>

            <ol class="mt-3 mb-3 breadcrumb ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('course.index')}}" class="text-decoration-none">Cursos</a>
                </li>
                <li class="breadcrumb-item active">Curso</li>
            </ol>
        </div>

        <div class="mb-4 shadow card border-light">
            <div class="gap-2 mb-1 card-header hstack">
                <span>Visualizar</span>

                <span class="flex-row ms-auto d-sm-flex">
                    @can('index-classe')
                        <a href="{{ route('classe.index', ['course' => $course->id]) }}" class="mb-1 btn btn-info btn-sm me-1 mb-sm-0">
                            <i class="fa-solid fa-list"></i> Aulas
                        </a>
                    @else
                        <span class="mb-1 btn btn-light btn-sm me-1 mb-md-0">
                            <i class="fa-solid fa-ban"></i> Aulas
                        </span>
                    @endcan

                    @can('index-course')
                        <a href="{{ route('course.index') }}" class="mb-1 btn btn-info btn-sm me-1 mb-sm-0">
                            <i class="fa-solid fa-list"></i> Listar
                        </a>
                    @else
                        <span class="mb-1 btn btn-light btn-sm me-1 mb-md-0">
                            <i class="fa-solid fa-ban"></i> Listar
                        </span>
                    @endcan

                    @can('edit-course')
                        <a href="{{ route('course.edit', ['course' => $course->id]) }}" class="mb-1 btn btn-warning btn-sm me-1 mb-sm-0">
                            <i class="fa-regular fa-pen-to-square"></i> Editar
                        </a>
                    @else
                        <span class="mb-1 btn btn-light btn-sm me-1 mb-md-0">
                            <i class="fa-solid fa-ban"></i> Editar
                        </span>
                    @endcan

                    @can('destroy-course')
                        <form action="{{ route('course.destroy', ['course' => $course->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza que deseja apagar este registro?')">
                                <i class="fa-regular fa-trash-can"></i> Apagar
                            </button>
                        </form>
                    @else
                        <span class="mb-1 btn btn-light btn-sm me-1 mb-md-0">
                            <i class="fa-solid fa-ban"></i> Apagar
                        </span>
                    @endcan

                </span>
            </div>

            <div class="card-body">
                {{-- Mensagem sem uso de componente  @if (session('success')) <p style="background-color: green; color: white"> {{ session('success') }} </p> @endif --}}

                <x-alert />

                <dl class="row">
                    <dt class="col-sm-2">ID:</dt>
                    <dd class="col-sm-10">{{ $course->id }}</dd>

                    <dt class="col-sm-2">Nome:</dt>
                    <dd class="col-sm-10">{{ $course->name }}</dd>

                    <dt class="col-sm-2">Preço:</dt>
                    <dd class="col-sm-10">{{ 'R$ '.number_format($course->price, 2, ',','.') }}</dd>

                    <dt class="col-sm-2">Criado:</dt>
                    <dd class="col-sm-10">{{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}</dd>

                    <dt class="col-sm-2">Editado:</dt>
                    <dd class="col-sm-10">{{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s') }}</dd>
                </dl>

            </div>

        </div>
    </div>

@endsection



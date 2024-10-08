@extends('layouts.admin')

@section('content')
    <div class="px-4 container-fluid">
        <div class="gap-2 mb-1 hstack">
            <h2 class="mt-3">Aulas: {{ $course->name }}</h2>

            <ol class="mt-3 mb-3 breadcrumb ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('course.index') }}" class="text-decoration-none">Cursos</a>
                </li>
                <li class="breadcrumb-item active">Aulas</li>
            </ol>
        </div>

        <div class="mb-4 card">
            <div class="gap-2 mb-1 card-header hstack">
                <span>Listar</span>

                <span class="ms-auto">
                    <a href="{{ route('course.show', ['course' => $course->id]) }}" class="btn btn-info btn-sm">
                        <i class="fa-solid fa-list"></i> Curso
                    </a>
                    @can('create-classe')
                        <a href="{{ route('classe.create', ['course' => $course->id]) }}" class="btn btn-success btn-sm">
                            <i class="fa-regular fa-square-plus"></i> Cadastrar
                        </a>
                    @else
                        <span class="mb-1 btn btn-light btn-sm me-1 mb-md-0">
                            <i class="fa-solid fa-ban"></i> Cadastrar
                        </span>
                    @endcan
                </span>
            </div>

            <div class="card-body">
                {{-- Mensagem sem uso de componente  @if (session('success')) <p style="background-color: green; color: white"> {{ session('success') }} </p> @endif --}}

                <x-alert />

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">ID</th>
                            <th>Nome</th>
                            <th class="d-none d-md-table-cell">Descrição</th>
                            <th class="d-none d-md-table-cell">Ordem</th>
                            <th class="d-none d-md-table-cell">Curso</th>
                            <th class="d-none d-md-table-cell">Cadastrado</th>
                            <th class="d-none d-md-table-cell">Editado</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Imprimir os registros --}}
                        @forelse ($classes as $classe)
                            <tr>
                                <th class="d-none d-sm-table-cell">{{ $classe->id }}</th>
                                <td>{{ $classe->name }}</td>
                                <td>{{ $classe->description }}</td>
                                <td class="d-none d-md-table-cell">{{ $classe->order_classe }}</td>
                                <td class="d-none d-md-table-cell">{{ $classe->course->name }}</td>
                                <td class="d-none d-md-table-cell">{{ \Carbon\Carbon::parse($classe->created_at)->format('d/m/Y H:i:s') }}</td>
                                <td class="d-none d-md-table-cell">{{ \Carbon\Carbon::parse($classe->updated_at)->format('d/m/Y H:i:s') }}</td>
                                <td class="flex-row d-md-flex justify-content-center">
                                    @can('index-classe')
                                        <a href="{{ route('classe.show', ['classe' => $classe->id]) }}" class="mb-1 btn btn-primary btn-sm me-1 mb-md-0">
                                            <i class="fa-regular fa-eye"></i> Visualizar
                                        </a>
                                    @endcan

                                    @can('edit-classe')
                                        <a href="{{ route('classe.edit', ['classe' => $classe->id]) }}" class="mb-1 btn btn-warning btn-sm me-1 mb-md-0">
                                            <i class="fa-regular fa-pen-to-square"></i> Editar
                                        </a>
                                    @endcan

                                    @can('destroy-classe')
                                        <form action="{{ route('classe.destroy', ['classe' => $classe->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"  class="btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza que deseja apagar este registro?')">
                                                <i class="fa-regular fa-trash-can"></i> Apagar
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhuma aula encontrada!
                            </div>
                        @endforelse
                    </tbody>
                </table>

            </div>

        </div>
    </div>
@endsection




@extends('layouts.admin')

@section('content')
    <div class="px-4 container-fluid">
        <div class="gap-2 mb-1 hstack">
            <h2 class="mt-3">Curso</h2>

            <ol class="mt-3 mb-3 breadcrumb ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Cursos</li>
            </ol>
        </div>

        <div class="mb-4 shadow card border-light">
            <div class="gap-2 mb-1 card-header hstack">
                <span>Listar</span>

                <span class="ms-auto">
                    @can('create-course')
                        <a href="{{ route('course.create') }}" class="btn btn-success btn-sm">
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
                            <th class="d-none d-md-table-cell">Preço</th>
                            <th class="d-none d-md-table-cell">Cadastrado</th>
                            <th class="d-none d-md-table-cell">Editado</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Imprimir os registros --}}
                        @forelse ($courses as $course )
                            <tr>
                                <th class="d-none d-sm-table-cell">{{ $course->id }}</th>
                                <td>{{ $course->name }}</td>
                                <td class="d-none d-md-table-cell">{{ 'R$ '.number_format($course->price, 2, ',','.') }}</td>
                                <td class="d-none d-md-table-cell">{{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}</td>
                                <td class="d-none d-md-table-cell">{{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s') }}</td>
                                <td class="flex-row d-md-flex justify-content-center">
                                    @can('index-classe')
                                        <a href="{{ route('classe.index', ['course' => $course->id]) }}" class="mb-1 btn btn-info btn-sm me-1 mb-md-0">
                                            <i class="fa-solid fa-list"></i> Aulas
                                        </a>
                                    @else
                                        <span class="mb-1 btn btn-light btn-sm me-1 mb-md-0">
                                            <i class="fa-solid fa-ban"></i> Aulas
                                        </span>
                                    @endcan

                                    @can('show-course')
                                        <a href="{{ route('course.show', ['course' => $course->id]) }}" class="mb-1 btn btn-primary btn-sm me-1 mb-md-0">
                                            <i class="fa-regular fa-eye"></i> Visualizar
                                        </a>
                                    @else
                                        <span class="mb-1 btn btn-light btn-sm me-1 mb-md-0">
                                            <i class="fa-solid fa-ban"></i> Visualizar
                                        </span>
                                    @endcan

                                    @can('edit-course')
                                        <a href="{{ route('course.edit', ['course' => $course->id]) }}" class="mb-1 btn btn-warning btn-sm me-1 mb-md-0">
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
                                            <button type="submit"  class="btn btn-danger btn-sm me-1" onclick="return confirm('Tem certeza que deseja apagar este registro?')">
                                                <i class="fa-regular fa-trash-can"></i> Apagar
                                            </button>
                                        </form>
                                    @else
                                        <span class="mb-1 btn btn-light btn-sm me-1 mb-md-0">
                                            <i class="fa-solid fa-ban"></i> Apagar
                                        </span>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Nenhum curso encontrado!
                            </div>
                        @endforelse
                    </tbody>
                </table>

                {{-- Imprimir a paginação --}}
                {{ $courses->links() }}

            </div>

        </div>
    </div>



@endsection



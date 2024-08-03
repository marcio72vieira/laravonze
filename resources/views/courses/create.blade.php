@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <h2 class="mt-3">Curso</h2>

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('course.index')}}" class="text-decoration-none">Cursos</a>
                </li>
                <li class="breadcrumb-item active">Curso</li>
            </ol>
        </div>

        <div class="card mb-4">
            <div class="card-header mb-1 hstack gap-2">
                <span>Cadastrar</span>

                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('course.index') }}" class="btn btn-info btn-sm me-1 mb-1 mb-sm-0">
                        Listar
                    </a>
                </span>
            </div>

            <div class="card-body">
                {{-- Mensagem sem uso de componente  @if (session('success')) <p style="background-color: green; color: white"> {{ session('success') }} </p> @endif --}}

                <x-alert />
                
                <form class="row g-3"  action="{{ route('course.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="col-12">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text"  name="name" id="name" class="form-control" placeholder="nome do curso" value="{{ old('name') }}" required>
                    </div>
                    
                    <div class="col-12">
                        <label for="price" class="form-label">Preço</label>
                        <input type="text"  name="price" id="price" class="form-control" placeholder="preço do curso 99.9, usar '.' para separar real do centavo" value="{{ old('price') }}" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-sm">Cadastar</button>
                    </div>
                </form>



            </div>

        </div>
    </div>

@endsection



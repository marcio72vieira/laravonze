@extends('layouts.admin')

@section('content')

    <h2>Cadastar o Curso</h2>
    
    <a href="{{ route('courses.index') }}">
        <button type="button">Listar</button>
    </a><br><br>
    
    @if (session('success'))
        <p style="background-color: green; color: white">
            {{ session('success') }}
        </p>
    @endif

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        @method('POST')

        <label>Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome do curso" value="{{ old('name') }}" required><br><br>
        
        <button type="submit">Cadastrar</button>
    </form>

@endsection


@extends('layouts.admin')

@section('content')

    <h2>Cadastar Aula: {{ $course->name }}</h2>
    
    <a href="{{ route('classe.index', ['course' => $course->id]) }}">
        <button type="button">Listar Aulas</button>
    </a><br><br>
    
    <x-alert />

    <form action="{{ route('classe.store') }}" method="POST">
        @csrf
        @method('POST')

        <label>Curso:</label>
        <input type="text" name="course_id" id="course_id" placeholder="Nome do curso" value="{{ $course->id }}" ><br><br>
        
        <label>Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome do curso" value="{{ old('name') }}" ><br><br>

        <label>Descrição:</label>
        <textarea name="description" id="description" placeholder="Descrição da aula" value="{{ old('description') }}" rows=2 cols=40></textarea><br><br>

        <label>Ordem:</label>
        <input type="text" name="order_classe" id="order_classe" placeholder="Ordem da aula" value="{{ old('order_classe') }}" ><br><br>


        <button type="submit">Cadastrar</button>
    </form>

@endsection


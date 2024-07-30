@extends('layouts.admin')

@section('content')

    <h2>Editar Aula: {{ $classe->name }}</h2>
    
    <a href="{{ route('classe.index', ['course' => $classe->course->id]) }}">
        <button type="button">Listar Aulas</button>
    </a><br><br>
    
    <x-alert />

    <form action="{{ route('classe.update', ['classe' => $classe->id]) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- <input type="hidden" name="course_id" id="course_id" value="{{ $classe->course->id }}" ><br><br>}} --}}

        <label>Curso:</label>
        <input type="text" name="name_course" id="name_course" value="{{ $classe->course->name }}" disabled><br><br>
        
        <label>Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome da aula" value="{{ old('name', $classe->name) }}"><br><br>

        <label>Descrição:</label>
        <textarea name="description" id="description" placeholder="Descrição da aula" rows="4" cols="30">
            {{ old('description', $classe->description) }}
        </textarea><br><br>

        <button type="submit">Editar</button>
    </form>

@endsection


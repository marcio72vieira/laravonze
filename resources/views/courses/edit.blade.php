@extends('layouts.admin')

@section('content')
    <h2>Editar o Curso: {{ $course->name }}</h2>

    {{-- Mensagem sem uso de componente
    @if ($errors->any())
        <span style="background-color: red; color: white">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </span>
    @endif
    --}}

    <x-alert />

    <a href="{{ route('courses.index') }}">
        <button type="button">Listar</button>
    </a><br><br>
    
    <a href="{{ route('courses.show', ['course' => $course->id]) }}">
        <button type="button">Visualizar</button>
    </a><br><br>


    <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome do curso" value="{{ old('name', $course->name) }}" ><br><br>

        <label>Preço:</label>
        <input type="text" name="price" id="price" placeholder="Preço do curso 0.00" value="{{ old('price', $course->price) }}" ><br><br>
        
        <button type="submit">Salvar</button>
    </form>

@endsection


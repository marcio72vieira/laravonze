@extends('layouts.admin')

@section('content')

    <h2>Cadastar o Curso</h2>
    
    <a href="{{ route('courses.index') }}">
        <button type="button">Listar</button>
    </a><br><br>
    
    {{-- Mensagem sem uso de componente
    @if (session('success'))
        <p style="background-color: green; color: white">
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <span style="background-color: red; color: white">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </span>
    @endif
    --}}

    <x-alert />

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        @method('POST')

        <label>Nome:</label>
        <input type="text" name="name" id="name" placeholder="Nome do curso" value="{{ old('name') }}" ><br><br>

        <label>Preço:</label>
        <input type="text" name="price" id="price" placeholder="Preço do curso 0.00" value="{{ old('price') }}" ><br><br>

        <button type="submit">Cadastrar</button>
    </form>

@endsection


@extends('layouts.admin')
    
@section('content')
    <h2>Detalhes da Aula</h2>

    <a href="{{ route('classe.index', ['course' => $classe->course_id]) }}">
        <button type="button">Listar Aulas</button>
    </a><br><br>

    <a href="{{ route('classe.edit', ['classe' => $classe->id]) }}">
        <button type="button">Editar</button>
    </a><br><br>

    <form action="{{ route('classe.destroy', ['classe' => $classe->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
    </form><br>

    <x-alert />

    {{-- dd($classe) --}}
    ID: {{ $classe->id }}<br>
    Nome: {{ $classe->name }}<br>
    Descriçao: {{ $classe->description }}<br>
    Curso: {{ $classe->course->name }}<br>
    Criado: {{ \Carbon\Carbon::parse($classe->created_at)->format('d/m/Y H:i:s') }}<br>
    Editado: {{ \Carbon\Carbon::parse($classe->updated_at)->format('d/m/Y H:i:s') }}<br>
@endsection

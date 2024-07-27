@extends('layouts.admin')
    
@section('content')
    <h2>Detalhes do Curso</h2>

    <a href="{{ route('courses.index') }}">
        <button type="button">Listar</button>
    </a><br><br>

    <a href="{{ route('courses.edit', ['course' => $course->id]) }}">
        <button type="button">Editar</button>
    </a><br><br>

    <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
    </form><br>

    @if (session('success'))
        <p style="background-color: green; color: white">
            {{ session('success') }}
        </p>
    @endif

    {{-- dd($course) --}}
    ID: {{ $course->id }}<br>
    Nome: {{ $course->name }}<br>
    Criado: {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}<br>
    Editado: {{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s') }}<br>
@endsection

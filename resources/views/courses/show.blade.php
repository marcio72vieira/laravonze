@extends('layouts.admin')
    
@section('content')
    <h2>Detalhes do Curso</h2>

    <a href="{{ route('courses.index') }}">Listar</a><br>
    <a href="{{ route('courses.edit') }}">Editar</a><br><br>

    {{-- dd($course) --}}
    ID: {{ $course->id }}<br>
    Nome: {{ $course->name }}<br>
    Criado: {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}<br>
    Editado: {{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s') }}<br>
@endsection

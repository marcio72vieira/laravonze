@extends('layouts.admin')

@section('content')

    <h2>Listar os Cursos</h2>

    <a href="{{ route('courses.create') }}">Cadastrar</a><br>

    {{-- Imprimir os registros --}}
    @forelse ($courses as $course )
        {{ $course->id }}<br>
        {{ $course->name }}<br>
        {{ \Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}<br>
        {{ \Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s') }}<br>
        <a href="{{ route('courses.show', ['course' => $course->id]) }}">Visualizar</a>
        <hr>
    @empty
        <p style="background: yellow; color: black">Nenhum curso encontrado!</p>
    @endforelse

    {{-- Imprimir a paginação --}}
    {{-- $courses->links() --}}
    
@endsection



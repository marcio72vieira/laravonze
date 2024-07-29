@extends('layouts.admin')

@section('content')

    <h2>Listar as Aulas: {{ $course->name }}</h2>

    <a href="{{ route('course.index') }}">
        <button type="button">Cursos</button>
    </a><br><br>


    {{--  SEM PASSAR course como parâmetro para essa view, ou seja, acessando diretamente através da variável $classes
          <a href="{{ route('classe.create', ['course' => $classes[0]->course->id]) }}"> 
              <button type="button">Cadastrar Aula</button> 
            </a><br><br> 
    --}}
    <a href="{{ route('classe.create', ['course' => $course->id]) }}">
        <button type="button">Cadastrar</button>
    </a><br><br> 


    <x-alert />


    {{-- Imprimir os registros --}}
    @forelse ($classes as $classe )
        ID: {{ $classe->id }}<br>
        Nome: {{ $classe->name }}<br>
        Descrição: {{ $classe->description }}<br>
        Ordem: {{ $classe->order_classe }}<br>
        Curso: {{ $classe->course->name }}<br>
        Cadastrado: {{ \Carbon\Carbon::parse($classe->created_at)->format('d/m/Y H:i:s') }}<br>
        Editado: {{ \Carbon\Carbon::parse($classe->updated_at)->format('d/m/Y H:i:s') }}<br>
        <hr>
    @empty
        <p style="background: yellow; color: black">Nenhum aula encontrada!</p>
    @endforelse

    {{-- Imprimir a paginação --}}
    {{-- $classes->links() --}}
    
@endsection




<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Course;
use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    // Listar as aulas de um curso
    // Recupera os dados do curso que será obtido pelo envio da variável "id do curso" e injete na variável "$curso"
    public function index(Course $course)
    {
        //$classes = Classe::where('course_id', $course->id)->orderBy('order_classe')->get();
        // A cláusula "with" evita a consulta desnecessária no banco, evitando o problema da consulta N + 1
        $classes = Classe::with('course')->where('course_id', $course->id)->orderBy('order_classe')->get();

        return view('classes.index', ['course' => $course, 'classes' => $classes]);
        
    }

    // Visualizar a aula
    public function show(Classe $classe)
    {
        // carregar a view
        return view('classes.show', ['classe' => $classe]);
    }

    // Carregar o formulário cadastrar nova aula
    public function create(Course $course)
    {
        // carregar a view
        return view('classes.create', ['course' => $course]);
    }

    // Cadastrar no banco de dados a nova aula
    public function store(ClasseRequest $request)
    {
        // Validar o formulário
        // $request->validate();
        $validated = $request->validated(); 

        // Cadastrar no banco de dados na tabela cursos os valores de todos os campos
        $course = Course::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return  redirect()->route('course.show', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso!');
    }
}

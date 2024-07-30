<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Listar os cursos
    public function index()
    {
        // Recuperar os registros do banco de dados
        // $courses = Course::where('id', '>=', 1)->get();
        // $courses = Course::paginate(10);
        $courses = Course::orderBy('name', 'ASC')->get();

        // carregar a view
        return view('courses.index', ['courses' => $courses]);
    }

    // Visualizar o curso
    // forma-1 public function show(Request $request)
    public function show(Course $course)
    {
        // forma-1 $course = Course::where('id', $request->course)->first();

        // carregar a view
        return view('courses.show', ['course' => $course]);
    }

    // Carregar o formulário cadastrar novo curso
    public function create()
    {
        // carregar a view
        return view('courses.create');
    }

    // Cadastrar no banco de dados o novo curso
    public function store(CourseRequest $request)
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

    // Carregar o formulário editar curso
    public function edit(Course $course)
    {
        // carregar a view
        return view('courses.edit', ['course' => $course]);
    }

    // Atualizar no banco de dados o curso
    public function update(CourseRequest $request, Course $course)
    {
        // Validar o formulário
        // $request->validate();
        $validated = $request->validated(); 

        
        $course->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return  redirect()->route('course.show', ['course' => $course->id])->with('success', 'Curso editado com sucesso!');
    }


    // Excluir o curso do banco de dados
    public function destroy(Course $course)
    {
        try {

            $course->delete();
    
            return  redirect()->route('course.index')->with('success', 'Curso excluído com sucesso!');

        } catch (Exception $e) {

            return  redirect()->route('course.index')->with('warning', 'O Curso não pode ser excluído!');

        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Listar os cursos
    public function index()
    {
        // Recuperar os registros do banco de dados
        // $courses = Course::where('id', '>=', 1)->get();
        // $courses = Course::paginate(10);
        //$courses = Course::orderBy('name', 'ASC')->get();
        $courses = Course::orderBy('name', 'ASC')->paginate(2);

        Log::info('Listando cursos.');

        // carregar a view
        return view('courses.index', ['menu' => 'courses', 'courses' => $courses]);
    }

    // Visualizar o curso
    // forma-1 public function show(Request $request)
    public function show(Course $course)
    {
        // forma-1 $course = Course::where('id', $request->course)->first();

        Log::info('Visualizando curso: ', ['name' => $course->name]);

        // carregar a view
        return view('courses.show', ['menu' => 'courses', 'course' => $course]);
    }

    // Carregar o formulário cadastrar novo curso
    public function create()
    {
        // carregar a view
        return view('courses.create', ['menu' => 'courses']);
    }

    // Cadastrar no banco de dados o novo curso
    public function store(CourseRequest $request)
    {
        // Validar o formulário
        // $request->validate();
        $validated = $request->validated();

        // Marcar o ponto inicial de uma transação
        DB::beginTransaction();

        try{
            // Cadastrar no banco de dados na tabela cursos os valores de todos os campos
            $course = Course::create([
                'name' => $request->name,
                //'price' => $request->price,
                'price' => str_replace(',', '.', str_replace('.', '', $request->price)),

            ]);

            // Operação concluída com êxito
            DB::commit();

            Log::info('Curso cadastrado.', ['course_id' => $course->id]);

            return  redirect()->route('course.show', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso!');

        } catch(Exception $e) {

            // Operação não é concluiída com êxito
            DB::rollBack();

            Log::notice('Curso não cadastrado.', ['erro' => $e->getMessage()]);
            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error', 'Curso não cadastrado. Tente outra vez!');

        }



    }

    // Carregar o formulário editar curso
    public function edit(Course $course)
    {
        // carregar a view
        return view('courses.edit', ['menu' => 'courses', 'course' => $course]);
    }

    // Atualizar no banco de dados o curso
    public function update(CourseRequest $request, Course $course)
    {
        // Validar o formulário
        // $request->validate();
        $validated = $request->validated();

        // Marcar o ponto inicial de uma transação
        DB::beginTransaction();

        try{

            $course->update([
                'name' => $request->name,
                //'price' => $request->price,
                'price' => str_replace(',', '.', str_replace('.', '', $request->price)),
            ]);

            // Operação concluída com êxito
            DB::commit();

            Log::info('Curso editado.', ['course_id' => $course->id]);
            return  redirect()->route('course.show', ['course' => $course->id])->with('success', 'Curso editado com sucesso!');

        } catch(Exception $e) {

            // Operação não é concluiída com êxito
            DB::rollBack();

            Log::notice('Curso não editado.', ['erro' => $e->getMessage()]);
            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error', 'Curso não editado. Tente outra vez!');

        }

    }


    // Excluir o curso do banco de dados
    public function destroy(Course $course)
    {
        try {

            $course->delete();

            Log::info('Curso apagado.', ['course_id' => $course->id]);

            return  redirect()->route('course.index')->with('success', 'Curso excluído com sucesso!');

        } catch (Exception $e) {

            Log::info('Curso não apagado.', ['course_id' => $course->id]);

            return  redirect()->route('course.index')->with('warning', 'O Curso não pode ser excluído!');

        }
    }
}

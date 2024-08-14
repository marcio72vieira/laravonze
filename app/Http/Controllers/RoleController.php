<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles =  Role::orderBy('name', 'ASC')->paginate(40);

        // Salvar log
        Log::info('Listar papéis', ['actioin_user_id' => Auth::id()]);

        // Carregar a View
        return view('roles.index', ['menu' => 'roles','roles' => $roles]);
    }

    // Visualizar o papel
    public function show(Role $role)
    {
        // forma-1 $course = Course::where('id', $request->course)->first();

        Log::info('Visualizando role: ', ['name' => $role->name]);

        // carregar a view
        return view('roles.show', ['menu' => 'roles', 'role' => $role]);
    }

    // Carregar o formulário cadastrar novo papel
    public function create()
    {
        // carregar a view
        return view('roles.create', ['menu' => 'roles']);
    }

    // Cadastrar no banco de dados o novo papel
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

}

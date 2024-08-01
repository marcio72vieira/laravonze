<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Course;
use App\Models\Classe;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    // Listar as aulas de um curso
    // Recupera os dados do curso que será obtido pelo envio do "id" do curso e injete na variável "$curso"
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

        // Marcar o ponto inicial de uma transação
        DB::beginTransaction();

        try{

            // Recupera a última ordem da aula no curso
            $lastOrderClasse = Classe::where('course_id', $request->course_id)->orderBy('order_classe', 'DESC')->first();

            
            // Cadastrar no banco de dados na tabela classes os valores de todos os campos
            $classe = Classe::create([
                'name' => $request->name,
                'description' => $request->description,
                'order_classe' => $lastOrderClasse ? $lastOrderClasse->order_classe + 1 : 1, // Se ja existir aulas cadastradas, soma 1, caso contrário recebe 1
                'course_id' => $request->course_id,
            ]);

            // Operação concluída com êxito
            DB::commit();
            return  redirect()->route('classe.index', ['course' => $request->course_id])->with('success', 'Aula cadastrado com sucesso!');
        
        } catch(Exception $e) {

            // Operação não é concluiída com êxito
            DB::rollBack();
            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error', 'Aula não cadastrada. Tente outra vez!');

        }
        
    }

    // Carregar o formulário editar aula
    public function edit(Classe $classe)
    {
        // carregar a view
        return view('classes.edit', ['classe' => $classe]);
    }

    // Atualizar no banco de dados o curso
    public function update(ClasseRequest $request, Classe $classe)
    {
        // Validar o formulário
        // $request->validate();
        $validated = $request->validated();

        // Marcar o ponto inicial de uma transação
        DB::beginTransaction();

        try{

            // Editar as informações do registro no banco de dados
            $classe->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            
            // Operação concluída com êxito
            DB::commit();
            // Redirecionar o usuário, enviar a mensagem de sucesso
            return  redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula editada com sucesso!');
        
        } catch(Exception $e) {

            // Operação não é concluiída com êxito
            DB::rollBack();
            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error', 'Aula não editada. Tente outra vez!');

        }
    }

    // Excluir a aula do banco de dados
    public function destroy(Classe $classe)
    {
        try {
            $classe->delete();

            return  redirect()->route('classe.index', $classe->course_id)->with('success', 'Aula excluída com sucesso!');

        } catch (Exception $e) {

            return  redirect()->route('classe.index', $classe->course_id)->with('warning', 'Aula não foi excluída! ');
        }
    }
}

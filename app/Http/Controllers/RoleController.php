<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function store(RoleRequest $request)
    {
        // Validar o formulário
        $request->validated();

        // Marcar o ponto inicial de uma transação
        DB::beginTransaction();

        try{
            // Cadastrar no banco de dados na tabela roles os valores de todos os campos
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => $request->guard_name,
            ]);

            // Operação concluída com êxito
            DB::commit();

            Log::info('Papel cadastrado.', ['role_id' => $role->id]);

            return  redirect()->route('role.show', ['role' => $role->id])->with('success', 'Papel cadastrado com sucesso!');

        } catch(Exception $e) {

            // Operação não é concluiída com êxito
            DB::rollBack();

            Log::notice('Papel não cadastrado.', ['erro' => $e->getMessage()]);
            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error', 'Papel não cadastrado. Tente outra vez!');
        }
    }



    // Carregar o formulário editar papel
    public function edit(Role $role)
    {
        // carregar a view
        // Obs: O registro referente a $role já é injetado na variável $role através da "captura" de seu "id" no momento da seleção na view "index" quando o mesmo e passado
        return view('roles.edit', ['menu' => 'roles', 'role' => $role]);
    }

    // Atualizar no banco de dados o curso
    public function update(RoleRequest $request, Role $role)
    {
        // Validar o formulário
        $request->validated();

        // Marcar o ponto inicial de uma transação
        DB::beginTransaction();

        try{

            $role->update([
                'name' => $request->name,
                'guard_name' => $request->guard_name,
            ]);

            // Operação concluída com êxito
            DB::commit();

            Log::info('Papel editado.', ['role_id' => $role->id]);
            return  redirect()->route('role.show', ['role' => $role->id])->with('success', 'Papel editado com sucesso!');

        } catch(Exception $e) {

            // Operação não é concluiída com êxito
            DB::rollBack();

            Log::notice('Papel não editado.', ['erro' => $e->getMessage()]);
            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error', 'Papel não editado. Tente outra vez!');

        }

    }


    // Excluir o papel do banco de dados
    public function destroy(Role $role)
    {
        try {

            $role->delete();

            Log::info('Papel apagado.', ['role_id' => $role->id]);

            return  redirect()->route('role.index')->with('success', 'Papel excluído com sucesso!');

        } catch (Exception $e) {

            Log::info('Papel não apagado.', ['role_id' => $role->id]);

            return  redirect()->route('role.index')->with('warning', 'O Papel não pode ser excluído!');

        }
    }



}

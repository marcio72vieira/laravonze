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
        // Salvar log
        Log::info('Carregar formulário cadastrar papel.', ['action_user_id' => Auth::id()]);

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

            // Salvar log
            Log::info('Papel cadastrado.', ['id' => $role->id, 'action_user_id' => Auth::id()]);

            // Operação concluída com êxito
            DB::commit();

            return  redirect()->route('role.index')->with('success', 'Papel cadastrado com sucesso!');

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
        // Salvar log
        Log::info('Carregar formulário editar papel.', ['id' => $role->id, 'action_user_id' => Auth::id()]);

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

            // Editar as informações do registro no banco de dados
            $role->update([
                'name' => $request->name,
                'guard_name' => $request->guard_name,
            ]);

            // Operação concluída com êxito
            DB::commit();

            // Salvar log
            Log::info('Papel editado.', ['id' => $role->id, 'action_user_id' => Auth::id()]);

            return  redirect()->route('role.index')->with('success', 'Papel editado com sucesso!');

        } catch(Exception $e) {

             // Salvar log
             Log::warning('Papel não editado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operação não é concluiída com êxito
            DB::rollBack();

            // Mantém o usuário na mesma página(back), juntamente com os dados digitados(withInput) e enviando a mensagem correspondente.
            return back()->withInput()->with('error', 'Papel não editado. Tente outra vez!');

        }

    }


    // Excluir o papel do banco de dados
    public function destroy(Role $role)
    {
        if ($role->name == 'Super Admin') {

            // Salvar log
            Log::warning('Papel super admin não pode ser excluído.', ['papel_id' => $role->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('role.index')->with('error', 'Papel super admin não pode ser excluído!');
        }

        // Não permitir excluir papel quando tem algum usuário utilizando o papel
        if ($role->users->isNotEmpty()) {

            // Salvar log
            Log::warning('Papel não pode ser excluído porque há usuários associados.', ['papel_id' => $role->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('role.index')->with('error', 'Não é possível excluir o papel porque há usuários associados a ele.');
        }


        try {
            // Excluir o registro do banco de dados
            $role->delete();

            // Salvar log
            Log::info('Papel excluído.', ['id' => $role->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return  redirect()->route('role.index')->with('success', 'Papel excluído com sucesso!');

        } catch (Exception $e) {

            // Salvar log
            Log::warning('Papel não excluído.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return  redirect()->route('role.index')->with('error', 'O Papel não pode ser excluído!');

        }
    }

}

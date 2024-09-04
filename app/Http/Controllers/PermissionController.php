<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // Listar as páginas
    public function index()
    {

        // Recuperar os registros do banco dados
        $permissions = Permission::orderBy('group')->paginate(10);

        // Salvar log
        Log::info('Listar as páginas', ['action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('permissions.index', ['menu' => 'permissions', 'permissions' => $permissions]);
    }

    // Detalhes da página
    public function show(Permission $permission)
    {

        // Salvar log
        Log::info('Visualizar página.', ['action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('permissions.show', ['menu' => 'permissions', 'permission' => $permission]);
    }


    // Carregar o formulário cadastrar nova permissão
    public function create()
    {

        // Salvar log
        Log::info('Carregar formulário cadastrar Permissão.', ['action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('permissions.create', [
            'menu' => 'permissions',
        ]);
    }

    // Cadastrar no banco de dados o nova permissão
    public function store(PermissionRequest $request)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Cadastrar no banco de dados
            $permission = Permission::create([
                'group' => $request->group,
                'title' => $request->title,
                'name' => $request->name,
            ]);

            // Salvar log
            Log::info('Permissão cadastrado.', ['id' => $permission->id, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('permission.index')->with('success', 'Permissão cadastrada com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Permissão não cadastrada.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operação não concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Permissão não cadastrada!');
        }
    }


    // Carregar o formulário editar permissão
    public function edit(Permission $permission)
    {

        // Salvar log
        Log::info('Carregar formulário editar permissão.', ['id' => $permission->id, 'action_user_id' => Auth::id()]);

        // Carregar a VIEW
        return view('permissions.edit', [
            'menu' => 'permissions',
            'permission' => $permission,
        ]);
    }

    // Editar no banco de dados a permissão
    public function update(PermissionRequest $request, Permission $permission)
    {

        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Editar as informações do registro no banco de dados
            $permission->update([
                'group' => $request->group,
                'title' => $request->title,
                'name' => $request->name,
            ]);

            // Salvar log
            Log::info('Permissão editada.', ['id' => $permission->id, 'action_user_id' => Auth::id()]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('permission.index')->with('success', 'Permissão editada com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Permissão não editada.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Permissão não editada!');
        }
    }


    // Excluir a permissão do banco de dados
    public function destroy(Permission $permission)
    {

        try {
            // Excluir o registro do banco de dados
            $permission->delete();

            // Salvar log
            Log::info('Permissão excluída.', ['id' => $permission->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('permission.index')->with('success', 'Permissão excluída com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::warning('Permissão não excluída.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('permission.index')->with('error', 'Permissão não excluída!');
        }
    }

}

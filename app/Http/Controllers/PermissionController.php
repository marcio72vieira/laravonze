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
        $permissions = Permission::orderBy('title')->paginate(10);

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


        // Carregar o formulário cadastrar nova página
        public function create()
        {
    
            // Salvar log
            Log::info('Carregar formulário cadastrar página.', ['action_user_id' => Auth::id()]);
    
            // Carregar a VIEW
            return view('permissions.create', [
                'menu' => 'permissions',
            ]);
        }
    
        // Cadastrar no banco de dados o nova página
        public function store(PermissionRequest $request)
        {
    
            // Validar o formulário
            $request->validated();
    
            // Marca o ponto inicial de uma transação
            DB::beginTransaction();
    
            try {
    
                // Cadastrar no banco de dados
                $permission = Permission::create([
                    'title' => $request->title,
                    'name' => $request->name,
                ]);
    
                // Salvar log
                Log::info('Página cadastrado.', ['id' => $permission->id, 'action_user_id' => Auth::id()]);
    
                // Operação é concluída com êxito
                DB::commit();
    
                // Redirecionar o usuário, enviar a mensagem de sucesso
                return redirect()->route('permission.index')->with('success', 'Página cadastrada com sucesso!');
            } catch (Exception $e) {
    
                // Salvar log
                Log::warning('Página não cadastrada.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);
    
                // Operação não concluída com êxito
                DB::rollBack();
    
                // Redirecionar o usuário, enviar a mensagem de erro
                return back()->withInput()->with('error', 'Página não cadastrada!');
            }
        }
    
}

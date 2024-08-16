<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index(Role $role)
    {
        // Verifica se o papel é "Super Admi", para não permitir viualizar as permissões, pois o mesmo possui acesso a tudo
        if($role->name ==  "Super Admin"){

            // Salvar log
            Log::info('Permissão do Super Administrador não pode ser acessada.', ['acation_user_id' => Auth::id()]);

            // Redirecionar o usuário
            return redirect()->route('role.index')->with('error', 'Permissão do Super Administrador não pode ser acessada!');

        }

        // Recuperar as permissões(somente o id da permissão) do papel na tabela 'role_has_permissions' onde o campo role_id seja igual ao id do papel informado ($role->id)
        $rolePermissions = DB::table('role_has_permissions')->where('role_id', $role->id)->pluck('permission_id')->all();

        // Recupera as permissões
        $permissions = Permission::get();

        // Salvar log
        Log::info('Listar permissões do papel.', ['role_id' => $role->id, 'acation_user_id' => Auth::id()]);



        return view('rolePermission.index', ['menu' => 'roles', 'rolePermissions' => $rolePermissions, 'permissions' => $permissions, 'role' => $role]);

    }

    // $request, recebe os dados enviados via requisição caso algum dado seja enviado,
    // $role recebe o objeto papel, que internamente, através da passagem do "id" recupera o objeto papel,
    // $permission recebe o objeto permissão, que internamente, através da passagem do "id" recupera o objeto permission,
    public function update(Request $request, Role $role)
    {
        // Obter a permissão especifica com base no ID fornecido em $request->permission
        $permission =  Permission::find($request->permission);

        // Verificar se a permissão não foi encontrada
        if(!$permission){

            // Salvar log
            Log::info('Permissão não encontrada.', ['role' => $role->id, 'permission' => $request->permission, 'acation_user_id' => Auth::id()]);

            // Redirecionar o usuário, envia a mensagem de erro
            return redirect()->route('role-permission.update', ['role' => $role->id, 'permission' => $request->permission])->with('error', 'Permissão não encontrad!');

        }

        // Verificar se a permissão já está associada ao papel
        // Se o papel possui a permissão, deve-se remover(bloquear), se o papel não contém a permissão, deve-se adicionar (liberar)
        // Obs: $role->permissions, devolve uma "coleção" e nesta coleção é aplicado o método contains, para verificar se o itm($permission)  está contido na coleção
        if($role->permissions->contains($permission)){

            // Remover a permissão do papel(bloquear)
            $role->revokePermissionTo($permission);

            // Salvar log
            Log::info('Bloquear permissão para o papel.', ['acation_user_id' => Auth::id(), 'permission' => $request->permission]);

            // Redirecionar o usuário, envia a mensagem de sucesso
            return redirect()->route('role-permission.index', ['role' => $role->id])->with('success', 'Permissão bloqueada com sucesso!');


        }else{

            // Adicionar a permissão ao papel(liberar)
            $role->givePermissionTo($permission);

            // Salvar log
            Log::info('Liberar permissão para o papel.', ['acation_user_id' => Auth::id(), 'permission' => $request->permission]);

            // Redirecionar o usuário, envia a mensagem de sucesso
            return redirect()->route('role-permission.index', ['role' => $role->id])->with('success', 'Permissão liberada com sucesso!');

        }


    }
}

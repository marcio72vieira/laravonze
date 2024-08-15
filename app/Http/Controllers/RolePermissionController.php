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
}

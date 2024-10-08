<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica se o papel está criado no banco, se não estiver, cadastra-o
        // Super Admin pode fazer tudo em relação ao administrativo
        if(!Role::where('name', 'Super Admin')->first()){
            Role::create([
                'name' => 'Super Admin',
                'order_roles' => 1,
            ]);
        }



        // Verifica se o papel está criado no banco, se não estiver, cadastra-o
        if(!Role::where('name', 'Admin')->first()){
            $admin = Role::create([
                'name' => 'Admin',
                'order_roles' => 2,
            ]);
        } else {
            // Se estiver cadastrado, recupera os dados do papel
            $admin =  Role::where('name', 'Admin')->first();
        }

        // Atribui as permissões ao papel Admin
        $admin->givePermissionTo([
            // Permissões referente a Cursos
            'index-course',
            'show-course',
            'create-course',
            'edit-course',
            'destroy-course',

            // Permissões referente a Aulas
            'index-classe',
            'show-classe',
            'create-classe',
            'edit-classe',
            'destroy-classe',

            // Permissões referente a Usuários
            'index-user',
            'show-user',
            'create-user',
            'edit-user',

            // Permissões referente a Papéis
            'index-role',
            'show-role',
            // 'create-role',
            // 'edit-role',
            // 'destroy-role',

            // Permissões referente a Permissões
            'index-role-permission',
            'update-role-permission',
        ]);

        // Exemplo para Revogar um papel atribuído a um papel
        // $admin->revokePermissionTo('update-role-permission');



        // Verifica se o papel está criado no banco, se não estiver, cadastra-o
        if(!Role::where('name', 'Professor')->first()){
            $teacher = Role::create([
                'name' => 'Professor',
                'order_roles' => 3,
            ]);
        } else {
            // Se estiver cadastrado, recupera os dados do papel e atribui ao papel 'Professor' as suas permissões
            $teacher =  Role::where('name', 'Professor')->first();
        }

        // Atribui as permissões ao papel Professor
        $teacher->givePermissionTo([
            // Permissões referente a Cursos
            'index-course',
            'show-course',
            'create-course',
            'edit-course',
            'destroy-course',

            // Permissões referente a Aulas
            'index-classe',
            'show-classe',
            'create-classe',
            'edit-classe',
            'destroy-classe',

            // Permissões referente a Usuários
            'index-user',
            'show-user',
        ]);



        // Verifica se o papel está criado no banco, se não estiver, cadastra-o
        if(!Role::where('name', 'Tutor')->first()){
            $tutor = Role::create([
                'name' => 'Tutor',
                'order_roles' => 4,
            ]);
        } else {
            // Se estiver cadastrado, recupera os dados do papel e atribui ao papel 'Professor' as suas permissões
            $tutor =  Role::where('name', 'Tutor')->first();
        }
        // Atribui as permissões ao papel Tutor
        $tutor->givePermissionTo([
            // Permissões referente a Cursos
            'index-course',
            'show-course',
            'edit-course',

            // Permissões referente a Aulas
            'index-classe',
            'show-classe',
            'edit-classe',
        ]);



        // Verifica se o papel está criado no banco, se não estiver, cadastra-o
        // Aluno não pode fazer nada em relação ao administrativo
        if(!Role::where('name', 'Aluno')->first()){
            Role::create([
                'name' => 'Aluno',
                'order_roles' => 5,
            ]);
        }
    }
}

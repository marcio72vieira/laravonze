<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Permissões referente a Cursos
            ['title' => 'Listar cursos', 'name' => 'index-course'],
            ['title' => 'Visualizar curso', 'name' => 'show-course'],
            ['title' => 'Criar curso', 'name' => 'create-course'],
            ['title' => 'Editar curso', 'name' => 'edit-course'],
            ['title' => 'Apagar curso', 'name' => 'destroy-course'],

            // Permissões referente a Aulas
            ['title' => 'Listar aulas', 'name' => 'index-classe'],
            ['title' => 'Visualizar aula', 'name' => 'show-classe'],
            ['title' => 'Criar aula', 'name' => 'create-classe'],
            ['title' => 'Editar aula', 'name' => 'edit-classe'],
            ['title' => 'Apagar aula', 'name' => 'destroy-classe'],

            // Permissões referente a Usuários
            ['title' => 'Listar usuários', 'name' => 'index-user'],
            ['title' => 'Visualizar usuário', 'name' => 'show-user'],
            ['title' => 'Criar usuário', 'name' => 'create-user'],
            ['title' => 'Editar usuário', 'name' => 'edit-user'],
            ['title' => 'Editar senha do usuário', 'name' => 'edit-user-password'],
            ['title' => 'Apagar usuário', 'name' => 'destroy-user'],

            // Permissões referente a Papéis
            ['title' => 'Listar papéis', 'name' => 'index-role'],
            ['title' => 'Visualizar papel', 'name' => 'show-role'],
            ['title' => 'Criar papel', 'name' => 'create-role'],
            ['title' => 'Editar papel', 'name' => 'edit-role'],
            ['title' => 'Apagar papel', 'name' => 'destroy-role'],

            // Permissões referente a Permissões
            ['title' => 'Listar permissões do papel', 'name' => 'index-role-permission'],
        ];

        // Percorre o array de permissões criado acima e verifica se no Model Permission já existe a permissão cadastrada
        foreach($permissions as $permission){
            $existingPermission = Permission::where('name', $permission['name'])->first();

            // Se a permissão não existir, cadastra a permissão na tabela(permissions), fornecendo o nome e o tipo da aplicação (web ou api)
            if(!$existingPermission){
                Permission::create([
                    'title' => $permission['title'],
                    'name' => $permission['name'],
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}

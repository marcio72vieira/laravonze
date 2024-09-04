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
            ['group' => 'CURSO', 'title' => 'Listar cursos', 'name' => 'index-course'],
            ['group' => 'CURSO', 'title' => 'Visualizar curso', 'name' => 'show-course'],
            ['group' => 'CURSO', 'title' => 'Criar curso', 'name' => 'create-course'],
            ['group' => 'CURSO', 'title' => 'Editar curso', 'name' => 'edit-course'],
            ['group' => 'CURSO', 'title' => 'Apagar curso', 'name' => 'destroy-course'],

            // Permissões referente a Aulas
            ['group' => 'AULA', 'title' => 'Listar aulas', 'name' => 'index-classe'],
            ['group' => 'AULA', 'title' => 'Visualizar aula', 'name' => 'show-classe'],
            ['group' => 'AULA', 'title' => 'Criar aula', 'name' => 'create-classe'],
            ['group' => 'AULA', 'title' => 'Editar aula', 'name' => 'edit-classe'],
            ['group' => 'AULA', 'title' => 'Apagar aula', 'name' => 'destroy-classe'],

            // Permissões referente a Usuários
            ['group' => 'USUÁRIO', 'title' => 'Listar usuários', 'name' => 'index-user'],
            ['group' => 'USUÁRIO', 'title' => 'Visualizar usuário', 'name' => 'show-user'],
            ['group' => 'USUÁRIO', 'title' => 'Criar usuário', 'name' => 'create-user'],
            ['group' => 'USUÁRIO', 'title' => 'Editar usuário', 'name' => 'edit-user'],
            ['group' => 'USUÁRIO', 'title' => 'Editar senha do usuário', 'name' => 'edit-user-password'],
            ['group' => 'USUÁRIO', 'title' => 'Apagar usuário', 'name' => 'destroy-user'],
            ['group' => 'USUÁRIO', 'title' => 'Gerar PDF dos Usuários', 'name' => 'generate-pdf-user'],

            // Permissões referente a Papéis
            ['group' => 'PAPEL', 'title' => 'Listar papéis', 'name' => 'index-role'],
            ['group' => 'PAPEL', 'title' => 'Visualizar papel', 'name' => 'show-role'],
            ['group' => 'PAPEL', 'title' => 'Criar papel', 'name' => 'create-role'],
            ['group' => 'PAPEL', 'title' => 'Editar papel', 'name' => 'edit-role'],
            ['group' => 'PAPEL', 'title' => 'Apagar papel', 'name' => 'destroy-role'],

            // Permissões referente a Permissões
            ['group' => 'PAPEL', 'title' => 'Listar permissões do papel', 'name' => 'index-role-permission'],
            ['group' => 'PAPEL', 'title' => 'Editar permissão do papel', 'name' => 'update-role-permission'],
        ];

        // Percorre o array de permissões criado acima e verifica se no Model Permission já existe a permissão cadastrada
        foreach($permissions as $permission){
            $existingPermission = Permission::where('name', $permission['name'])->first();

            // Se a permissão não existir, cadastra a permissão na tabela(permissions), fornecendo o nome e o tipo da aplicação (web ou api)
            if(!$existingPermission){
                Permission::create([
                    'group' => $permission['group'],
                    'title' => $permission['title'],
                    'name' => $permission['name'],
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}

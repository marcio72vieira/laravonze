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
            'index-course',
            'show-course,',
            'create-course',
            'edit-course',
            'destroy-course',
        ];

        // Percorre o array de permissões criado acima e verifica se no Model Permission ja existe a permissão cadastrada
        foreach($permissions as $permission){
            $existingPermission = Permission::where('name', $permission)->first();

            // Se a permissão não existir, cadastra a permissão na tabela(permissions), fornecendo o nome e o tipo da aplicação (web ou api)
            if(!$existingPermission){
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web',
                ]);

            }

        }


    }
}

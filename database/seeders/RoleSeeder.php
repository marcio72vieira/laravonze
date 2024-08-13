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
        if(!Role::where('name', 'Super Admin')->first()){
            Role::create(['name' => 'Super Admin']);
        }

        // Verifica se o papel está criado no banco, se não estiver, cadastra-o
        if(!Role::where('name', 'Admin')->first()){
            $admin = Role::create(['name' => 'Admin']);

            // Atribui as permissões ao papel Admin
            $admin->givePermissionTo([
                // Permissões referente a Cursos
                'index-course',
                'show-course',
                'create-course',
                'edit-course',
                'destroy-course',
            ]);
        }

        // Verifica se o papel está criado no banco, se não estiver, cadastra-o
        if(!Role::where('name', 'Professor')->first()){
            $teacher = Role::create(['name' => 'Professor']);

            // Atribui as permissões ao papel Professor
            $teacher->givePermissionTo([
                // Permissões referente a Cursos
                'index-course',
                'show-course',
                'create-course',
                'edit-course',
                'destroy-course',
            ]);
        }

        // Verifica se o papel está criado no banco, se não estiver, cadastra-o
        if(!Role::where('name', 'Tutor')->first()){
            $tutor = Role::create(['name' => 'Tutor']);

            // Atribui as permissões ao papel Tutor
            $tutor->givePermissionTo([
                // Permissões referente a Cursos
                'index-course',
                'show-course',
                'edit-course',
            ]);
        }

        // Verifica se o papel está criado no banco, se não estiver, cadastra-o
        if(!Role::where('name', 'Aluno')->first()){
            Role::create(['name' => 'Aluno']);
        }
    }
}

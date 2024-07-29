<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Só cria uma aula, se não existir uma aula com o nome já cadastrado
        if(!Classe::where('name','Aula 1')->first()){
            Classe::create([
                'name' => 'Aula 1',
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, aperiam ratione! Error repellendus commodi magnam eos expedita! Voluptas recusandae magni expedita, iste nihil dicta! Porro tenetur consectetur labore maiores nisi!',
                'order_classe' => 1,
                'course_id' => 1,
            ]);
        }
        
        if(!Classe::where('name','Aula 2')->first()){
            Classe::create([
                'name' => 'Aula 2',
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, aperiam ratione! Error repellendus commodi magnam eos expedita! Voluptas recusandae magni expedita, iste nihil dicta! Porro tenetur consectetur labore maiores nisi!',
                'order_classe' => 2,
                'course_id' => 1,
            ]);
        }

        if(!Classe::where('name','Aula 3')->first()){
            Classe::create([
                'name' => 'Aula 3',
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, aperiam ratione! Error repellendus commodi magnam eos expedita! Voluptas recusandae magni expedita, iste nihil dicta! Porro tenetur consectetur labore maiores nisi!',
                'order_classe' => 1,
                'course_id' => 2,
            ]);
        }

        if(!Classe::where('name','Aula 4')->first()){
            Classe::create([
                'name' => 'Aula 4',
                'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut, aperiam ratione! Error repellendus commodi magnam eos expedita! Voluptas recusandae magni expedita, iste nihil dicta! Porro tenetur consectetur labore maiores nisi!',
                'order_classe' => 2,
                'course_id' => 2,
            ]);
        }
    }
}

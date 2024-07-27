<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
USE App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Só cria um curso, se não existir um curso com o nome já cadastrado
        if(!Course::where('name','Curso de Laravel - T1')->first()){
            Course::create([
                'name' => 'Curso de Laravel - T1',
                'price' => 197.43
            ]);
        }
        
        if(!Course::where('name','Curso de Laravel - T2')->first()){
            Course::create([
                'name' => 'Curso de Laravel - T2',
                'price' => 247.43
            ]);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'courses';

    // Indicar quais as colunas que podem ser cadastradas
    protected $fillable = ['name', 'price'];

    

}

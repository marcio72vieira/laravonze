<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'courses';

    // Indicar quais as colunas que podem ser cadastradas
    protected $fillable = ['name', 'price'];

    // Criar relacionamento entre um e muitos. Um CURSO possui muitas AULAS
    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class);
    }

}

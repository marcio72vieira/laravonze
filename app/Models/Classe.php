<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

class Classe extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'classes';

    // Indicar quais as colunas que podem ser cadastradas
    protected $fillable = ['name', 'description', 'order_classe', 'course_id'];

    // Criar relacionamento entre um e muitos(hasMany) de forma INVESA(belongsTo). Uma AULA pertence a um CURSO
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

}

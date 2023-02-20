<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pokemon extends Model
{
    use HasFactory;
    protected $table = 'pokemon';

    protected $fillable = [
        'nome',
        'tipo',
        'habilidade_1',
        'habilidade_2',
        'habilidade_3',
        'image',
    ];

}

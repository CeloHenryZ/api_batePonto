<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{
    use HasFactory;

    public $table = 'pontos';
    public $primaryKey = 'id';

    public $fillable = [
        "ponto",
        "dia_da_semana",
        "mes"
    ];
}

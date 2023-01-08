<?php

namespace App\Services;

use App\Models\Ponto;
use Carbon\Carbon;

class Pontos
{
    public function pontosHoje()
    {
        $ponto = new Ponto();
        $dateNow = Carbon::now();
        return $ponto->where('ponto', 'LIKE', $dateNow->format('d.m.Y').'%')->get();
    }
}

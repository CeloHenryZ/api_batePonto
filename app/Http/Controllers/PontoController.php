<?php

namespace App\Http\Controllers;

use App\Http\Requests\pontoRequest;
use App\Models\Ponto;
use App\Services\Pontos;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PontoController extends Controller
{

    public function getPontosHoje()
    {
        $ponto = new Ponto();
        $dateNow = Carbon::now();

        $pontosHoje = $ponto->where('ponto', 'LIKE', $dateNow->format('d-m-Y').'%')->get();
        if(empty($pontosHoje)){
            return response()->json('Menhum ponto bátido Hoje');
        }
        return  response()->json($pontosHoje, 200);

    }

    public function getPontosDoMes($mes)
    {
        $ponto = new Ponto();

        $pontosMes = $ponto->where('mes', $mes)->get();

        if(empty($pontosMes)){
            return response()->json('nenhum ponto encontrado neste mês');
        }

        return response()->json($pontosMes, 200);
    }

    public function batePonto()
    {
        $ponto = new Ponto();
        $dateNow = Carbon::now();

        $pontosHoje = $ponto->where('ponto', 'LIKE', $dateNow->format('d-m-Y').'%')->get();

        if($pontosHoje->count() >= 4){
            return response()->json(
                'todos os pontos do dia já foram batidos',
                403
            );
        }

        $newPonto = $ponto->create(
            [
                'ponto' => $dateNow->format('d-m-Y H:i'),
                'dia_da_semana' => Carbon::parse($dateNow)->locale('pt-br')->getTranslatedDayName('dddd'),
                'mes' => Carbon::parse($dateNow)->locale('pt-br')->getTranslatedMonthName('M')
            ]
        );
        return response()->json($newPonto, 200);
    }

    public function atualizaPonto($id_ponto, pontoRequest $req)
    {
        $ponto = Ponto::find($id_ponto);

        if(empty($ponto)){
            return response()->json('ponto não encontrado', 405);
        }

        $ponto->ponto = $req->ponto;
        $ponto->save();

        return response()->json($ponto, 200);
    }

    public function addPonto(pontoRequest $req)
    {
        $date = new Carbon($req->ponto);
        $dateFormat = $date->format('d-m-Y H:i');
        $pontoExistis = Ponto::where('ponto', 'LIKE', $date->format('d-m-Y') . '%')->get();

        $dateNow = Carbon::now();
        if($dateFormat > $dateNow->format('d-m-Y H:i')){
            return Response()->json('informe uma data válida', 403);
        }
        if($pontoExistis->count() < 4){
            $ponto = Ponto::create([
                "ponto" => $dateFormat,
                'dia_da_semana' => Carbon::parse($date)->locale('pt-br')->getTranslatedDayName('dddd'),
                'mes' => Carbon::parse($date)->locale('pt-br')->getTranslatedMonthName('M')
            ]);
            return response()->json("ponto $ponto->ponto cadastrado com sucesso", 200);
        }
        return response()->json('todos os pontos desse dia já foram bátidos', 405);

    }
}

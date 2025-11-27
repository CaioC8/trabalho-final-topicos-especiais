<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class TemaController extends Controller
{
    public function alternar()
    {
        $temaAtual = Cookie::get('tema', 'claro');

        $novoTema = ($temaAtual === 'escuro') ? 'claro' : 'escuro';

        Cookie::queue('tema', $novoTema, 43200);

        return back();
    }
}

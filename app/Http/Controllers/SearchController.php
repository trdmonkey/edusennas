<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palabra;

class SearchController extends Controller
{
    /* public function buscar(Request $request)
    {

        $query = $request->q;

        $palabras = Palabra::where('nombre','LIKE',"%{$query}%")
        ->where('estado',1)
        ->limit(10)
        ->get();

        $palabras = \App\Models\Palabra::with('categoria')
        ->where('nombre','LIKE',"%{$query}%")
        ->where('estado',1)
        ->limit(10)
        ->get();

        return response()->json($palabras);

    } */

    public function buscar(Request $request)
    {
        $query = $request->q;

        $palabras = \App\Models\Palabra::with('categoria')
        ->where('nombre','LIKE',"%{$query}%")
        ->where('estado',1)
        ->limit(10)
        ->get();

        $resultado = $palabras->map(function($palabra){

            return [
                'nombre' => $palabra->nombre,
                'slug' => $palabra->slug,
                'categoria' => $palabra->categoria->nombre ?? 'General',
                'video' => $palabra->getFirstMediaUrl('video')
            ];

        });

        return response()->json($resultado);
    }

}


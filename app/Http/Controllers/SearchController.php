<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palabra;

class SearchController extends Controller
{
    public function buscar(Request $request)
    {

        $query = $request->q;

        $palabras = Palabra::where('nombre','LIKE',"%{$query}%")
        ->where('estado',1)
        ->limit(10)
        ->get();

        return response()->json($palabras);

    }
}
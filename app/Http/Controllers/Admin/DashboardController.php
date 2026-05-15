<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\Palabra;    
use App\Models\Categorium; 
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): Factory|View
    {
        return view('admin.dashboard.index', [
            'usersCount' => AdminUser::count(),
            'wordsCount' => Palabra::count(),
            'categoriesCount' => Categorium::count(),
            'latestWords' => Palabra::with('categoria')->latest()->take(5)->get(),
            // categorías con el conteo de sus palabras
            'categoriesStats' => Categorium::withCount('palabras')->orderBy('palabras_count', 'desc')->take(4)->get(),
        ]);
    }
}
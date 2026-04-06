<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentamos loguear, pero verificando que el 'estado' sea 1 (Activo)
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'estado' => 1])) {
            $request->session()->regenerate();
            
            // Si es usuario normal, lo mandamos al home o a su perfil
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden o tu cuenta está desactivada.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
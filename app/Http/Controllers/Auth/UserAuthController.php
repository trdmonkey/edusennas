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

        // Intentamos el login. Si el correo y clave son correctos, ENTRA.
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
                   
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ])->withInput($request->only('email'));
    }
}
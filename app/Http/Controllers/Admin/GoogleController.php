<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    // Función que redirige a Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Función que recibe la respuesta de Google
    public function handleGoogleCallback()
    {
        try {
            // Usamos stateless() para evitar errores de sesión/state en algunas distros
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // Extraer nombres
            $fullName = $googleUser->getName();
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? '';

            // Buscamos o creamos el usuario
            $user = AdminUser::updateOrCreate(
                ['email' => $googleUser->getEmail()], // Buscamos por email
                [
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                    'google_id'  => $googleUser->getId(), // ¡IMPORTANTE!
                    'password'   => $user->password ?? bcrypt(str_random(16)),
                    'activated'  => 1,
                    'forbidden'  => 0,
                    'language'   => 'es',
                ]
            );

            // asignamos el rol
            if (!$user->hasRole('Administrator')) {
                $user->assignRole('Administrator');
            }

            // Forzamos el login
            /* Auth::login($user, true); */
            Auth::guard('admin')->login($user, true);

            return redirect()->intended('/admin');

        } catch (\Exception $e) {
            return redirect('/admin/login')->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}
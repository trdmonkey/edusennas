<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminUser;
use Spatie\Permission\Models\Role;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admin_users'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'email.unique' => 'Este correo ya está registrado.',
        ]);

        $nameParts = explode(' ', $data['name'], 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? '';

        $user = AdminUser::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'activated' => true,
            'forbidden' => false,
            'language' => 'es',
        ]);

        $role = Role::where('name', 'Administrator')->where('guard_name', 'admin')->first();
        if ($role) {
            $user->assignRole($role);
        }

        Auth::guard('admin')->login($user);
        
        $request->session()->put('admin_auth_passed', true);
        $request->session()->save();

        return redirect()->intended('/admin');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentar login con el guard 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('admin_auth_passed', true);
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ])->withInput($request->only('email'));
    }
}
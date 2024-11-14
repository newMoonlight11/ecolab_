<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            // Redirige a /home si el usuario es Administrador
            return '/home';
        } elseif ($user->hasRole('general')) {
            // Redirige a /prestamos si el usuario es Usuario General
            return '/prestamos/create';
        }

        // Redirige a una página predeterminada si no tiene un rol específico
        return '/home';
    }

    protected function authenticated(Request $request, $user)
    {
        // Establece una variable de sesión para indicar el inicio de sesión exitoso
        session(['login_success' => true]);

        // Redirecciona según el rol
        return redirect()->intended($this->redirectTo());
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

/**
 * RegisteredUserController — Version sécurisée
 * 
 * Corrections appliquées :
 * 1. Suppression du code mort (deuxième bloc if jamais exécuté)
 * 2. Validation du type_user limitée aux valeurs autorisées (in:client,artisan)
 *    → empêche un utilisateur de s'inscrire comme 'admin' via le formulaire
 * 3. Validation du téléphone améliorée (format numérique)
 */
class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            // ✅ Seuls 'client' et 'artisan' sont autorisés — impossible de s'inscrire comme 'admin'
            'type_user' => ['required', 'string', 'in:client,artisan'],
            'ville'     => ['required', 'string', 'max:100'],
            // ✅ Validation du format téléphone (8 à 15 chiffres)
            'telephone' => ['required', 'string', 'regex:/^[0-9]{8,15}$/'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'type_user' => $request->type_user,
            'ville'     => $request->ville,
            'telephone' => $request->telephone,
            'password'  => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // ✅ Redirection selon le rôle (code mort supprimé)
        if (Auth::user()->type_user === 'artisan') {
            return redirect(RouteServiceProvider::DASHBOARD);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}

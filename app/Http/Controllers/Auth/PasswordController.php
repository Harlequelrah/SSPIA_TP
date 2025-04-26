<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Http\Requests\PasswordUpdateRequest;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\Validation\Rules\Password;

// class PasswordController extends Controller
// {
//     /**
//      * Update the user's password.
//      */
//     public function update(PasswordUpdateRequest $request): RedirectResponse
//     {
//         dd($request);
//         $validated = $request->validated();

//         $request->user()->update([
//             'password' => Hash::make($validated['new_password']),
//         ]);

//         // Déconnecter l'utilisateur pour qu'il se reconnecte avec son nouveau mot de passe
//         Auth::guard('web')->logout();

//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return Redirect::route('login')->with('status', 'password-updated')->with('message', 'Votre mot de passe a été mis à jour. Veuillez vous reconnecter avec votre nouveau mot de passe.');
//     }
// }

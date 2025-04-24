<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\NotSameAsOld;
use Illuminate\Support\Facades\Auth;

class MustChangePasswordController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function showForm()
    {
        return view('auth.password-change');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', 'min:8', 'different:current_password'],
            'new_password_confirmation' => ['required'],
        ], [
            'current_password.required' => 'Le mot de passe actuel est obligatoire.',
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
            'new_password.required' => 'Le nouveau mot de passe est obligatoire.',
            'new_password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'new_password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
            'new_password.different' => 'Le nouveau mot de passe doit être différent du mot de passe actuel.',
            'new_password_confirmation.required' => 'La confirmation du mot de passe est obligatoire.',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($validated['new_password']),
            'must_change_password' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Mot de passe changé avec succès.');
    }
}

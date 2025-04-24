<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\UserFormRequest;
use App\Mail\AccountCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Str;

class AgriculteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $agriculteurs = User::withTrashed()
            ->where('role', RoleEnum::AGRICULTEUR)
            ->paginate(10);

        return view('agriculteurs.index', compact('agriculteurs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $request)
    {
        $validated = $request->validated();
        $password = Str::random(10);

        $user = User::create([
            'name' => $validated['firstName'] . ' ' . $validated['lastName'],
            'username' => $validated['userName'],
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'],
            'address' => $validated['address'] ?? null,
            'password' => bcrypt($password),
            'role' => RoleEnum::AGRICULTEUR,
            'must_change_password' => true,
        ]);
        Mail::to($user->email)->send(new AccountCreated($user, $password));

        return redirect()->route('agriculteurs.index')
            ->with('success', "L'agriculteur a été créé et un email de confirmation a été envoyé.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $agriculteur)
    {
        $agriculteur->delete();
        return redirect()->route('agriculteurs.index')
            ->with('success', "L'agriculteur a été supprimée");
    }
}

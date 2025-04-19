<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\View\Components\Agriculteurs;
use Illuminate\Http\Request;

class AgriculteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $agriculteurs = User::where('role', RoleEnum::AGRICULTEUR)->paginate(10);
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

        $user = User::create([
            'name'     => $validated['firstName'] . ' ' . $validated['lastName'],
            'username' => $validated['userName'],
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'],
            'address' => $validated['address'] ?? null,
            'password' => bcrypt($validated['password']),
            'role' => RoleEnum::AGRICULTEUR,
        ]);

        return redirect()->route('agriculteurs.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}

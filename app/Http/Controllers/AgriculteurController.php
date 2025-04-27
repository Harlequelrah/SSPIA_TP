<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\UserFormRequest;
use App\Mail\AccountCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Str;

class AgriculteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Démarrer la requête de base
        $query = User::query();

        // Recherche textuelle globale
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('userName', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Filtres spécifiques
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('userName')) {
            $query->where('username', 'like', '%' . $request->input('userName') . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->input('phone') . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->input('address') . '%');
        }

        // Récupération des résultats avec pagination
        $agriculteurs = $query->orderBy('firstName')->paginate(10);

        return view('agriculteurs.index', compact('agriculteurs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function show(User $agriculteur)
    {
        return view('agriculteurs.partials.show', compact('agriculteur'));
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
    public function update(UserFormRequest $request, User $agriculteur)
    {

        dd($agriculteur);
        // Vérifiez si l'utilisateur est autorisé à modifier cet agriculteur
        if (Auth::user()->role !== RoleEnum::ADMIN) {
            abort(403, 'Unauthorized action');
        }

        // Récupérez les données validées depuis le FormRequest
        $validated = $request->validated();

        // Combinaison du prénom et du nom en un seul champ 'name'
        if (isset($validated['firstName']) && isset($validated['lastName'])) {
            $validated['name'] = $validated['firstName'] . ' ' . $validated['lastName'];

            // Supprimez les champs firstName et lastName car ils n'existent pas dans la base de données
            unset($validated['firstName']);
            unset($validated['lastName']);
        }

        // Mettez à jour l'agriculteur
        $agriculteur->update($validated);

        // Redirigez avec un message de succès
        return redirect()->route('agriculteurs.show', $agriculteur->id)
            ->with('success', 'Agriculteur mis à jour avec succès.');
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

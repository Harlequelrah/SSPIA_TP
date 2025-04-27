<?php

namespace App\Http\Controllers;

use App\Enums\InterventionTypeEnum;
use App\Enums\RoleEnum;
use App\Enums\UnitEnum;
use App\Http\Requests\InterventionFormRequest;
use App\Models\Intervention;
use App\Models\Plot;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->role == RoleEnum::ADMIN;

        // Démarrer la requête de base
        $query = Intervention::query();

        // Vérification du rôle de l'utilisateur
        if ($user->role === RoleEnum::ADMIN) {
            // Si l'utilisateur est admin, récupérer toutes les parcelles
            $plots = Plot::orderBy('name')->get();
        } else {
            // Si l'utilisateur n'est pas admin, récupérer uniquement les parcelles associées à l'utilisateur
            $plots = $user->plots()->orderBy('name')->get();
            // Filtrer les interventions par l'ID utilisateur
            $query->where('user_id', $user->id);
        }

        // Recherche textuelle globale
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        // Filtrage par type d'intervention
        if ($request->filled('intervention_type')) {
            $query->where('intervention_type', $request->input('intervention_type'));
        }

        // Filtrage par parcelle
        if ($request->filled('plot_id')) {
            $query->where('plot_id', $request->input('plot_id'));
        }

        // Filtrage par produit utilisé
        if ($request->filled('product_used')) {
            $query->where('product_used', 'like', '%' . $request->input('product_used') . '%');
        }

        // Filtrage par date
        if ($request->filled('date_from')) {
            $query->whereDate('intervention_date', '>=', $request->input('date_from'));
        }

        // Ajout du filtrage par date_to si vous implémentez cette fonctionnalité
        if ($request->filled('date_to')) {
            $query->whereDate('intervention_date', '<=', $request->input('date_to'));
        }

        // Validation des dates
        if ($request->filled('date_from')) {
            $dateFrom = new DateTime($request->input('date_from'));

        }

        // Récupérer les résultats (avec pagination)
        $interventions = $query->with('plot') // Assurez-vous de charger la relation 'plot'
            ->orderBy('intervention_date', 'desc')
            ->paginate(10);

        // Retourner la vue avec les interventions et les parcelles
        return view('interventions.index', compact('interventions', 'plots', 'isAdmin'));
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
    public function store(InterventionFormRequest $request)
    {
        // Récupérez les données validées depuis le FormRequest
        $validated = $request->validated();

        // Ajoutez user_id manuellement
        $validated['user_id'] = Auth::user()->id;

        // Créez une nouvelle intervention
        Intervention::create($validated);

        // Redirigez avec un message de succès
        return redirect()->route('interventions.index')
            ->with('success', 'Intervention créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Intervention $intervention)
    {
        return view('interventions.partials.show', compact('intervention'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intervention $intervention)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InterventionFormRequest $request, Intervention $intervention)
    {
        // Vérifiez si l'agriculteur est autorisé à modifier cette intervention
        if (Auth::user()->role !== RoleEnum::ADMIN && $intervention->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized action');
        }

        // Récupérez les données validées depuis le FormRequest
        $validated = $request->validated();

        // Ajoutez user_id manuellement
        $validated['user_id'] = Auth::user()->id;

        // Mettez à jour l'intervention
        $intervention->update($validated);

        // Redirigez avec un message de succès
        return redirect()->route('interventions.show', $intervention->id)
            ->with('success', 'Intervention mise à jour avec succès.');
    }

    // Lister les interventions d’une parcelle.
    public function byPlot(Plot $plot)
    {
        // S'assurer que l'utilisateur a le droit de voir cette parcelle
        if (Auth::user()->role !== RoleEnum::ADMIN && $plot->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized action');
        }

        $interventions = $plot->interventions()->paginate(10);

        return view('interventions.by_plot', compact('plot', 'interventions'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intervention $intervention)
    {
        if ($intervention->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized action');
        }
        $intervention->delete();
        return redirect()->back()
            ->with('success', "L'intervention a été supprimée");
    }
}

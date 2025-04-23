<?php

namespace App\Http\Controllers;

use App\Enums\InterventionTypeEnum;
use App\Enums\RoleEnum;
use App\Enums\UnitEnum;
use App\Http\Requests\InterventionFormRequest;
use App\Models\Intervention;
use App\Models\Plot;
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

        if ($user->role === RoleEnum::ADMIN) {
            // administrateur: afficher toutes les parcelles
            $plots = Plot::paginate(10);
            $interventions = Intervention::with('plot')->paginate(10);
        } else {
            // autres agriculteur: récupérer uniquement leurs parcelles
            $interventions = Intervention::where('user_id', $user->id)->with('plot')->paginate(10);
            $plots = $user->plots()->paginate(10);
        }

        return view('interventions.index', compact('interventions', 'plots'));
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
        return redirect()->route('interventions.index')
            ->with('success', "L'intervention a été supprimée");
    }
}

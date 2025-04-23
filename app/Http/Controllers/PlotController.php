<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\PlotFormRequest;
use App\Models\Plot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Request;

class PlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === RoleEnum::ADMIN) {
            // administrateur: afficher toutes les parcelles
            $plots = Plot::paginate(5);
        } else {
            // autres agriculteur: récupérer uniquement leurs parcelles
            $plots = $user->plots()->paginate(5);
        }

        return view('parcelles.index', [
            'plots' => $plots,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $plot = new Plot();
    //     return view(
    //         'parcelles.create',
    //         [
    //             'plot' => $plot,
    //         ]
    //     );
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlotFormRequest $request)
    {

        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id; // link plot to current user

        Plot::create($validated);
        return redirect()->route('plots.index')
            ->with('success', 'Parcelles ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $plot_id)
    {
        $plot = Plot::where('id', $plot_id)->first();

        // Si la parcelle n'existe pas, retournez une erreur 404
        if (!$plot) {
            abort(404, 'Parcelle non trouvée');
        }

        return view('parcelles.partials.show', compact('plot'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plot $plot)
    {
        if ($plot->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized action');
        }
        return view(
            'plot.edit',
            [
                'plot' => $plot,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlotFormRequest $request, Plot $plot)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        $validated['area'] = (float) $validated['area'];

        $plot->update($validated);

        return redirect()->route('plots.index')
            ->with('success', "The plot was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plot $plot)
    {
        if ($plot->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized action');
        }
        $plot->delete();
        return redirect()->route('plots.index')
            ->with('success', "La parcelle a été supprimé avec succès");
    }

    public function updateStatus(Request $request)
    {

        $validated = $request->validate([
            'plot_id' => 'required|exists:plots,id',
            'status' => ['required', Rule::in(StatusEnum::values())],
        ]);

        $plot = Plot::findOrFail($validated['plot_id']);

        // Vérifiez que l'utilisateur actuel est autorisé à modifier cette parcelle
        $this->authorize('update-status', $plot);

        $plot->status = $validated['status'];
        $plot->save();

        return redirect()->back()->with('success', 'Statut de la parcelle mis à jour avec succès.');
    }
}

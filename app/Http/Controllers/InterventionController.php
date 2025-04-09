<?php
namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\InterventionFormRequest;
use App\Models\Intervention;
use App\Models\Plot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $interventions = Intervention::orderByDesc('id')->paginate(10);

        // $plots = Plot::all();
        $user = Auth::user();

        if ($user->role === RoleEnum::ADMIN->value) {
            // administrateur: afficher toutes les parcelles
            $plots = Plot::paginate(10);
        } else {
            // autres utilisateur: récupérer uniquement leurs parcelles
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

        Intervention::create($request->validated());
        return redirect()->route('interventions.index')
            ->with('success', 'Intervention ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Intervention $intervention)
    {
        //
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
    public function update(Request $request, Intervention $intervention)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intervention $intervention)
    {
        //
    }
}

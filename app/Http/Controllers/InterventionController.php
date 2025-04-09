<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Plot;
use App\Http\Requests\InterventionFormRequest;
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

        $plots = Plot::all();

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
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        Intervention::create($validated);
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

<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Plot;
use App\Enums\InterventionTypeEnum;
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
    public function store(Request $request)
    {
        $request->validate([
            'plot_id' => 'required|exists:plots,id',
            'intervention_type' => ['required', 'in:' . implode(',', InterventionTypeEnum::values())],
            'intervention_date' => 'required|date',
            'product_used_quantity' => 'nullable|string|max:255',
            'product_used_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Intervention::create([
            'plot_id' => $request->plot_id,
            'intervention_type' => $request->intervention_type,
            'intervention_date' => $request->intervention_date,
            'product_used_quantity' => $request->product_used_quantity,
            'product_used_name' => $request->product_used_name,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

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

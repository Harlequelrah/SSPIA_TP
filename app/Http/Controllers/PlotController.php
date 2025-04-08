<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\PlotFormRequest;
use App\Models\Plot;
use Illuminate\Support\Facades\Auth;

class PlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === RoleEnum::ADMIN->value) {
            // administrateur: afficher toutes les parcelles
            $plots = Plot::paginate(10);
        } else {
            // autres utilisateur: récupérer uniquement leurs parcelles
            $plots = $user->plots()->paginate(10);
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
        return redirect()->route('parcelles.index')
            ->with('success', 'Plot created successfully.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Plot $plot)
    // {
    //     return view('plot.show', [
    //         'plot' => $plot,
    //     ]);
    // }

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
        $plot->update($request->validated());
        return redirect()->route('plot.index')
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
        return redirect()->route('plot.index')
            ->with('success', "The plot was successfully deleted");
    }
}

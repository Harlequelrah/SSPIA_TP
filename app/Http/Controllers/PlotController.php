<?php
namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\PlotFormRequest;
use App\Models\Plot;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user    = Auth::user();
        $isAdmin = $user->role === RoleEnum::ADMIN;

        // Base de la requête
        $query = Plot::query();

        if ($isAdmin) {
            $query->with('user'); // l'admin peut voir à qui appartient chaque parcelle
        } else {
            // utilisateur normal : filtrer sur ses propres parcelles
            $query->where('user_id', $user->id);
        }

        // --- Filtres dynamiques ---
        // Recherche globale sur le nom ou le type de culture
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('crop_type', 'like', "%{$search}%");
            });
        }

        // Filtrage par status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filtrage par date de plantation
        if ($request->filled('date_from')) {
            $query->whereDate('plantation_date', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('plantation_date', '<=', $request->input('date_to'));
        }

        // Validation des dates
        if ($request->filled('date_from')) {
            $dateFrom = new \DateTime($request->input('date_from'));
        }

        // Récupération finale avec pagination
        $plots = $query->orderBy('name')->paginate(5);

        return view('parcelles.index', compact('plots', 'isAdmin'));
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

        $validated            = $request->validated();
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
        if (! $plot) {
            abort(404, 'Parcelle non trouvée');
        }
if ((string) $plot->user_id !== (string) Auth::user()->id) {
    abort(403, 'Unauthorized action');
}


        return view('parcelles.partials.show', compact('plot'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Plot $plot)
    // {
    //     if ($plot->user_id !== Auth::user()->id) {
    //         abort(403, 'Unauthorized action');
    //     }
    //     return view(
    //         'plot.edit',
    //         [
    //             'plot' => $plot,
    //         ]
    //     );
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlotFormRequest $request, Plot $plot)
    {
        if ((string) $plot->user_id !== (string) Auth::user()->id) {
            abort(403, 'Unauthorized action');
        }
        $validated            = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        $validated['area']    = (float) $validated['area'];

        $plot->update($validated);

        return redirect()->route('plots.index')
            ->with('success', "The plot was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plot $plot)
    {
        if ((string) $plot->user_id !== (string) Auth::user()->id) {
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
            'status'  => ['required', Rule::in(StatusEnum::values())],
        ]);

        $plot = Plot::findOrFail($validated['plot_id']);

        // Vérifiez que l'utilisateur actuel est autorisé à modifier cette parcelle
        $this->authorize('update-status', $plot);

        $plot->status = $validated['status'];
        $plot->save();

        return redirect()->back()->with('success', 'Statut de la parcelle mis à jour avec succès.');
    }

    public function etiquette($id)
    {
        // Récupérer la parcelle
        $plot = Plot::findOrFail($id);

        // Récupérer toutes les interventions pour cette parcelle
        $interventions = $plot->interventions()->latest()->get();

        // Si aucune intervention n'existe, gérer ce cas
        if ($interventions->isEmpty()) {
            return back()->with('error', 'Aucune intervention trouvée pour cette parcelle.');
        }

        // Récupérer l'agriculteur (du propriétaire de la parcelle ou de la première intervention)
        $agriculteur = $plot->user ?? $interventions->first()->user;

        $data = [
            'title'         => 'Fiche d\'interventions agricoles',
            'date'          => Carbon::now(),
            'interventions' => $interventions,
            'nom_parcelle'  => $plot->name ?? 'Non défini',
            'superficie'    => $plot->area ?? '',
            'type_culture'  => $plot->crop_type ?? '',
            'agriculteur'   => $agriculteur->name ?? 'Inconnu',
        ];

        $filename = 'parcelle_' . $plot->id . '.pdf';
        $folder   = public_path('etiquettes');

        if (! file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $pdf = PDF::loadView('parcelles.etiquette', $data)
            ->setPaper('a5', 'portrait')
            ->setOptions([
                'defaultFont'          => 'DejaVu Sans',
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled'         => true,
            ]);

        $pdf->save($folder . '/' . $filename);
        return $pdf->stream($filename);
    }
}

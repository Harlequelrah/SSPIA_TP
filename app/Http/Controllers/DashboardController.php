<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\Intervention;
use App\Models\Plot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->role === RoleEnum::ADMIN;
        $enCulture = StatusEnum::EN_C;
        $enJachere = StatusEnum::EN_J;
        $recoltee = StatusEnum::RCLT;
        // Récupération des parcelles et interventions selon le rôle
        $plots = $isAdmin ? Plot::all() : $user->plots()->get();
        $plots = $plots ?: collect([]); // Assure que $plots est une collection

        $interventions = $isAdmin
            ? Intervention::all()
            : Intervention::whereIn('plot_id', $plots->pluck('id'))->get();
        $interventions = $interventions ?: collect([]); // Assure que $interventions est une collection

        // Statistiques de base (gestion des cas de nullité)
        $totalPlots = $plots->count();
        $plotsInCulture = $plots->where('status', $enCulture)->count();
        $plotsHarvested = $plots->where('status', $recoltee)->count();
        $plotsInFallow = $plots->where('status', $enJachere)->count();

        // Superficie totale (avec gestion du cas où il n'y a pas de parcelles)
        $totalCultivatedArea = $plots->where('status', $enCulture)->sum('area') ?? 0;

        // Interventions récentes (7 derniers jours)
        $recentInterventions = $interventions->where('date', '>=', Carbon::now()->subDays(7))->values();

        // Nombre d'interventions par type (gestion des cas où il n'y a pas d'interventions)
        $interventionTypesCount = collect([
            'Semis' => $interventions->where('intervention_type', 'Semis')->count(),
            'Arrosage' => $interventions->where('intervention_type', 'Arrosage')->count(),
            'Fertilisation' => $interventions->where('intervention_type', 'Fertilisation')->count(),
            'Traitement' => $interventions->where('intervention_type', 'Traitement')->count(),
            'Récolte' => $interventions->where('intervention_type', 'Récolte')->count(),
        ]);

        // Répartition des types de cultures
        $cultureTypes = $plots->groupBy('crop_type')
            ->map(function ($group) {
                return $group->count();
            });

        // Parcelles nécessitant attention (pas d'intervention depuis 30 jours)
        $needAttentionPlots = $plots->filter(function ($plot) use ($interventions) {
            $lastIntervention = $interventions
                ->where('plot_id', $plot->id)
                ->sortByDesc('date')
                ->first();

            return $lastIntervention === null ||
                Carbon::parse($lastIntervention->date)->diffInDays(Carbon::now()) > 30;
        })->values();

        // Dernières interventions (5 plus récentes)
        $latestInterventions = $interventions->sortByDesc('date')->take(5)->values();

        // Mois avec le plus d'interventions (gestion du cas où il n'y a pas d'interventions)
        $interventionsByMonth = collect();
        if ($interventions->count() > 0) {
            $interventionsByMonth = $interventions->groupBy(function ($intervention) {
                return Carbon::parse($intervention->date)->format('m-Y');
            })->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'month' => Carbon::parse($group->first()->date)->format('F Y')
                ];
            })->sortByDesc('count')->take(5);
        }

        return view('dashboard', compact(
            'isAdmin',
            'plots',
            'interventions',
            'totalPlots',
            'plotsInCulture',
            'plotsHarvested',
            'plotsInFallow',
            'totalCultivatedArea',
            'interventionTypesCount',
            'recentInterventions',
            'cultureTypes',
            'needAttentionPlots',
            'latestInterventions',
            'interventionsByMonth',
        ));
    }
}

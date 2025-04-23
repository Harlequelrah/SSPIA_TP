{{-- dashboard --}}

@extends('app_layout')

@section('title', 'Tableau de bord')

@section('header', 'Tableau de bord')

@section('content')
    <x-dashboard :isAdmin="$isAdmin" :interventions="$interventions" :plots="$plots" :plotsInCulture="$plotsInCulture" :plotsHarvested="$plotsHarvested" :totalPlots="$totalPlots"
        :plotsInFallow="$plotsInFallow" :totalCultivatedArea="$totalCultivatedArea" :interventionTypesCount="$interventionTypesCount" :needAttentionPlots="$needAttentionPlots" :recentInterventions="$recentInterventions" :cultureTypes="$cultureTypes" :latestInterventions="$latestInterventions" :interventionsByMonth="$interventionsByMonth" :totalFarmers="$totalFarmers" />
@endsection

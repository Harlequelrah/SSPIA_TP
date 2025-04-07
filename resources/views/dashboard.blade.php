@extends('app_layout')

@section('title', 'Tableau de bord')

@section('header', 'Tableau de bord')

@section('content')
    <div class="p-6">
        <div class="flex flex-col justify-around md:flex-row mb-10">
            <x-dashboard-card title="Parcelle totales" count=10 class="border-green-500" />
            <x-dashboard-card title="Interventions totales" count=18 class="border-amber-500" />
            <x-dashboard-card title="Parcelles en culture" count=5 class="border-blue-500" />
            <x-dashboard-card title="Parcelles récoltées" count=8 class="border-red-500" />
        </div>

        <div class="flex justify-around gap-3">
            <div class="p-10 shadow-lg rounded-lg flex flex-col w-lg h-lg">
                <h1 class="mb-4">Carte des parcelles</h1>
                <div class="bg-slate-200 rounded-lg p-40"></div>
            </div>
            <div class="p-10 shadow-lg rounded-lg flex flex-col w-lg h-lg">
                <h1>Répartition des cultures</h1>
            </div>
        </div>
    </div>
@endsection


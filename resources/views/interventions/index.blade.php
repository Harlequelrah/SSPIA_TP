@extends('app_layout')

@section('title', 'Interventions')

@section('header', 'Historique des Interventions')

@section('content')
    {{-- search bar --}}
    <div class="">
        <section class="bg-slate-50 mb-5">
            <form action="">
                <div class="flex items-center">
                    <input
                        class="w-full p-2 border rounded-sm border-slate-400 bg-slate-200 focus:bg-white focus:border-green-500 focus:outline-none text-sm placeholder:text-sm"
                        type="search" name="search" id="search" placeholder="Rechercher une intervention">
                    <i class="fa-solid fa-search text-slate-600 w-10 bg-slate-200 p-3 rounded-sm"></i>
                </div>
            </form>
        </section>
        <section class="mb-5">
            <div class="w-full flex justify-between items-center">
                <x-heading title="Liste des interventions" />
                <button
                    class="bg-[#4a7c59] px-3 py-2 rounded-lg text-white cursor-pointer duration-200 transition-all hover:bg-green-800 active:bg-green-700 active:scale-105">
                    <i class="fa-solid fa-plus"></i>
                    <span class="font-semibold">Nouvelle Intervention</span>
                </button>
            </div>
        </section>
        @include('interventions.includes.create')
        @include('interventions.includes.intervention-list')
    </div>



@endsection

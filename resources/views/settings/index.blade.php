@extends('app_layout')
@section('title', 'Paramètres')
@section('content')
    @if (session('success'))
        <x-notification :message="session('success')" color="green" icon="fa-circle-check" />
    @elseif (session('error'))
        <x-notification :message="session('error')" color="red" icon="fa-circle-exclamation" />
    @endif
    
    <div class="max-w-5xl mx-auto mt-10 mb-12" x-data="{ activeTab: 'profile' }">
        <div class="bg-gradient-to-r from-green-100 to-blue-50 rounded-t-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800">Paramètres du compte</h1>
            <p class="text-gray-600 mt-2">Gérez vos informations personnelles et les préférences de sécurité</p>
        </div>

        <div class="bg-white shadow-lg rounded-b-lg border border-gray-100">
            <!-- Tabs Navigation -->
            <div class="flex border-b border-gray-200">
                <button @click="activeTab = 'profile'"
                    :class="{ 'text-green-600 border-b-2 border-green-500': activeTab === 'profile', 'text-gray-500 hover:text-gray-700': activeTab !== 'profile' }"
                    class="px-6 py-4 font-medium text-sm transition duration-150">
                    Profil
                </button>
                <button @click="activeTab = 'security'"
                    :class="{ 'text-green-600 border-b-2 border-green-500': activeTab === 'security', 'text-gray-500 hover:text-gray-700': activeTab !== 'security' }"
                    class="px-6 py-4 font-medium text-sm transition duration-150">
                    Sécurité
                </button>
                <button @click="activeTab = 'notifications'"
                    :class="{ 'text-green-600 border-b-2 border-green-500': activeTab === 'notifications', 'text-gray-500 hover:text-gray-700': activeTab !== 'notifications' }"
                    class="px-6 py-4 font-medium text-sm transition duration-150">
                    Notifications
                </button>
            </div>

            <!-- Profile Section -->
            @include('settings.partials.profile')

            <!-- Security Section -->
            @include('settings.partials.security')

            <!-- Notifications Section -->
            @include('settings.partials.notification')
        </div>
    </div>
@endsection

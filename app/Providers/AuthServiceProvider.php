<?php

namespace App\Providers;

use App\Models\Plot;
use App\Policies\PlotPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
        Plot::class => PlotPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Optionnel si tu veux définir manuellement une Gate personnalisée
        Gate::define('update-status', [PlotPolicy::class, 'updateStatus']);
    }
}

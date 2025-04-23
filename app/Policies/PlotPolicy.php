<?php

namespace App\Policies;

use App\Models\Plot;
use App\Models\User;

class PlotPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function updateStatus(User $user, Plot $plot)
    {
        // Vérifier si l'utilisateur est bien l'agriculteur associé à la parcelle
        return $user->id === $plot->user_id;
    }
}

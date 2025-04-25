<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $sessions = DB::table('sessions')
            ->where('user_id', $userId)
            ->orderBy('last_activity', 'desc')
            ->get()
            ->map(function ($session) {
                $agent = new Agent();
                $agent->setUserAgent($session->user_agent);

                return [
                    'id' => $session->id,
                    'ip_address' => $session->ip_address,
                    'is_current_device' => $session->id === session()->getId(),
                    'browser' => $agent->browser(),
                    'platform' => $agent->platform(),
                    'device' => $agent->device(),
                    'last_activity' => \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                ];
            });
        return view('settings.index', compact('sessions'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function sessions() {}

    /**
     * Détruire une session spécifique
     */
    public function destroySession($sessionId)
    {
        // Vérifier que l'utilisateur ne supprime pas sa propre session
        if ($sessionId === session()->getId()) {
            return back()->with('error', 'Vous ne pouvez pas déconnecter votre session actuelle.');
        }

        // Vérifier que la session appartient bien à l'utilisateur connecté
        $session = DB::table('sessions')
            ->where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->first();

        if ($session) {
            DB::table('sessions')->where('id', $sessionId)->delete();
            return back()->with('success', 'Appareil déconnecté avec succès.');
        }

        return back()->with('error', 'Session introuvable.');
    }

    /**
     * Détruire toutes les autres sessions de l'utilisateur
     */
    public function destroyAllSessions()
    {
        $currentSessionId = session()->getId();

        DB::table('sessions')
            ->where('user_id', Auth::id())
            ->where('id', '!=', $currentSessionId)
            ->delete();

        return back()->with('success', 'Tous les autres appareils ont été déconnectés.');
    }
}

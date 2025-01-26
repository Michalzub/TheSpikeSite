<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpikeSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('wiki.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function agents()
    {
        $agents = session('agents');

        if (!$agents) {
            $response = Http::get('https://valorant-api.com/v1/agents', ['isPlayableCharacter' => 'true']);
            $agents = $response->json()['data'];

            session(['agents' => $agents]);
        }

        return view('wiki.agents', compact('agents'));
    }

    public function agentDetails($name)
    {
        $agents = session('agents');

        $agent = collect($agents)->firstWhere('displayName', ucfirst(strtolower($name)));

        if (!$agent) {
            abort(404, 'Agent not found');
        }

        return view('wiki.agents-page', compact('agent'));
    }

    public function weapons()
    {
        $weapons = session('weapons');

        if (!$weapons) {
            $response = Http::get('https://valorant-api.com/v1/weapons');

            $weapons = collect($response->json()['data'])->map(function($weapon) {
                unset($weapon['skins']);
                return $weapon;
            });
            session(['weapons' => $weapons]);
        }

        return view('wiki.weapons', compact('weapons'));
    }

    public function maps()
    {
        return view('wiki.maps');
    }
}

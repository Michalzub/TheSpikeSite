<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpikeSiteController extends Controller
{
    public function index()
    {
        return view('wiki.index');
    }

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

        if (!$agents) {
            $response = Http::get('https://valorant-api.com/v1/agents', ['isPlayableCharacter' => 'true']);
            $agents = $response->json()['data'];

            session(['agents' => $agents]);
        }

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

    public function weaponDetails($name)
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


        $weapon = collect($weapons)->firstWhere('displayName', ucfirst(strtolower($name)));

        if (!$weapon) {
            abort(404, 'Weapon not found');
        }

        $weaponUuid = $weapon['uuid'];

        $response = Http::get("https://valorant-api.com/v1/weapons/{$weaponUuid}");

        if ($response->failed()) {
            abort(500, 'Failed to fetch weapon details');
        }

        $weapon = $response->json()['data'];


        $skins = $weapon['skins'];


        return view('wiki.weapon-page', compact('weapon', 'skins'));
    }

    public function maps()
    {
        $maps = session('maps');

        if (!$maps) {
            $response = Http::get('https://valorant-api.com/v1/maps');

            $maps = $response->json()['data'];

            $excludedMapNames = ['The Range', 'Basic Training'];
            foreach ($maps as $key => $map) {
                if (in_array($map['displayName'], $excludedMapNames)) {
                    unset($maps[$key]);
                }
            }

            $maps = array_values($maps);

            session(['maps' => $maps]);
        }

        return view('wiki.maps', compact('maps'));
    }

    public function mapDetails($name)
    {
        $maps = session('maps');

        if (!$maps) {
            $response = Http::get('https://valorant-api.com/v1/maps');

            $maps = $response->json()['data'];

            $excludedMapNames = ['The Range', 'Basic Training'];
            foreach ($maps as $key => $map) {
                if (in_array($map['displayName'], $excludedMapNames)) {
                    unset($maps[$key]);
                }
            }

            $maps = array_values($maps);

            session(['maps' => $maps]);
        }

        $map = collect($maps)->firstWhere('displayName', ucfirst(strtolower($name)));

        if (!$map) {
            abort(404, 'Map not found');
        }

        return view('wiki.maps-page', compact('map'));
    }
}

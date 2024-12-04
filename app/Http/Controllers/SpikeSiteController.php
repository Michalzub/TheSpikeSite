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
        $response = Http::get('https://valorant-api.com/v1/agents',['isPlayableCharacter' => 'true']);
        $agents = $response->json()['data'];
        return view('wiki.agents', compact('agents'));
    }

    public function agentspage(Request $request) {
        $response = Http::get('https://valorant-api.com/v1/agents/' . $request->id);
    }

    public function maps()
    {
        return view('wiki.maps');
    }

    public function weapons()
    {
        return view('wiki.weapons');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

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
        return view('wiki.agents');
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

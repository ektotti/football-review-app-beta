<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fixture;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $recentFixtures = Fixture::getRecentFixtures();
        $comingSoonFixtures = Fixture::getComingSoonFixtures() ?? null;
        return view('home', compact('recentFixtures', 'comingSoonFixtures'));
    }
}

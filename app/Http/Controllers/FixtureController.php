<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fixture;

class FixtureController extends Controller
{
    public function getRecentFixtures (){
        $recentFixtures = Fixture::getRecentFixtures();
        return $recentFixtures;
    }
    public function getComingSoonFixtures (){
        $comingSoonFixtures = Fixture::getComingSoonFixtures();
        return $comingSoonFixtures;
    }
}

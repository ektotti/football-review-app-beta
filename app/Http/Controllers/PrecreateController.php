<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fixture;
use App\Member;

class PrecreateController extends Controller
{
    public function index(Request $request){
        $fixtures = Fixture::simplePaginate(10);
        return view('create_prepare', ['fixtures'=>$fixtures]);
    }

    public function board(Request $request){
        $selectedFixture = Fixture::where('id', $request->id)->get()->toArray();
        $request->session()->put("fixture_id", $selectedFixture[0]['id']);
        $hometeamMember = Member::getSeparetedNameAndNumber($selectedFixture[0]['id'], $selectedFixture[0]['hometeam_name']);
        $awayteamMember = Member::getSeparetedNameAndNumber($selectedFixture[0]['id'], $selectedFixture[0]['awayteam_name']);
        return view('create_board',['hometeamMember'=>$hometeamMember, 'awayteamMember'=>$awayteamMember, 'selectedFixture'=>$selectedFixture]);
    }
}

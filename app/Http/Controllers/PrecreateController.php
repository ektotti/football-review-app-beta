<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fixture;
use App\Member;

class PrecreateController extends Controller
{
    public function index(Request $request){
        return view('create_prepare');
    }

    public function board(Request $request){
        $refererUrl = parse_url($_SERVER['HTTP_REFERER']);
        $isPost = $refererUrl['path'] == "/create/prepare" ? true : false;
        $selectedFixture = Fixture::where('id', $request->id)->get()->toArray();
        $request->session()->put("fixture_id", $selectedFixture[0]['id']);
        $hometeamMember = Member::getSeparetedNameAndNumber($selectedFixture[0]['id'], $selectedFixture[0]['hometeam_name']);
        $awayteamMember = Member::getSeparetedNameAndNumber($selectedFixture[0]['id'], $selectedFixture[0]['awayteam_name']);
        
        return view('create_board', compact('isPost', 'hometeamMember', 'awayteamMember', 'selectedFixture',));
    }
}

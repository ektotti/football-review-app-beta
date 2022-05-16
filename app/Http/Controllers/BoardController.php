<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Fixture;

class BoardController extends Controller
{
    public function index(Request $request){
        $selectedMatch = Fixture::where('id', $request->id)->get()->toArray();
        $hometeamMember = Member::getSeparetedNameAndNumber($selectedMatch[0]['id'], $selectedMatch[0]['hometeam_name']);
        $awayteamMember = Member::getSeparetedNameAndNumber($selectedMatch[0]['id'], $selectedMatch[0]['awayteam_name']);
        return view('board',['hometeamMember'=>$hometeamMember, 'awayteamMember'=>$awayteamMember]);
    }
}

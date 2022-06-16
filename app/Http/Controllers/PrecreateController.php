<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fixture;
use App\Member;

use function Psy\debug;

class PrecreateController extends Controller
{
    public function index(Request $request){
        return view('create_prepare');
    }

    public function board(Request $request){
        return view('create_board');
    }
}

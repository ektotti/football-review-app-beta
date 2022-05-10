<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class CaptureController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $imageData = $request->data;
        $imageData = preg_replace("/data\:image\/png\;base64,/", '', $imageData);
        $image = base64_decode($imageData);
        $fileName = $user->id . Uuid::uuid4() . '.png';
        Storage::disk('public')->put($fileName,$image);
    }
}

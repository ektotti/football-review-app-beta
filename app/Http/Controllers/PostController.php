<?php

namespace App\Http\Controllers;

use App\Fixture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fixtureId = $request->session()->get('fixture_id');
        $user = Auth::user();
        $post = new Post;
        $columns = [
            'user_id' => $user->id,
            'fixture_id' => $fixtureId,
            'title' => $request->title,
            'body' => $request->textContent,
        ];

        for($i = 0; $i < count($request->images); $i++) {
            $image_number = $i + 1;
            $imageData = $request->images[$i];
            $imageData = preg_replace("/data\:image\/png\;base64,/", '', $imageData);
            $image = base64_decode($imageData);
            $fileName = Uuid::uuid4() . '.png';
            Storage::disk('public')->put($fileName,$image);
            $columns["image{$image_number}"] = $fileName;
        }
        Log::debug($request->textContent);
        $post->fill($columns)->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

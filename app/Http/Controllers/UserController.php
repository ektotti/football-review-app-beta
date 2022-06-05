<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Relationship;

class UserController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loginUser = Auth::user();
        // $selectedUser = User::find($id);
        $selectedUser = User::with(['followingUser','followedUser',])->find($id);
        // dd($selectedUser->followingUser->count());
        $isIndex = true;
        $isSelf = $loginUser->id == $id;
        $isFollowing = $loginUser->isfollowingOrNot($selectedUser);

        return view('user.detail', compact(
                                    'selectedUser',
                                    'loginUser',
                                    'isIndex',
                                    'isFollowing',
                                    'isSelf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        return view('user.edit', ['user'=>$user]);
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
        $user = User::find($id);

        if($request->name){
            $user->name = $request->name;
        }

        if($request->email){
            $user->email = $request->email;
        }

        if($request->file('image')) {
            
            if($user->icon_image) {
                Storage::dist('public')->delete($user->icon_image);
            }

            $imageName = Storage::disk('public')
                        ->putFile('image_icon', $request->file('image'));
            $user->icon_image = $imageName;
        
        }

        $user->save();
        return redirect("/user/{$id}");
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

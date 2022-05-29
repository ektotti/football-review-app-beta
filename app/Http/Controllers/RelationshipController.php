<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relationship;
use Illuminate\Support\Facades\Log;

class RelationshipController extends Controller
{
    public function follow(Request $request) {
        $relationship = Relationship::where('user_id', $request->loginUserId)
                                    ->where('following_user_id', $request->selectedUserId)
                                    ->first();
        
        if($relationship) {
            echo 'おかしくない？例外です。';
        }

        $newRelationship = Relationship::create([
            'user_id' => $request->loginUserId,
            'following_user_id' => $request->selectedUserId,
        ]);

        $newRelationship->save();
    }

    public function unfollow(Request $request) {
        $relationship = Relationship::where('user_id', $request->loginUserId)
                                    ->where('following_user_id', $request->selectedUserId)
                                    ->first();
        
        if($relationship) {
            $relationship->delete();
        } else {
            echo 'おかしくない？例外です。';
        }
    }

    public function followList(Request $request) {
        $followList = Relationship::getFollowingUserList($request->id);
        return $followList;
    }

    public function followerList(Request $request) {
        $followerList = Relationship::getFollowedUserList($request->id);
        return $followerList;
    }
}
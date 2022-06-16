<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Log;

class GetPostsController extends Controller
{
    public function __invoke()
    {
        Log::debug('getpostscontrollerまでは来ています');
        $posts = [];
        $refererUrl = parse_url($_SERVER['HTTP_REFERER']);
        $refererPath = $refererUrl['path'];
        
        if(preg_match("/\/user\/\d+/", $refererPath)){
            $user_id = str_replace("/user/", "", $refererPath);
            $posts = Post::where('user_id',$user_id)->with(['user', 'fixture', 'comments.user', 'likes'])->simplePaginate(3);
        }else{
            $posts = Post::with(['user', 'fixture', 'comments.user', 'likes'])->simplePaginate(3);
        }
        
        return $posts;
    }
}

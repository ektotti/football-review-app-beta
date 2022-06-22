<?php

namespace App\Http\Controllers;

use App\Fixture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Symfony\Component\ErrorHandler\Debug;

use function Psy\debug;

class PostController extends Controller
{

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
        Log::debug($fixtureId);
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
            $imageData = preg_replace("/data\:image\/jpeg\;base64,/", '', $imageData);
            $image = base64_decode($imageData);
            $fileName = Uuid::uuid4() . '.jpeg';
            Storage::disk('public')->put($fileName,$image);
            $columns["image{$image_number}"] = $fileName;
        }
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
        $post = Post::with(['user', 'fixture', 'comments.user', 'likes'])->get()->find($id);
        $isSelf = $post->checkIsSelf();
        $likeThisPost = $post->checkUserLikePost();

        return view('post_detail',compact('post', 'likeThisPost', 'isSelf'));
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
        $selectedPost = Post::where('id', $id)->first();
        $selectedPost->body = $request->body;
        $done = $selectedPost->save();
        if($done){
            header("Location:{$request->header('referer')}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        for ($i=1; $i <= 4; $i++) {

            if($post["image$i"]){
                Storage::disk('public')->delete($post["image$i"]);
            }
        }
        Post::destroy($id);
        $isIndex = true;
         return view('/', compact('isIndex'));
    }
}

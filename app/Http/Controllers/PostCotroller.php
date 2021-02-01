<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCotroller extends Controller
{
    public function postindex()
    {
        $myPosts = Post::all()->sortByDesc('id');
        $allcats = Category::all();
        return view('admin.post.postindex' , compact('myPosts' , 'allcats')) ;
    }

    public function newpost()
    {
        $allcats = Category::all();
        return view('admin.post.new' , compact('allcats')) ;
    }

    public function savepost(Request $request)
    {
        //dd($request);
        $user_id = Auth::user()->id ;
        $tags = explode( '-' , $request->tags );
        foreach ($tags as $tag){
            $newTag = new Tag();
            $newTag -> word = $tag ;
            $newTag -> shortDescription = $tag ;
            $newTag -> metaDescription = $tag ;
            $newTag -> save() ;
        }

        $newPost = new Post();
        $newPost-> user_id = $user_id ;
        $newPost-> subject = $request ->subject ;
        $newPost-> text = $request-> text ;
        $newPost -> category = $request -> category ;
        $newPost -> tag = $request -> tags ;
        $newPost -> save();

        return back();
    }

    public function showpost(Post $id)
    {
        return view('visa.post.post' , compact('id'));
    }
}

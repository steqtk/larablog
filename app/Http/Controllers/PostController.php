<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        $posts = Post::with('user')->orderBy('id', 'desc')->paginate(10);

        if ($request->ajax())
        {
            $view = view('post.data',compact('posts'))->render();

            return response()->json(['html'=>$view]);
        }

        return view('post.index', ['posts' => $posts]);
    }

}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('user')->orderBy('id', 'desc')->paginate(5);
        if ($request->ajax())
        {
            $view = view('post.data',compact('posts'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('post.index', ['posts' => $posts]);
    }

    public function getPostsOfAuthUser()
    {
        $posts = Auth::user()->posts;
        return view('post.index', ['posts' => $posts]);
    }

    public function getCountOfPosts()
    {
        return (Auth::check()) ? count(Auth::user()->posts) : '';
    }

    public function edit(Post $post)
    {
        ($post->user_id === Auth::id()) ? : abort(403);
        return view ('post.edit' , ['post' => $post]);
    }

    public function update(PostRequest $request)
    {
        $post_image_to_db = [];
        if ($request->has('post_image')) {
            foreach ($request->post_image as $image) {
                if ($image instanceof UploadedFile) {
                    $extension = $image->getClientOriginalExtension(); // you can also use file name
                    $filename = Auth::user()->name.'_'.Str::random(10).'.'.$extension;
                    $filepath = $image->storeAs('', $filename);
                    $post_image_to_db[] = 'img/'.$filepath;
                } else {
                    $post_image_to_db[] = $image;
                }
            }
        }

        Post::whereId($request->post_id)->update([
            'title' => $request->title,
            'text' => $request->text,
            'image' => (!empty($post_image_to_db)) ? serialize($post_image_to_db) : null,
        ]);

        return redirect(route('myposts'));
    }

    public function destroy(Post $post)
    {
        ($post->user_id === Auth::id()) ? : abort(403);
        Post::whereId($post->id)->delete();

        return ['success'];
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(PostRequest $request)
    {
        $post_image_to_db = [];
        if ($request->has('post_image')) {
            foreach ($request->post_image as $image) {
                if ($image instanceof UploadedFile) {
                    $extension = $image->getClientOriginalExtension(); // you can also use file name
                    $filename = Auth::user()->name . '_' . Str::random(10) . '.' . $extension;
                    $filepath = $image->storeAs('', $filename);
                    $post_image_to_db[] = 'img/' . $filepath;
                }
            }
            Post::create([
                'title' => $request->title,
                'text' => $request->text,
                'image' => (!empty($post_image_to_db)) ? serialize($post_image_to_db) : null,
                'user_id' => Auth::id()
            ]);

            return redirect(route('myposts'));
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    /**
     * @param $id
     * @return int
     */
    public function getLikesByPostID($id)
    {
        return count(Like::where('post_id', $id)->get()->toArray());
    }
    
    /**
     * @param Request $request
     * @return int|void
     */
    public function setLikesByPostID(Request $request)
    {
        $id = (int) $request->post('id');
        $posts = Auth::user()->posts;
    
        if (!in_array($id, $posts->pluck('id')->toArray())){
            try {
                Like::where('post_id', $id)->insert([
                    'post_id' => $id,
                    'user_id' => Auth::id()
                ]);
            } catch (\Exception $e) {
                // trying to like your post
            }
            
            return $this->getLikesByPostID($id);
        }
    }
    
    public function getPostsIDbyUserID($userID)
    {
        return Like::where('user_id', $userID)->pluck('post_id')->toArray();
    }
   
}

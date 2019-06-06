<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function create(Request $request) {
      $like = new Like;
      $like->user_id = Auth::user()->id;
      $like->post_id = $request['postId'];
      $like->save();

      $like_count = $like->like_count($request['postId']);
      return $like_count;
    }

    public function delete(Request $request) {
      $like = Like::whereRaw('user_id = :user_id and post_id = :post_id',
                                  ['user_id' => Auth::user()->id, 'post_id' => $request['postId']])->first();
      $like->delete();

      $like_count = $like->like_count($request['postId']);
      return $like_count;
    }
}

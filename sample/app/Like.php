<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function like_count($postId)
    {
      $count = Like::where('post_id', $postid)->count();
      return $count;
    }
}

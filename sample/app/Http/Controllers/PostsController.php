<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{

    //NOTE: POSTテーブルからcreated_atカラムの降順（最新）取得し、$postsに代入。pagenate:10
    public function index()
    {
      $posts = Post::orderBy('created_at', 'desc')->paginate(10);

      //NOTE: index.bladeに$postsをpostsに変えて渡し、表示
      return view('posts.index', ['posts' => $posts]);
    }


    public function create()
    {
    return view('posts.create');
    }


    //NOTE: バリデーダー適応
    public function store(Request $request)
    {
    $params = $request->validate([
        'title' => 'required|max:50',
        'body' => 'required|max:2000',
    ]);

    Post::create($params);

    return redirect()->route('top');
    }


    //NOTE:　Postテーブルからpost_idを取ってきてビューに渡す
    public function show($post_id)
    {
      $post = Post::findOrFail($post_id);
      return view('posts.show', [
        'post' => $post,
    ]);
    }

    //NOTE: edit.bladeにPostテーブルの$post_idを渡している
    public function edit($post_id)
    {
     $post = Post::findOrFail($post_id);

     return view('posts.edit', ['post' => $post,]);
    }


    public function update($post_id, Request $request)
    {

    $params = $request->validate([
      'title' => 'required|max:50',
      'body' => 'required|max:2000',
    ]);

    $post = Post::findOrFail($post_id);
    //NOTE; $fill()は引数に代入した値を確認して、代入する
    $post->fill($params)->save();

    return redirect()->route('posts.show', ['post' => $post]);
   }


   public function destroy($post_id)
   {
    $post = Post::findOrFail($post_id);

    //NOTE; DBファサードで$postをデリート
    \DB::transaction(function () use ($post) {
        $post->comments()->delete();
        $post->delete();
    });

    return redirect()->route('top');
  }

  public function profile()
  {
    return view('users.profile');
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{

    //NOTE: POSTテーブルからcreated_atカラムの降順（最新）取得し、$postsに代入。pagenate:10//
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

    //NOTE: valudateを設定、$paramsに代入し、Postテーブルに代入。//
    public function store(Request $request)
    {
    $params = $request->validate([
        'title' => 'required|max:50',
        'body' => 'required|max:2000',
    ]);
    //?
    Post::create($params);

    return redirect()->route('top');
    }

    //XXX:　$post_idがどこから来たのか？多分、post_idカラムの事？//
    public function show($post_id)
    {
      $post = Post::findOrFail($post_id);
      return view('posts.show', [
        'post' => $post,
    ]);
    }

    //NOTE: Postテーブルの$post_idのカラムデータを持っきて、$postに代入し、edit.bladeに投げる//
    public function edit($post_id)
    {
     $post = Post::findOrFail($post_id);

     return view('posts.edit', ['post' => $post,]);
    }


    //NOTE:　更新機能:request->validate作成->$post_idをDBから持ってくる->fillしてsave//
    public function update($post_id, Request $request)
    {

    $params = $request->validate([
      'title' => 'required|max:50',
      'body' => 'required|max:2000',
    ]);

    $post = Post::findOrFail($post_id);
    //NOTE: fill()は値を確認して、代入する。//
    $post->fill($params)->save();

    return redirect()->route('posts.show', ['post' => $post]);
   }


   //NOTE: DBファサードのtransactionメソッドを使用
   public function destroy($post_id)
   {
    $post = Post::findOrFail($post_id);

    \DB::transaction(function () use ($post) {
        $post->comments()->delete();
        $post->delete();
    });

    return redirect()->route('top');
  }

  //NOTE: 自分のプロフィール//
  public function profile()
  {
    return view('users.profile');
  }
}

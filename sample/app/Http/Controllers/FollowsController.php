<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
  public function create(Request $request) {
  $follow = new Follow;
  $follow->user_id = Auth::user()->id;
  $follow->follow_id = $request->follow;
  $follow->save();

  return redirect("/users/index");
}

public function delete(Request $request) {
  $follow = Follow::whereRaw('user_id = :user_id and follow_id = :follow_id',
                            ['user_id' => Auth::user()->id ,'follow_id' => $request->follow])->first();
  $follow->delete();

  return redirect("/users/index");
}
}

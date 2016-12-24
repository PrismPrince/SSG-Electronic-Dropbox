<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
  public function __construct()
  {
    # code...
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $posts = Post::with('user')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get();

    return response()->json($posts);
  }

  // public function getPosts(Request $request)
  // {
  // }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $post = new Post();
    $post->user_id = $request->id;
    $post->title = $request->title;
    $post->desc = $request->desc;
    $post->save();

    return response()->json(Post::with('user')->find($post->id));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($post)
  {
    return response()->json(Post::with('user')->find($post));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $post)
  {
    $post = Post::with('user')->find($post);
    $post->title = $request->title;
    $post->desc = $request->desc;
    $post->save();

    return response()->json($post);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($post)
  {
    $post = Post::with('user')->find($post);
    $post->delete();

    return response()->json($post);
  }
}

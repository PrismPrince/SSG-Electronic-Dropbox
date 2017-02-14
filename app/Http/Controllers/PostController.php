<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Photo;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['show']]);
    $this->middleware('auth', ['only' => 'show']);
  }

  public function index(Request $request)
  {
    return response()->json(Post::with('user')->with('photos')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get());
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $post = new Post();

    $post->user_id = Auth::guard('api')->id();
    $post->title   = $request->title;
    $post->desc    = $request->desc;
    $post->save();

    $photos = [];

    foreach ($request->photos as $key => $photo) {
      $photos[$key] = new Photo();

      $photos[$key]->name = $photo;
    }

    $post->photos()->saveMany($photos);

    return response()->json(Post::with('user')->with('photos')->find($post->id));
  }

  public function show(Request $request, $post)
  {
    Post::findOrFail($post);

    return view('posts.show');
  }

  public function getPost($post)
  {
    return response()->json(Post::with('user')->with('photos')->find($post));
  }

  public function edit($post)
  {
    return response()->json(Post::with('user')->find($post));
  }

  public function update(Request $request, $post)
  {
    $post = Post::with('user')->with('photos')->find($post);

    $post->title = $request->title;
    $post->desc  = $request->desc;
    $post->save();

    return response()->json($post);
  }

  public function destroy($post)
  {
    $post = Post::with('user')->with('photos')->find($post);
    $post->delete();

    return response()->json($post);
  }
}

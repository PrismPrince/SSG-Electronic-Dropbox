<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['only' => ['uploadUserProfile', 'uploadPostPhotos']]);
    $this->middleware('auth', ['only' => ['userProfile', 'postImage']]);
  }

  public function userProfile(Request $request, $user)
  {
    if (file_exists(storage_path('app/public/images/users/' . $user)))
      $image = Image::make(storage_path('app/public/images/users/' . $user));
    else
      $image = Image::make(public_path('images/default_avatar.png'));

    if (isset($request->wh))
      $image->resize($request->wh, $request->wh);

    return $image->response();
  }

  public function postImage(Request $request, $image)
  {
    if (file_exists(storage_path('app/public/images/posts/' . $image)))
      return Image::make(storage_path('app/public/images/posts/' . $image))->response();

    return false;
  }

  public function uploadUserProfile(Request $request)
  {
    $image = Image::make($request->image)->crop(floor($request->width), floor($request->height), floor($request->xpos), floor($request->ypos))->save(storage_path('app/public/images/users/' . Auth::guard('api')->id()));

    return response($image);
  }

  public function uploadPostPhotos(Request $request)
  {
    $images = [];

    foreach ($request->photos as $photo) {
      $imageName = time() . '-' . mt_rand(1000000000, mt_getrandmax()) . '-' . mt_rand(1000000000, mt_getrandmax());
      $images[] = $imageName;
      $image = Image::make($photo)->save(storage_path('app/public/images/posts/' . $imageName));
    }

    return response()->json($images);
  }
}

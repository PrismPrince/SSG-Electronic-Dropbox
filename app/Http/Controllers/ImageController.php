<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['only' => ['uploadUserProfile']]);
    $this->middleware('auth', ['only' => ['userProfile']]);
  }

  public function userProfile(Request $request, $user)
  {
    if (file_exists(storage_path('app/public/users/' . $user)))
      $image = Image::make(storage_path('app/public/users/' . $user));
    else
      $image = Image::make(public_path('images/default_avatar.png'));

    if (isset($request->wh))
      $image->resize($request->wh, $request->wh);

    return $image->response();
  }

  public function uploadUserProfile(Request $request)
  {
    $image = Image::make($request->image)->crop(floor($request->width), floor($request->height), floor($request->xpos), floor($request->ypos))->encode('jpg')->save(storage_path('app/public/users/') . Auth::guard('api')->id());

    return response($image);
  }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
  use SoftDeletes;

  protected $hidden = [
    'post_id', 'updated_at', 'deleted_at',
  ];

  protected $dates = ['deleted_at'];

  public function post()
  {
    return $this->belongsTo(Post::class);
  }
}

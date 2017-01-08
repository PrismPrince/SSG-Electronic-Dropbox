<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
  use SoftDeletes;
  
  protected $hidden = [
    'poll_id', 'created_at', 'updated_at', 'deleted_at',
  ];

  protected $dates = ['deleted_at'];

  public function poll()
  {
    return $this->belongsTo(Poll::class);
  }

  public function users()
  {
    return $this->belongsToMany(User::class, 'votes');
  }
}

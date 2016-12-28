<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poll extends Model
{
  use SoftDeletes;
  
  protected $hidden = [
    'user_id', 'updated_at', 'deleted_at',
  ];

  protected $dates = ['deleted_at'];

  public function users()
  {
    return $this->belongsTo(User::class);
  }

  public function answers()
  {
    return $this->hasMany(Answer::class);
  }
}

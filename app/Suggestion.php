<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suggestion extends Model
{
  use SoftDeletes;
  
  protected $hidden = [
    'user_id', 'updated_at', 'deleted_at',
  ];

  protected $dates = ['deleted_at'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function scopeSearchTitle($query, $key)
  {
    return $query->where('title', 'LIKE', '%' . $key . '%');
  }

  public function scopeSearch($query, $key)
  {
    return $query->where('title', 'LIKE', '%' . $key . '%')->orWhere('message', 'LIKE', '%' . $key . '%');
  }
}

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

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function answers()
  {
    return $this->hasMany(Answer::class);
  }

  public function scopeSearchTitle($query, $key)
  {
    return $query->where('title', 'LIKE', '%' . $key . '%');
  }

  public function scopeSearch($query, $key)
  {
    return $query->where('title', 'LIKE', '%' . $key . '%')->orWhere('desc', 'LIKE', '%' . $key . '%');
  }
}

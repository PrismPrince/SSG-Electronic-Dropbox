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

  public function scopeSearch($query, $field, $key)
  {
    return $query->where($field, 'LIKE', '%' . $key . '%');
  }
}

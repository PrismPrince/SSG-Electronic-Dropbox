<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

  protected $hidden = [
    'user_id', 'suggestion_id', 'updated_at', 'deleted_at',
  ];

  protected $dates = ['deleted_at'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function suggestion()
  {
    return $this->belongsTo(Suggestion::class);
  }

}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
  use SoftDeletes, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'fname',
    'mname',
    'lname',
    'email',
    'password',
    'api_token',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'email', 'password', 'api_token', 'remember_token', 'created_at', 'updated_at', 'deleted_at',
  ];

  public $incrementing = false;

  protected $dates = ['deleted_at'];

  public function posts()
  {
    return $this->hasMany(Post::class);
  }

  public function polls()
  {
    return $this->hasMany(Poll::class);
  }

  public function suggestions()
  {
    return $this->hasMany(Suggestion::class);
  }

  public function answers()
  {
    return $this->belongsToMany(Answer::class, 'votes');
  }

  public function scopeWithRole($query, $role)
  {
    return $query->where('role', $role);
  }

  public function scopeSearchName($query, $key)
  {
    return $query
      ->where('fname', 'LIKE', '%' . $key . '%')
      ->orWhere('lname', 'LIKE', '%' . $key . '%');
  }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRegistrationRequest extends Model
{
  protected $dates = ['deleted_at'];

  public $incrementing = false;
}

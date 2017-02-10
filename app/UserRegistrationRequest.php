<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRegistrationRequest extends Model
{
  public $incrementing = false;
  protected $dates     = ['deleted_at'];
}

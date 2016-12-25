<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
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
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $hidden = [
		'user_id', 'updated_at', 'deleted_at',
	]; 

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

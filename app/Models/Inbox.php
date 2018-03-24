<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inbox extends Model {
	use SoftDeletes;
	public $timestamps = true;
	
	protected $table = 'inbox';

	protected $attributes = array(
		'id' => '',
		'name' => '',
		'userID' => 0,
		'content' => '',

	);
	
	//
}

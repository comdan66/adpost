<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model {
	// use SoftDeletes;
	public $timestamps = true;
	
	protected $table = 'setting';

	protected $attributes = array(
		'id' => '',
		'name' => '',
		// 'userID' => 0,
		'content' => '',

	);
	
	//
}

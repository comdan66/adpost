<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model {
	use SoftDeletes;
	
	protected $table = 'advertisement';

	protected $attributes = array(
		'id' => '',
		'name' => '',
		'postTypeID' => 1,
		'typeID' => 1,

	);
}

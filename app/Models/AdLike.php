<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdLike extends Model {
	use SoftDeletes;
	
	protected $table = 'ad_like';

	protected $attributes = array(
		'id' => '',

	);
}

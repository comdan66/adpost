<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdComment extends Model {
	use SoftDeletes;
	
	protected $table = 'ad_comment';

	protected $attributes = array(
		'id' => '',

	);
}

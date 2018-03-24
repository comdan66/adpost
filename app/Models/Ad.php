<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model {
	use SoftDeletes;
	
	protected $table = 'advertisement';

	protected $attributes = array(
		'id' => '',
		'name' => '',
		'userID' => '',
		'postTypeID' => 1,
		'typeID' => 1,
		'brief' => '',
		'content' => '',
		'youtubeID' => '',
		'youtubeJson' => array(),
		'url' => '',
		'photoJson' => array(),
		'photo' => '',
		'isActive' => 0,
		'isApprove' => 0,

	);
}

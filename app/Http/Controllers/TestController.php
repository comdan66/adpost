<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
// use App\Models\Admin;

use App\Helpers\MailHelper;
use App;

class TestController extends _Controller {

	
	public function test() {

		if (App::environment('live')) {
			print 'asdsda';
		}

		die('1111');

		$userID = 25;

		setSession('isLogin', true);
		setSession('userID', $userID);

		$user = User::find($userID);

		setSession('userID', $user['id']);
		setSession('isUserLogin', true);
		setSession('isLogin', true);
		setSession('user', $user);

		// MailHelper::sendDo('bittyferrari@gmail.com', null, 'test');
	}

}

<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// use Illuminate\Support\Facades\Route;

class _ControllerUser extends _Controller {
	// use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public $title = 'Member Center';

	//bitty
	public function callAction($method, $parameters) {
		$this -> beforeAction();
		return call_user_func_array(array($this, $method), $parameters);
	}

	//控制memberCenter是否登入，以及redirect去哪
	public function beforeAction() {

		parent::beforeAction();

		$isLogin = getSession('isLogin');

		if ($isLogin == true) {

		} else {
			if (isset($_SERVER['HTTP_REFERER'])) {
				toPage('/');
			} else {
				toPage('/login');
			}

		}

	}

}

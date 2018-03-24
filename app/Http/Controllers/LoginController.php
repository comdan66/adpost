<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\MailHelper;

class LoginController extends _Controller {

	public function index() {
		$v = &$this -> vueData;
		$isLogin = getSession('isLogin');
		if ($isLogin == true) {
			return redirect('/');
		}
		$this -> vueData['fbAppID'] = config('facebook.app_id');
		return v($this);
	}

	public function forgot() {
		$v = &$this -> vueData;
		$isLogin = getSession('isLogin');
		if ($isLogin == true) {
			// return redirect('/');
		}
		return v($this);
	}

	public function ad() {
		$v = &$this -> vueData;
		$isLogin = getSession('isLogin');
		if ($isLogin == true) {
			// return redirect('/');
		}
		$this -> vueData['fbAppID'] = config('facebook.app_id');
		return v($this);
	}

	public function normal() {
		$v = &$this -> vueData;
		$isLogin = getSession('isLogin');
		if ($isLogin == true) {
			// return redirect('/');
		}
		$this -> vueData['fbAppID'] = config('facebook.app_id');
		return v($this);
	}

	public function logoutDo() {

		$return = null;
		$return['responseCode'] = 1;

		forgetSession('isLogin');
		forgetSession('isUserLogin');
		forgetSession('user');
		forgetSession('userID');

		saveSession();

		returnJson($return);
	}

	public function loginDo() {

		$return = null;
		$responseCode = 0;
		$roleID = 0;

		$requestBody = file_get_contents('php://input');
		$request = jsonDecode($requestBody);

		$email = $request['email'];
		$password = $request['password'];

		$rememberMe = request('rememberMe');
		if ($rememberMe == 1) {
			$rememberMe = true;
		} else {
			$rememberMe = false;
		}

		$user = User::where('email', '=', $email) -> first();

		if ($user) {

			if ($user['password'] == _md5($password)) {
				if ($user['isActive'] == 1 && $user['isEmailVerify'] == 1) {

					setSession('userID', $user['id']);
					setSession('isUserLogin', true);
					setSession('isLogin', true);
					setSession('user', $user);

					// $user -> save();

					$roleID = $user['roleID'];

					$responseCode = 1;

				} else {

					$responseCode = 2;

				}
			} else {
				$responseCode = 3;
			}
		} else {

			$responseCode = 4;

		}

		$return['responseCode'] = $responseCode;
		$return['roleID'] = $roleID;
		returnJson($return);
	}

	public function forgotDo() {

		$return = null;
		$responseCode = 0;

		$requestBody = file_get_contents('php://input');
		$request = jsonDecode($requestBody);

		$email = $request['email'];

		if (empty($email)) {

			$return['responseCode'] = 1;

			returnJson($return);
		}
		if (!isEmail($email)) {
			$return['responseCode'] = 2;
			returnJson($return);
		}

		$user = User::where('email', '=', $email) -> first();

		if ($user) {

			$verifyCode = randString(20);
			$user['verifyCode'] = $verifyCode;

			$user -> save();

			//send email
			$verifyUrl = url('/login/forgotReset?email=' . $user['email'] . '&verifyCode=' . $verifyCode);

			$mailData = null;
			$mailData['email'] = $user['email'];
			$mailData['name'] = $user['name'];
			$mailData['verifyUrl'] = $verifyUrl;

			MailHelper::sendDo($email, $mailData, 'userForgot');

			$return['responseCode'] = 3;

		} else {

			$return['responseCode'] = 4;
		}

		returnJson($return);

	}

	public function forgotReset() {

		// if ($isLogin == true) {
		// return redirect('/');
		// }

		$vueData = &$this -> vueData;

		$email = request('email');
		$verifyCode = request('verifyCode');

		$vueData['email'] = $email;
		$vueData['verifyCode'] = $verifyCode;

		$user = User::where('email', '=', $email) -> first();

		$vueData = &$this -> vueData;
		$vueData['email'] = $email;
		$vueData['verifyCode'] = $verifyCode;

		$user = User::where('email', '=', $email) -> first();

		if (!$user) {

			print '找不到user或驗證碼過期0rz';

		} else {

			if ($user['verifyCode'] == $verifyCode) {
				// $this -> render($vueData);

				return v($this);

			} else {

				//$this -> showAlert('驗證碼過期, 麻煩再使用一次忘記密碼功能喔', 'forgot', 'login');
			}

			v($this);

		}

	}

	public function forgotResetDo() {
		$return = null;
		$responseCode = 0;

		$requestBody = file_get_contents('php://input');
		$request = jsonDecode($requestBody);

		$email = $request['email'];
		$verifyCode = $request['verifyCode'];
		$password = $request['password'];
		$password2 = $request['password2'];

		if (empty($password)) {
			$return['responseCode'] = 4;
			returnJson($return);
		}

		$user = User::where('email', '=', $email) -> first();

		if (!$user) {

			$return['responseCode'] = 1;

		} else {
			if ($user['verifyCode'] == $verifyCode) {

				$return['responseCode'] = 2;

				//reset password
				$user['password'] = _md5($password);
				$user['isEmailVerify'] = 1;
				$user -> save();

			} else {

				$return['responseCode'] = 3;

			}

		}

		returnJson($return);

	}

}

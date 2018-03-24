<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

use App\Helpers\MailHelper;

class ForgotController extends _Controller {

	public $bodyClass = 'forgot';

	public function index() {
		//
		// if ($isLogin == true) {
		// return redirect('/');
		// }

		return v($this);
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
			$verifyUrl = url('/forgot/forgotReset?email=' . $user['email'] . '&verifyCode=' . $verifyCode);

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

		if ($isLogin == true) {
			return redirect('/');
		}

		$vueData = &$this -> vueData;

		$email = request('email');
		$verifyCode = request('verifyCode');

		$vueData['email'] = $email;
		$vueData['verifyCode'] = $verifyCode;

		$user = User::where('email', '=', $email) -> first();

		$viewData = &$this -> viewData;
		$viewData['email'] = $email;
		$viewData['verifyCode'] = $verifyCode;

		$user = User::where('email', '=', $email) -> first();

		if (!$user) {

			print '找不到user或驗證碼過期0rz';

		} else {

			if ($user['verifyCode'] == $verifyCode) {
				// $this -> render($viewData);

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

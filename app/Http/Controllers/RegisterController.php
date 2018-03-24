<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
// use App\Models\Admin;

use App\Helpers\MailHelper;

class RegisterController extends _Controller {

	public function index() {
		$v = &$this -> vueData;
		$isLogin = getSession('isLogin');
		if ($isLogin == true) {
			// return redirect('/');
		}
		$this -> vueData['fbAppID'] = config('facebook.app_id');
		return v($this, 'normal');
	}

	public function ad() {
		$v = &$this -> vueData;
		$isLogin = getSession('isLogin');
		if ($isLogin == true) {
			// return redirect('/');
		}
		$this -> vueData['fbAppID'] = config('facebook.app_id');

		$this -> vueData['option'] = getOption();

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

	public function verifyEmailDo() {

		$verifyCode = request('verifyCode');
		$email = request('email');

		$user = User::where('email', '=', $email) -> first();

		if ($user) {

			if ($user['verifyCode'] == $verifyCode) {

				$user['isActive'] = 1;
				$user['isEmailVerify'] = 1;
				$user -> save();

				setSession('userID', $user['id']);
				setSession('isLogin', true);
				setSession('isUserLogin', true);
				setSession('user', $user);

				$userID = $user['id'];

				print '<div id="box">信箱驗證完成，5秒後為你跳轉到登入頁</div><script>var count=5,timer=null,box = document.getElementById("box");function gocount(){timer = setInterval(function(){count-=1;box.innerHTML = "信箱驗證完成，"+count+"秒後為你跳轉到登入頁";if(count<=0){clearInterval(timer);location.replace("' . url('/') . '");}},1000)};gocount()</script>';

			} else {

				print '信箱驗證失敗';
			}

		} else {
			print '信箱驗證失敗';
		}

	}

	public function registerDo() {

		$return = null;
		$responseCode = 0;

		// $email = request('email');
		// $password = request('password');
		// $password2 = request('password2');

		$requestBody = file_get_contents('php://input');
		$request = jsonDecode($requestBody);

		$name = $request['name'];
		$email = $request['email'];
		$password = $request['password'];
		$password2 = $request['password2'];

		$email = filterHtml($email);
		$companyUrl = '';
		$companyNumber = '';
		$contact = '';
		$cityID = '';
		$areaID = '';
		$address = '';
		$roleID = $request['roleID'];
		$phone = '';

		if (isset($request['companyUrl'])) {
			$companyUrl = $request['companyUrl'];
		}

		if (isset($request['companyNumber'])) {
			$companyNumber = $request['companyNumber'];
		}

		if (isset($request['contact'])) {
			$contact = $request['contact'];
		}

		if (isset($request['cityID'])) {
			$cityID = $request['cityID'];
		}

		if (isset($request['areaID'])) {
			$areaID = $request['areaID'];
		}

		if (isset($request['address'])) {
			$address = $request['address'];
		}

		if (isset($request['phone'])) {
			$phone = $request['phone'];
		}

		// $roleID = request('roleID');
		$phone = filterHtml($phone);

		//check start---------------------------------------------
		if (!isEmail($email)) {
			$responseCode = 1;
			$return['responseCode'] = $responseCode;
			returnJson($return);
		}

		if (empty($password)) {
			$responseCode = 2;
			$return['responseCode'] = $responseCode;
			returnJson($return);
		}
		if ($password != $password2) {
			$responseCode = 3;
			$return['responseCode'] = $responseCode;
			returnJson($return);
		}

		//check end---------------------------------------------
		// $name = explode('@', $email);
		// $name = $name[0];

		$verifyCode = randString(10);
		$verifyUrl = url('register/verifyEmailDo?email=' . $email . '&verifyCode=' . $verifyCode);

		$user = User::where('email', '=', $email) -> first();

		if ($user) {

			//update active code
			if ($user['isActive'] != 1) {

				//not active yet------------------------------------------------

				$user['verifyCode'] = $verifyCode;
				$user -> save();

				$mailData = null;
				$mailData['name'] = $name;
				$mailData['verifyUrl'] = $verifyUrl;

				MailHelper::sendDo($email, $mailData, 'userRegister');

				// $this -> sendMailDo($email, $title, $content);

				$responseCode = 8;

			} else {

				//has active--------------------------------------------
				if ($user['isEmailVerify'] != '1') {

					$user['phone'] = $phone;
					$user['address'] = $address;
					$user['password'] = $this -> _md5($password);
					$user['verifyCode'] = $verifyCode;
					// $user -> passwordRegister = $password;
					$user -> lastModify = new CDbExpression('NOW()');
					$user -> update();

					$mailData = null;
					$mailData['name'] = $name;
					$mailData['verifyUrl'] = $verifyUrl;

					MailHelper::sendDo($email, $mailData, 'userRegister');

					$responseCode = 7;

				} else {

					$responseCode = 6;
				}

			}
		} else {

			//create new user-----------------------------------------------------------------------------

			$user = new User;

			$user['email'] = $email;
			$user['name'] = $name;

			$user['companyNumber'] = $companyNumber;
			$user['companyUrl'] = $companyUrl;
			$user['contact'] = $contact;
			$user['cityID'] = $cityID;
			$user['areaID'] = $areaID;
			$user['address'] = $address;
			$user['phone'] = $phone;

			if (!empty($cityID) && !empty($areaID)) {
				$city = type('city');
				$cityText = '';
				$areaText = '';
				$cityText = $city[$cityID]['name'];
				$areaText = $city[$cityID]['areas'][$areaID]['name'];
				$user['addressText'] = $cityText . $areaText . $user['address'];
			}

			$user['roleID'] = $request['roleID'];

			$user['verifyCode'] = $verifyCode;
			$user['password'] = _md5($password);
			$user['isActive'] = -1;
			$user['isEmailVerify'] = -1;
			$user['photo'] = '_default.png';

			$r = $user -> save();

			if ($r) {

				//update code
				// $user['code'] = '01' . sprintf("%07d", $user['id']) . '0';
				// $user -> save();

				$mailData = null;
				$mailData['name'] = $name;
				$mailData['verifyUrl'] = $verifyUrl;

				MailHelper::sendDo($email, $mailData, 'userRegister');

				$responseCode = 4;

			} else {
				$responseCode = 5;
			}
		}

		$return['responseCode'] = $responseCode;

		returnJson($return);
	}

}

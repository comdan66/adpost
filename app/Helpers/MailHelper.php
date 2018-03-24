<?php

namespace App\Helpers;

use Mail;
use App;

class MailHelper {

	static $toEmail;
	static $title = 'AD-POST通知';
	static $isSend = false;

	public static function sendDo($email, $data, $typeID) {

		self::$toEmail = $email;

		switch($typeID) {

			case 'userRegister' :
				self::$title = '會員註冊驗證';

				self::sendMailDo($email, $data, $typeID);
				break;
			case 'userForgot' :
				self::$title = 'AD-POST忘記密碼';
				self::sendMailDo($email, $data, $typeID);
				break;

			case 'test' :
				self::$title = 'ad-post test';
				self::sendMailDo($email, $data, $typeID);

				break;

			case 'contactAdd' :
				self::$title = '聯絡我們通知';
				self::sendMailDo($email, $data, $typeID);
				break;
		}

	}

	public static function sendMailDo($email, $data, $templateID) {

		if ($data == null) {
			$data = array();
		}

		if (App::environment('live')) {

			// if (self::$isSend) {
			Mail::send('_mail/' . $templateID, $data, function($message) {
				$message -> to(self::$toEmail, 'AD-POST') -> subject(self::$title);
			});
		}
	}

}

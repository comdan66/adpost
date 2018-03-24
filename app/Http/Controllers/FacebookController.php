<?php

namespace App\Http\Controllers;

require base_path() . '/vendor/facebook/graph-sdk/src/Facebook/autoload.php';

use App\Http\Controllers\Controller;
use App\Models\User;

class FacebookController extends _Controller {

	public function loginReturn() {

		$return = null;
		$return['responseCode'] = 1;

		if (isset($_POST['verifyCode'])) {
			$verifyCode = $_POST['verifyCode'];
		}
		if (isset($_POST['phone'])) {
			$phone = $_POST['phone'];
		}

		$isFacebookLogin = false;

		$app_id = config('facebook.app_id');
		$app_secret = config('facebook.app_secret');

		$fb = new \Facebook\Facebook( array('app_id' => $app_id, 'app_secret' => $app_secret, 'default_graph_version' => 'v2.9'));

		$helper = $fb -> getJavaScriptHelper();

		$accessToken = null;

		try {
			$accessToken = $helper -> getAccessToken();

		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			// echo 'Graph returned an error: ' . $e -> getMessage();
			// exit ;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			// echo 'Facebook SDK returned an error: ' . $e -> getMessage();
			// exit ;
		}

		if ($accessToken) {

			$response = null;

			try {
				// Returns a `Facebook\FacebookResponse` object
				$response = $fb -> get('/me?fields=id,email,name,gender', $accessToken);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				// echo 'Graph returned an error: ' . $e -> getMessage();
				// exit ;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				// echo 'Facebook SDK returned an error: ' . $e -> getMessage();
				// exit ;
			}

			if ($response) {

				$return['responseCode'] = 2;

				//have verifyCode
				if (isset($verifyCode)) {
					$return['responseCode'] = 5;
				};

				$isFacebookLogin = true;

				$fbUser = $response -> getGraphUser();

				if (!isset($fbUser['email'])) {
					$return['responseCode'] = 4;
					returnJson($return);
				}

				/*
				 ( [id] => 1733955813287709 [email] => bittyferrari@gmail.com [name] => Bitty Ferrari [gender] => male ) )
				 */

				// print_r($fbUser);

				$fbID = $fbUser['id'];

				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

				$user = User::where('fbID', '=', $fbID) -> first();

				//find by fbID
				if ($user) {

					//find email , update fbID
					$userID = $user['id'];

					setSession('userID', $userID);
					setSession('isUserLogin', true);
					setSession('isLogin', true);
					setSession('user', $user);
					setSession('isFbLogin', true);

				} else {

					//find by email

					$user = User::where('email', '=', $fbUser['email']) -> first();

					if ($user) {

						//update fbID
						$user['fbID'] = $fbID;
						$user -> save();

						setSession('userID', $user['id']);
						setSession('isUserLogin', true);
						setSession('isLogin', true);
						setSession('user', $user);
						setSession('isFbLogin', true);

					} else {

						//register new user by facebook
						$genderID = null;
						switch( $fbUser['gender']) {
							case 'male' :
								$genderID = 1;
								break;
							case 'female' :
								$genderID = 2;
								break;
						}

						//add new user
						$user = new User;
						$user['fbID'] = $fbID;
						$user['genderID'] = $genderID;
						$user['email'] = $fbUser['email'];
						$user['password'] = _md5($fbID);
						$user['isActive'] = 1;
						$user['roleID'] = 1;
						$user['name'] = $fbUser['name'];
						$user['photo'] = '_default.png';
						$user['fbEmail'] = $fbUser['email'];
						if (isset($verifyCode)) {
							$user['verifyCode'] = $verifyCode;
						}
						if (isset($phone)) {
							$user['phone'] = $phone;
						}

						$r = $user -> save();

						if ($r) {

							$userID = $user['id'];

							//update code
							// $user['code'] = '01' . sprintf("%07d", $user['id']) . '0';

							$photo = _md5(time() . uniqid() . $user['id']) . '.jpg';

							$file = null;
							// $file['tmp_name'] = 'http://graph.facebook.com/' . $fbID . '/picture?type=large';
							$file = 'http://graph.facebook.com/' . $fbID . '/picture?type=large';
							saveFile($file, $photo, 'user');

							$user['photo'] = $photo;
							$user -> save();

							setSession('userID', $userID);
							setSession('isUserLogin', true);
							setSession('isLogin', true);
							setSession('user', $user);
							setSession('isFbLogin', true);

						} else {

							$return['responseCode'] = 3;

						}

					}

				}

				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			}

		}

		returnJson($return);

	}

}

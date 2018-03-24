<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Contact;
use App\Models\Setting;

use App\Helpers\MailHelper;

class PageController extends _Controller {

	public function error() {
		$v = &$this -> viewData;

		return v($this);
	}

	public function about() {
		$v = &$this -> vueData;

		$item = Setting::where('keyID', '=', 'about') -> first();
		$v['json'] = jsonDecode($item['content']);

		return v($this);
	}

	public function propossal() {
		$v = &$this -> vueData;

		$item = Setting::where('keyID', '=', 'ad') -> first();
		$v['json'] = jsonDecode($item['content']);

		$item = Setting::where('keyID', '=', 'cooperation') -> first();
		$v['json2'] = jsonDecode($item['content']);

		return v($this);
	}

	public function rule() {
		$v = &$this -> viewData;

		return v($this);
	}

	public function description() {
		$v = &$this -> viewData;

		return v($this);
	}

	public function privacy() {
		$v = &$this -> viewData;

		return v($this);
	}

	public function contact() {
		$v = &$this -> vueData;

		$item = Setting::where('keyID', '=', 'contact') -> first();
		$v['json'] = jsonDecode($item['content']);

		return v($this);
	}

	public function contactDo() {
		$result = null;
		$request = getInputJson();

		$item = new Contact;

		$item['typeID'] = $request['typeID'];
		$item['email'] = $request['email'];
		$item['name'] = $request['name'];
		$item['phone'] = $request['phone'];
		$item['content'] = $request['content'];
		$item['file'] = $request['file'];

		$isSuccess = $item -> save();
		$result['isSuccess'] = $isSuccess;

		if ($isSuccess) {

			//get admin email

			$setting = Setting::where('keyID', '=', 'adminEmail') -> first();
			if ($setting) {

				$json = jsonDecode($setting['content']);
				if (isset($json['email'])) {

					if (isEmail($json['email'])) {

						$email = $json['email'];
						$data['item'] = $item -> toArray();
						MailHelper::sendDo($email, $data, 'contactAdd');

					}
				}
			}

		}

		returnJson($result);
	}

	//
	// public function consultant() {
	// $v = &$this -> viewData;
	//
	// $items = Consultant::get();
	//
	// $v['items'] = $items;
	//
	// return v($this);
	// }

}

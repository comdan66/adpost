<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Ad;
use App\Models\Inbox;
use App\Models\Setting;
// use App\Models\Admin;

class MemberController extends _ControllerUser {

	public function setPreviewDo() {

		$request = getInputJson();
		$request['created_at'] = date('Y-m-d H:i:s');
		setSession('previewData', $request);

	}

	public function preview() {

		$v = &$this -> vueData;

		// setSession('previewData', $request);

		$previewData = getSession('previewData');

		$item = $previewData;

		$this -> vueData['item'] = $previewData;
		$this -> vueData['option'] = getOption();

		$slider = null;

		$youtubeJson = jsonDecode($item['youtubeJson']);
		$photoJson = jsonDecode($item['photoJson']);

		$n = 0;
		foreach ($youtubeJson as $x) {
			$a = null;
			$a['typeID'] = 1;
			$a['youtubeID'] = $x;
			$a['n'] = $n;
			$n++;
			$slider[] = $a;
		}
		foreach ($photoJson as $x) {
			$a = null;
			$a['typeID'] = 2;
			$a['photo'] = $x['photo'];
			$a['n'] = $n;
			$n++;
			$slider[] = $a;
		}

		$v['slider'] = $slider;

		$v['countLove'] = 0;
		$v['countComment'] = 0;
		$v['related'] = array();
		$v['comments'] = array();
		$v['isLike'] = false;

		// return v($this, 'item', 'advertisement');
		return v($this);

	}

	public function adUpdate() {
		$vueData = &$this -> vueData;

		$id = request('id');
		$item = Ad::find($id);

		if ($item && $item['userID'] == $this -> userID) {

			$vueData['item'] = $item;
			$vueData['option'] = getOption();

			return v($this);
		} else {
			return redirect('/member/dashboard');
		}

	}

	public function adUpdateDo() {
		$result = false;

		$request = getInputJson();

		$id = $request['id'];

		$item = new Ad;

		$item = Ad::findOrNew($id);

		setModelData($item, $request);

		//photo
		$item['postTypeID'] = 2;
		$youtubeJson = jsonDecode($item['youtubeJson']);
		if (count($youtubeJson) > 0) {
			//video
			$item['postTypeID'] = 1;
			$item['youtubeID'] = $youtubeJson[0];
		}

		$photoJson = jsonDecode($item['photoJson']);
		if (isset($photoJson[0])) {
			$item['photo'] = $photoJson[0]['photo'];
		}

		$item['userID'] = $this -> userID;

		// $item['name'] = $request['name'];
		// $item['brief'] = $request['brief'];
		// $item['content'] = $request['content'];
		// $item['youtubeID'] = $request['youtubeID'];
		// $item['youtubeJson'] = $request['youtubeJson'];
		// $item['url'] = $request['url'];
		// $item['typeID'] = $request['typeID'];
		// $item['postTypeID'] = $request['postTypeID'];
		// $item['photoJson'] = $request['photoJson'];
		// $item['photo'] = $request['photo'];

		//is auto approve

		$setting = Setting::where('keyID', '=', 'adApprove') -> first();

		if ($setting) {
			$json = jsonDecode($setting['content']);

			if ($json['isAutoApprove'] == true) {

				$item['isApprove'] = 1;

			}

		}

		$result = $item -> save();

		returnJson($result);
	}

	public function dashboard() {
		$vueData = &$this -> vueData;

		$this -> vueData['fbAppID'] = config('facebook.app_id');

		$vueData['option'] = getOption();
		$itemPerPage = 10;
		$page = request('page');
		if (!$page) {
			$page = 1;

		}
		$page = intval($page);
		$skip = ($page - 1) * $itemPerPage;

		$items = Ad::where('userID', '=', $this -> userID) -> skip($skip) -> take($itemPerPage) -> get();

		$vueData['items'] = $items;

		$vueData['item'] = $this -> user;

		$totalCount = Ad::where('userID', '=', $this -> userID) -> count();

		$vueData['pageTotal'] = ceil($totalCount / $itemPerPage);
		$vueData['page'] = $page;

		return v($this);
	}

	public function adCreate() {
		$vueData = &$this -> vueData;

		$vueData['item'] = new Ad;

		$vueData['option'] = getOption();

		return v($this);
	}

	public function inbox() {
		$vueData = &$this -> vueData;

		$vueData['item'] = $this -> user;
		$vueData['items'] = Inbox::where('userID', '=', $this -> userID) -> get();

		$vueData['option'] = getOption();

		return v($this);
	}

	public function profile() {
		$vueData = &$this -> vueData;

		$vueData['option'] = getOption();

		if (empty($this -> user['interestIDs'])) {
			// $this -> user['interestIDs'] = array();
		} else {
		}

		$this -> user['interestIDs'] = jsonDecode($this -> user['interestIDs']);

		$vueData['item'] = $this -> user;

		if ($this -> user['roleID'] == 1) {
			return v($this, 'profileNormal');
		} else {
			return v($this, 'profileAd');
		}

	}

	public function profileUpdateDo() {

		$result = false;

		$request = getInputJson();

		$item = $this -> user;

		$item['companyName'] = $request['companyName'];
		$item['companyNumber'] = $request['companyNumber'];
		$item['companyUrl'] = $request['companyUrl'];
		$item['companyPhone'] = $request['companyPhone'];
		$item['companyEmail'] = $request['companyEmail'];

		$item['name'] = $request['name'];
		$item['birthday'] = $request['birthday'];
		$item['genderID'] = $request['genderID'];
		$item['phone'] = $request['phone'];
		$item['address'] = $request['address'];
		$item['cityID'] = $request['cityID'];
		$item['areaID'] = $request['areaID'];
		$item['photo'] = $request['photo'];
		$item['contact'] = $request['contact'];
		$item['interestIDs'] = jsonEncode($request['interestIDs']);

		if (!empty($item['cityID']) && !empty($item['areaID'])) {
			$city = type('city');
			$cityText = '';
			$areaText = '';
			$cityText = $city[$item['cityID']]['name'];
			$areaText = $city[$item['cityID']]['areas'][$item['areaID']]['name'];
			$item['addressText'] = $cityText . $areaText . $item['address'];
		}

		$result = $item -> save();

		if ($result) {
			setSession('user', $item);
		}

		returnJson($result);

	}

	public function profileUpdate() {
		$vueData = &$this -> vueData;

		$vueData['option'] = getOption();

		if (empty($this -> user['interestIDs'])) {
			// $this -> user['interestIDs'] = array();
		} else {

		}
		$this -> user['interestIDs'] = jsonDecode($this -> user['interestIDs']);

		$vueData['item'] = $this -> user;

		if ($this -> user['roleID'] == 1) {
			return v($this, 'profileUpdateNormal');
		} else {
			return v($this, 'profileUpdateAd');
		}

	}

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\_ControllerAdmin;
// use App\Models\Setting;
use App\Models\User;
use App\Models\Inbox;

class MessageController extends _ControllerAdmin {

	public $moduleName = '站內訊息';

	public function listing() {

		$vueData = &$this -> vueData;

		$this -> viewData['pageTitle'] = $this -> moduleName . '管理';

		$vueData['option'] = getOption();

		return vAdmin($this);
	}

	public function getList() {
		$request = getInputJson();

		$search = $request['search'];

		setListSearch($search);

		$page = $request['page'];
		$pageSize = $request['pageSize'];
		$orderField = $request['orderField'];
		$orderType = $request['orderType'];

		// dd($search);

		if (!$pageSize) {
			$pageSize = 10;
		} else {
			$pageSize = intval($pageSize);
		}

		$page = intval($page);

		$skip = ($page - 1) * $pageSize;

		if (empty($orderField)) {
			$orderField = 'id';
		}
		if (empty($orderType)) {
			$orderType = 'ASC';
		}

		$result = Setting::orderby($orderField, $orderType);

		addWhere($result, 'id');
		addWhere($result, 'typeID');
		addWhere($result, 'name', 'like');
		addWhere($result, 'email', 'like');
		addWhere($result, 'addressText', 'like');
		addWhere($result, 'nameEnglish', 'like');
		addWhere($result, 'sequence');

		// addWhere($result, 'priceInternetFrom', '>=', 'priceInternet');
		// addWhere($result, 'priceInternetTo', '<=', 'priceInternet');
		// addWhere($result, 'priceSettingFrom', '>=', 'priceSetting');
		// addWhere($result, 'priceSettingTo', '<=', 'priceSetting');

		$itemCount = $result -> count();

		$select = array('*');
		$data = $result -> select($select) -> skip($skip) -> take($pageSize) -> get();

		// $json['data'] = $data;
		$json['items'] = $data;

		$json['skip'] = intval($itemCount);
		$json['itemPerPage'] = intval($pageSize);
		$json['totalItem'] = intval($itemCount);
		$json['pageTotal'] = ceil($itemCount / $pageSize);

		returnJson($json);
	}

	public function updateDo() {

		$request = getInputJson();

		$result = false;
		$isSuccess = false;
		$message = '';

		// $id = request('id');
		// $id = $request['id'];

		$name = $request['name'];
		$content = $request['content'];
		$roleID = $request['roleID'];
		//
		// $item = Setting::find($id);
		// if (!$item) {
		// $item = new Setting;
		// die();
		//
		// }
		//
		// setModelData($item, $request, array('date'));

		$user = User::where('roleID', '=', $roleID) -> get();

		//find all user
		foreach ($user as $x) {

			$item = new Inbox;

			$item['name'] = $name;
			$item['content'] = $content;
			$item['userID'] = $x['id'];

			$item -> save();

		}

		$isSuccess = true;

		// dd($request);
		if ($isSuccess) {
			//clear product plus
		}

		$return = null;
		$return['isSuccess'] = $isSuccess;
		$return['message'] = $message;
		$return['model'] = $item;
		returnJson($return);
	}

	public function deleteDo() {
		$result = false;
		$id = request('id');
		$item = Setting::find($id);
		if ($item) {
			$result = $item -> delete();
		}
		returnJson($result);
	}

	public function update() {

		//$this -> viewData['pageTitle'] = $this -> moduleName . '資料';
		$this -> viewData['pageTitle'] = $this -> moduleName . '發送';

		$vueData = &$this -> vueData;

		$id = request('id');

		// $item = Setting::find($id);

		// if ($item) {
		// $item['content'] = jsonDecode($item['content']);
		// } else {
		// }
		//

		$item = array();

		$vueData['item'] = $item;

		$vueData['option'] = getOption();

		return vAdmin($this, 'item');
	}

}

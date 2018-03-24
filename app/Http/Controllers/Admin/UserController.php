<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\_ControllerAdmin;
use App\Models\User;

class UserController extends _ControllerAdmin {

	public $moduleName = '使用者';

	public function listing() {

		$vueData = &$this -> vueData;

		$this -> viewData['pageTitle'] = $this -> moduleName . '管理';

		$vueData['option'] = getOption();

		//get user total
		$countNormal = User::where('roleID', '=', 1) -> count();
		$countAd = User::where('roleID', '=', 2) -> count();

		$vueData['countNormal'] = $countNormal;
		$vueData['countAd'] = $countAd;

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

		$result = User::orderby($orderField, $orderType);

		addWhere($result, 'id');
		addWhere($result, 'typeID');
		addWhere($result, 'roleID');
		addWhere($result, 'name', 'like');
		addWhere($result, 'email', 'like');
		addWhere($result, 'addressText', 'like');
		addWhere($result, 'nameEnglish', 'like');
		addWhere($result, 'sequence');

		addWhere($result, 'priceInternetFrom', '>=', 'priceInternet');
		addWhere($result, 'priceInternetTo', '<=', 'priceInternet');
		addWhere($result, 'priceUserFrom', '>=', 'priceUser');
		addWhere($result, 'priceUserTo', '<=', 'priceUser');

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
		$id = $request['id'];

		$item = User::find($id);
		if (!$item) {
			$item = new User;
		}
		setModelData($item, $request, array('date'));

		if (!empty($item['cityID']) && !empty($item['areaID'])) {
			$city = type('city');
			$cityText = '';
			$areaText = '';
			$cityText = $city[$item['cityID']]['name'];
			$areaText = $city[$item['cityID']]['areas'][$item['areaID']]['name'];
			$item['addressText'] = $cityText . $areaText . $item['address'];
		}
		$isSuccess = $item -> save();

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
		$item = User::find($id);
		if ($item) {
			$result = $item -> delete();
		}
		returnJson($result);
	}

	public function update() {

		$this -> viewData['pageTitle'] = $this -> moduleName . '資料';

		$vueData = &$this -> vueData;

		$id = request('id');

		$item = User::find($id);

		if ($item) {

			// $item['photoJson'] = jsonDecode($item['photoJson']);
			// if (!$item['photoJson']) {
			// $item['photoJson'] = array();
			// }

		} else {
			$item = new User;
		}
		$vueData['item'] = $item;

		$vueData['option'] = getOption();

		return vAdmin($this, 'item');
	}

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\_ControllerAdmin;
use App\Models\Ad;
use App\Models\User;

class AdvertisementController extends _ControllerAdmin {

	public $moduleName = '廣告';

	public function listing() {

		$this -> viewData['pageTitle'] = $this -> moduleName . '管理';

		$v = &$this -> viewData;
		$vueData = &$this -> vueData;

		$vueData['option'] = getOption();

		return vAdmin($this);
	}

	public function updateSequenceDo() {

		$id = request('id');

		$result = false;

		$item = Admin::find($id);

		if ($item) {
			$sequence = intval(request('sequence'));

			$item['sequence'] = $sequence;
			$result = $item -> save();
		} else {
		}

		returnJson($result);
	}

	public function getList() {

		$requestBody = file_get_contents('php://input');

		$request = jsonDecode($requestBody);

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

		if (strpos($orderField, '.') === false) {
			$orderField = 'advertisement.' . $orderField;
		}

		// $orderField = 'advertisement.id';

		// $result = Ad::join('user', 'user.id', 'advertisement.userID') -> orderby($orderField, $orderType);
		$result = Ad::leftJoin('user', 'user.id', 'advertisement.userID') -> orderby($orderField, $orderType);

		addWhere($result, 'id', '=', 'advertisement.id');
		addWhere($result, 'name', 'like', 'advertisement.name');
		// addWhere($result, 'url', 'like');
		// addWhere($result, 'youtubeID', 'like');
		addWhere($result, 'postTypeID', '=', 'advertisement.postTypeID');
		addWhere($result, 'typeID', '=', 'advertisement.typeID');
		addWhere($result, 'isActive', '=', 'advertisement.isActive');
		// addWhere($result, 'isApprove', '=', 'advertisement.isApprove');

		addWhere($result, 'userName', 'like', 'user.name');
		addWhere($result, 'userEmail', 'like', 'user.email');

		if ($search['isApprove'] == null && $search['isApprove'] != '0') {
			$result = $result -> whereNull('advertisement.isApprove');
		} else {
			if ($search['isApprove'] == 'all') {
			} else {
				addWhere($result, 'isApprove', '=', 'advertisement.isApprove');
			}
		}

		// addWhere($result, 'isAdvertisement');

		// addWhere($result, 'priceFrom', '>=', 'price');
		// addWhere($result, 'priceTo', '<=', 'price');

		$itemCount = $result -> count();

		$select = array('advertisement.*', 'user.email', 'user.name as userName');

		// $result = $result -> join('user', 'user.id', 'advertisement.userID');

		// $result = Advertisement::orderby($orderField, $orderType);

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

		$requestBody = file_get_contents('php://input');

		$request = jsonDecode($requestBody);

		// die();

		$result = false;
		$isSuccess = false;
		$message = '';

		// $id = request('id');
		$id = $request['id'];

		$item = Ad::find($id);

		if (!$item) {
			$item = new Ad;
		}
		// setModelData($item, $request, array('productPlus', 'photoJson'));
		setModelData($item, $request);

		// $item['content'] = strip_tags($item['content']);

		$item['photoJson'] = jsonEncode($request['photoJson']);

		$youtubeJson = $request['youtubeJson'];
		if (count($youtubeJson) > 0) {
			$item['youtubeID'] = $youtubeJson[0];
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

		// $items = Ad::get();
		// foreach ($items as $x) {
		// $x['content'] = str_replace('<br>', "\n", $x['content']);
		// $x -> save();
		// }

		returnJson($return);
	}

	public function deleteDo() {
		$result = false;
		$id = request('id');
		$item = Ad::find($id);
		if ($item) {
			$result = $item -> delete();
		}
		returnJson($result);
	}

	public function update() {

		$this -> viewData['pageTitle'] = $this -> moduleName . '資料';

		$v = &$this -> viewData;
		$formData = &$this -> formData;
		$vueData = &$this -> vueData;

		$id = request('id');

		$item = Ad::find($id);

		if ($item) {

			$item['photoJson'] = jsonDecode($item['photoJson']);
			$item['youtubeJson'] = jsonDecode($item['youtubeJson']);

		} else {
			$item = new Ad;
		}

		if (!$item['photoJson']) {
			$item['photoJson'] = array();
		}

		if (!$item['youtubeJson']) {
			$item['youtubeJson'] = array();
		}

		// $item['content'] = nl2br($item['content']);

		$vueData['item'] = $item;

		$vueData['option'] = getOption();
		$vueData['option']['user'] = User::orderby('id', 'asc') -> pluck('name', 'id');

		return vAdmin($this, 'item');
	}

}

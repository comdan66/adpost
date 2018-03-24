<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\_ControllerAdmin;
use App\Models\Option;

class PostTypeController extends _ControllerAdmin {

	public $moduleName = '廣告分類';

	public function listing() {

		$this -> viewData['pageTitle'] = $this -> moduleName . '管理';

		$v = &$this -> viewData;
		$vueData = &$this -> vueData;

		$option = null;
		$option['is'] = type('is');
		$vueData['option'] = $option;

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

		$result = Option::orderby($orderField, $orderType);

		addWhere($result, 'id');
		addWhere($result, 'name', 'like');
		addWhere($result, 'email', 'like');
		addWhere($result, 'phone', 'like');
		addWhere($result, 'isRead');
		addWhere($result, 'isOption');

		// addWhere($result, 'priceFrom', '>=', 'price');
		// addWhere($result, 'priceTo', '<=', 'price');

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

		$requestBody = file_get_contents('php://input');

		$request = jsonDecode($requestBody);

		// die();

		$result = false;
		$isSuccess = false;
		$message = '';

		// $id = request('id');
		$id = $request['id'];

		$item = Option::find($id);

		if (!$item) {
			$item = new Option;
		}
		// setModelData($item, $request, array('productPlus', 'photoJson'));
		setModelData($item, $request);

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
		$item = Option::find($id);
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

		$item = Option::find($id);

		if ($item) {

			// $item['photoJson'] = jsonDecode($item['photoJson']);
			// if (! $item['photoJson']) {
			//     $item['photoJson'] = [];
			// }
		} else {
			$item = new Option;
			$item['groupID'] = 'postType';
		}

		$item['content'] = nl2br($item['content']);

		$vueData['item'] = $item;

		$option = null;
		$option['is'] = type('is');

		$vueData['option'] = $option;

		return vAdmin($this, 'item');
	}

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\_ControllerAdmin;
use App\Models\AdComment;
use App\Models\User;

class AdCommentController  extends _ControllerAdmin {

	public function listing() {

		$v = &$this -> viewData;
		$v['pageTitle'] = '廣告留言';

		return vAdmin($this);
	}

	public function updateSequenceDo() {

		$id = request('id');

		$result = false;

		$item = AdComment::find($id);

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
			$orderField = 'ad_comment.' . $orderField;
		}

		$result = AdComment::join('user', 'user.id', 'ad_comment.userID') -> orderby($orderField, $orderType);

		addWhere($result, 'id', '=', 'ad_comment.id');
		addWhere($result, 'adID', '=', 'ad_comment.adID');

		addWhere($result, 'userName', 'like', 'user.name');
		addWhere($result, 'userEmail', 'like', 'user.email');

		// $result = $result -> where('isLike', '=', 1);

		// addWhere($result, 'isAdvertisement');

		// addWhere($result, 'priceFrom', '>=', 'price');
		// addWhere($result, 'priceTo', '<=', 'price');

		$itemCount = $result -> count();

		$select = array('ad_comment.*', 'user.email', 'user.name as userName');

		$data = $result -> select($select) -> skip($skip) -> take($pageSize) -> get();

		// $json['data'] = $data;
		$json['items'] = $data;

		$json['skip'] = intval($itemCount);
		$json['itemPerPage'] = intval($pageSize);
		$json['totalItem'] = intval($itemCount);
		$json['pageTotal'] = ceil($itemCount / $pageSize);

		returnJson($json);
	}

	/*
	 public function update()
	 {
	 $v = &$this -> viewData;
	 $formData = &$this -> formData;

	 $id = request('id');

	 $item = AdComment::find($id);

	 if ($item) {
	 $v['pageTitle'] = '廣告喜歡資料';

	 $permission = jsonDecode($item['permissionJson']);

	 $tempPermissionJson = null;

	 foreach ($this->controllers as $x) {
	 $controller = $x['controllerName'];

	 $tempPermissionJson[$x['controllerName']]['create'] = true;
	 $tempPermissionJson[$x['controllerName']]['read'] = true;
	 $tempPermissionJson[$x['controllerName']]['update'] = true;
	 $tempPermissionJson[$x['controllerName']]['delete'] = true;

	 $permissionType = 'create';
	 if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] == '0') {
	 $tempPermissionJson[$x['controllerName']][$permissionType] = false;
	 }

	 $permissionType = 'read';
	 if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] == '0') {
	 $tempPermissionJson[$x['controllerName']][$permissionType] = false;
	 }

	 $permissionType = 'update';
	 if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] == '0') {
	 $tempPermissionJson[$x['controllerName']][$permissionType] = false;
	 }

	 $permissionType = 'delete';
	 if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] == '0') {
	 $tempPermissionJson[$x['controllerName']][$permissionType] = false;
	 }
	 }

	 $formData = $item;

	 $formData['permissionJson'] = $tempPermissionJson;
	 } else {
	 $v['pageTitle'] = '廣告喜歡建立';

	 $emptyPermissinJson = null;

	 foreach ($this->controllers as $x) {
	 $emptyPermissinJson[$x['controllerName']]['create'] = false;
	 $emptyPermissinJson[$x['controllerName']]['read'] = false;
	 $emptyPermissinJson[$x['controllerName']]['update'] = false;
	 $emptyPermissinJson[$x['controllerName']]['delete'] = false;
	 }

	 $formData['permissionJson'] = $emptyPermissinJson;
	 }
	 $option = null;
	 // $option['typeID'] = type('product.type');
	 $option['is'] = type('is');
	 $option['AdCommentRole'] = type('AdComment.role');
	 $formData['option'] = $option;

	 $v['controllers'] = $this -> controllers;

	 return vAdmin($this, 'item');
	 }
	 */

	public function updateDo() {

		$requestBody = file_get_contents('php://input');

		$request = jsonDecode($requestBody);

		// die();

		$result = false;
		$isSuccess = false;
		$message = '';

		// $id = request('id');
		$id = $request['id'];

		$item = AdComment::find($id);

		if (!$item) {
			$item = new AdComment;
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
		$item = AdComment::find($id);
		if ($item) {
			$result = $item -> delete();
		}
		returnJson($result);
	}

	public function update() {
		$v = &$this -> viewData;
		$formData = &$this -> formData;
		$vueData = &$this -> vueData;

		$id = request('id');

		$item = AdComment::find($id);

		if ($item) {
			$v['pageTitle'] = '廣告喜歡資料';

			$item['photoJson'] = jsonDecode($item['photoJson']);

			if (!$item['photoJson']) {
				$item['photoJson'] = array();
			}
		} else {
			$v['pageTitle'] = '廣告喜歡建立';
			$item = new AdComment;
		}

		$vueData['item'] = $item;

		$option = null;
		$option['is'] = type('is');
		$option['role'] = type('AdComment.role');

		$vueData['option'] = $option;

		return vAdmin($this, 'item');
	}

}

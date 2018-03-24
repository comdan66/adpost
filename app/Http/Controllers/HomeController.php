<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Models\User;
use App\Models\Slider;
use App\Models\Ad;
use App\Models\Setting;

use Mail;

class HomeController extends _Controller {

	public function index() {
		$v = &$this -> vueData;

		$video = request('video');
		$photo = request('photo');

		if (empty($video)) {
			$video = 'new';
		}
		if (empty($photo)) {
			$photo = 'new';
		}

		$videoItems = Ad::where('postTypeID', '=', 1) -> where('isActive', '=', 1) -> where('isApprove', '=', 1);
		$photoItems = Ad::where('postTypeID', '=', 2) -> where('isActive', '=', 1) -> where('isApprove', '=', 1);

		switch($video) {
			case 'views' :
				$videoItems -> orderby('countViews', 'desc');
				break;
			case 'popular' :
				$videoItems -> orderby('countPopular', 'desc');
				break;
			default :
				$videoItems -> orderby('created_at', 'desc');
				break;
		}

		switch($video) {
			case 'views' :
				$photoItems -> orderby('countViews', 'desc');
				break;
			case 'popular' :
				$photoItems -> orderby('countPopular', 'desc');
				break;
			default :
				$photoItems -> orderby('created_at', 'desc');
				break;
		}

		// $videoItems = Ad::where('postTypeID', '=', 1) -> take(10) -> get();
		// $photoItems = Ad::where('postTypeID', '=', 2) -> take(10) -> get();
		$videoItems = $videoItems -> take(8) -> get();
		$photoItems = $photoItems -> take(8) -> get();

		$n = 0;
		foreach ($videoItems as $x) {
			$x['className'] = '';
			if ($n == 0) {
				$x['className'] = 'aa';
			}
			$n++;
			if ($n >= 4) {
				$n = 0;
			}
		}

		$n = 0;
		foreach ($photoItems as $x) {
			$x['className'] = '';
			if ($n == 0) {
				$x['className'] = 'aa';
			}
			$n++;
			if ($n >= 4) {
				$n = 0;
			}
		}

		$v['videoItems'] = $videoItems;
		$v['photoItems'] = $photoItems;

		//
		$v['videoItems_new'] = Ad::where('postTypeID', '=', 1) -> where('isActive', '=', 1) -> where('isApprove', '=', 1) -> orderby('created_at', 'desc') -> take(8) -> get();
		$v['photoItems_new'] = Ad::where('postTypeID', '=', 2) -> where('isActive', '=', 1) -> where('isApprove', '=', 1) -> orderby('created_at', 'desc') -> take(8) -> get();

		$v['videoItems_views'] = Ad::where('postTypeID', '=', 1) -> where('isActive', '=', 1) -> where('isApprove', '=', 1) -> orderby('countViews', 'desc') -> take(8) -> get();
		$v['photoItems_views'] = Ad::where('postTypeID', '=', 2) -> where('isActive', '=', 1) -> where('isApprove', '=', 1) -> orderby('countViews', 'desc') -> take(8) -> get();

		$v['videoItems_popular'] = Ad::where('postTypeID', '=', 1) -> where('isActive', '=', 1) -> where('isApprove', '=', 1) -> orderby('countPopular', 'desc') -> take(8) -> get();
		$v['photoItems_popular'] = Ad::where('postTypeID', '=', 2) -> where('isActive', '=', 1) -> where('isApprove', '=', 1) -> orderby('countPopular', 'desc') -> take(8) -> get();

		$this -> processItems($v['videoItems_new']);
		$this -> processItems($v['photoItems_new']);
		$this -> processItems($v['videoItems_views']);
		$this -> processItems($v['photoItems_views']);
		$this -> processItems($v['videoItems_popular']);
		$this -> processItems($v['photoItems_popular']);

		$v['video'] = $video;
		$v['photo'] = $photo;

		$item = Setting::where('keyID', '=', 'index') -> first();
		$v['json'] = jsonDecode($item['content']);

		return v($this);
	}

	public function processItems(&$items) {
		$n = 0;
		foreach ($items as $x) {
			$x['className'] = '';
			if ($n == 0) {
				$x['className'] = 'aa';
			}
			$n++;
			if ($n >= 4) {
				$n = 0;
			}
		}

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

		$result = Ad::orderby($orderField, $orderType);

		// addWhere($result, 'id');
		// addWhere($result, 'name', 'like');
		// addWhere($result, 'url', 'like');
		// addWhere($result, 'youtubeID', 'like');
		//
		// addWhere($result, 'postTypeID');
		// addWhere($result, 'typeID');
		//
		//
		// if (count($search['typeIDs']) > 0) {
		// $result = $result -> whereIn('typeID', $search['typeIDs']);
		// }

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

}

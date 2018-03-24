<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

// use App\Models\User;
use App\Models\Ad;
use App\Models\AdComment;
use App\Models\AdLike;
use App\Models\User;

class AdvertisementController extends _Controller {

	public function recalculateCountPupular($id) {

		$item = Ad::find($id);
		if ($item) {
			$count = AdLike::where('adID', '=', $id) -> where('isLike', '=', 1) -> count();
			$item['countPopular'] = $count;
			$item -> save();

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

		$pageSize = 12;

		$page = intval($page);

		$skip = ($page - 1) * $pageSize;

		if (empty($orderField)) {
			$orderField = 'id';
		}
		if (empty($orderType)) {
			$orderType = 'ASC';
		}

		$result = Ad::orderby($orderField, $orderType);

		addWhere($result, 'id');
		addWhere($result, 'name', 'like');
		addWhere($result, 'url', 'like');
		addWhere($result, 'youtubeID', 'like');

		// addWhere($result, 'phone', 'like');
		addWhere($result, 'postTypeID');
		addWhere($result, 'typeID');

		// addWhere($result, 'isAd');

		// addWhere($result, 'priceFrom', '>=', 'price');
		// addWhere($result, 'priceTo', '<=', 'price');

		if (count($search['typeIDs']) > 0) {
			$result = $result -> whereIn('typeID', $search['typeIDs']);
		}

		$result = $result -> where('isActive', '=', 1) -> where('isApprove', '=', 1);

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

	public function item($id = null) {

		$v = &$this -> vueData;
		$this -> vueData['fbAppID'] = config('facebook.app_id');

		$item = Ad::find($id);

		if ($item && $item['isActive'] == 1 && $item['isApprove'] == 1) {

			$this -> metaDescription = $item['brief'];

			if ($item['postTypeID'] == 1) {
				$this -> metaImage = 'https://img.youtube.com/vi/' . $item['youtubeID'] . '/0.jpg';
			} else {
				$this -> metaImage = '/storage/photo/' . $item['photo'];
			}

			$this -> metaTitle = 'AD-POST - ' . $item['name'];

			$item['countViews'] = $item['countViews'] + 1;
			$item -> save();

			// $item['dateJson'] = jsonDecode($item['dateJson']);

			//find related
			$related = Ad::where('typeID', '=', $item['typeID']) -> where('postTypeID', '=', $item['postTypeID']) -> take(4) -> get();

			$v['option'] = getOption();
			$v['related'] = $related;
			$v['item'] = $item;

			$v['countViews'] = $item['counViews'];
			$v['countLove'] = AdLike::where('adID', '=', $item['id']) -> where('isLike', '=', 1) -> count();
			$v['countComment'] = AdComment::where('adID', '=', $item['id']) -> count();

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

			//find comment
			$comments = AdComment::where('adID', '=', $item['id']) -> get();

			$temp = array();

			foreach ($comments as $x) {
				//find user
				$userTemp = User::find($x['userID']);
				if ($userTemp) {
					$x['userPhoto'] = $userTemp['photo'];
					$x['userName'] = $userTemp['name'];
					$temp[] = $x;
				} else {
					// unset($comments[$k]);
				}
			}

			// $v['comments'] = $comments;
			$v['comments'] = $temp;

			$v['isLike'] = false;

			if (isLogin()) {
				$userID = getSession('userID');
				$item = AdLike::where('userID', '=', $userID) -> where('adID', '=', $item['id']) -> first();
				if ($item && $item['isLike'] == 1) {
					$v['isLike'] = true;

				}

			}

			return v($this);

		} else {

			return redirect('/');

		}

	}

	public function commentDo() {

		$result = false;

		$request = getInputJson();

		$adID = request('adID');
		// $isLike = request('isLike');
		$content = request('content');

		$userID = getSession('userID');

		if ($userID) {

			$item = new AdComment;
			$item['userID'] = $userID;
			$item['adID'] = $adID;
			$item['content'] = $content;

			$result = $item -> save();

			//recalculate comment
			$count = AdComment::where('adID', '=', $adID) -> count();

			$ad = Ad::find($adID);
			$ad['countComment'] = $count;
			$ad -> save();

		}
		//
		// $items = Ad::get();
		// foreach ($items as $x) {
		// $count = AdComment::where('adID', '=', $x['id']) -> count();
		//
		// $x['countComment'] = $count;
		// $x -> save();
		//
		// }

		returnJson($result);

	}

	public function likeDo() {

		$result = false;

		$adID = request('adID');
		$isLike = request('isLike');

		if (isLogin()) {

			$userID = getSession('userID');
			$item = AdLike::where('userID', '=', $userID) -> where('adID', '=', $adID) -> first();

			if (!$item) {

				$item = new AdLike;

			}

			$item['userID'] = $userID;
			$item['adID'] = $adID;
			$item['isLike'] = $isLike;
			$result = $item -> save();

			if ($result) {
				$this -> recalculateCountPupular($adID);
			}

		}

		returnJson($result);
	}

	public function listing($page = 1) {

		//current time
		$now = date('Y-m-d H:i:s');

		$itemPerPage = 27;
		$page = intval($page);
		$skip = ($page - 1) * $itemPerPage;
		$count = 123;
		$totalPage = 123;

		$typeID = request('typeID');

		// $items = null;

		if ($typeID) {
			// $items = Ad::where('typeID', '=', $typeID) -> get();

		} else {
			// $items = Ad::get();

		}

		// $this -> viewData['title'] = $title;

		// $this -> viewData['count'] = $count;

		// $this -> vueData['count'] = $count;
		// $this -> vueData['page'] = $page;
		// $this -> vueData['totalPage'] = $totalPage;

		// $this -> vueData['items'] = $items;

		$this -> vueData['option'] = getOption();
		// $this -> vueData['blockID'] = $blockID;
		// $this -> vueData['blockUrl'] = '/' . $blockUrl;
		// $this -> vueData['types'] = $types;

		return v($this);
	}

}

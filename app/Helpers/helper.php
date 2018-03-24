<?php

use Illuminate\Support\Facades\Storage;

use App\Models\Store;
use App\Models\Product;
use App\Models\Option;
use App\Models\Setting;

function filterHtml($v) {
	return trim(strip_tags($v));
}

function getSettingJson($keyID) {

	$json = null;

	$setting = Setting::where('keyID', '=', $keyID) -> first();

	if ($setting) {
		$json = jsonDecode($setting['content']);

	}

	return $json;
}

function stripTags($x, $length = 200) {
	$x = strip_tags($x);
	if (mb_strlen($x, 'utf-8') > $length) {
		$x = mb_substr($x, 0, $length, 'utf-8') . '...';
	} else {
		$x = mb_substr($x, 0, $length, 'utf-8');
	}
	return $x;
}

function getInputJson() {
	$requestBody = file_get_contents('php://input');
	$request = jsonDecode($requestBody);
	return $request;
}

function isEmail($v) {
	if (!filter_var($v, FILTER_VALIDATE_EMAIL)) {
		return false;
	} else {
		return true;
	}
}

function toPage($x) {
	header('location: ' . $x);
	exit ;

}

function _md5($x) {
	return md5('tpsaa' . $x . 'tpsaa');
}

function randString($length = 20) {
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	mt_srand((double)microtime() * 1000000 * getmypid());
	$password = '';
	while (strlen($password) < $length) {
		$password .= substr($chars, (mt_rand() % strlen($chars)), 1);
	}
	return $password;
}

function getOption() {

	$a = null;

	$a['is'] = type('is');
	$a['receiptType'] = type('receipt.type');
	$a['nameTitleType'] = type('nameTitle.type');
	$a['priceType'] = type('price.type');
	$a['gender'] = type('gender');
	$a['city'] = type('city');
	$a['advertisementType'] = type('advertisement.type');
	$a['adType'] = type('advertisement.type');
	$a['advertisementPost'] = type('advertisement.post');
	$a['adPost'] = type('advertisement.post');
	$a['userInterest'] = type('userInterest');
	$a['userRole'] = type('user.role');

	return $a;
}

function type($key) {
	$a = null;
	switch($key) {

		case 'city' :
			$type = config('type');
			$a = $type['city'];

			break;

		case 'settingType' :
			$a[1] = '文字';
			$a[2] = '圖片';

			break;
		case 'userInterest' :
			$a[1] = '時尚流行';
			$a[2] = '資訊科技';
			$a[3] = '休閒旅遊';
			$a[4] = '體育運動';
			$a[5] = '風味美食';

			break;

		case 'advertisement.post' :
			$a[1] = '影片';
			$a[2] = '圖片';
			break;

		case 'advertisement.type' :
			$a = Option::where('groupID', '=', 'postType') -> pluck('name', 'id');

			// $a[1] = '汽車';
			// $a[2] = '影視';
			// $a[3] = '酒類';
			// $a[4] = '3C';
			// $a[5] = '家電';
			// $a[6] = '精品';
			// $a[7] = '運動';
			// $a[8] = '旅遊';
			// $a[9] = '房產';
			// $a[10] = '藥品';
			// $a[11] = '其它';
			break;

		case 'application.type' :
			$a[1] = '課程恩請';
			$a[2] = '求才刊登';
			$a[3] = '合作提案';
			break;
		case 'receipt.type' :
			$a[1] = '二聯式電子發票';
			$a[2] = '二聯式捐贈發票';
			$a[3] = '三聯式紙本發票(公司行號報帳用)';
			break;
		case 'nameTitle.type' :
			$a[1] = '先生';
			$a[2] = '小姐';
			break;

		case 'price.type' :
			$a[1] = '網路價';
			$a[2] = '會員價';
			break;

		case 'store' :
			$items = Store::select('id', 'name') -> get();
			foreach ($items as $x) {
				$a[$x['id']] = $x['name'];
			}
			break;
		case 'product' :
			$items = Product::select('id', 'name') -> get();
			foreach ($items as $x) {
				$a[$x['id']] = $x['name'];
			}
			break;

		case 'country' :
		case 'city' :
		case 'building' :
		case 'brand' :
		case 'category' :
			$items = Option::select('id', 'name') -> where('group', '=', $key) -> get();
			foreach ($items as $x) {
				$a[$x['id']] = $x['name'];
			}
			break;

		case 'gender' :
			$a[1] = '男';
			$a[2] = '女';
			break;
		case 'is' :
			$a[0] = 'No';
			$a[1] = 'Yes';
			break;

		case 'user.role' :
			$a[1] = '一般會員';
			$a[2] = '廣告會員';

			break;
	}

	return $a;
}

function setSession($key, $value) {

	session() -> put($key, $value);
	session() -> save();

}

function saveFile($file, $fileName, $path = null) {

	// Storage::disk('public') -> put('/photo/' . $fileName, file_get_contents($file['tmp_name']));
	Storage::disk('public') -> put('/photo/' . $fileName, file_get_contents($file));

}

function getSession($key, $defaultValue = null) {

	return session() -> get($key, $defaultValue);

}

function ls($x) {
	print '<pre>';
	print_r($x);
	print '</pre>';
}

function setModelData(&$item, $data, $ignoreKeys = null) {
	$ignoreKeys[] = 'id';
	$ignoreKeys[] = 'files';
	foreach ($data as $key => $v) {
		if (!in_array($key, $ignoreKeys)) {
			if (is_array($v)) {
				$item[$key] = jsonEncode($v);
			} else {
				$item[$key] = $v;
			}
		}
	}
}

function jsonEncode($x) {
	return json_encode($x, JSON_UNESCAPED_UNICODE);
}

function jsonDecode($x) {
	if (is_array($x)) {
		return $x;
	} else {

		if (empty($x)) {
			return array();
		} else {

			return json_decode($x, true);
		}
	}
}

function setListSearch($value) {
	$GLOBALS['listSearch'] = $value;
}

function printJson($variableName, $variable, $isReturn = false) {

	if ($isReturn) {
		return '<script>var ' . $variableName . ' = ' . jsonEncode($variable) . ';</script>';
	} else {
		print '<script>var ' . $variableName . ' = ' . jsonEncode($variable) . ';</script>';
	}

}

function returnJson($x) {
	header('Content-Type: application/javascript');
	print json_encode($x);
	exit ;

}

function addWhere(&$result, $field, $type = '=', $dbField = null, $whereType = null) {

	$search = $GLOBALS['listSearch'];

	if (empty($dbField)) {
		$dbField = $field;
	}

	if (isset($search[$field])) {
		$value = $search[$field];

		// if (!empty($value) || $value == 0 || $value == '0' ) {
		if ($value !== '') {

			switch($type) {

				case 'like' :
					$result = $result -> where($dbField, 'like', '%' . $value . '%');
					break;
				default :
					if ($whereType == 'date') {
						$result = $result -> whereDate($dbField, $type, $value);
					} else {
						$result = $result -> where($dbField, $type, $value);

					}

					break;
			}
		} else {
		}

	}
}

function saveSession() {

	session() -> save();
}

function forgetSession($key) {

	session() -> forget($key);
}

function adminUrl($route) {

	return url('admin/' . $route);
}

function adminHome() {

	return adminUrl('dashboard');
}

function showAlert($text, $toPage) {

	print '
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<script type="">
alert("' . $text . '");
document.location = "' . $toPage . '";
</script>
</body>
</html>
';
	exit ;
}

function printTypeOption($typeName, $isPrintEmptyOption = false) {
	$html = '';
	$array = $this -> getType($typeName);

	if ($isPrintEmptyOption) {
		$html .= '<option value="">----</option>';
	}

	if (is_array($array)) {
		foreach ($array as $k => $v) {
			$html .= '<option value="' . $k . '">' . $v . '</option>';
		}
	}
	return $html;
}

function typeText($typeKey, $v, $defaultText = '--') {

	$text = '';

	$type = type($typeKey);
	if (isset($type[$v])) {
		$text = $type[$v];
	} else {
		$text = $defaultText;
	}
	return $text;

}

function isLogin() {
	$isLogin = getSession('isLogin');
	if ($isLogin == true) {
		return true;
	} else {
		return false;
	}
}

function v($z, $action = null, $controller = null) {

	// $aaa = $z -> viewData;
	$aaa = $z -> vueData;
	$aaa['isLogin'] = $z -> isLogin;
	$aaa['vueData'] = $z -> vueData;
	$aaa['userID'] = $z -> userID;
	$aaa['user'] = $z -> user;

	$aaa['metaTitle'] = $z -> metaTitle;
	$aaa['metaDescription'] = $z -> metaDescription;
	$aaa['metaImage'] = $z -> metaImage;
	$aaa['metaKeywords'] = $z -> metaKeywords;

	$aaa['postType'] = type('advertisement.type');

	if (empty($controller)) {
		$controller = $GLOBALS['controller'];
	}
	if (empty($action)) {
		$action = $GLOBALS['action'];
	}

	// return view('admin/product/item', $aaa);

	return view($controller . '/' . $action, $aaa);

}

function vAdmin($z, $action = null, $controller = null) {

	$aaa = $z -> viewData;
	$aaa['vueData'] = $z -> vueData;
	$aaa['formData'] = $z -> formData;
	$aaa['formData']['baseUrl'] = url('/');

	$aaa['user'] = $z -> user;

	if (empty($controller)) {
		$controller = $GLOBALS['controller'];
	}
	if (empty($action)) {
		$action = $GLOBALS['action'];
	}

	$aaa['controller'] = $controller;
	$aaa['action'] = $action;

	$aaa['permissionCSS'] = $z -> permissionCSS;

	$user = getSession('user');
	$aaa['userName'] = $user['name'];
	$aaa['userID'] = $user['id'];

	// $aaa['pageTitle'] = $z -> moduleName;

	return view('admin/' . $controller . '/' . $action, $aaa);

}

function redirectAdmin($action, $controller = null) {
	if (empty($controller)) {
		$controller = $GLOBALS['controller'];
	}
	return redirect('admin/' . $controller . '/' . $action);

}

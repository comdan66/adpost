<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

//upload file
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;

// use Illuminate\Support\Facades\Route;

class _ControllerAdmin extends _Controller {
	// use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public $controllerArray = array('productt', 'order', 'user', 'admin');

	public $pageTitle = 'Admin Management';
	public $permissionCSS = '';

	public $isBusiness = true;
	public $user = null;
	public $userID = null;
	public $saveFilePath = null;

	public function uploadFileDo() {
		$data = array();
		if (count($_FILES) > 0) {
			$error = false;
			$files = array();

			foreach ($_FILES as $file) {
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$name = md5(time() . rand(0, 9999));
				$fileName = $name . '.' . $ext;

				// $image = $request -> file('image');
				$image = $file['tmp_name'];
				// $s3 = \Storage::disk('s3');

				// $filePath = '/support-tickets/' . $imageFileName;
				// $filePath = '/u/' . $fileName;
				// $s3 -> put($filePath, file_get_contents($image), 'public');

				// saveFile($file, $fileName, $this -> saveFilePath);
				saveFile($file, $fileName);

				$fileArray = null;
				$fileArray['name'] = $name;
				$fileArray['fileName'] = $fileName;
				$fileArray['ext'] = $ext;
				$files[] = $fileArray;
			}

			$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
		} else {
			$data = array('success' => 'Form was submitted', 'formData' => $_POST);
		}
		returnJson($data);
	}

	//bitty
	public function callAction($method, $parameters) {
		$this -> beforeAction();
		return call_user_func_array(array($this, $method), $parameters);
	}

	public function beforeAction() {

		$isAdminLogin = getSession('isAdminLogin');
		if ($isAdminLogin == true) {
		} else {
			die('<a href="' . url('adminLogin') . '">請重新登入</a>');
		}

		$this -> user = getSession('user');

		if ($this -> user['roleID'] == 1 || $this -> user['roleID'] == 2) {
			$this -> isBusiness = false;
		}

		$this -> userID = $this -> user['id'];

		$user = getSession('user');

		$this -> getPermissionCSS();

	}

	public function getPermissionCSS() {
		// return;

		//css generate
		$permissionCss = '';
		// $permissionCss .= '<style>';

		$user = getSession('user');

		$controllerName = $GLOBALS['controller'];
		$actionName = $GLOBALS['action'];

		if ($user['roleID'] != 1) {
			// if (true) {

			$controllerArray = $this -> controllerArray;

			$permission = json_decode($user['permissionJson'], true);

			foreach ($controllerArray as $x) {
				$controller = $x;

				$permissionType = 'create';
				if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] != 1) {
					$permissionCss .= '*[' . $controller . ucfirst($permissionType) . ']' . ' { display:none !important; } ';
					if ($controller == $controllerName) {
						$permissionCss .= '*[' . $permissionType . ']' . ' { display:none !important; } ';
					}
				}

				$permissionType = 'read';
				if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] != 1) {
					$permissionCss .= '*[' . $controller . ucfirst($permissionType) . ']' . ' { display:none !important; } ';
					if ($controller == $controllerName) {
						$permissionCss .= '*[' . $permissionType . ']' . ' { display:none !important; } ';
					}
				}

				$permissionType = 'update';
				if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] != 1) {
					$permissionCss .= '*[' . $controller . ucfirst($permissionType) . ']' . ' { display:none !important; } ';
					if ($controller == $controllerName) {
						$permissionCss .= '*[' . $permissionType . ']' . ' { display:none !important; } ';
					}
				}

				$permissionType = 'delete';
				if (!isset($permission[$controller][$permissionType]) || $permission[$controller][$permissionType] != 1) {
					$permissionCss .= '*[' . $controller . ucfirst($permissionType) . ']' . ' { display:none !important; } ';
					if ($controller == $controllerName) {
						$permissionCss .= '*[' . $permissionType . ']' . ' { display:none !important; } ';
					}
				}

			}
		}

		$this -> permissionCSS = $permissionCss;

	}

	public function setUserPermission($roleID) {
		$text = '';
		$data = null;

		$actionType = array('create', 'read', 'update', 'delete');
		//init permission
		foreach ($this->controllerArray as $x) {

			$a = null;
			foreach ($actionType as $xx) {
				$a[$xx] = 0;
			}

			$data[$x] = $a;
		}

		switch($roleID) {

			case 3 :
				//allow
				$allowController = 'product';
				$data[$allowController]['create'] = 1;
				$data[$allowController]['read'] = 1;
				$data[$allowController]['update'] = 1;
				$data[$allowController]['delete'] = 1;

				$allowController = 'order';
				$data[$allowController]['create'] = 1;
				$data[$allowController]['read'] = 1;
				$data[$allowController]['update'] = 1;
				$data[$allowController]['delete'] = 1;

				break;
		}

		$text = json_encode($data);

		return $text;
	}

}

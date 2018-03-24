<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Route;

class _Controller extends BaseController {
	
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	public $vueData = null;
	public $viewData = null;
	public $formData = null;
	// public $optionData = null;

	public $controller;
	public $action;

	public $title = 'AD POST';
	public $isLogin = false;
	public $user = null;
	public $userID = null;
	
	public $metaTitle = 'AD POST';
	public $metaDescription = '';
	public $metaImage = '';
	public $metaKeywords = '';

	//bitty
	public function callAction($method, $parameters) {
		$this -> beforeAction();
		return call_user_func_array(array($this, $method), $parameters);
	}

	//控制memberCenter是否登入，以及redirect去哪
	public function beforeAction() {

		// parent::beforeAction();
		$this -> isLogin = getSession('isLogin');
		if ($this -> isLogin) {
			$this -> user = getSession('user');
			$this -> userID = getSession('userID');
		}
		

	}

	public function __construct() {

		$this -> viewData['title'] = $this -> title;
		$this -> viewData['adminUrl'] = '/admin';
		$this -> viewData['baseUrl'] = '/';
		$this -> viewData['pageTitle'] = 'Management';

		// $this -> viewData['routeName'] = Route::getFacadeRoot() -> current() -> uri();
		// $this -> viewData['routeName'] = Route::currentRouteName();
		// $this -> viewData['routeName'] = Route::getCurrentRoute() -> getPath();
		// $this -> viewData['routeName'] = Route::getCurrentRoute() -> getActionName();

		//----------------------------------------
		$request = request();
		$action = $request -> route() -> getAction();
		$controller = class_basename($action['controller']);
		list($controller, $action) = explode('@', $controller);
		// $controller = strtolower($controller);
		$controller = lcfirst($controller);
		$controller = str_replace('Controller', '', $controller);

		$this -> controller = $controller;
		$this -> action = $action;
		$GLOBALS['controller'] = $controller;
		$GLOBALS['action'] = $action;

		//----------------------------------------

		$this -> viewData['formData'] = $this -> formData;

		//get controllerPath;
		$uri = Route::getFacadeRoot() -> current() -> uri();
		$xx = explode('/', $uri);

		unset($xx[count($xx) - 1]);

		$u = '/' . implode('/', $xx);

		$this -> viewData['u'] = $u;

		$currentPath = Route::getFacadeRoot() -> current() -> uri();

	}

}

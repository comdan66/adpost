<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;

class AdminLoginController extends _Controller {

	public function logoutDo() {

		forgetSession('adminID');
		forgetSession('admin');
		forgetSession('isAdminLogin');
		forgetSession('isBusiness');

		return redirect('adminLogin');

		//showAlert('登入失敗, 帳號或密碼錯誤', url('/adminLogin'));

	}

	public function index() {
		$v = &$this -> viewData;

		$v['pageTitle'] = 'Admin Login';

		return view('adminLogin', $this -> viewData);
	}

	public function loginDo() {

		$v = &$this -> viewData;

		$email = request('email', null);
		$password = request('password', null);

		// print $email;
		// print $password;

		$where = null;

		$where[] = array('email', '=', $email);
		// $where[] = array('roleID', '!=', 4);

		$item = Admin::where($where) -> first();

		if ($item && $item['password'] == $password) {

			setSession('userID', $item['id']);
			setSession('user', $item);
			setSession('isAdminLogin', true);
			setSession('userRoleID', $item['roleID']);
			setSession('userName', $item['name']);

			return redirect('admin/advertisement/listing');

		} else {
			forgetSession('adminID');
			forgetSession('admin');
			forgetSession('isAdminLogin');

			showAlert('登入失敗, 帳號或密碼錯誤', url('/adminLogin'));

		}

		return redirect('adminLogin');

	}

}

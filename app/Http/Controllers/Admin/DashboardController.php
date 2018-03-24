<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\_ControllerAdmin;

class DashboardController extends _ControllerAdmin {

	public function index() {

		return redirect('/admin/event/listing');

		$v = &$this -> viewData;
		$formData = &$this -> formData;

		$v['pageTitle'] = 'Dashboard';

		return vAdmin($this);
	}

}

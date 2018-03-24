<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\_Controller;

class _HelperController extends _Controller {

	public function uploadFile(Request $request) {

		$fileOriginName = $request -> file('file') -> getClientOriginalName();
		$ext = pathinfo($fileOriginName, PATHINFO_EXTENSION);

		$fileName = md5(uniqid(rand(), true)) . '.' . $ext;
		// $path = Storage::disk('s3')->putFile('/user/'. , $request->file('file'), 'public');

		// $path = Storage::disk('s3') -> put('/u/' . $fileName, file_get_contents($request -> file('file') -> getRealPath()), 'public');

		$file = $request -> file('file');

		saveFile($file -> getRealPath(), $fileName);

		$data = array('fileName' => $fileName);

		// return response() -> json($data);
		returnJson($data);
	}

	public function uploadFiles(Request $request) {

		$data = array();

		$files = $request -> file('files');

		foreach ($files as $file) {

			$fileOriginName = $file -> getClientOriginalName();
			$ext = pathinfo($fileOriginName, PATHINFO_EXTENSION);

			$fileName = md5(uniqid(rand(), true)) . '.' . $ext;

			// $path = Storage::disk('s3')->putFile('/user/'. , $request->file('file'), 'public');
			// $path = Storage::disk('s3') -> put('/u/' . $fileName, file_get_contents($file -> getRealPath()), 'public');

			saveFile($file -> getRealPath(), $fileName);

			$data[] = array('fileName' => $fileName);

		}

		returnJson($data);
		// return response() -> json($data);
	}

}

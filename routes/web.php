<?php

/*
 |--------------------------------------------------------------------------
 | Web Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register web routes for your application. These
 | routes are loaded by the RouteServiceProvider within a group which
 | contains the "web" middleware group. Now create something great!
 |
 */
 
 

function setRoute($controller, $get, $post) {
	foreach ($get as $x) {
		Route::get($x, $controller . '@' . $x);
	}
	foreach ($post as $x) {
		Route::post($x, $controller . '@' . $x);
	}
}

//backend---------------------------------------------------------------------------

Route::prefix('adminLogin') -> group(function() {

	Route::get('/logoutDo', 'AdminLoginController@logoutDo');
	Route::get('/', 'AdminLoginController@index');
	Route::post('/loginDo', 'AdminLoginController@loginDo');

});

Route::prefix('admin') -> namespace('Admin') -> group(function() {

	//helper
	Route::post('/_helper/uploadFile', '_HelperController@uploadFile');
	Route::post('/_helper/uploadFiles', '_HelperController@uploadFiles');

	Route::prefix('admin') -> group(function() {
		$controller = 'AdminController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});

	Route::prefix('adLike') -> group(function() {
		$controller = 'AdLikeController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});

	Route::prefix('slider') -> group(function() {
		$controller = 'SliderController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});

	Route::prefix('adComment') -> group(function() {
		$controller = 'AdCommentController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});
	Route::prefix('event') -> group(function() {
		$controller = 'EventController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});
	Route::prefix('news') -> group(function() {
		$controller = 'NewsController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});

	Route::prefix('user') -> group(function() {
		$controller = 'UserController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});

	Route::prefix('contact') -> group(function() {
		$controller = 'ContactController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});
	Route::prefix('advertisement') -> group(function() {
		$controller = 'AdvertisementController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});

	Route::prefix('post') -> group(function() {
		$controller = 'AdvertisementController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});

	Route::prefix('inbox') -> group(function() {
		$controller = 'InboxController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});

	Route::prefix('setting') -> group(function() {
		$controller = 'SettingController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});

	Route::prefix('postType') -> group(function() {
		$controller = 'PostTypeController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});

	Route::prefix('message') -> group(function() {
		$controller = 'MessageController';
		$get = array('listing', 'update', );
		$post = array('updateDo', 'getList', 'deleteDo', );
		setRoute($controller, $get, $post);
	});

});

//frontend---------------------------------------------------------------------------
Route::get('/', 'HomeController@index');
Route::post('/home/getList', 'HomeController@getList');

//facebook
Route::post('/facebook/loginReturn', 'FacebookController@loginReturn');

Route::get('/login', 'LoginController@index');
Route::get('/login/forgot', 'LoginController@forgot');
Route::get('/login/normal', 'LoginController@normal');
Route::get('/login/ad', 'LoginController@ad');
Route::get('/login/logoutDo', 'LoginController@logoutDo');
Route::post('/login/loginDo', 'LoginController@loginDo');

//forgot
Route::get('/login/forgot', 'LoginController@forgot');
Route::get('/login/forgotReset', 'LoginController@forgotReset');
Route::post('/login/forgotDo', 'LoginController@forgotDo');
Route::post('/login/forgotResetDo', 'LoginController@forgotResetDo');

//register
Route::get('/register', 'RegisterController@index');
Route::get('/register/normal', 'RegisterController@normal');
Route::get('/register/ad', 'RegisterController@ad');
Route::post('/register/registerDo', 'RegisterController@registerDo');
Route::get('/register/verifyEmailDo', 'RegisterController@verifyEmailDo');

//page
Route::get('/about', 'PageController@about');
Route::get('/service', 'PageController@service');
Route::get('/description', 'PageController@description');
Route::get('/privacy', 'PageController@privacy');
Route::get('/propossal', 'PageController@propossal');
Route::get('/rule', 'PageController@rule');
Route::get('/contact', 'PageController@contact');
Route::post('/contactDo', 'PageController@contactDo');

// Route::post('/advertisement/commentDo', 'AdvertisementController@commentDo');
// Route::post('/advertisement/likeDo', 'AdvertisementController@likeDo');
// Route::post('/advertisement/getList', 'AdvertisementController@getList');
// Route::get('/advertisement/listing', 'AdvertisementController@listing');
// Route::get('/advertisement/item/{id}', 'AdvertisementController@item');

Route::post('/post/commentDo', 'AdvertisementController@commentDo');
Route::post('/post/likeDo', 'AdvertisementController@likeDo');
Route::post('/post/getList', 'AdvertisementController@getList');
Route::get('/post/listing', 'AdvertisementController@listing');
Route::get('/post/item/{id}', 'AdvertisementController@item');

Route::get('/member/adUpdate', 'MemberController@adUpdate');
Route::post('/member/adUpdateDo', 'MemberController@adUpdateDo');
Route::get('/member/dashboard', 'MemberController@dashboard');
Route::get('/member/adCreate', 'MemberController@adCreate');
Route::get('/member/profile', 'MemberController@profile');
Route::get('/member/profileUpdate', 'MemberController@profileUpdate');
Route::post('/member/profileUpdateDo', 'MemberController@profileUpdateDo');
Route::post('/member/setPreviewDo', 'MemberController@setPreviewDo');
Route::get('/member/preview', 'MemberController@preview');
Route::get('/member/inbox', 'MemberController@inbox');

//helper
Route::post('/_helper/uploadFile', '_HelperController@uploadFile');
Route::post('/_helper/uploadFiles', '_HelperController@uploadFiles');

Route::get('/test/test', 'TestController@test');

//404
// Route::any('/{all}', 'PageController@error');
// Route::get('/{any}', 'PageController@error');

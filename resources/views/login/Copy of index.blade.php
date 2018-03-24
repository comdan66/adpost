@extends('_layouts/main')

@section('content')

<!-- facebook -->
{{ printJson('fbAppID', $fbAppID) }}

<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId : fbAppID,
			cookie : true,
			xfbml : true,
			oauth : true,
			version : 'v2.9'
		});

		FB.getLoginStatus(function(r) {
			if (r.status == 'connected') {
				isFbLogin = true;

			} else {
				isFbLogin = false;
			}

		});

	};

	//---------------
	( function(d, s, id) {
			var js,
			    fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {
				return;
			}
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

</script>

<div class="container" id="vue">

	<div class="col-md-4 col-xs-12 text-center" style="float:none;margin:auto">

		<h2>會員登入</h2>

		<button class="btn btn-primary" style="width:100%" v-on:click="fbLoginDo()" v-bind:disabled="isProcessing">
			@{{ fbLoginText }}
		</button>

		<div style="height:40px"></div>

		<h3>或使用TPSAA帳號登入</h3>

		<form class="form-signin">
			<!-- <h2 class="form-signin-heading">Please sign in</h2> -->

			<div class="text-left">
				帳號:
			</div>
			<!-- <label for="inputEmail" class="sr-only">帳號</label> -->
			<input type="email" v-model="email" class="form-control" placeholder="帳號" required autofocus>
			<div style="height:10px"></div>

			<!-- <label for="inputPassword" class="sr-only">Password</label> -->
			<div class="text-left">
				密碼:
			</div>
			<input type="password" v-model="password" class="form-control" placeholder="密碼" required>
			<!-- <div class="checkbox">
			<label>
			<input type="checkbox" value="remember-me"> Remember me
			</label>
			</div>
			-->

			<div style="height:20px"></div>

			<!-- <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button> -->

			<button class="btn btn-red" style="width:100%" type="button" v-on:click="loginDo()" v-bind:disabled="isProcessing">
				@{{ textLogin }}
			</button>

			<div style="height:10px"></div>
			<div class="row">

				<div class="col-xs-6 col-md-6 pull-left text-left">
					<a href="/register">註冊新會員</a>
				</div>
				<div class="col-xs-6 col-md-6 pull-right text-right">
					<a href="/forgot">忘記密碼?</a>
				</div>
			</div>

		</form>

	</div>
</div>

@stop @section('js')

<script>
	var vue = new Vue({
		el : '#vue',
		data : {
			email : '',
			password : '',

			textLogin : 'TPSAA登入',
			fbLoginText : 'facebook 登入',
			isProcessing : false,

		},

		methods : {

			fbLoginDo : function() {
				var self = this;

				this.isProcessing = true;

				FB.login(function(response) {
					// console.log(response);

					if (response.authResponse) {
						self.fbLoginSuccess();
					} else {
					}

				}, {
					scope : 'email',
					auth_type : 'rerequest'
				});

			},
			fbLoginSuccess : function() {

				var url = '/facebook/loginReturn';

				this.$http.post(url, this._data).then(function(r) {

					this.isProcessing = false;

					switch(r.body.responseCode) {

					case 2:

						//success
						location.replace(document.referrer);

						break;
					case 4:
						alert('Facebook登入失敗, 請同意使用email喔');
						break;
					case 1:
					case 3:
					default:

						alert('Facebook登入失敗:(');
						break;
					}

				}).catch(function(r) {
					this.isProcessing = false;

				});

			},
			loginDo : function() {

				if (!this.email || !this.password) {

					alert('請填完所有欄位喔');

				} else {

					this.textLogin = '登入中...';
					this.isProcessing = true;

					var url = '/login/loginDo';

					this.$http.post(url, this._data).then(function(r) {

						this.isProcessing = false;
						var body = r.body;

						switch(body.responseCode) {

						case 1:
							//alert('請填寫正確信箱喔');
							// history.back();
							// location.reload();
							location.replace(document.referrer);
							// document.location = '/';

							break;
						case 2:
							alert('信箱尚未完成驗證喔');
							break;

						case 3:

						case 4:
							alert('登入失敗, 帳號或密碼錯誤');
							break;

						}

						this.textLogin = 'TPSAA登入';

					});
				}

			},
		},
		created : function() {
		}
	});

</script>

@stop
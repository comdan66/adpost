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

		<h2>註 冊 新 會 員</h2>
		<div style="height:40px"></div>

		<form class="form-signin" onsubmit="return false">
			<!-- <h2 class="form-signin-heading">Please sign in</h2> -->

			<div class="text-left">
				暱稱:
			</div>
			<input type="text"   v-model="name" class="form-control" placeholder="暱稱" required autofocus>

			<div style="height:10px"></div>
			<div class="text-left">
				信箱:
			</div>
			<input type="email"  v-model="email" class="form-control" placeholder="信箱" required  >

			<div style="height:10px"></div>
			<div class="text-left">
				密碼:
			</div>
			<input type="password"  v-model="password"  class="form-control" placeholder="密碼" required  >

			<div style="height:10px"></div>
			<div class="text-left">
				再次確認密碼:
			</div>
			<input type="password"  class="form-control"  v-model="password2"  placeholder="再次確認密碼" required  >

			<div class="text-left">
				註冊 TPSAA - 台北市專業秘書暨行政人員協會會員，等同於同意以下 服務條款
			</div>

			<div style="height:20px"></div>

			<!-- <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button> -->

			<button button="button" class="btn btn-red" style="width:100%" v-on:click="registerDo()" v-bind:disabled="isProcessing">
				@{{ textRegister }}
			</button>

			<div style="height:20px"></div>

			<h3> 或使用 facebook 帳號登入 </h3>

			<div style="height:10px"></div>

			<button class="btn btn-primary" style="width:100%;padding:10px 0" v-on:click="fbLoginDo()" type="button">
				facebook 登入
			</button>

			<div class="row">

				<div class="col-md-12 pull-left text-left">
					<a href="/login">已經是會員前往登入</a>
				</div>
			</div>

		</form>

	</div>
</div>

@stop

@section('js')

<script>
	var vue = new Vue({
		el : '#vue',
		data : {
			name : '',
			email : '',
			password : '',
			password2 : '',

			textRegister : '同意並註冊',
			isProcessing : false,

		},

		methods : {

			fbLoginDo : function() {
				var self = this;
				FB.login(function(response) {

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

					switch(r.body.responseCode) {

					case 2:

						//success
						location.replace(document.referrer);

						break;
					case 4:
						alert('Facebook登入失敗, 請同意使用email喔');
						$('#buttonFbLogin').text('Facebook 快速登入');
						$('#buttonFbLogin').attr('disabled', false);
						break;
					case 1:
					case 3:
					default:

						alert('Facebook登入失敗:(');
						$('#buttonFbLogin').text('Facebook 快速登入');
						$('#buttonFbLogin').attr('disabled', false);
						break;
					}

				});

			},

			registerDo : function() {

				if (!this.name || !this.email || !this.password || !this.password2) {

					alert('請填完所有欄位喔');

				} else {

					this.textRegister = '註冊中...';
					this.isProcessing = true;

					var url = '/register/registerDo';

					this.$http.post(url, this._data).then(function(r) {

						this.isProcessing = false;
						var body = r.body;

						switch(body.responseCode) {
						case 1:
							alert('註冊失敗, 信箱格式錯誤');
							break;

						case 2:
							alert('密碼不得空白喔');
							break;

						case 3:
							alert('密碼不一致');
							break;

						case 4:
							alert('註冊完成, 請至信箱收驗證信喔');
							location.href = '/';
							break;

						case 5:
							alert('註冊失敗, 請再試一次..');
							break;

						case 6:
							alert('此信箱已經被註冊過囉');
							break;

						case 7:
						case 8:
							alert('此信箱已經註冊過 但尚未完成信箱驗證, 請至信箱收信完成驗證喔');
							break;

						}

						this.textRegister = '同意並註冊';

					});
				}

			},
		},
		created : function() {
		}
	});

</script>

@stop
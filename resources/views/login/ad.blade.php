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
<!--main-area-->
<section id="main-area" class="inter">

	<div class="login-area bg-gray" id="vue">
		<div class="container">
			<div class="row">

				<div class="col-sm-3"></div>

				<div class="content col-xs-12 col-sm-6">

					<div class="kv inter small">
						<h2>廣告會員登入</h2>
					</div>

					<form class="login com bg-white">
						<!-- <div class="fb-join text-center">
						<a  class="btn-line-grad btn-block" v-on:click="fbLoginDo()"><em>Facebook 登入</em></a>
						</div>
						-->
						<p class="remarks line text-center">
							<span>或用 Email 登入</span>
						</p>

						<div class="form-group">
							<label><span class="highlight">*</span>Email</label>
							<input type="email" class="form-control" id="Email1" placeholder="請輸入..." v-model="email">
						</div>

						<div class="form-group">
							<label><span class="highlight">*</span>密碼</label>
							<input type="password" class="form-control" id="password" placeholder="請輸入..." v-model="password">
						</div>

						<div class="checkbox checkbox-primary">
							<label class="con-check"><span>記住我的帳號</span>
								<input type="checkbox" checked="checked">
								<span class="checkmark"></span> </label>
						</div>

						<a type="submit" class="btn btn-post btn-block" role="button" v-on:click="submitDo()" v-bind:disabled="isProcessing">登入</a>
						<p class="log pull-left">
							<a href="/login/forgot">忘記密碼</a>
						</p>
						<p class="log pull-right">
							<a href="/register/ad">註冊</a>
						</p>
						<div class="clearfix"></div>
					</form>

				</div><!--/content-->

				<div class="col-sm-3"></div>
			</div>
		</div>
	</div>
</section>

@stop

@section('js')

<script>
	var vue = new Vue({
		el : '#vue',
		data : {
			email : '',
			password : '',

			textLogin : 'AD-POST登入',
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
			submitDo : function() {

				if (!this.email || !this.password) {

					alert('請填完所有欄位');

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

							if (body.roleID == 2) {

								document.location = '/member/dashboard';
							} else {
								location.replace(document.referrer);
							}

							// document.location = '/';
							// alert('yada');

							break;
						case 2:
							alert('信箱尚未完成驗證喔');
							break;

						case 3:

						case 4:
							alert('登入失敗, 帳號或密碼錯誤');
							break;

						}

						this.textLogin = 'AD-POST登入';

					});
				}

			},
		},
		created : function() {
		}
	});

</script>

@stop
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
<section id="main-area">

	<div class="login-area bg-gray">
		<div class="container">
			<div class="row">

				<div class="col-sm-3"></div>

				<div class="content col-xs-12 col-sm-6">
					<div class="kv inter small">
						<h2>登入</h2>
					</div>

					<div class="login com bg-white">
						<div class="com text-center">
							<a href="/login/normal" class="btn-line-grad btn-block"><em>一般會員登入</em></a>
						</div>
						<div class="ad text-center">
							<a href="/login/ad" class="btn-line-grad btn-block"><em>廣告會員登入</em></a>
						</div>
						<p class="log pull-right">
							<!-- <a href="#">登入</a> -->
						</p>
					</div>

				</div><!--/row-->

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

			textLogin : '登入',
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

						this.textLogin = '登入';

					});
				}

			},
		},
		created : function() {
		}
	});

</script>

@stop
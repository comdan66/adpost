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

	<div class="login-area bg-gray" id="vue">
		<div class="container">
			<div class="row">

				<div class="col-sm-3"></div>

				<div class="content col-xs-12 col-sm-6">
					<div class="kv inter small">
						<h2>註冊</h2>
					</div>

					<form class="login com bg-white">
						<div class="fb-join text-center">
							<a v-on:click="fbLoginDo()" class="btn-line-grad btn-block"><em>Facebook 註冊</em></a>
						</div>
						<p class="remarks line text-center">
							<span>或用 Email 註冊</span>
						</p>

						<div class="form-group">
							<label><span class="highlight">*</span>Email</label>
							<input type="email" class="form-control" id="Email1" placeholder="請輸入..." v-model="email">
						</div>

						<div class="form-group">
							<label><span class="highlight">*</span>姓名</label>
							<input type="name" class="form-control" id="name" placeholder="請輸入..." v-model="name">
						</div>

						<div class="form-group">
							<label><span class="highlight">*</span>密碼</label>
							<input type="password" class="form-control" id="password" placeholder="請輸入..." v-model="password">
						</div>

						<div class="form-group">
							<label><span class="highlight">*</span>確認密碼</label>
							<input type="password" class="form-control" id="checkpassward" placeholder="請輸入..." v-model="password2">
						</div>

						<div class="form-group">
							<label class="con-check"><span><a style="font-weight:normal" href="/privacy" target="_blank">我已經閱讀並同意隱私權政策</a></span>
								<input type="checkbox"  v-model="isAgree">
								<span class="checkmark"></span> </label>
						</div>

						<a type="submit" class="btn btn-post btn-block" v-on:click="registerDo()" role="button" v-bind:disabled="isProcessing">註冊</a>
						<p class="log pull-right">
							<a href="/login">登入</a>
						</p>
						<div class="clearfix"></div>
					</form>
				</div>

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
			password2 : '',
			name : '',
			textLogin : '',
			fbLoginText : 'facebook 登入',
			isProcessing : false,
			isAgree : false,
			roleID : 1,
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

			registerDo : function() {

				var isValid = true;
				var message = '';

				if (this.email == '') {
					isValid = false;
					message += '請填寫Email\n';
				} else {

					if (!isEmail(this.email)) {
						isValid = false;
						message += '請填寫正確信箱格式\n';
					}

				}

				if (this.name == '') {
					isValid = false;
					message += '請填寫姓名\n';
				}

				if (this.name == '') {
					isValid = false;
					message += '請填寫密碼\n';
				} else {

					if (this.password != this.password2) {
						isValid = false;
						message += '密碼不一致, 請再試一次\n';
					}

				}

				if (this.isAgree == false) {
					isValid = false;
					message += '請同意隱私權政策\n';
				}

				if (isValid) {

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
				} else {

					alert(message);

				}

			},
		},
		created : function() {
		}
	});

</script>

@stop
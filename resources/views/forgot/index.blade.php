@extends('_layouts/main')

@section('content')

<div class="container" id="vue">

	<div class="col-md-4 col-xs-12 text-center" style="float:none;margin:auto">

		<h2>忘記密碼</h2>

		<div style="height:20px"></div>

		<form class="form-signin">
			<!-- <h2 class="form-signin-heading">Please sign in</h2> -->

			<div class="text-left">
				信箱:
			</div>
			<!-- <label for="inputEmail" class="sr-only">帳號</label> -->
			<input type="email" v-model="email" class="form-control" placeholder="信箱" required autofocus>
			<div style="height:10px"></div>

			<div style="height:20px"></div>

			<!-- <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button> -->

			<button class="btn btn-red" style="width:100%" type="button" v-on:click="loginDo()" v-bind:disabled="isProcessing">
				@{{ textSubmit }}
			</button>

			<div style="height:10px"></div>
			<div class="row">

				<div class="col-xs-6 col-md-6 pull-left text-left">
					<a href="/register">註冊新會員</a>
				</div>
				<div class="col-xs-6 col-md-6 pull-right text-right">
					<a href="/login">登入</a>
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

			textSubmit : '發送忘記密碼信件',
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
						break;
					case 1:
					case 3:
					default:

						alert('Facebook登入失敗:(');
						break;
					}

				});

			},
			loginDo : function() {

				if (!this.email) {

					alert('請填寫信箱喔');

				} else {

					this.textSubmit = '信件發送中...';
					this.isProcessing = true;

					var url = '/forgot/forgotDo';

					this.$http.post(url, this._data).then(function(r) {

						this.isProcessing = false;
						var body = r.body;

						switch(body.responseCode) {

						case 1:
							alert('請填寫信箱喔');
							break;

						case 2:
							alert('請填寫正確信箱喔');

							break;

						case 3:
							alert('忘記密碼的申請信件已發送! 請至您的會員信箱收信喔');
							break;

						case 4:
							alert('此信件尚未註冊喔, 請至註冊頁面註冊');
							break;

						}

						this.textSubmit = '發送忘記密碼信件';

					});
				}

			},
		},
		created : function() {
		}
	});

</script>

@stop
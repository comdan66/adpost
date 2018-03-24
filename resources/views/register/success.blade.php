@extends('_layouts/main')

@section('content')

<!--main-area-->
<section id="main-area">

	<div class="login-area bg-gray">
		<div class="container">
			<div class="row">

				<div class="col-sm-2"></div>

				<div class="content col-xs-12 col-sm-8">
					<div class="kv inter small">
						<h2>註冊成功！</h2>
					</div>

					<div class="login bg-white">
						<p class="text-center">
							恭喜您，已成功註冊為廣告會員！
						</p>

						<div class="col-xs-2 col-sm-4"></div>
						<div class="col-xs-8 col-sm-4">
							<a type="submit" class="btn btn-post btn-block" href="#" role="button">上傳我的廣告</a>
						</div>
						<div class="col-xs-2 col-sm-4"></div>

						<div class="clearfix"></div>
					</div>

				</div>

				<div class="col-sm-2"></div>
			</div><!--/row-->
		</div>
	</div>
</section>

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
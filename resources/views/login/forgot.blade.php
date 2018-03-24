@extends('_layouts/main')

@section('content')

<!--main-area-->
<section id="main-area">

	<div class="login-area bg-gray" id="vue">
		<div class="container">
			<div class="row">

				<div class="col-sm-3"></div>

				<div class="content col-xs-12 col-sm-6">
					<div class="kv inter small">
						<h2>重設密碼</h2>
					</div>
					<form class="login com bg-white">
						<p>
							忘記您的密碼了嗎？請輸入您的註冊信箱，我們將會寄送信件給您。請使用信件內的連結，重新設定您的密碼。
						</p>
						<div class="form-group">
							<label><span class="highlight">*</span>Email</label>
							<input type="email" class="form-control" id="Email1" placeholder="請輸入..." v-model="email">
						</div>
						<a  class="btn btn-post btn-block" v-on:click="submitDo()" v-bind:disabled="isProcessing" role="button">送出</a>
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
			textSubmit : '發送忘記密碼信件',
			isProcessing : false,

		},

		methods : {

			submitDo : function() {

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

				if (isValid) {
					this.textSubmit = '信件發送中...';
					this.isProcessing = true;

					var url = '/login/forgotDo';

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
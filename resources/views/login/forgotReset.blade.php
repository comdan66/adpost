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

						<div class="form-group">
							<label><span class="highlight">*</span>密碼</label>
							<input type="password" class="form-control" id="password" placeholder="請輸入..." v-model="password">
						</div>

						<div class="form-group">
							<label><span class="highlight">*</span>再次輸入密碼</label>
							<input type="password" class="form-control" id="password" placeholder="請輸入..." v-model="password2">
						</div>

						<a type="submit" class="btn btn-post btn-block" href="#" role="button" v-on:click="submitDo()" v-bind:disabled="isProcessing"> 重設密碼</a>

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
	vueData.password = '';
	vueData.password2 = '';
	vueData.isProcessing = false;

	var vue = new Vue({
		el : '#vue',
		data : vueData,
		methods : {
			submitDo : function() {

				if (this.password != '' && this.password == this.password2) {

					this.textSubmit = '密碼重設中...';
					this.isProcessing = true;

					var url = '/login/forgotResetDo';

					this.$http.post(url, this._data).then(function(r) {

						this.isProcessing = false;
						var body = r.body;

						switch(body.responseCode) {
						case 1:
							alert('驗證碼過期, 麻煩再使用一次忘記密碼功能喔');
							break;

						case 2:
							alert('新密碼設置完成, 請使用新的密碼登入');

							document.location = '/login';

							break;

						case 3:
							alert('驗證碼過期, 麻煩再使用一次忘記密碼功能喔');
							break;
						case 4:
							alert('請輸入新的密碼喔');
							break;

						}

						this.textSubmit = '重設密碼';

					});

				} else {
					alert('請填寫新的密碼');
				}

			},
		},
		created : function() {
		}
	});

</script>

@stop
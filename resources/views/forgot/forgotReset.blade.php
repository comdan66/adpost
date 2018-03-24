@extends('_layouts/main')

@section('content')

<div class="container" id="vue">

	<div class="col-md-4 col-xs-12 text-center" style="float:none;margin:auto">

		<h2>重設密碼</h2>

		<div style="height:20px"></div>

		<form class="form-signin">
			<!-- <h2 class="form-signin-heading">Please sign in</h2> -->

			<div class="text-left">
				密碼:
			</div>
			<input type="password" v-model="password" class="form-control" placeholder="密碼"  autofocus>
			<div style="height:10px"></div>

			<div class="text-left">
				再次輸入密碼:
			</div>
			<input type="password" v-model="password2" class="form-control" placeholder="再次輸入密碼"  >
			<div style="height:10px"></div>

			<!-- <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button> -->

			<button class="btn btn-red" style="width:100%" type="button" v-on:click="resetDo()" v-bind:disabled="isProcessing">
				@{{ textSubmit }}
			</button>

		</form>

	</div>
</div>

@stop @section('js')

<script>
	vueData.password = '';
	vueData.password2 = '';
	vueData.isProcessing = false;
	vueData.textSubmit = '重設密碼';

	var vue = new Vue({
		el : '#vue',
		data : vueData,

		methods : {

			resetDo : function() {

				if (this.password != '' && this.password == this.password2) {

					this.textSubmit = '密碼重設中...';
					this.isProcessing = true;

					var url = '/forgot/forgotResetDo';

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

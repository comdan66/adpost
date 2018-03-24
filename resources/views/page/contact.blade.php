@extends('_layouts/main')

@section('content')

<style>
	.clear {
		clear: both;
	}
</style>
<!--main-area-->
<section id="main-area">
	<div class="kv inter">
		<h2>聯絡我們</h2>
	</div>

	<div class="contact-us bg-gray">
		<div class="container">
			<div class="row">

				<div class="crop-form col-xs-12 col-sm-6">
					<form role="form" id="vue">
						<!-- <div class="form-group">
						<label><span class="highlight">*</span>提問類型</label>
						<select class="form-control"  v-model="typeID">
						<option value="1">廣告會員相關</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						</select>
						</div>
						-->

						<div class="form-group">
							<label><span class="highlight">*</span>姓名 / 公司名稱</label>
							<input type="name" class="form-control" id="name" placeholder="請輸入..." v-model="name">
						</div>

						<div class="form-group">
							<label><span class="highlight">*</span>聯絡信箱</label>
							<input type="email" class="form-control" id="Email1" placeholder="請輸入..." v-model="email">
						</div>

						<div class="form-group">
							<label>聯絡電話</label>
							<input type="phone" class="form-control" id="phone" placeholder="請輸入..." v-model="phone">
						</div>

						<div class="form-group">
							<label><span class="highlight">*</span>提問訊息</label>
							<textarea class="form-control" style="height:auto" rows="3" placeholder="請輸入..." v-model="content"></textarea>
						</div>

						<div class="upload form-group">
							<div class="row">
								<input  id="qqqq" class="  hidden form-control" style="width:100px;" ref="xxx" type="file"  v-on:change="uploadFile($event, 'file')" />

								<label class="col-xs-12" for="qqqq" v-on:click="clickFileLabel()"> <span class="col-xs-3"><span class="highlight">*</span>上傳附件</span> <!-- <input type="file" style="display: none"> --> <span class="upload-box col-xs-5"><em>瀏覽檔案</em></span> </label>
							</div>
						</div>

						<a class="btn btn-post btn-block" v-on:click="submitDo()" role="button" >送出</a>

					</form>
				</div>

				<div class="crop-info col-xs-12 col-sm-6">
					<div class="info-box">
						<h3>公司資訊</h3>
						<dl>
							<dt class="col-xs-4 col-sm-3">
								公司名稱
							</dt>
							<dd class="col-xs-8 col-sm-9">
								{{ $json['companyName'] }}
							</dd>

							<div class="clear"></div>

							<dt class="col-xs-4 col-sm-3">
								公司地址
							</dt>
							<dd class="col-xs-8 col-sm-9">
								{{ $json['companyAddressText'] }}
							</dd>
							<div class="clear"></div>

							<!-- <dt class="col-xs-4 col-sm-3">
							負責人
							</dt>
							<dd class="col-xs-8 col-sm-9">
							{{ $json['person'] }}
							</dd> -->
							<div class="clear"></div>
							<dt class="col-xs-4 col-sm-3">
								聯絡電話
							</dt>
							<dd class="col-xs-8 col-sm-9">
								{{ $json['phone'] }}
							</dd>
							<div class="clear"></div>
							<dt class="col-xs-4 col-sm-3">
								聯絡信箱
							</dt>
							<dd class="col-xs-8 col-sm-9">
								{{ $json['email'] }}
							</dd>
							<div class="clear"></div>
							<!-- <dt class="col-xs-4 col-sm-3">
							傳　　真
							</dt>
							<dd class="col-xs-8 col-sm-9">
							{{ $json['fax'] }}
							</dd> -->
							<div class="clear"></div>
							<dt class="col-xs-4 col-sm-3">
								營業時間
							</dt>
							<dd class="col-xs-8 col-sm-9">
								{{ $json['businessTime'] }}
							</dd>
						</dl>
						<div class="clearfix"></div>
					</div>

					<div class="map">
						{!! $json['iframe'] !!}
						<!--
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19831.19062196924!2d121.44803791724266!3d25.21994514298435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442ac72bce20a99%3A0x3f6a35cedd0ac2e0!2z6Ie65YyX5biC!5e0!3m2!1szh-TW!2stw!4v1513167425596" width="100%" height="260" frameborder="0" style="border:0" allowfullscreen></iframe> -->
					</div>
				</div>

			</div>
		</div>
	</div><!--/contact-us-->

</section>
@stop

@section('js')

<script>
	var vue = new Vue({
		el : '#vue',
		data : {
			name : '',
			email : '',
			content : '',
			phone : '',
			typeID : 1,
			file : '',

		},

		methods : {
			submitDo : function() {

				var isValid = true;
				var message = '';
				if (this.typeID == '') {
					isValid = false;
					message += '請填寫提問類型\n';
				}

				if (this.name == '') {
					isValid = false;
					message += '請填寫姓名 / 公司名稱\n';
				}

				if (this.email == '') {
					isValid = false;
					message += '請填寫聯絡信箱\n';
				} else {

					if (!isEmail(this.email)) {
						isValid = false;
						message += '請填寫正確信箱格式\n';
					}

				}

				if (this.content == '') {
					isValid = false;
					message += '請填寫提問訊息\n';
				}

				if (this.file == '') {
					isValid = false;
					message += '請上傳附件\n';
				}

				if (isValid) {
					this.$http.post('contactDo', this._data).then(function(r) {

						if (r.body.isSuccess) {
							alert('送出完成');
							location.reload();

						} else {
							alert('送出失敗, 請再試一次');
						}

					});

				} else {
					alert(message);

				}

			},
			clickFileLabel : function() {
				this.$refs.xxx.click();

			},
			uploadFile : function(event, key) {
				var self = this;
				var files = event.target.files;

				console.log(files);

				//single file veriosn
				if (files.length > 0) {
					var file = files[0];
					var reader = new FileReader();
					reader.onload = function() {
						var data = new FormData();
						// data.append('file', event.target.files);
						data.append('file', files[0]);
						self.$http.post('/_helper/uploadFile', data).then(function(r) {
							self[key] = r.body.fileName;
						});

					};
					reader.onerror = function() {
					};
					reader.readAsDataURL(file);

				}
			},
		}
	});

</script>

@stop
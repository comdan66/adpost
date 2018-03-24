@extends('_layouts/main')

@section('content')

<style>
	.viewport:nth-child(4n+1) {
		clear: left;
	}
</style>
<!--main-area-->
<section id="main-area">
	<div class="kv inter">
		<h2>個人資訊</h2>
	</div>

	<div class="ad-plus bg-gray" id="vue" v-cloak>
		<div class="container">
			<div class="row">

				<div class="go-back left">
					<a href="dashboard"><span class="icon-goback"></span>返回廣告列表</a>
				</div>

				<div class="infobox bg-white-line">

					<div class="form-group col-xs-12 col-sm-6">
						<label><span class="highlight">*</span>廣告標題</label>
						<input type="" class="form-control" id="" placeholder="請輸入..." v-model="item.name">
					</div>

					<div class="form-group col-xs-12 col-sm-6">
						<label><span class="highlight">*</span>廣告分類</label>
						<!-- <input type="" class="form-control" id="" placeholder="請輸入..."> -->

						<select class="form-control" v-model="item.typeID">
							<option v-bind:value="i" v-for="(x,i) of option.adType">@{{ x }}</option>
						</select>

					</div>

					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="form-group film-number-l col-sm-6">
								<label>影片數量</label>

								<!-- <input class="form-control" v-model="countYoutube" readonly=""> -->

								<select class="form-control" v-model.number="countYoutube"   v-on:change="changeYoutubeCount()">
									<option value="0">0</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
							<div class="form-group film-number-r col-sm-6">
								<label>圖片數量</label>
								<input class="form-control" v-model="countPhoto" readonly="">
								<!-- <select class="form-control" v-model="countPhoto"  v-on:change="changePhotoCount()" disabled>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								</select> -->
							</div>
						</div>

						<div class="film-number-info col-xs-12 col-sm-6">
							<ul>
								<li>
									您上傳的影片及圖片之總數量不可超過 5。
									<br>
									2 影片 + 3 圖片   ( O )
									<br>
									2 影片 + 4 圖片   ( X )
								</li>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>

					<!--輸入youtube 連結代碼-->
					<div class="col-xs-12 col-sm-6">
						<!-- <p>
						<strong>影片廣告：輸入 youtube 連結代碼</strong>
						</p>
						<p>
						請輸入網址連結代碼，例：<span class="font-blue">FwcADsEAvOM</span>
						<br>
						https://www.youtube.com/watch?v=<span class="font-blue">FwcADsEAvOM</span>
						</p> -->

						請先選擇影片數量，再將YouTube影片網址複製貼在下方輸入網址欄位中(網址會自動轉成代碼)

						<div class="youtube row">

							<div class="form-group col-xs-12 col-sm-6" v-for="n in countYoutube">
								<!-- <input type="" @paste="onYoutubePaste($event, n)" v-model="item.youtubeJson[(n-1)]" class="form-control" id="" placeholder="請輸入代碼"> -->
								<input type="" @paste="onYoutubePaste($event, n)" v-model="item.youtubeJson[(n-1)]" class="form-control" id="" placeholder="請輸入網址">

							</div>

							<!-- <div class="form-group col-xs-12 col-sm-6 text-left" style="padding-top:6px;" v-on:click="addYoutube()">
							<i class="fa fa-plus"></i>
							</div>
							-->

							<!--
							<div class="form-group col-xs-12 col-sm-6">
							<input type="" class="form-control" id="" placeholder="請輸入代碼">
							</div>

							<div class="form-group col-xs-12 col-sm-6">
							<input type="" class="form-control" id="" placeholder="請輸入代碼">
							</div>

							<div class="form-group col-xs-12 col-sm-6">
							<fieldset disabled>
							<input type="" class="form-control" id="" placeholder="請輸入代碼">
							</fieldset>
							</div>

							<div class="form-group col-xs-12 col-sm-6">
							<fieldset disabled>
							<input type="" class="form-control" id="" placeholder="請輸入代碼">
							</fieldset>
							</div>
							<div class="form-group col-xs-12 col-sm-6">
							<fieldset disabled>
							<input type="" class="form-control" id="" placeholder="請輸入代碼">
							</fieldset>
							</div> -->
						</div>
					</div>

					<!-- upload file-->
					<div class="col-xs-12 col-sm-6">
						<p>
							<strong>圖片廣告：上傳圖檔</strong>
						</p>
						<p class="hidden-xs">
							<!-- 格式：.png / .jpg -->
							格式：.png / .jpg  比例::16:9 (非此此吋，圖片將被自動裁切)
							<br>
							<!-- 點擊按鈕上傳檔案，或拖曳圖片至灰色區域。 -->
							點擊按鈕上傳檔案。
						</p>
						<!-- <form action="/upload-target" class="dropzone hidden-xs"></form> -->

						<input   id="qqqq" ref="xxx"  class="hidden form-control" type="file" multiple accept="image/*" v-on:change="uploadFiles($event, 'photoJson')" />

						<label class="hidden-xs" for="qqqq"  > <span class="btn btn-default" style="padding:5px 10px"> 上傳檔案 </span> </label>

						<p class="visible-xs">
							<!-- 格式：.png / .jpg -->
							格式：.png / .jpg  比例::16:9 (非此此吋，圖片將被自動裁切)
							<br>
							點擊按鈕上傳檔案。
						</p>
						<div class="upload form-group visible-xs">
							<div class="row">
								<label class="col-xs-12" for="qqqq" v-on:click="clickFileLabel()">
									<!-- <input type="file" style="display: none"> -->
									<span class="upload-box col-xs-5"><em>瀏覽檔案</em></span></label>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>

					<div class="infobox upload-file bg-white-line">
						<p class="col-xs-12">
							已上傳的檔案
						</p>
						<!-- 第一組X2-->

						<div class="col-xs-12">

							<div class="viewport col-xs-3" v-for="(x,i) of item.photoJson"  style="margin:0;margin-bottom:10px">
								<span class="dark_overlay"></span>
								<figure>
									<img v-bind:src="'/storage/photo/' + x.photo " class="img-responsive">
									<figcaption>
										<p>
											<a v-on:click="removePhotoJson(i)"><span class="glyphicon glyphicon-trash"></span>刪除</a>
										</p>
									</figcaption>
								</figure>
							</div>

							<!--
							<div class="viewport col-xs-3" v-for="">
							<span class="dark_overlay"></span>
							<figure>
							<img src="/images/pic-adlist-01.jpg" class="img-responsive">
							<figcaption>
							<p>
							<a v-on:click="removePhoto(i)"><span class="glyphicon glyphicon-trash"></span>刪除</a>
							</p>
							</figcaption>
							</figure>
							</div>
							-->

						</div>
						<!-- 第一組X3-->

						<div class="clearfix"></div>
					</div><!--/infobox-->

					<div class="col-xs-12">
						<div class="form-group">
							<label>產品簡述 (限20字內，說明文字會出現在廣告列表該廣告下方)</label>
							<input type="" class="form-control" id="" placeholder="請輸入文字" v-model="item.brief">
						</div>

						<div class="form-group">
							<label>產品內容</label>
							<textarea class="form-control" rows="10" placeholder="請輸入文字" v-model="item.content"></textarea>
						</div>
						<div class="form-group">
							<label>網址</label>

							<input type="text"   class="form-control"  v-model="item.url">
						</div>

					</div>
					<!--send-->

					<div class="col-xs-12 col-sm-6 pull-left">

						<div class="form-group">
							<label class="pull-left">上架狀態</label>
							<label class="switch col-xs-2">
								<input type="checkbox"  v-model="item.isActive">
								<span class="slider round"></span> </label>
						</div>

					</div>

					<div class="btu-area col-xs-12 col-sm-6 pull-right">
						<div class="go-back hidden-xs col-sm-4">
							<a href="dashboard">返回列表</a>
						</div>
						<div class="pre col-xs-6 col-sm-4">
							<a v-on:click="previewDo()" class="preview"><em>預覽</em></a>
						</div>
						<div class="send col-xs-6 col-sm-4">
							<!-- <a type="submit" class="btn btn-post"  role="button" v-on:click="submitDo()">確定發佈</a> -->

							<button v-bind:disabled="isProcessing" type="button" v-on:click="submitDo()" class="btn btn-post" role="button">
								確定發佈
							</button>

						</div>
					</div>

					<div class="clearfix"></div>
				</div><!--/infobox-->
				<div class="go-back left visible-xs">
					<a href="dashboard"><span class="icon-goback"></span>返回廣告列表</a>
				</div>
			</div>
		</div>
	</div>
</section>

@stop

@section('js')

<script>
	vueData.countPhoto = 0;
	vueData.countYoutube = 0;
	vueData.isProcessing = false;

	var vue = new Vue({
		el : '#vue',
		data : vueData,
		methods : {

			onYoutubePaste : function(event, n) {

				n = n - 1;

				this.youtubePasteIndex = n;

				setTimeout(this.afterYoutubePaste, 100);

				// this.item.youtubeJson

			},
			afterYoutubePaste : function() {

				// alert(this.youtubePasteIndex);

				var n = this.youtubePasteIndex;
				var url = this.item.youtubeJson[n];

				var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
				var match = url.match(regExp);
				if (match && match[2].length == 11) {

					this.item.youtubeJson[n] = match[2];
					this.item.youtubeJson.push('');
					this.item.youtubeJson.pop();

					// return match[2];
				} else {
					//error
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
							self.item[key] = r.body.fileName;
						});

					};
					reader.onerror = function() {
					};
					reader.readAsDataURL(file);

				}
			},

			removePhotoJson : function(index) {
				this.item.photoJson.splice(index, 1);

				this.countPhoto = this.item.photoJson.length;

			},
			uploadFiles : function(event, key) {
				// var self = this;
				var files = event.target.files;
				if (files.length > 0) {
					var data = new FormData();
					for (var i = 0; i < files.length; i++) {
						data.append('files[]', files[i]);
					}
					// window.alert(key);
					this.$http.post('/_helper/uploadFiles', data).then(function(r) {
						// console.log(r);
						for (var i in r.body) {
							var x = r.body[i];
							var a = {
								photo : x.fileName
							};
							// this.item[key].push(x.fileName);
							this.item[key].push(a);

							this.countPhoto = this.item.photoJson.length;

						}

					});

				}

			},

			previewDo : function() {

				// localStorage.setItem('memberPreview', this.item);

				var isOK = true;
				var message = '';

				if (this.item.name == '') {
					isOK = false;
					message += '請填寫廣告標題\n';
				}

				if (this.item.brief == '') {
					isOK = false;
					message += '請填寫產品簡述\n';
				}

				if (this.item.content == '') {
					isOK = false;
					message += '請填寫產品內容\n';
				}

				if (this.countPhoto + this.countYoutube <= 0) {
					isOK = false;
					message += '請最少設定一個影片或一張圖片\n';
				}

				if (this.countPhoto + this.countYoutube > 5) {

					isOK = false;
					message += '數量超過限制\n';

				}

				if (isOK) {

					var newWindow = window.open('', '_blank');
					var data = this.item;
					this.$http.post('setPreviewDo', data).then(function(r) {
						newWindow.location.href = 'preview';
					});
				} else {
					alert(message);

				}

			},

			addYoutube : function() {

				this.countYoutube++;
				if (this.countYoutube > 5) {
					this.countYoutube = 5;

				}

			},
			changeYoutubeCount : function() {

				for (var i in this.item.youtubeJson) {

					if (i >= this.countYoutube) {
						try {
							this.item.youtubeJson.splice(i, 1);
						} catch(e) {
						}
					}
				}

			},
			submitDo : function() {

				var isOK = true;
				var message = '';

				if (this.item.name == '') {
					isOK = false;
					message += '請填寫廣告標題\n';
				}

				if (this.item.brief == '') {
					isOK = false;
					message += '請填寫產品簡述\n';
				}

				if (this.item.content == '') {
					isOK = false;
					message += '請填寫產品內容\n';
				}

				if (this.countPhoto + this.countYoutube <= 0) {
					isOK = false;
					message += '請最少設定一個影片或一張圖片\n';
				}

				if (this.countPhoto + this.countYoutube > 5) {

					isOK = false;
					message += '數量超過限制\n';

				}

				if (isOK) {

					this.isProcessing = true;

					this.$http.post('adUpdateDo', this._data.item).then(function(r) {
						this.isProcessing = false;

						var body = r.body;

						alert('發佈完成');

						document.location = 'dashboard';

						// document.location = 'dashboard';

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
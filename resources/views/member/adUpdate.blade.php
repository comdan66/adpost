@extends('_layouts/main')

@section('content')

<!--main-area-->
<section id="main-area">
	<div class="kv inter">
		<h2>個人資訊</h2>
	</div>

	<div class="member bg-gray" id="vue" v-cloak>
		<div class="container">
			<div class="row">

				<div class="go-back left">
					<a href="dashboard"><span class="icon-goback"></span>返回廣告列表</a>
				</div>

				<div class="infobox edit bg-white-line">
					<div class="form-group ol-xs-12 col-sm-6">
						<label><span class="highlight">*</span>廣告標題</label>
						<input type="" class="form-control" id="" placeholder="請輸入..." v-model="item.name">
					</div>

					<div class="form-group col-xs-12 col-sm-6">
						<label><span class="highlight">*</span>廣告分類</label>
						<select class="form-control" v-model="item.typeID">

							<option v-bind:value="i" v-for="(x,i) of option.adType">@{{ x }}</option>
						</select>

					</div>

					<div class="form-group">
						<label>產品簡述 (限20字內，說明文字會出現在廣告列表該廣告下方)</label>
						<input type="" class="form-control" id="" placeholder="請輸入文字" v-model="item.brief">
					</div>

					<div class="form-group">
						<label>產品內容</label>
						<textarea class="form-control" rows="3" placeholder="請輸入文字" v-model="item.content"></textarea>
					</div>

					<div class="form-group">
						<label>網址連結 (如官網、FB、購物網站等)</label>
						<input type="" class="form-control" id="" placeholder="請輸入網址" v-model="item.url">
					</div>

					<div class="form-group">
						<label class="pull-left">上架狀態</label>
						<label class="switch col-xs-2">
							<input type="checkbox"  v-model="item.isActive">
							<span class="slider round"></span> </label>
					</div>

					<!--send-->
					<div class="row">
						<div class="btu-area col-xs-12 col-sm-6 pull-right">
							<div class="go-back hidden-xs col-sm-4">
								<a href="dashboard">返回列表</a>
							</div>
							<div class="pre col-xs-6 col-sm-4">
								<a v-on:click="previewDo()" class="preview"><em>預覽</em></a>
							</div>
							<div class="send col-xs-6 col-sm-4">
								<button v-bind:disabled="isProcessing" type="button" v-on:click="submitDo()" class="btn btn-post" role="button">
									確定發佈
								</button>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div><!--/infobox-->

				<div class="go-back left visible-xs">
					<a href="#"><span class="icon-goback"></span>返回廣告列表</a>
				</div>

			</div>
		</div>
	</div>

</section>

@stop

@section('js')

<script>
	if (vueData.item.isActive == 1) {
		vueData.item.isActive = true;
	} else {
		vueData.item.isActive = false;
	}

	vueData.isProcessing = false;

	var vue = new Vue({
		el : '#vue',
		data : vueData,
		methods : {

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

				if (isOK) {

					this.isProcessing = true;

					this.$http.post('adUpdateDo', this._data.item).then(function(r) {

						this.isProcessing = false;

						var body = r.body;

						alert('發佈完成');
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
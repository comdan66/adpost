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
				<div class="infobox no-padding-h bg-white-line">
					<div class="member-info-up">
						<div class="box col-xs-12 col-sm-4">
							<div class="pic col-xs-4">
								<!-- <img src="/images/pic-guest.jpg" class="img-circle"> -->
								<!-- <img v-bind:src="'/storage/photo/' + item.photo" class="img-circle" style="max-width:80px;max-height:80px"> -->

								<label style="cursor:pointer"> <img v-bind:src="'/storage/photo/' + item.photo" class="img-circle" style="max-width:80px;max-height:80px">
									<input style="display:none" class="form-control" type="file"  accept="image/*" v-on:change="uploadFile($event, 'photoJson')" />
								</label>

							</div>
							<div class="text-info">
								<h4>@{{ item.name }}</h4>
								<p>
									@{{ item.emil}}
								</p>
								<p class="small">
									<span class="bg-deepgray">廣告會員</span>
								</p>
							</div>
						</div>
						<div class="box col-xs-12 col-sm-4"></div>
						<div class="manage-item col-xs-12 col-sm-4">
							<ul>
								<li class="col-xs-4">
									<a href="profile" class="active"><span class="icon-user"></span><span class="text">個人資料</span></a>
								</li>
								<li class="col-xs-4">
									<a href="dashboard"><span class="icon-file"></span><span class="text">我的廣告</span></a>
								</li>
								<li class="col-xs-4">
									<a href="inbox"><span class="icon-message"></span><span class="text">訊息箱</span></a>
								</li>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
					<hr class="hidden-xs">
					<div class="go-back left bg-gray visible-xs">
						<a href="#"><span class="glyphicon glyphicon-arrow-left"></span>返回</a>
					</div>

					<div class="member-info-main">
						<div class="col-xs-12 col-sm-6">
							<h4><strong>基本資料</strong></h4>

							<div class="form-group col-xs-12 col-sm-6">
								<label><span class="highlight">*</span>名稱</label>
								<input type="" class="form-control" id="" placeholder="請輸入..." v-model="item.name" >
							</div>

							<div class="form-group col-xs-12 col-sm-6">
								<label><span class="highlight">*</span>公司名稱</label>
								<input type="" class="form-control" id="" placeholder="請輸入..." v-model="item.companyName" >
							</div>

							<div class="form-group col-xs-12 col-sm-6">
								<label><span class="highlight">*</span>統一編號</label>
								<input type="" class="form-control" id="" placeholder="請輸入..." v-model="item.companyNumber" >
							</div>

							<div class="form-group col-xs-12 col-sm-6">
								<label><span class="highlight">*</span>聯絡窗口</label>
								<input type="" class="form-control" id="" placeholder="請輸入..." v-model="item.contact" >
							</div>

							<div class="form-group col-xs-12 col-sm-6">
								<label><span class="highlight">*</span>公司信箱</label>
								<input type="" class="form-control" id="" placeholder="請輸入..." v-model="item.companyEmail" >
							</div>

							<div class="form-group col-xs-12 col-sm-6">
								<label><span class="highlight">*</span>公司電話</label>
								<input type="" class="form-control" id="" placeholder="請輸入..." v-model="item.companyPhone" >
							</div>

							<div class="form-group col-xs-12 col-sm-6">
								<label><span class="highlight">*</span>公司網站</label>
								<input type="" class="form-control" id="" placeholder="請輸入..." v-model="item.companyUrl" >
							</div>
						</div>

						<div class="col-xs-12 col-sm-6">
							<div class="form-group">
								<div class="row">
									<label class="col-xs-12">公司地址</label>

									<div class="crop-address edit col-xs-12 col-sm-6">
										<select class="form-control" v-model="item.cityID">
											<option v-for="(city, cityIndex) of option.city" v-bind:value="cityIndex">@{{ city.name }}</option>
										</select>
									</div>

									<div class="crop-address edit col-xs-12 col-sm-6">
										<select class="form-control" v-model="item.areaID">
											<option v-for="(area, areaIndex) of getCityAreas()" v-bind:value="areaIndex">@{{ area.name }}</option>
										</select>
									</div>

									<div class="crop-address edit col-xs-12">
										<input type="" class="form-control" id="" placeholder="請輸入地址..." v-model="item.address" >
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<!--send-->
						<div class="row">
							<div class="btu-area col-xs-12 col-sm-6 pull-right">
								<div class="send col-xs-12 col-sm-4 pull-right">
									<a type="submit" class="btn btn-post" v-on:click="submitDo()" role="button">確定發佈</a>
								</div>
								<div class="go-back col-sm-4 pull-right hidden-xs">
									<a href="profile">返回</a>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>

					</div>
				</div><!--/infobox-->
				<div class="go-back left bg-gray visible-xs">
					<a href="profile"><span class="glyphicon glyphicon-arrow-left"></span>返回</a>
				</div>
			</div>
		</div>
	</div>
</section>

@stop

@section('js')

<script>
	var vue = new Vue({
		el : '#vue',
		data : vueData,
		methods : {

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
							// self.item[key] = r.body.fileName;

							self.item.photo = r.body.fileName;

						});

					};
					reader.onerror = function() {
					};
					reader.readAsDataURL(file);

				}
			},

			getCityAreas : function() {

				try {
					return this.option.city[this.item.cityID].areas;
				} catch(e) {
					return [];
				}
			},
			submitDo : function() {

				this.$http.post('profileUpdateDo', this._data.item).then(function(r) {

					alert('更新成功');
					// var body = r.body;

				})
			},
		},
		created : function() {
		}
	});

</script>

@stop
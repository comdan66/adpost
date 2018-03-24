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

								<label  style="cursor:pointer"> <img v-bind:src="'/storage/photo/' + item.photo" class="img-circle" style="max-width:80px;max-height:80px">
									<input style="display:none" class="form-control" type="file"  accept="image/*" v-on:change="uploadFile($event, 'photoJson')" />
								</label>

							</div>
							<div class="text-info">
								<h4>@{{ item.name }}</h4>
								<p>
									@{{ item.email }}
								</p>
								<p class="small">
									<span class="bg-deepgray">一般告會員</span>
								</p>
							</div>
						</div>
						<div class="box col-xs-12 col-sm-4"></div>
						<div class="manage-item col-xs-12 col-sm-4">
							<ul>
								<li class="col-xs-4">
									<a href="profile" class="active"><span class="icon-user"></span><span class="text">個人資料</span></a>
								</li>
								<li class="col-xs-3">
									<a href="inbox"><span class="icon-message"></span><span class="text">訊息箱</span></a>
								</li>
								<li class="col-xs-5">
									<a href="/register/ad"><span class="icon-ad"></span><span class="text">註冊廣告會員</span></a>
								</li>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>

					<hr class="hidden-xs">
					<div class="go-back left bg-gray visible-xs">
						<a href="profile"><span class="icon-goback"></span>返回</a>
					</div>

					<div class="member-info-main">
						<div class="col-xs-12 col-sm-6">

							<form>
								<h4><strong>基本資料</strong></h4>

								<div class="col-xs-2">
									<label class="con-radio"><span>男</span>
										<input type="radio" name="radio" value="1" v-model="item.genderID">
										<span class="radiobtn"></span> </label>
								</div>

								<div class="col-xs-2">
									<label class="con-radio"><span>女</span>
										<input type="radio" name="radio" value="2" v-model="item.genderID">
										<span class="radiobtn"></span> </label>
								</div>
								<div class="clearfix"></div>
								<div class="form-group">
									<label><span class="highlight">*</span>生日</label>
									<input type="date" class="form-control" id="" placeholder="請輸入..." v-model="item.birthday">
								</div>
								<div class="form-group">
									<label><span class="highlight">*</span>行動電話</label>
									<input type="" class="form-control" id="" placeholder="請輸入..." v-model="item.phone">
								</div>

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
											<input type="" class="form-control" id="" placeholder="請輸入地址..."  v-model="item.address">
										</div>
									</div>
								</div>

								<div class="clearfix"></div>
							</form>
						</div>

						<div class="col-xs-12 col-sm-4">
							<h4><strong>個人興趣</strong></h4>
							<ul>
								<li class="col-xs-6" v-for="(x, i) of option.userInterest">
									<label class="con-check"><span>@{{ x }}</span>
										<input type="checkbox" v-model="item.interestIDs" v-bind:value="i">
										<span class="checkmark"></span></label>
								</li>
							</ul>
						</div>
						<div class="col-xs-12 col-sm-2"></div>
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
				</div>
				<div class="go-back left visible-xs">
					<a href="profile"><span class="icon-goback"></span>返回</a>
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
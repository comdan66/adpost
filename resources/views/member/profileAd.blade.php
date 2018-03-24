@extends('_layouts/main')

@section('content')

<!--main-area-->
<section id="main-area">
	<div class="kv inter">
		<h2>個人資訊</h2>
	</div>

	<div class="member bg-gray"  id="vue" v-cloak>
		<div class="container">
			<div class="row">
				<div class="infobox no-padding-h bg-white-line">
					<div class="member-info-up">
						<div class="box col-xs-12 col-sm-4">
							<div class="pic col-xs-4">
								<!-- <img src="/images/pic-guest.jpg" class="img-circle"> -->

								<img v-bind:src="'/storage/photo/' + item.photo" class="img-circle" style="max-width:80px;max-height:80px">
								<!-- <label>
								<input style="display:none" class="form-control" type="file"  accept="image/*" v-on:change="uploadFile($event, 'photoJson')" />
								</label> -->
							</div>
							<div class="text-info">
								<h4>@{{ item.name }}</h4>
								<p>
									@{{ item.email }}
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
					<hr>

					<div class="member-info-main">
						<div class="col-xs-12 col-sm-6">
							<h4><strong>基本資料</strong></h4>
							<ul>
								<li>
									公司名稱：@{{ item.companyName }}
								</li>
								
								<li>
									聯絡窗口：@{{ item.contact }}
								</li>
								<li>
									公司電話：@{{ item.companyPhone}}
								</li>
								<li>
									統一編號：@{{ item.companyNumber }}
								</li>
								<li>
									公司信箱：@{{ item.companyEmail }}
								</li>
								<li>
									公司網站：@{{ item.companyUrl }}
								</li>
								<li>
									公司地址：@{{ item.addressText }}
								</li>
							</ul>
						</div>

						<div class="clearfix"></div>

						<!--send-->
						<div class="col-xs-12 col-sm-2 pull-right">
							<a type="submit" class="btn btn-post btn-block" href="profileUpdate" role="button">編輯資訊</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div><!-- /infobox -->

			</div>
		</div>
	</div>
</section>

@stop

@section('js')

<script>
	vue = new Vue({
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
						self.$http.post('/admin/_helper/uploadFile', data).then(function(r) {
							// self.item[key] = r.body.fileName;

							self.item.photo = r.body.fileName;

						});

					};
					reader.onerror = function() {
					};
					reader.readAsDataURL(file);

				}
			},

			getCityName : function() {

				try {
					return this.option.city[this.item.cityID].name;
				} catch(e) {
					return '';
				}
			},
			submitDo : function() {

				this.$http.post('profileUpdateDo', this._data.item).then(function(r) {

					var body = r.body;

				})
			},
		},
		created : function() {
		}
	});

</script>
@stop
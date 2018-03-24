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
								<img v-bind:src="'/storage/photo/' + item.photo" class="img-circle" style="max-width:80px;max-height:80px">
							</div>
							<div class="text-info">
								<h4>@{{ item.name }}</h4>
								<p>
									@{{ item.email }}
								</p>
								<p class="small">
									<span v-if="item.roleID == 2" class="bg-deepgray">廣告會員</span>
									<span v-if="item.roleID == 1" class="bg-deepgray">一般會員</span>
								</p>
							</div>
						</div>
						<div class="box col-xs-12 col-sm-4"></div>
						<div class="manage-item col-xs-12 col-sm-4">

							<ul v-if="item.roleID==1">
								<li class="col-xs-4">
									<a href="profile"><span class="icon-user"></span><span class="text">個人資料</span></a>
								</li>
								<li class="col-xs-3">
									<a href="inbox"><span class="icon-message"></span><span class="text">訊息箱</span></a>
								</li>
								<li class="col-xs-5">
									<a href="/register/ad"  class="active"><span class="icon-ad"></span><span class="text">註冊廣告會員</span></a>
								</li>
							</ul>

							<ul v-if="item.roleID==2">
								<li class="col-xs-4">
									<a href="profile" ><span class="icon-user"></span><span class="text">個人資料</span></a>
								</li>
								<li class="col-xs-4">
									<a href="dashboard"><span class="icon-file"></span><span class="text">我的廣告</span></a>
								</li>
								<li class="col-xs-4">
									<a href="inbox" class="active"><span class="icon-message"></span><span class="text">訊息箱</span></a>
								</li>
							</ul>

						</div>
						<div class="clearfix"></div>
					</div>
					<hr>

					<div class="member-info-main success" v-for="(x,i) of items">
						<div class="col-xs-12">
							<p class="time">
								@{{ x.created_at }}
							</p>
							<p>
								@{{ x.name }}
							</p>
							<p>
								@{{ x.content }}
							</p>
						</div>

					</div>
					<!-- <div class="member-info-main success">
					<div class="col-xs-12">
					<p class="time">
					04/26/2017
					</p>
					<p>
					個人資訊更新成功！
					</p>
					<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit.
					</p>
					</div>
					</div> -->

					<div class="clearfix"></div>
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

			// submitDo : function() {
			//
			// this.$http.post('profileUpdateDo', this._data.item).then(function(r) {
			//
			// var body = r.body;
			//
			// })
			// },
		},
		created : function() {
		},
		mounted : function() {

		}
	});

</script>

@stop
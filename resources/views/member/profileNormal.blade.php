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
								<h4>@{{ item.name  }}</h4>
								<p>
									@{{ item.email  }}
								</p>
								<p class="small">
									<span class="bg-deepgray"> 一般會員 </span>
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
					<hr>

					<div class="member-info-main">
						<div class="col-xs-12 col-sm-6">
							<h4><strong>基本資料</strong></h4>
							<ul>
								<li>
									性別：@{{ option.gender[item.genderID]}}
								</li>
								<li>
									生日：@{{ item.birthday }}
								</li>
								<li>
									行動電話：@{{ item.phone }}
								</li>
								<li>
									<!-- 居住地區：@{{ option.city[item.cityID].name}} -->
									居住地區：@{{ getCityName() }}
								</li>
							</ul>

							<h4><strong>我的廣告</strong></h4>
							<p>
								您是一般會員，若想上傳您的廣告，請 <a href="/register/ad">點此註冊</a> 廣告會員。
							</p>
						</div>

						<div class="interest col-xs-12 col-sm-4">
							<h4><strong>個人興趣</strong></h4>
							<ul>
								<li class="col-xs-6" v-for="(x,i) of item.interestIDs">
									<span class="icon-tag"></span><a >@{{ option.userInterest[x] }}</a>
								</li>
								<!--
								<li class="col-xs-6">
								<span class="icon-tag"></span><a href="#">美容保健</a>
								</li>
								<li class="col-xs-6">
								<span class="icon-tag"></span><a href="#">時尚流行</a>
								</li>
								<li class="col-xs-6">
								<span class="icon-tag"></span><a href="#">資訊科技</a>
								</li>
								<li class="col-xs-6">
								<span class="icon-tag"></span><a href="#">體育運動</a>
								</li>
								<li class="col-xs-6">
								<span class="icon-tag"></span><a href="#">休閒旅遊</a>
								</li>
								<li class="col-xs-6">
								<span class="icon-tag"></span><a href="#">風味美食</a>
								</li> -->
							</ul>
						</div>
						<div class="col-sm-2"></div>
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
	var vue = new Vue({
		el : '#vue',
		data : vueData,
		methods : {

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
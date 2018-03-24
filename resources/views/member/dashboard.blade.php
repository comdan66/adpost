@extends('_layouts/main')

@section('content')

<!-- facebook -->
{{ printJson('fbAppID', $fbAppID) }}

<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId : fbAppID,
			cookie : true,
			xfbml : true,
			oauth : true,
			version : 'v2.9'
		});

	};

	//---------------
	( function(d, s, id) {
			var js,
			    fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {
				return;
			}
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

</script>

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
									<span class="bg-deepgray">廣告會員</span>
								</p>
							</div>
						</div>
						<div class="box col-xs-12 col-sm-4"></div>
						<div class="manage-item col-xs-12 col-sm-4">
							<ul>
								<li class="col-xs-4">
									<a href="profile" ><span class="icon-user"></span><span class="text">個人資料</span></a>
								</li>
								<li class="col-xs-4">
									<a href="dashboard" class="active"><span class="icon-file"></span><span class="text">我的廣告</span></a>
								</li>
								<li class="col-xs-4">
									<a href="inbox"><span class="icon-message"></span><span class="text">訊息箱</span></a>
								</li>
							</ul>
						</div>
						<div class="clearfix"></div>
					</div>
				</div><!--/infobox-->

				<div class="col-xs-12">
					<div class="btu-plus">
						<a type="submit" class="btn btn-post btn-block" href="adCreate" role="button">＋新增廣告</a>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="infobox no-padding-h bg-white-line">
					<div class="row">
						<div class="title-item-up hidden-xs">
							<div class="box-l col-xs-12 col-sm-5">
								<p>
									廣告名稱
								</p>
							</div>
							<div class="box-r col-xs-12 col-sm-7">
								<ul>
									<li class="col-sm-2">
										Share
									</li>
									<li class="col-sm-2">
										瀏覽量
									</li>
									<li class="col-sm-2">
										喜愛數
									</li>
									<li class="col-sm-2">
										回應數
									</li>
									<li class="col-sm-2">
										狀態
									</li>
									<li class="col-sm-2">
										操作
									</li>
								</ul>
							</div>
						</div>
						<div class="col-xs-12">
							<hr>
						</div>
					</div>
					<!-- 1-->
					<div class="row" id="item-one" v-for="(x,i) of items">
						<div class="adver-item-up">
							<div class="box-l col-xs-12 col-sm-5">
								<div class="pic col-xs-5">
									<!-- <img src="/images/pic-adlist-01.jpg" class="img-responsive"> -->

									<img v-bind:src="'https://img.youtube.com/vi/' +x.youtubeID + '/0.jpg' " class="img-responsive" v-if="x.postTypeID==1" style="width:100%">
									<img v-bind:src="'/storage/photo/' + x.photo" class="img-responsive" v-if="x.postTypeID==2" style="width:100%">

								</div>
								<div class="text-info col-xs-7">
									<h4 style="word-break: break-all;">@{{ x.name}}</h4>
									<p class="hidden-xs" style="word-break: break-all;">
										@{{ x.brief }}
									</p>
									<p class="small">
										<span class="bg-deepgray">發佈時間  @{{ x.created_at }}</span>
									</p>
								</div>
							</div>

							<div class="box-r col-xs-12 col-sm-7">
								<ul>
									<li class="col-xs-6 col-sm-2">
										<!-- <span class="visible-xs">Share</span>@{{ x.countShare }} -->
										<div class="fb-share-button" v-bind:data-href="'/post/item/' + x.id" data-layout="button_count"></div>
									</li>
									<li class="col-xs-6 col-sm-2">
										<span class="visible-xs">瀏覽量</span>@{{ x.countViews}}
									</li>
									<li class="col-xs-6 col-sm-2">
										<span class="visible-xs">喜愛數</span>@{{ x.countPopular}}
									</li>
									<li class="col-xs-6 col-sm-2">
										<span class="visible-xs">回應數</span>@{{ x.countComment }}
									</li>
									<li class="col-sm-2 hidden-xs">

										<span v-if="x.isApprove != 1">審核中</span>
										<span v-if="x.isApprove == 1"> <span v-if="x.isActive == 1">上架</span> <span v-if="x.isActive != 1">下架</span> </span>

										<!-- <label class="switch">
										<input type="checkbox" v-model="x.isActive" disabled="">
										<span class="slider round"></span> </label>
										-->
									</li>
									<li class="col-xs-12 col-sm-2">
										<div class="col-xs-6 col-sm-12">
											<a v-bind:href="'adUpdate?id=' + x.id" class="but-edit btn-block"><span class="icon-edit hidden-xs"></span><em>編輯</em></a>
										</div>
										<div class="col-xs-6 col-sm-12">
											<a v-bind:href="'/post/item/' + x.id" class="preview-b btn-bloc"><span class="icon-eye-b hidden-xs"></span><em>瀏覽</em></a>
										</div>
									</li>
								</ul>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="adver-item " >
							<div class="content">
								<!-- show-->
								<p>
									<strong>產品簡述</strong>
								</p>
								<p>
									@{{ x.brief }}
								</p>
								<p>
									<strong>產品介紹</strong>
								</p>
								<p>
									@{{ x.content }}
								</p>
								<p>
									<strong>網址連結</strong>
								</p>
								<p>
									<a v-bind:href="x.url" target="_blank">@{{ x.url }}</a>
								</p>
								<!-- <div class="hidden-xs">
								<p>
								<strong>已上傳檔案</strong>
								</p>

								<ul class="upload-ed">
								<li><img src="/images/pic-adlist-01.jpg" class="img-responsive">
								</li>
								<li><img src="/images/pic-adlist-01.jpg" class="img-responsive">
								</li>
								<li><img src="/images/pic-adlist-01.jpg" class="img-responsive">
								</li>
								<li><img src="/images/pic-adlist-01.jpg" class="img-responsive">
								</li>
								<li><img src="/images/pic-adlist-01.jpg" class="img-responsive">
								</li>
								</ul>

								</div> -->
								<div class="clearfix"></div>
								<!-- /show-->
							</div>
							<div class="details">
								<a href="#item-two"><span>展開詳細資訊</span></a>
							</div>
						</div>

						<div class="col-xs-12">
							<hr>
						</div>
					</div>

					<!-- pagination-->
					<div class="col-xs-12 text-center visible-xs">
						<a href="#" id="loadMore"><em>載入更多</em></a>
					</div>

					<div class="text-center hidden-xs">
						<ul class="pagination pagination-primary">
							<li v-if="page > 1">
								<a v-bind:href="'dashboard?page=' + (page -1)">&lt;</a>
							</li>

							<li v-for="n in pageTotal" v-bind:class="{active: (n == page)}" v-on:click="changePage(n)">
								<a v-bind:href="'?page=' + n">@{{ n }}</a>
							</li>

							<!-- <li>
							<a href="javascript:void(0);">...</a>
							</li>
							-->

							<!--
							<li class="active">
							<a href="javascript:void(0);">7</a>
							</li> -->

							<!--
							<li>
							<a href="javascript:void(0);">...</a>
							</li> -->

							<li v-if="page < pageTotal">
								<a v-bind:href="'dashboard?page=' + (page +1)">&gt;</a>
							</li>

						</ul>
					</div>
					<!-- / pagination-->

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

			submitDo : function() {

				this.$http.post('profileUpdateDo', this._data.item).then(function(r) {

					var body = r.body;

				})
			},
		},
		created : function() {
		},
		mounted : function() {
			$('.adver-item .details').hover(function() {
				$(this).addClass('details_on');
			}, function() {
				$(this).removeClass('details_on');
			}).click(function() {

				var $content = $(this).prev('.content');
				if (!$content.is(':visible')) {
					$('.adver-item .content:visible').slideUp();
				}
				$content.slideToggle();
			}).siblings().addClass('.content').hide();

		}
	});

</script>

@stop
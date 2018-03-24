@extends('_layouts/main')

@section('content')

<style>
	#adinside #bx-pager li a.active:after {
		content: '';
	}
	.zzz {
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
	}

</style>
 
<!--main-area-->
<section id="main-area" >

	<div id="adinside" class="bg-gray">

		<div class="container" >
			<div class="row">

				<div class="info">
					<div class="go-back col-sm-2 hidden-xs">
						<a href="/post/listing"> <span class="icon-goback"></span>返回廣告列表 </a>

					</div>

					<div class="title col-sm-8 col-xs-12 text-center">
						<p>
							<span class="icon-tag"></span>{{ $option['advertisementType'][$item['typeID']] }}
						</p>
						<h1 style="word-break: break-all;">{{ $item['name'] }}</h1>
					</div>
					<div class="clearfix"></div>
				</div>

				<!--slider-->
				<ul class="bxslider-single">

					@foreach($slider as $x)

					@if($x['typeID'] == 1)

					<li>
						<div class="pic">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe class="yt-item"  src="http://www.youtube.com/embed/{{ $x['youtubeID'] }}?rel=0&wmode=Opaque&enablejsapi=1;showinfo=0;controls=1;showinfo=0" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>
					</li>

					@else

					<li>
						<div class="pic">
							<div class="embed-responsive embed-responsive-16by9" >
								<img class="yt-item" src="/storage/photo/{{ $x['photo'] }}" style="width:100%;">
							</div>
						</div>
					</li>

					@endif

					@endforeach

				</ul>
				<div id="bx-pager" class="hidden-xs">
					<ul>

						@foreach($slider as $x)

						@if($x['typeID'] == 1)

						<li>
							<!-- style="https://img.youtube.com/vi/{{ $x['youtubeID'] }}/0.jpg" -->

							<a data-slide-index="{{ $x['n'] }}" style="background:none"> <div style="height:132px;width:100%;background-position:center;background-image:url(https://img.youtube.com/vi/{{ $x['youtubeID'] }}/0.jpg);background-size:cover" ></div> <!-- <img src="https://img.youtube.com/vi/{{ $x['youtubeID'] }}/0.jpg" style="max-width:100%;max-height:132px">  --> <!-- <span style="visibility: hidden">1</span> --> </a>
						</li>

						@else

						<li>
							<!-- style="background-image:url(/storage/photo/{{ $x['photo'] }})" -->
							<a data-slide-index="{{ $x['n'] }}" style="background:none"> <div style="height:132px;width:100%;background-position:center;background-image:url(/storage/photo/{{ $x['photo'] }});background-size:cover" ></div> <!-- <img src="/storage/photo/{{ $x['photo'] }}" style="max-width:100%;max-height:125px">  --> </a>
						</li>
						@endif

						@endforeach
						<!--

						<li>
						<a data-slide-index="0" href=""><span style="visibility: hidden">1</span></a>
						</li>
						<li>
						<a data-slide-index="1" href=""><span style="visibility: hidden">2</span></a>
						</li>
						<li>
						<a data-slide-index="2" href=""><span style="visibility: hidden">3</span></a>
						</li>
						<li>
						<a data-slide-index="3" href=""><span style="visibility: hidden">4</span></a>
						</li>
						<li>
						<a data-slide-index="4" href=""><span style="visibility: hidden">5</span></a>
						</li> -->
					</ul>
				</div>
				<!-- /slider-->

			</div>
		</div>
	</div><!--/adinside-->

	<div id="vue" v-cloak>
		<div class="adver-descript">
			<div class="container">

				<div class="row">
					<div class="time pull-left">
						<span class="bg-deepgray">發佈時間  {{ substr($item['created_at'], 0, 10) }}</span>
					</div>

					<div class="community">
						<ul>
							<li>
								<span class="icon-eye-open"></span>@{{ item.countViews}}
							</li>
							<li>
								<span class="icon-heart-empty"></span>{{ $countLove}}
							</li>
							<li>
								<span class="icon-comment"></span>{{ $countComment }}
							</li>
						</ul>
					</div>
				</div><!-- /row-->

				<h2 style="word-break: break-all;">{{ $item['name'] }}</h2>
				<h4 style="word-break: break-all;"> {{ $item['brief'] }} </span></h4>

				<div class="row">
					<div class="blue-line"></div>
				</div>
				<p style="word-break: break-all;">
					{!! nl2br($item['content']) !!}
				</p>
				<div class="row">
					<div class="favorite col-xs-12">
						<div class="btn-line-grad">
							<a v-on:click="likeDo()"><em> <span v-if="!isLike" class="glyphicon glyphicon-heart-empty"></span> <span v-if="isLike" class="glyphicon glyphicon-heart"></span> 喜歡</em></a>
						</div>

						<!-- <div>
						<button class="btn btn-primary" v-on:click="fbShare()" style="width:auto;display:inline-block;padding:5px 15px">
						分享
						</button>
						</div> -->
						<div class="col-xs-12 row">
							<!-- <div class="fb-share-button" data-href="/post/item/{{ $item['id'] }}" data-layout="button_count"></div> -->
						</div>
						<!-- <div class="fb-like col-xs-12" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="recommend" data-size="small" data-show-faces="false" data-share="true"></div> -->

						<div  class="col-xs-12 row" v-if="item.url != '' " style="margin-top:10px">
							網址: <a v-bind:href="item.url" target="_blank">@{{ item.url }}</a>
						</div>
					</div>

				</div>

			</div>
		</div>

		<div class="bordertest"></div>

		<div class="adver-result">
			<div class="container">

				<div class="guest-group">
					<div class="guest-message">
						<p>
							訪客回應 (@{{ comments.length }})
						</p>
						<div class="pic col-sm-2 col-lg-1 hidden-xs">
							<!-- <img src="/images/pic-guest.jpg" class="img-circle"> -->
							<img src="/img/user.png" class="img-circle">
						</div>
						<div class="message col-xs-12 col-sm-10 col-lg-11">
							<textarea class="form-control" rows="3" placeholder="輸入回應..." v-on:keyup.enter="commentDo()" v-model="commentContent" v-bind:disabled="isCommenting || !isLogin" ></textarea>
							<p v-if="isLogin">
								請按 Enter 送出留言。
							</p>

							<p v-if="!isLogin">
								登入後才可以留言喔
							</p>

						</div>
						<div class="clearfix"></div>
					</div>
					<hr>
					<div class="guest-response">
						<ul >

							<li v-for="(x,i) of comments" v-if="i < maxCommentCount " style="display:block">

								<div class="pic col-xs-3 col-sm-2 col-lg-2">
									<!-- <img src="/images/pic-guest.jpg" class="img-circle"> -->
									<img v-bind:src="'/storage/photo/' + x.userPhoto" class="img-circle" style="max-width:80px;max-height:80px">
								</div>
								<div class="user col-xs-9 col-sm-10 col-lg-10">
									<span class="name">@{{ x.userName  }}</span><span class="time">@{{ x.created_at }}</span>
								</div>
								<div class="text-descript col-xs-12 col-sm-10 col-lg-10 pull-right" style="word-break:break-all;">
									@{{ x.content }}

								</div>
								<div class="clearfix"></div>
							</li>

						</ul>

						<div class="col-xs-12 text-center">
							<a v-on:click="showAllComment()" v-if="maxCommentCount == 5 " id="loadMore"><em>載入更多留言</em></a>
						</div>
					</div>

					<div class="clearfix"></div>
				</div>

				<!-- maybe you like-->
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<h2>你可能也會喜歡</h2>
					</div>
					<div class="clearfix"></div>
					<div class="adver-group">
						<ul class="row" style="display:block;margin:0">

							<li class="col-xs-6 col-sm-3" v-for="(x,i) of related">
								<div class="box">
									<div class="pic">

										<div class="embed-responsive embed-responsive-16by9" v-if="x.postTypeID == 1">
											<iframe  class="yt-item" id="yt2" width="100%" v-bind:src="'http://www.youtube.com/embed/' + x.youtubeID + '?rel=0&wmode=Opaque&enablejsapi=1;showinfo=0;controls=1;showinfo=0'" frameborder="0" allowfullscreen></iframe>
										</div>

										<a v-if="x.postTypeID ==2" v-bind:href="'/post/item/' + x.id"> <div class="embed-responsive embed-responsive-16by9 zzz"  v-bind:style="{backgroundImage: 'url('+uploadUrl+x.photo+')' }" >

										</div> </a>

									</div>
									<div class="text">
										<p>
											<a v-bind:href="'/post/item/' + x.id">@{{ x.name }}</a>
										</p>
										<p class="pull-left">
											<span class="icon-tag"></span><a v-bind:href="'/post/listing?typeID=' + x.typeID"> @{{ option.advertisementType[x.typeID] }} </a>
										</p>
										<p class="pull-right">
											<!-- 1 days ago -->
										</p>
										<div class="clearfix"></div>
									</div>
								</div>
							</li>

						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- /maybe you like-->

			</div>
		</div>
	</div>
</section>

@stop

@section('js')

<script>
	vueData.maxCommentCount = 5;

	vueData.commentContent = '';
	vueData.isCommenting = false;
	vueData.isLogin = isLogin;

	var vue = new Vue({
		el : '#vue',
		data : vueData,
		methods : {

			showAllComment : function() {
				this.maxCommentCount = 9999;
			},

			// checkLogin : function() {
			// if (isLogin !== true) {
			// alert('登入後才可以留言喔');
			// }
			//
			// },
			fbShare : function() {
				FB.ui({
					method : 'feed',
					//name : '台北創業家',
					name : vueData.item.name,
					//link : 'http://www.story.taipei/',
					link : window.location.href,
					// picture : '',
					description : vueData.item.content
				}, function(response) {

					if (response && response.post_id) {

					} else {

					}
				});

			},
			likeDo : function() {

				if (isLogin == true) {
					var data = {
						isLike : !this.isLike,
						adID : this.item.id,
					}
					this.$http.post('/post/likeDo', data).then(function(r) {
						log(r);

						var body = r.body;
						if (body) {
							this.isLike = !this.isLike;

						} else {

						}
					});
				} else {
					alert('請先登入會員');
				}

			},
			commentDo : function() {

				if (this.commentContent != '') {

					if (this.isCommenting == false) {

						this.isCommenting = true;

						var data = {
							content : this.commentContent,
							adID : this.item.id,

						}
						this.$http.post('/post/commentDo', data).then(function(r) {
							this.isCommenting = false;

							var x = {
								userPhoto : userPhoto,
								userName : userName,
								created_at : getDatetime(),
								content : this.commentContent
							};
							this.comments.push(x);

							this.commentContent = '';

						});

					}
				}

			},
		}
	});

</script>

@stop
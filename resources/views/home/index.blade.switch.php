@extends('_layouts/index')

@section('content')

<div class="kv-home row visible-xs visible-sm">
	<div class="col-xs-12">
		<h2>屬於你的廣告平台</h2>
		<div class="bt-action col-xs-6 center-block">
			<a class="btn btn-post" href="/register" role="button">馬上註冊</a>
		</div>
	</div>
</div>

<!--main-area-->
<section id="main-area">
	<div class="part-a" id="partA">
		<div class="container">
			<div class="row">
				<div class="description col-xs-12 col-sm-8">
					<h2 class="text-left">熱門影音廣告</h2>
					<p>
						Maybe you’ve heard these different marketing terms, maybe you haven’t. Either way, let me help to clarify the difference between them, because you should have all
					</p>
				</div>
				<div class="item col-xs-12 col-sm-4">
					<ul>
						<!-- <li class="col-xs-4">
						<a href="/?video=new" id="video_new"  v-bind:class="{active:condition.orderField == 'created_at'}" v-on:click="changeOrder('created_at')">最新廣告</a>
						</li>
						<li class="col-xs-4">
						<a href="/?video=views"  id="video_views" v-bind:class="{active:condition.orderField == 'views'}" v-on:click="changeOrder('views')">最多觀看</a>
						</li>
						<li class="col-xs-4">
						<a href="/?video=popular"  id="video_popular" v-bind:class="{active:condition.orderField == 'countPopular'}" v-on:click="changeOrder('countPopular')">最受歡迎</a>
						</li> -->
						<li class="col-xs-4">

							<a onclick="showVideo('new')"  class="active"  id="videoTab_new"  v-bind:class="{active:condition.orderField == 'created_at'}" v-on:click="changeOrder('created_at')">最新廣告</a>
						</li>
						<li class="col-xs-4">
							<a onclick="showVideo('views')"   id="videoTab_views" v-bind:class="{active:condition.orderField == 'views'}" v-on:click="changeOrder('views')">最多觀看</a>
						</li>
						<li class="col-xs-4">
							<a  onclick="showVideo('popular')"   id="videoTab_popular"  v-bind:class="{active:condition.orderField == 'countPopular'}" v-on:click="changeOrder('countPopular')">最受歡迎</a>
						</li>

					</ul>

				</div>

				<div class="clearfix"></div>

				<div class="part-a-slider" id="video_new">
					<ul class="bxslider">

						@foreach($videoItems_new as $x)
						<li class="{{ $x['className'] }}">
							<a href="/advertisement/item/{{ $x['id'] }}">
							<div class="pic" style="max-width:100%;">
								<div class="embed-responsive embed-responsive-16by9">
									<img src="https://img.youtube.com/vi/{{ $x['youtubeID'] }}/0.jpg" style="width:100%;">
									
									<!-- <iframe id="player2" src="http://www.youtube.com/embed/{{ $x['youtubeID'] }}?rel=0&wmode=Opaque&enablejsapi=1;showinfo=0;controls=1;showinfo=0" frameborder="0" allowfullscreen></iframe> -->
								</div>
							</div>
							<p>
								{{ $x['name'] }}
							</p> </a>
						</li>

						@endforeach

					</ul>

				</div>

				<div class="part-a-slider"  id="video_views">
					<ul class="bxslider">

						@foreach($videoItems_views as $x)
						<li class="{{ $x['className'] }}">
							<a href="/advertisement/item/{{ $x['id'] }}">
							<div class="pic" style="max-width:100%;">
								<div class="embed-responsive embed-responsive-16by9">
									<img src="https://img.youtube.com/vi/{{ $x['youtubeID'] }}/0.jpg" style="width:100%;">
									
									<!-- <iframe id="player2" src="http://www.youtube.com/embed/{{ $x['youtubeID'] }}?rel=0&wmode=Opaque&enablejsapi=1;showinfo=0;controls=1;showinfo=0" frameborder="0" allowfullscreen></iframe> -->
								</div>
							</div>
							<p>
								{{ $x['name'] }}
							</p> </a>
						</li>

						@endforeach

					</ul>

				</div>

				<div class="part-a-slider"  id="video_popular">
					<ul class="bxslider">

						@foreach($videoItems_popular as $x)
						<li class="{{ $x['className'] }}">
							<a href="/advertisement/item/{{ $x['id'] }}">
							<div class="pic" style="max-width:100%;">
								<div class="embed-responsive embed-responsive-16by9">
									<img src="https://img.youtube.com/vi/{{ $x['youtubeID'] }}/0.jpg" style="width:100%;">
									
									<!-- <iframe id="player2" src="http://www.youtube.com/embed/{{ $x['youtubeID'] }}?rel=0&wmode=Opaque&enablejsapi=1;showinfo=0;controls=1;showinfo=0" frameborder="0" allowfullscreen></iframe> -->
								</div>
							</div>
							<p>
								{{ $x['name'] }}
							</p> </a>
						</li>

						@endforeach

					</ul>

				</div>

			</div>
		</div>
	</div><!--/part-a-->

	<div class="part-b" id="partB">
		<div class="container">
			<div class="row">
				<div class="description col-xs-12 col-sm-8">
					<h2>熱門圖文廣告</h2>
					<p>
						Maybe you’ve heard these different marketing terms, maybe you haven’t. Either way, let me help to clarify the difference between them, because you should have all
					</p>
				</div>
				<div class="item col-xs-12 col-sm-4">

					<ul>
						<!-- <li class="col-xs-4" >
						<a href="/?photo=new" id="photo_new"  v-bind:class="{active:condition.orderField == 'created_at'}" v-on:click="changeOrder('created_at')">最新廣告</a>
						</li>
						<li class="col-xs-4" >
						<a href="/?photo=views"  id="photo_views" v-bind:class="{active:condition.orderField == 'views'}" v-on:click="changeOrder('views')">最多觀看</a>
						</li>
						<li class="col-xs-4"  >
						<a href="/?photo=popular"  id="photo_popular" v-bind:class="{active:condition.orderField == 'countPopular'}" v-on:click="changeOrder('countPopular')">最受歡迎</a>
						</li> -->

						<li class="col-xs-4" >
							<a  onclick="showPhoto('new')" class="active" id="photoTab_new"  v-bind:class="{active:condition.orderField == 'created_at'}" v-on:click="changeOrder('created_at')">最新廣告</a>
						</li>
						<li class="col-xs-4" >
							<a  onclick="showPhoto('views')"  id="photoTab_views" v-bind:class="{active:condition.orderField == 'views'}" v-on:click="changeOrder('views')">最多觀看</a>
						</li>
						<li class="col-xs-4"  >
							<a  onclick="showPhoto('popular')" id="photoTab_popular"   v-bind:class="{active:condition.orderField == 'countPopular'}" v-on:click="changeOrder('countPopular')">最受歡迎</a>
						</li>

					</ul>
				</div>

				<div class="clearfix"></div>

				<div class="part-b-slider"  id="photo_new">
					<ul class="bxslider" >

						@foreach($photoItems_new as $x)
						<li class="{{ $x['className'] }}">
							<a href="/advertisement/item/{{ $x['id'] }}">
							<div class="pic">
								<!-- <img src="/images/pic2.jpg"/> -->
								<img src="/storage/photo/{{ $x['photo'] }}" />
							</div>
							<p>
								{{ $x['name']}}
							</p> </a>
						</li>

						@endforeach

					</ul>

				</div>

				<div class="part-b-slider" id="photo_views">
					<ul class="bxslider"  >

						@foreach($photoItems_views as $x)
						<li class="{{ $x['className'] }}">
							<a href="/advertisement/item/{{ $x['id'] }}">
							<div class="pic">
								<!-- <img src="/images/pic2.jpg"/> -->
								<img src="/storage/photo/{{ $x['photo'] }}" />
							</div>
							<p>
								{{ $x['name']}}
							</p> </a>
						</li>

						@endforeach

					</ul>

				</div>

				<div class="part-b-slider"  id="photo_popular">
					<ul class="bxslider" >

						@foreach($photoItems_popular as $x)
						<li class="{{ $x['className'] }}">
							<a href="/advertisement/item/{{ $x['id'] }}">
							<div class="pic">
								<!-- <img src="/images/pic2.jpg"/> -->
								<img src="/storage/photo/{{ $x['photo'] }}" />
							</div>
							<p>
								{{ $x['name']}}
							</p> </a>
						</li>

						@endforeach

					</ul>

				</div>

			</div>
		</div>
	</div><!--/part-b-->

	<div class="part-c">
		<div class="container">
			<div class="row">
				<div class="bt-more col-sm-3 center-block">
					<a class="btn btn-post" href="/advertisement/listing" role="button">探索更多廣告</a>
				</div>
			</div>
		</div>

	</div><!--/part-c-->

</section>

@stop

@section('js')

<script>
	vueListData.el = '#partA';
	vueListData.data.option = vueData.option;
	vueListData.data.condition.search.typeIDs = [];
	vueListData.data.condition.orderField = 'created_at';
	vueListData.data.condition.pageSize = 3;

	var typeID = getQuery('typeID');
	if (typeID) {
		vueListData.data.condition.search.typeIDs.push(typeID);
	}

	var name = getQuery('name');
	if (name) {
		vueListData.data.condition.search.name = name;
	}

	vueListData.methods.changeOrder = function(x) {

		this.condition.orderField = x;
		this.condition.orderType = 'desc';
		this.getList();

	}

	vueListData.data.getListUrl = '/home/getList';

	// var vuePartA = new Vue(vueListData);

	var vueListData2 = Object.assign({}, vueListData);

	vueListData2.el = '#partB';
	vueListData2.data.option = vueData.option;
	vueListData2.data.condition.search.typeIDs = [];
	vueListData2.data.condition.orderField = 'created_at';
	vueListData2.data.condition.pageSize = 3;

	var typeID = getQuery('typeID');
	if (typeID) {
		vueListData2.data.condition.search.typeIDs.push(typeID);
	}

	var name = getQuery('name');
	if (name) {
		vueListData2.data.condition.search.name = name;
	}

	vueListData2.methods.changeOrder = function(x) {

		this.condition.orderField = x;
		this.condition.orderType = 'desc';
		this.getList();

	}

	vueListData2.data.getListUrl = '/home/getList';

	// var vuePartB = new Vue(vueListData2);

	// jQuery('#video_' + vueData.video).addClass('active');
	// jQuery('#photo_' + vueData.photo).addClass('active');
	//
	// jQuery('#video_views').hide();
	// jQuery('#video_popular').hide();
	// jQuery('#photo_views').hide();
	// jQuery('#photo_popular').hide();

	function showVideo(x) {
		jQuery('#video_new').hide();
		jQuery('#video_views').hide();
		jQuery('#video_popular').hide();
		jQuery('#video_' + x).show();

		jQuery('#videoTab_new').removeClass('active');
		jQuery('#videoTab_views').removeClass('active');
		jQuery('#videoTab_popular').removeClass('active');
		jQuery('#videoTab_' + x).addClass('active');

	}

	function showPhoto(x) {
		jQuery('#photo_new').hide();
		jQuery('#photo_views').hide();
		jQuery('#photo_popular').hide();
		jQuery('#photo_' + x).show();

		jQuery('#photoTab_new').removeClass('active');
		jQuery('#photoTab_views').removeClass('active');
		jQuery('#photoTab_popular').removeClass('active');
		jQuery('#photoTab_' + x).addClass('active');
	}


	jQuery(document).ready(function() {
		setTimeout("showVideo('new');showPhoto('new')", 500);
		// showVideo('new');
		// showPhoto('new');
	});

</script>

@stop
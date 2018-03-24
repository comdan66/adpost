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
						<li class="col-xs-4">
							<a href="/?video=new" id="video_new"  v-bind:class="{active:condition.orderField == 'created_at'}" v-on:click="changeOrder('created_at')">最新廣告</a>
						</li>
						<li class="col-xs-4">
							<a href="/?video=views"  id="video_views" v-bind:class="{active:condition.orderField == 'views'}" v-on:click="changeOrder('views')">最多觀看</a>
						</li>
						<li class="col-xs-4">
							<a href="/?video=popular"  id="video_popular" v-bind:class="{active:condition.orderField == 'countPopular'}" v-on:click="changeOrder('countPopular')">最受歡迎</a>
						</li>
					</ul>

				</div>

				<div class="clearfix"></div>

				<div class="part-a-slider">
					<ul class="bxslider">

						@foreach($videoItems as $x)
						<li class="{{ $x['className'] }}">
							<a href="/advertisement/item/{{ $x['id'] }}">
							<div class="pic" style="max-width:100%;">
								<div class="embed-responsive embed-responsive-16by9">
									<iframe id="player2" src="http://www.youtube.com/embed/{{ $x['youtubeID'] }}?rel=0&wmode=Opaque&enablejsapi=1;showinfo=0;controls=1;showinfo=0" frameborder="0" allowfullscreen></iframe>
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
						<li class="col-xs-4" >
							<a href="/?photo=new" id="photo_new"  v-bind:class="{active:condition.orderField == 'created_at'}" v-on:click="changeOrder('created_at')">最新廣告</a>
						</li>
						<li class="col-xs-4" >
							<a href="/?photo=views"  id="photo_views" v-bind:class="{active:condition.orderField == 'views'}" v-on:click="changeOrder('views')">最多觀看</a>
						</li>
						<li class="col-xs-4"  >
							<a href="/?photo=popular"  id="photo_popular" v-bind:class="{active:condition.orderField == 'countPopular'}" v-on:click="changeOrder('countPopular')">最受歡迎</a>
						</li>
					</ul>
				</div>

				<div class="clearfix"></div>

				<div class="part-b-slider">
					<ul class="bxslider">

						<!-- <li v-for="(x,i) of items">
						<a href="#">
						<div class="pic"><img v-bind:src="'/storage/photo/' + x.photo" style="max-width:200px"/>
						</div>
						<p>
						@{{ x.name }}
						</p> </a>
						</li> -->

						@foreach($photoItems as $x)
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

						<!-- <li class="aa">
						<a href="#">
						<div class="pic"><img src="/images/pic1.jpg"/>
						</div>
						<p>
						廣告標題
						</p> </a>

						</li>
						<li>
						<a href="#">
						<div class="pic"><img src="/images/pic2.jpg"/>
						</div>
						<p>
						Three Ways To Get Travel Discoun
						</p> </a>
						</li>
						<li>
						<a href="#">
						<div class="pic"><img src="/images/pic3.jpg"/>
						</div>
						<p>
						The Number 1 Secret Of Success
						</p> </a>
						</li>
						<li>
						<a href="#">
						<div class="pic"><img src="/images/pic4.jpg"/>
						</div>
						<p>
						Computer Hardware Desktops And Notebooks..
						</p> </a>
						</li>
						<li class="aa">
						<a href="#">
						<div class="pic"><img src="/images/pic1.jpg"/>
						</div>
						<p>
						廣告標題
						</p> </a>

						</li>
						<li>
						<a href="#">
						<div class="pic"><img src="/images/pic2.jpg"/>
						</div>
						<p>
						Three Ways To Get Travel Discoun
						</p> </a>
						</li>
						<li>
						<a href="#">
						<div class="pic"><img src="/images/pic3.jpg"/>
						</div>
						<p>
						The Number 1 Secret Of Success
						</p> </a>
						</li>
						<li>
						<a href="#">
						<div class="pic"><img src="/images/pic4.jpg"/>
						</div>
						<p>
						Computer Hardware Desktops And Notebooks..
						</p> </a>
						</li>
						<li class="aa">
						<a href="#">
						<div class="pic"><img src="/images/pic1.jpg"/>
						</div>
						<p>
						廣告標題
						</p> </a>

						</li>
						<li>
						<a href="#">
						<div class="pic"><img src="/images/pic2.jpg"/>
						</div>
						<p>
						Three Ways To Get Travel Discoun
						</p> </a>
						</li>
						<li>
						<a href="#">
						<div class="pic"><img src="/images/pic3.jpg"/>
						</div>
						<p>
						The Number 1 Secret Of Success
						</p> </a>
						</li>
						<li>
						<a href="#">
						<div class="pic"><img src="/images/pic4.jpg"/>
						</div>
						<p>
						Computer Hardware Desktops And Notebooks..
						</p> </a>
						</li> -->

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

	jQuery('#video_' + vueData.video).addClass('active');
	jQuery('#photo_' + vueData.photo).addClass('active');

</script>

@stop
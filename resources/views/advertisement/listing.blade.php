@extends('_layouts/main')

@section('content')

<style>
	.ooo:nth-child(4n+1) {
		clear: left;
	}
	.zzz {
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
	}
</style>

<!--main-area-->
<section id="main-area" v-cloak>
	<div class="kv inter">
		<h2>探索廣告</h2>
	</div>

	<div class="adver-search" id="vue" >
		<div class="container">

			<div class="input-group">
				<input type="text" class="form-control" placeholder="輸入關鍵字" v-model="condition.search.name" v-on:keypress.enter="getList()">
				<span class="input-group-btn"> <a class="btn" v-on:click="getList()"><span class="glyphicon glyphicon-search"></span></a> </span>
			</div><!-- /input-group -->

			<div class="checkbox-group">
				<ul class="col-xs-12 text-center">

					<li class="col-xs-4 col-sm-1" v-for="(x, i) of option.advertisementType"  >

					

						<label class="con-check"  v-bind:for="'checkbox_' + i" >@{{ x }}	<input type="checkbox"  v-bind:id="'checkbox_' + i" v-bind:value="i" v-model="condition.search.typeIDs" style="display:none"  v-on:change="getList()" >
							 <span class="checkmark"></span> </label>
					</li>
				</ul>
			</div><!-- /checkbox-group  -->

		</div>
	</div>

	<div class="adver-result">
		<div class="container">

			<div class="result-text col-xs-12 col-sm-4">
				<!-- <h2>搜尋結果 (16/50)</h2> -->
				<h2>搜尋結果 ( <span>@{{ itemInterval }}</span>/ <span>@{{ totalItem }}</span>)</h2>
			</div>
			<div class="col-xs-12 col-sm-4"></div>
			<div class="item col-sm-4 col-xs-12">
				<ul>
					<li class="col-xs-4">
						<a  v-bind:class="{active:condition.orderField == 'created_at'}" v-on:click="changeOrder('created_at')">最新廣告</a>
					</li>
					<li class="col-xs-4">
						<a v-bind:class="{active:condition.orderField == 'views'}" v-on:click="changeOrder('countViews')">最多觀看</a>
					</li>
					<li class="col-xs-4">
						<a v-bind:class="{active:condition.orderField == 'countPopular'}" v-on:click="changeOrder('countPopular')">最受歡迎</a>
					</li>
				</ul>
			</div>

			<div class="clearfix"></div>

			<div class="adver-group">
				<ul class="row" style="display:block">

					<li class="col-xs-6 col-sm-3 ooo" v-for="(x,i) of items">
						<div class="box">
							<div class="pic">

								<div class="embed-responsive embed-responsive-16by9" v-if="x.postTypeID == 1">
									<iframe  class="yt-item" id="yt2" width="100%" v-bind:src="'http://www.youtube.com/embed/' + x.youtubeID + '?rel=0&wmode=Opaque&enablejsapi=1;showinfo=0;controls=1;showinfo=0'" frameborder="0" allowfullscreen></iframe>
								</div>

								<a v-if="x.postTypeID ==2" v-bind:href="'item/' + x.id"> <div class="embed-responsive embed-responsive-16by9 zzz"  v-bind:style="{backgroundImage: 'url('+uploadUrl+x.photo+')' }" >

								</div> </a>
								<!-- <div style="background-size:cover;width:100%;height:100%;background:position:center;background-repeat: no-repeat"></div> -->
								<!-- <img v-bind:src="uploadUrl + x.photo" v-if="x.postTypeID == 2" style="amx-width:100%;max-height:100px;"> -->

							</div>

							<div class="text">
								<a v-bind:href="'item/' + x.id">
								<p class="JQellipsis">
									@{{ getName(x.name) }}
								</p></a>

								<!--
								<p class="JQellipsis">
								<a v-bind:href="'item/' + x.id"></a>
								</p> -->
								<p class="pull-left">
									<span class="icon-tag"></span>
									<!-- <a href="listing">@{{ option.adType[x.typeID] }}</a> -->
									<a >@{{ option.adType[x.typeID] }}</a>
								</p>
								<p class="pull-right">
									@{{ x.created_at }}
								</p>
								<div class="clearfix"></div>
							</div>
						</div>
					</li>

					<!--
					<li class="col-xs-6 col-sm-3">
					<div class="box">
					<div class="pic">
					<div class="embed-responsive embed-responsive-16by9">
					<iframe class="yt-item" id="yt2" width="100%" src="http://www.youtube.com/embed/erDxb4IkgjM?rel=0&wmode=Opaque&enablejsapi=1;showinfo=0;controls=1;showinfo=0" frameborder="0" allowfullscreen></iframe>
					</div>
					</div>
					<div class="text">
					<p>
					<a href="#">Three Ways To Get Travel Discoun</a>
					</p>
					<p class="pull-left">
					<span class="icon-tag"></span><a href="#">旅遊</a>
					</p>
					<p class="pull-right">
					1 days ago
					</p>
					<div class="clearfix"></div>
					</div>
					</div>
					</li> -->

				</ul>
			</div>
			<div class="clearfix"></div>

			<!-- pagination-->
			<!-- <div class="col-xs-12 text-center visible-xs">
			<a href="#" id="loadMore"><em>載入更多</em></a>
			</div> -->
			<!-- <div class="text-center hidden-xs"> -->
			<div class="text-center ">

				<ul class="pagination pagination-primary">

					<li v-if="condition.page > 1">
						<a v-on:click="prevPage()">&lt;</a>
					</li>

					<li v-if="condition.page > 1" >
						<a href="javascript:void(0);">...</a>
					</li>

					<li v-for="n in pageTotal" v-if="n >= displayPageFrom && n <= displayPageTo" v-bind:class="{active: (n == condition.page)}" v-on:click="changePage(n)">
						<a>@{{ n }}</a>
					</li>

					<li v-if="condition.page < pageTotal">
						<a href="javascript:void(0);">...</a>
					</li>

					<li v-if="condition.page < pageTotal">
						<a v-on:click="nextPage()">&gt;</a>
					</li>

					<!--
					<li>
					<a href="javascript:void(0);">&lt;</a>
					</li>

					<li>
					<a href="javascript:void(0);">1</a>
					</li>
					<li>
					<a href="javascript:void(0);">...</a>
					</li>

					<li>
					<a href="javascript:void(0);">...</a>
					</li>
					<li>
					<a href="javascript:void(0);">12</a>
					</li>

					<li>
					<a href="javascript:void(0);">&gt;</a>
					</li> -->

				</ul>
			</div>

		</div>
	</div>

</section>

@stop

@section('js')

<script>
	vueListData.el = '#main-area';
	vueListData.data.option = vueData.option;
	vueListData.data.condition.search.typeIDs = [];
	vueListData.data.condition.orderField = 'created_at';
	vueListData.data.condition.pageSize = 10;

	// var typeID = getQuery('typeID');
	var typeID = getQueryString('typeID');
	// if (typeID != null && typeID != 'null' && typeID != undefined) {
	if (typeID != null && typeID != 'null' && typeof (typeID) != 'undefined' && typeID != 'undefined') {
		vueListData.data.condition.search.typeIDs.push(typeID);
	}

	// var name = getQuery('name');
	var name = getQueryString('name');
	// alert(name);

	// name = decodeURIComponent(name);

	if (name != null && name != 'null' && typeof (name) != 'undefined' && name != 'undefined') {
		vueListData.data.condition.search.name = name;
	}

	vueListData.methods.getName = function(x) {

		var len = 20;
		var text = x;
		// 超過20個字以"..."取代
		if (x.length > len) {
			text = text.substring(0, len - 1) + "...";
			// $(this).text(text);
		}

		return text;
	}

	vueListData.methods.changeOrder = function(x) {

		this.condition.orderField = x;
		this.condition.orderType = 'desc';
		this.getList();

	}
	var vue = new Vue(vueListData);

</script>

@stop
@extends('_layouts/admin') @section('content')

<style>
</style>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">{{ $pageTitle }}</h1>
	</div>
</div>

<ol class="breadcrumb">

	<li class="breadcrumb-item active">
		{{ $pageTitle }}
	</li>
</ol>

<div id="vue" v-cloak>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">

					<div class="row">
						<div class="col-lg-12">
							<div class="pull-left">

								<a class="btn btn-success" href="update">建立</a> |

								<button class="btn btn-primary" v-on:click="changeMode('waiting')">
									顯示尚未審核廣告
								</button>

							</div>

							<div class="pull-right">
								<select class="form-control inlineBlock itemPerPage" v-model="pageSize">
									<option value="10">10</option>
									<option value="30">30</option>
									<option value="50">50</option>
									<option value="100">100</option>
									<option value="500">500</option>
									<option value="1000">1000</option>
								</select>

							</div>
						</div>
					</div>

				</div>
				<div class="panel-body">

					<div class="fieldWrapper">

						<table class="table table-striped table-bordered table-hover dataTable">

							<thead>
								<tr>
									<!-- <th></th> -->
									<th style="width:80px" class="sortable" v-on:click="changeOrder('id')" orderable>ID</th>
									<th style="width:120px" class="sortable" v-on:click="changeOrder('postTypeID')" orderable>種類</th>
									<th style="width:120px" class="sortable" v-on:click="changeOrder('typeID')" orderable>分類</th>
									<th style="width:auto" class="sortable" v-on:click="changeOrder('name')" orderable>名稱</th>
									<th style="width:100px" class="sortable" v-on:click="changeOrder('user.name')" orderable>會員名稱</th>
									<th style="width:200px" class="sortable" v-on:click="changeOrder('user.email')" orderable>會員Email</th>
									<!-- <th style="width:auto" class="sortable" v-on:click="changeOrder('url')" orderable>網址</th> -->
									<th style="width:60px" class="sortable" v-on:click="changeOrder('countViews')" orderable>瀏覽數</th>
									<th style="width:60px" class="sortable" v-on:click="changeOrder('countComment')" orderable>留言數</th>
									<th style="width:60px" class="sortable" v-on:click="changeOrder('countViews')" orderable>喜歡數</th>
									<th style="width:80px" class="sortable" v-on:click="changeOrder('isActive')" orderable>上架</th>
									<th style="width:80px" class="sortable" v-on:click="changeOrder('isApprove')" orderable>審核</th>
									<th style="width:160px">Functions</th>
								</tr>
								<tr>
									<!-- <th></th> -->

									<th>
									<input ref="searchInput" v-on:keyup.enter="inputSearch()" v-model="search.id" class="form-control" />
									</th>
									<th>
									<select class="form-control" v-model="search.postTypeID">
										<option value="">----</option>
										<option v-for="(item, index) of option.advertisementPost" v-bind:value="index">@{{ item }}</option>
									</select></th>
									<th>
									<select class="form-control" v-model="search.typeID">
										<option value="">----</option>
										<option v-for="(item, index) of option.advertisementType" v-bind:value="index">@{{ item }}</option>
									</select></th>
									<th>
									<input ref="searchInput" v-on:keyup.enter="inputSearch()" v-model="search.name" class="form-control" />
									</th>
									<!-- <th>
									<input ref="searchInput" v-on:keyup.enter="inputSearch()" v-model="search.url" class="form-control" />
									</th>
									-->

									<th>
									<input ref="searchInput" v-on:keyup.enter="inputSearch()" v-model="search.userName" class="form-control" />
									</th>

									<th>
									<input ref="searchInput" v-on:keyup.enter="inputSearch()" v-model="search.userEmail" class="form-control" />
									</th>
									<th> </th>
									<th> </th>
									<th> </th>

									<th>
									<select class="form-control" v-model="search.isActive">
										<option value="">----</option>
										<option v-for="(item, index) of option.is" v-bind:value="index">@{{ item }}</option>
									</select></th>

									<th>
									<select class="form-control" v-model="search.isApprove">
										<option value="all">--所有--</option>
										<option :value="null">--尚未審核--</option>
										<option v-for="(item, index) of option.is" v-bind:value="index">@{{ item }}</option>
									</select></th>

									<th>
									<button @click="getList()" class="btn btn-default">
										SEARCH
									</button></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(item, index) of items">
									<!-- <td><img v-bind:src="uploadUrl + item.photo" /></td> -->
									<td>@{{ item.id }}</td>
									<td>@{{ option.advertisementPost[item.postTypeID] }}</td>
									<td>@{{ option.advertisementType[item.typeID] }}</td>
									<td>@{{ item.name }}</td>
									<!-- <td>@{{ item.url }}</td> -->
									<td>@{{ item.userName }}</td>
									<td>@{{ item.email }}</td>
									<td>@{{ item.countViews }}</td>
									<td><a class="btn btn-success btn-xs" v-bind:href="'../adComment/listing?adID=' + item.id">@{{ item.countComment}}</a></td>
									<td><a class="btn btn-info btn-xs" v-bind:href="'../adLike/listing?adID=' + item.id">@{{ item.countPopular}}</a></td>
									<td>@{{ option.is[item.isActive] }}</td>
									<td>@{{ option.is[item.isApprove] }}</td>
									<td><a class="btn btn-default btn-primary btn-xs" v-bind:href="'update?id=' + item.id"><i class="fa fa-edit"></i> 檢視</a><a class="btn btn-default btn-danger btn-xs" v-on:click="deleteItem(index)" t=""><i class="fa fa-trash"></i> 刪除</a></td>
								</tr>

								<tr v-if="!isFirstTime && items.length <= 0">
									<td colspan="99">@{{ text.notFound }}</td>
								</tr>

							</tbody>
						</table>

						<div class="row listBottomFrame">

							<div class="col-md-12 text-right">
								<ul class="pagination pagination-xs nomargin pagination-custom pageFrame">

									<li v-for="n in pageTotal" v-bind:class="{active: (n == page)}" v-on:click="changePage(n)">
										<a>@{{ n }}</a>
									</li>

								</ul>
							</div>
						</div>

					</div>

				</div>
			</div>

		</div>
	</div>
</div>

@stop @section('js')

<script>
	vueListData.data.search = {
		id : '',
		name : '',
		typeID : '',
		postTypeID : '',
		isActive : '',
		isApprove : 'all',
	};

	vueListData.data.option = vueData.option;

	vueListData.data.orderField = 'advertisement.id';
	vueListData.methods.changeMode = function(x) {

		switch(x) {

		case 'all':
			this.search.id = '';
			this.search.name = '';
			this.search.typeID = '';
			this.search.postTypeID = '';
			this.search.isActive = '';
			this.search.isApprove = null;
			break;

		case 'waiting':
			this.search.id = '';
			this.search.name = '';
			this.search.typeID = '';
			this.search.postTypeID = '';
			this.search.isActive = '';
			this.search.isApprove = null;

			break;

		}
		this.getList();

	}
	// vueListData.data.option = vueData.option;

	var vue = new Vue(vueListData); 
</script>

@stop
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
								<a class="btn btn-success" v-bind:href="'update?userID=' + search.userID">建立</a>
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
									<!-- <th class="sortable" v-on:click="changeOrder('typeID')" orderable>分類</th> -->
									<th style="width:auto" class="sortable" v-on:click="changeOrder('name')" orderable>名稱</th>
									<th style="width:auto" class="sortable" v-on:click="changeOrder('content')" orderable>內容</th>
									<th style="width:160px">Functions</th>
								</tr>
								<tr>

									<th>
									<input ref="searchInput" v-on:keyup.enter="inputSearch()" v-model="search.id" class="form-control" />
									</th>
									<!-- <th>
									<select class="form-control" v-model="search.typeID">
									<option value="">----</option>
									<option v-for="(item, index) of option.teachType" v-bind:value="index">@{{ item }}</option>
									</select></th> -->

									<th>
									<input ref="searchInput" v-on:keyup.enter="inputSearch()" v-model="search.name" class="form-control" />
									</th>

									<th>
									<input ref="searchInput" v-on:keyup.enter="inputSearch()" v-model="search.content" class="form-control" />
									</th>

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
									<td>@{{ item.name }}</td>
									<td>@{{ item.content }}</td>

									<td><!-- <a class="btn btn-default btn-success btn-xs" v-bind:href="'update?id=' + item.id"><i class="fa fa-edit"></i> 訊息</a> --><a class="btn btn-default btn-primary btn-xs" v-bind:href="'update?id=' + item.id"><i class="fa fa-edit"></i> 編輯</a><a class="btn btn-default btn-danger btn-xs" v-on:click="deleteItem(index)" t=""><i class="fa fa-trash"></i> 刪除</a></td>
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
		nameEnglish : '',
		sequence : '',
		typeID : '',
	};

	vueListData.data.option = vueData.option;

	// vueListData.data.option = vueData.option;

	var vue = new Vue(vueListData); 
</script>

@stop
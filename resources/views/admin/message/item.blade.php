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
		<a href="listing">Listing</a>
	</li>

	<li class="breadcrumb-item active">
		{{ $pageTitle }}
	</li>

</ol>

<div id="vue" v-cloak>
	<!-- <input type="hidden" name="id" v-model="item.id" /> -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">

					<div class="row">
						<div class="col-lg-12">
							Detail
						</div>
					</div>

				</div>

				<div class="panel-body">

					<div class="row">

						<div class="col-sm-4 col-xs-12">
							<div class="form-group hide">
								<label>ID</label>
								<input class="form-control" placeholder="" readonly v-model="item.id" />
							</div>

							<!--
							<div class="form-group">
							<label>Email(登入帳號)</label>
							<input class="form-control" placeholder="" v-model="item.email" />

							<select class="form-control" v-model="item.storeID">
							<option v-for="(item, index) of option.store" v-bind:value="index">@{{ item }}</option>
							</select>
							</div>
							-->

							<div class="form-group">
								<label>標題</label>
								<input class="form-control" placeholder="" v-model="item.name" />
							</div>
							<div class="form-group">
								<label>發送對象</label>

								<select class="form-control" v-model="item.roleID">
									<option v-for="(item, index) of option.userRole" v-bind:value="index">@{{ item }}</option>
								</select>
							</div>

						</div>
						<div class="col-sm-8 col-xs-12">

							<div class="form-group hide">
								<label>建立時間</label>
								<input class="form-control" placeholder="" disabled="" v-model="item.created_at" />
							</div>

							<div class="form-group">
								<label>內容</label>
								<textarea class="form-control" placeholder="" style="height:200px" v-model="item.content" ></textarea>
							</div>

							<!--
							<div class="form-group">
							<label>權限</label>
							<select class="form-control" v-model="item.roleID">
							<option v-for="(item, index) of option.role" v-bind:value="index">@{{ item }}</option>
							</select>
							</div> -->

						</div>
					</div>

					<!--
					<div class="row">

					<div class="col-sm-6 col-xs-12">

					<div class="form-group">
					<label>種類</label>

					<select class="form-control" v-model="item._typeID">
					<option v-for="(item, index) of option.type" v-bind:value="index">@{{ item }}</option>
					</select>

					</div>

					</div>
					<div class="col-sm-6 col-xs-12">

					<div class="form-group">
					<label>順序</label>
					<input class="form-control" placeholder="" v-model="item.sequence" />
					</div>

					</div>
					</div> -->
					<div class="row">

					</div>

					<!-- <div class="row">

					<div class="col-sm-12 col-xs-12">
					<div class="form-group">
					<label>商品內文</label>
					<textarea class="form-control" placeholder="" summernote name="content" v-model="item.content" style="height:200px"></textarea>
					</div>
					</div>
					</div> -->

				</div>
				<div class="panel-footer text-center">
					<button class="btn btn-primary" type="button" v-on:click="sendDo()">
						發送
					</button>

					<!-- <a class="btn btn-default " href="listing" type="button"> 返回列表 </a> -->

				</div>

			</div>
		</div>
	</div>

</div>

@stop @section('js')

<script>
	// vueData.selectedHiddenProduct = 0;

	// vueItemData.data.item = vueData.item;
	vueItemData.data.item = {
		name : '',
		content : '',
		roleID : 2,
	};
	vueItemData.data.option = vueData.option;
	vueItemData.methods.sendDo = function() {

		this.$http.post('updateDo', this.item).then(function(r) {
			alert('發送完成');
		});
	};

	var vue = new Vue(vueItemData); 
</script>

@stop
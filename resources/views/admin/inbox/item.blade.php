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

						<div class="col-sm-6 col-xs-12">
							<div class="form-group">
								<label>ID</label>
								<input class="form-control" placeholder="" readonly v-model="item.id" />
							</div>

							<div class="form-group">
								<label>標題</label>
								<input class="form-control" placeholder="" v-model="item.name" />

								<!--
								<select class="form-control" v-model="item.storeID">
								<option v-for="(item, index) of option.store" v-bind:value="index">@{{ item }}</option>
								</select> -->
							</div>

							<div class="form-group">
								<label>內容</label>
								<textarea class="form-control" placeholder="" v-model="item.content" ></textarea>								


							</div>

						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="form-group">
								<label>建立時間</label>
								<input class="form-control" placeholder="" disabled="" v-model="item.created_at" />
							</div>

						</div>
					</div>

				</div>
				<div class="panel-footer text-center">
					<button class="btn btn-primary" type="button" v-on:click="saveDo()">
						儲存
					</button>

					<a class="btn btn-default " v-bind:href="'listing?userID=' + item.userID" type="button"> 返回列表 </a>

				</div>

			</div>
		</div>
	</div>

</div>

@stop @section('js')

<script>
	// vueData.selectedHiddenProduct = 0;

	vueItemData.data.item = vueData.item;
	vueItemData.data.option = vueData.option;

	var vue = new Vue(vueItemData); 
</script>

@stop
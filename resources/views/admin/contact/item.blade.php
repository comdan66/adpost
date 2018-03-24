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
								<label>名稱</label>
								<input class="form-control" placeholder="" v-model="item.name" disabled/>

								<!--
								<select class="form-control" v-model="item.storeID">
								<option v-for="(item, index) of option.store" v-bind:value="index">@{{ item }}</option>
								</select> -->
							</div>

							<div class="form-group">
								<label>電話</label>
								<input class="form-control" placeholder="" v-model="item.phone" disabled/>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" placeholder="" v-model="item.email" disabled/>
							</div>

							<div class="form-group">
								<label>附件</label>
								<div class="form-control">
									<a v-bind:href="'/storage/photo/' + item.file" target="_blank">檔案下載</a>
								</div>
							</div>

						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="form-group">
								<label>建立時間</label>
								<input class="form-control" placeholder="" disabled="" v-model="item.created_at" />
							</div>

							<!-- <div class="form-group">
							<label>是否讀取</label>

							<select class="form-control" v-model="item.isRead">
							<option v-for="(item, index) of option.is" v-bind:value="index">@{{ item }}</option>
							</select>
							</div>

							<div class="form-group">
							<label>是否聯繫</label>

							<select class="form-control" v-model="item.isContact">
							<option v-for="(item, index) of option.is" v-bind:value="index">@{{ item }}</option>
							</select>
							</div> -->

							<div class="form-group">
								<label>訊息</label>
								<div class="form-control wordBreak" style="height:auto" v-html="item.content" disabled></div>

							</div>

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

					<!--
					<div class="row">

					<div class="col-md-12">

					<label>
					<button type="button" class="btn btn-primary buttonFileUpload" onclick="uploadPhotoType='more';$('#formFileUpload input[type=file]').click()">
					<span><i class="fa fa-plus"></i> 上傳照片</span>
					</button> </label>

					</div>

					</div>

					<div class="row">
					<div class="col-md-2">
					主照片
					<div>
					<input type="hidden" v-model="item.photo">
					<img v-bind:src="uploadUrl + item.photo" class="photoMain" onerror="$(this).hide();" onload="$(this).show()" />

					</div>

					</div>
					<div class="col-md-10">
					照片
					<div class="form-group">

					<div id="photoMore">
					<div class="col-md-2 photoMoreFrame" v-for="(item, index) in item.photoJson" v-bind:key="item" v-on:remove="item.photoJson.splice(index, 1)">
					<img class="photoJsonImg pointer" v-bind:src="uploadUrl + item.photo" v-on:click="setMainPhoto(index)">

					<div class="text-right">
					<button class="btn btn-default btn-xs" type="button" v-on:click="removePhotoJson(index)">
					<i class="fa fa-trash"></i>
					</button>
					</div>

					</div>
					</div>

					</div>

					</div>

					</div> -->

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
					<!-- <button class="btn btn-primary" type="button" v-on:click="saveDo()">
					儲存
					</button> -->
					<a class="btn btn-default " href="listing" type="button"> 返回列表 </a>

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
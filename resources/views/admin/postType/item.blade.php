@extends('_layouts/admin')

@section('content')

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

						<div class="col-sm-3 col-xs-12">
							<div class="form-group">
								<label>ID</label>
								<input class="form-control" placeholder="" readonly v-model="item.id" />
							</div>

							<div class="form-group">
								<label>名稱</label>
								<input class="form-control" placeholder="" v-model="item.name"  />
							</div>

						</div>
						<div class="col-sm-9 col-xs-12">

						</div>
					</div>
				</div>

				<div class="panel-footer text-center">
					<button class="btn btn-primary" type="button" v-on:click="saveDo()">
						儲存
					</button>

					<a class="btn btn-default " href="listing" type="button"> 返回列表 </a>

				</div>

			</div>
		</div>
	</div>

</div>

@stop

@section('js')

<script>
	// vueData.selectedHiddenProduct = 0;

	// vueData.item.content = {
	// brief : '',
	// items : [],
	// };

	// vueData.item.content = {
	// videoTitle : '',
	// videoBrief : '',
	// photoTitle : '',
	// photoBrief : '',
	// photoJson: [],	// }
	//
	// vueData.item.content = {
	// companyName:'asdadasd',
	// companyAddressText:'asdadasd',
	// }
	//

	vueItemData.data.item = vueData.item;

	/*
	 vueItemData.methods.uploadFile = function(event, key) {

	 var files = event.target.files;

	 var self = this;

	 console.log(files);

	 //single file veriosn
	 if (files.length > 0) {
	 var file = files[0];
	 var reader = new FileReader();
	 reader.onload = function() {
	 var data = new FormData();
	 // data.append('file', event.target.files);
	 data.append('file', files[0]);
	 self.$http.post('/admin/_helper/uploadFile', data).then(function(r) {
	 log(r);

	 self.item.content.photoJson[key] = r.body.fileName;
	 });

	 };
	 reader.onerror = function() {
	 };
	 reader.readAsDataURL(file);

	 }

	 }*/

	vueItemData.methods.addBrief = function() {
		this.item.content.items.push({
			brief : '',
			photo : ''
		});
	}

	vueItemData.methods.removeBrief = function(i) {

		this.item.content.items.splice(i, 1);

	};

	vueItemData.methods.uploadFile = function(event, key) {
		var self = this;
		var files = event.target.files;

		//single file veriosn
		if (files.length > 0) {
			var file = files[0];
			var reader = new FileReader();
			reader.onload = function() {
				var data = new FormData();
				// data.append('file', event.target.files);
				data.append('file', files[0]);
				self.$http.post('/admin/_helper/uploadFile', data).then(function(r) {
					// alert(key);
					self.item.content.items[key].photo = r.body.fileName;
				});
			};
			reader.onerror = function() {
			};
			reader.readAsDataURL(file);
		}
	};

	vueItemData.methods.uploadFiles = function(event, key) {
		// var self = this;
		var files = event.target.files;
		if (files.length > 0) {
			var data = new FormData();
			for (var i = 0; i < files.length; i++) {
				data.append('files[]', files[i]);
			}
			// window.alert(key);
			this.$http.post('/admin/_helper/uploadFiles', data).then(function(r) {
				// console.log(r);
				for (var i in r.body) {

					var x = r.body[i];
					var a = {
						photo : x.fileName
					};
					// this.item[key].push(x.fileName);

					this.item.content[key] = [];
					this.item.content[key].push(x.fileName);

				}

			});

		}

	}
	// vueItemData.data.option = vueData.option;

	var vue = new Vue(vueItemData); 
</script>

@stop
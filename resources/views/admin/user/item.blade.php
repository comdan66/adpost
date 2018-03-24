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
								<input class="form-control" placeholder="" v-model="item.name" />

								<!--
								<select class="form-control" v-model="item.storeID">
								<option v-for="(item, index) of option.store" v-bind:value="index">@{{ item }}</option>
								</select> -->
							</div>

							<div class="form-group">
								<label>Email</label>
								<input class="form-control" placeholder="" v-model="item.email" />

							</div>

							<div class="form-group">
								<label>聯絡窗口</label>
								<input class="form-control" placeholder="" v-model="item.contact" />

							</div>

							<div class="form-group">
								<label>生日</label>
								<br>

								<input type="date" class="form-control" placeholder="" v-model="item.birthday" />

							</div>
							<div class="form-group">
								<label>性別</label>

								<select class="form-control" v-model="item.genderID">
									<option v-bind:value="null">----</option>
									<option v-for="(item, index) of option.gender" v-bind:value="index">@{{ item}}</option>
								</select>

							</div>

							<div class="form-group">
								<label>會員身分</label>
								<select class="form-control" v-model="item.roleID">

									<option v-for="(item, index) of option.userRole" v-bind:value="index">@{{ item}}</option>
								</select>

							</div>

						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="form-group">
								<label>建立時間</label>
								<input class="form-control" placeholder="" disabled="" v-model="item.created_at" />
							</div>
							<div class="form-group">
								<label>公司名稱</label>
								<input class="form-control" placeholder=""   v-model="item.companyName" />
							</div>

							<div class="form-group">
								<label>公司網站</label>
								<input class="form-control" placeholder=""   v-model="item.companyUrl" />
							</div>

							<div class="form-group">
								<label>公司電話</label>
								<!-- <input class="form-control" placeholder=""   v-model="item.companyPhone" /> -->
								<input class="form-control" placeholder=""   v-model="item.phone" />
							</div>

							<div class="form-group">
								<label>統一編號</label>
								<input class="form-control" placeholder=""   v-model="item.companyNumber" />
							</div>

							<div class="form-group">
								<label for="isActive">公司地址</label>
								<div class="row">

									<div class="col-md-6">
										<select class="form-control" v-model="item.cityID">
											<option v-for="(city, cityIndex) of option.city" v-bind:value="cityIndex">@{{ city.name }}</option>
										</select>
									</div>
									<div class="col-md-6">
										<select class="form-control" v-model="item.areaID">
											<option v-for="(area, areaIndex) of getCityAreas()" v-bind:value="areaIndex">@{{ area.name }}</option>
										</select>
									</div>
								</div>
								<div class="row" style="margin-top:10px">
									<div class="col-md-12">
										<input class="form-control" placeholder=""   v-model="item.address" placeholder="地址" />
									</div>
								</div>
							</div>

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

@stop @section('js')

<script>
	// vueData.selectedHiddenProduct = 0;

	vueItemData.data.item = vueData.item;
	vueItemData.data.option = vueData.option;

	vueItemData.methods.getCityAreas = function() {
		try {
			return this.option.city[this.item.cityID].areas;
		} catch(e) {
			return [];
		}
	};

	var vue = new Vue(vueItemData); 
</script>

@stop
@extends('_layouts/main')

@section('content')

<div class="container" id="vue">
	<div class="row">

		<div class="col-md-10 col-xs-12" style="float:none;margin:auto">

			<div class="row">

				<div class="col-md-4 col-xs-12 ">
					<div class=" labelStep ">
						Step1. 選擇付款方式
					</div>
				</div>
				<div class="col-md-4 col-xs-12 ">
					<div class=" labelStep active">
						Step2. 填寫訂單資料
					</div>
				</div>
				<div class="col-md-4 col-xs-12 ">
					<div class=" labelStep ">
						Step3. 完成訂購
					</div>
				</div>

			</div>

		</div>

	</div>

	<div style="height:40px"></div>

	<div class="row">
		<div class="col-md-12">
			<div class="frameTitle">
				您的會員等級為:
			</div>
			<span class="labelGreen">A-會員(享85折優惠)</span>
		</div>
	</div>

	<hr>

	<div style="height:10px"></div>

	<div class="row">
		<div class="col-md-12">
			<div class="frameTitle">
				訂單內容:
			</div>
		</div>

		<div class="">

			<div class="col-md-4">
				<div class="tableTitle">
					商品名稱
				</div>
				<div class="labelGreen">
					{{ $item['name'] }}
				</div>
			</div>

			<div class="col-md-2">
				<div class="tableTitle">
					場次
				</div>
				<div class="labelGreen">
					{{ $item['date'] }} - {{ $item['timeText'] }}
				</div>
			</div>

			<div class="col-md-3">
				<div class="tableTitle">
					定價：
				</div>
				<div class="labelGreen">
					網路價: ${{ $item['priceInternet'] }}  A+會員價: ${{ $item['priceUser'] }}
				</div>
			</div>
			<div class="col-md-1">
				<div class="tableTitle">
					參加人數：
				</div>
				<div class="labelGreen">
					{{ $countPerson }}
				</div>
			</div>
			<div class="col-md-2">
				<div class="tableTitle">
					小計：
				</div>
				<div class="labelGrey">
					<span class=""> A+會員價: ${{ $sum }}</span>
				</div>
			</div>

		</div>

	</div>

	<hr>

	<div style="height:10px"></div>

	<div class="row">
		<div class="col-md-12 text-right sum">
			合計: ${{ $sum }}元

		</div>
	</div>

	<hr>

	<div style="height:10px"></div>

	<div class="row">
		<div class="col-md-12">
			<div class="frameTitle">
				訂購人資源:
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-2">
			<div class="labelGrey">
				中文全名
			</div>
		</div>

		<div class="col-md-3">
			<input type="text" class="form-control"  v-model="name" />
		</div>

		<div class="col-md-3">
			<label style="margin-right:10px">
				<input type="radio" value="1" v-model="titleTypeID" />
				先生</label>

			<label>
				<input type="radio" value="2" v-model="titleTypeID" />
				小姐</label>
		</div>

	</div>

	<div class="row">

		<div class="col-md-2">
			<div class="labelGrey">
				手機號碼
			</div>
		</div>

		<div class="col-md-3">
			<input type="text" class="form-control"  v-model="phone"  />
		</div>

	</div>

	<div class="row">

		<div class="col-md-2">
			<div class="labelGrey">
				聯絡地址
			</div>
		</div>

		<div class="col-md-10" >

			<div hidden>
				<select class="form-control inlineBlock " style="width:120px" >

					<option >(郵遞區號)</option>
					<option >asdad</option>
					<option >asdad</option>
					<option >asdad</option>
					<option >asdad</option>
				</select>
			</div>

			<input type="text" class="form-control" v-model="addressText" />
			※ 地址請勿填寫郵政信箱

		</div>

	</div>

	<div class="row">

		<div class="col-md-2">

		</div>

		<div class="col-md-6">
			<!-- <input type="text" class="form-control" /> -->
		</div>

	</div>

	<hr>

	<div class="row">
		<div class="col-md-12">
			<div class="frameTitle">
				發票資訊:
			</div>

		</div>

		<div class="col-md-12">

			<label style="margin-right:30px">
				<input type="radio" v-model="receiptTypeID" value="1" />
				二聯式電子發票</label>

			<label style="margin-right:30px">
				<input type="radio" v-model="receiptTypeID" value="2"/>
				二聯式捐贈發票</label>

			<label>
				<input type="radio" v-model="receiptTypeID" value="3" />
				三聯式紙本發票(公司行號報帳用)</label>

		</div>

		<div class="col-md-12" v-if="receiptTypeID == 3">

			<div style="height:20px"></div>
			<div class="row">
				<div class="col-md-2">
					<div class="labelGrey">
						公司抬頭
					</div>
				</div>

				<div class="col-md-3">
					<input type="text" class="form-control"  v-model="companyTitle"  />
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div class="labelGrey">
						公司統編
					</div>
				</div>

				<div class="col-md-3">
					<input type="text" class="form-control"  v-model="companyCode"  />
				</div>
			</div>

		</div>
		<div class="col-md-12 ">

			<div style="height:10px"></div>

			<div class="labelGrey" style="padding:20px">
				※ 若您持有手機載具，請【 點選填寫 】載具條碼。 手機載具說明
				<br>
				※ 依統一發票使用辦法規定：個人戶（二聯式）發票一經開立，不得任意更改為公司戶（三聯式）發票。
				<br>

				核准文號：北區國稅北市三字第999999999999號，電子發票說明
			</div>

		</div>

	</div>

	<div style="height:30px"></div>

	<div class="row">
		<div class="col-md-12 text-center">

			<a  v-on:click="prevDo()" class="btn btn-grey" style="margin-right:20px"> 回上一頁 </a>
			<!-- <a href="/event/bookStep1/123" class="btn btn-grey" style="margin-right:20px"> 回上一頁 </a> -->

			<!-- <a href="/event/bookStep3/123" class="btn btn-red"> 前往下一頁‣ </a> -->

			<a v-on:click="nextDo()" class="btn btn-red"> 前往下一頁‣ </a>

		</div>
	</div>

</div>

@stop

@section('js')

<script>
	var vue = new Vue({
		el : '#vue',

		data : {
			countPerson : vueData.countPerson,
			price : vueData.price,
			eventID : vueData.eventID,
			date : vueData.date,
			receiptTypeID : 1,
			name : '',
			phone : '',
			addressZip : '',
			addressText : '',
			companyTitle : '',
			companyCode : '',
			titleTypeID : 1,
		},
		methods : {
			prevDo : function() {
				document.location = '/event/bookStep1/' + this.eventID + '/' + this.date + '/' + this.countPerson;

			},
			nextDo : function() {

				var isOK = true;
				var message = '';
				if (!this.name) {
					isOK = false;
					message += '請輸入姓名\n';
				}

				if (!this.phone) {
					isOK = false;
					message += '請輸入手機號碼\n';
				}

				if (!this.addressText) {
					isOK = false;
					message += '請輸入聯絡地址\n';
				}

				if (isOK) {
					//send post

					var url = '/event/bookDo';
					this.$http.post(url, this._data).then(function(r) {

						if (r.body) {
							document.location = '/event/bookStep3/' + this.eventID + '/' + this.date + '/' + this.countPerson;
						} else {
						}

					});

				} else {

					alert(message);

				}

				// if (this.countPerson <= 0 || this.countPerson > 5) {
				//
				// alert('參加人數必須1~5人之間');
				//
				// } else {
				// document.location = '/event/bookStep2/' + this.eventID + '/' + this.date + '/' + this.countPerson;
				// }
			}
		},
		computed : {
			total : function() {

				var total = this.price * this.countPerson;

				return total;
			},

			sum : function() {

				var sum = this.price * this.countPerson;

				return sum;
			}
		}
	});

</script>

@stop

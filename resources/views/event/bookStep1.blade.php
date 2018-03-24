@extends('_layouts/main')

@section('content')

<div class="container" id="vue">
	<div class="row">

		<div class="col-md-10 col-xs-12" style="float:none;margin:auto">

			<div class="row">

				<div class="col-md-4 col-xs-12 ">
					<div class=" labelStep active">
						Step1. 選擇付款方式
					</div>
				</div>
				<div class="col-md-4 col-xs-12 ">
					<div class=" labelStep ">
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
				付款方式:
			</div>
			<span class="labelGreen">
				<input type="radio" checked/>
				ATM轉帳或匯款</span>

			<span class="labelGrey">使用ATM轉帳或銀行（郵局）匯款，匯款轉帳手續費為自行負擔。</span>

		</div>
	</div>

	<hr>

	<div style="height:10px"></div>

	<div class="row">
		<div class="col-md-12">
			<div class="frameTitle">
				轉帳帳戶:
			</div>

			<div class="labelGrey">
				中國信託銀行新莊分行
				<br>
				帳戶：台北市專業秘書暨行政人員協會
				<br>
				帳號：2990000999900
			</div>

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
					{{ $item['name']}}
				</div>
			</div>

			<div class="col-md-2">
				<div class="tableTitle">
					場次
				</div>
				<div class="labelGreen">
					{{ $date }} - {{ $item['timeText']}}
				</div>
			</div>

			<div class="col-md-3">
				<div class="tableTitle">
					定價：
				</div>
				<div class="labelGreen">
					網路價: ${{ $item['priceInternet']}}  A+會員價: ${{ $item['priceUser']}}
				</div>
			</div>
			<div class="col-md-1">
				<div class="tableTitle">
					參加人數：
				</div>
				<input type="number" min="1" max="5" class="form-control" v-model="countPerson" />
			</div>
			<div class="col-md-2">
				<div class="tableTitle">
					小計：
				</div>
				<div class="labelGrey">
					$<span>@{{ sum }}</span>
					<!-- <span class="pull-left"> A+會員價: $850</span> -->
					<!-- <img class="pull-right" src="/img/trash.png"> -->
				</div>
			</div>

		</div>

	</div>

	<hr>

	<div style="height:10px"></div>

	<div class="row">
		<div class="col-md-12 text-right sum">
			合計: $
			@{{ total }}
			元

		</div>
	</div>

	<div style="height:30px"></div>

	<div class="row">
		<div class="col-md-12 text-center">

			<a href="/" class="btn btn-grey" style="margin-right:20px"> 暫不訂購回首頁 </a>
			<!-- <a href="/event/bookStep2/123" class="btn btn-red"> 前往下一頁‣ </a> -->
			<a v-on:click="nextDo()" class="btn btn-red"> 前往下一頁‣ </a>

		</div>
	</div>

</div>

<hr>

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
		},
		methods : {
			nextDo : function() {

				if (this.countPerson <= 0 || this.countPerson > 5) {

					alert('參加人數必須1~5人之間');

				} else {
					document.location = '/event/bookStep2/' + this.eventID + '/' + this.date + '/' + this.countPerson;
				}
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
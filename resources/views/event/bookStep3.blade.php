@extends('_layouts/main')

@section('content')

<div class="container">
	<div class="row">

		<div class="col-md-10 col-xs-12" style="float:none;margin:auto">

			<div class="row">

				<div class="col-md-4 col-xs-12 ">
					<div class=" labelStep ">
						Step1. 選擇付款方式
					</div>
				</div>
				<div class="col-md-4 col-xs-12 ">
					<div class=" labelStep ">
						Step2. 填寫訂單資料
					</div>
				</div>
				<div class="col-md-4 col-xs-12 ">
					<div class=" labelStep active">
						Step3. 完成訂購
					</div>
				</div>

			</div>

		</div>

	</div>

	<div style="height:40px"></div>

	<div class="row">
		<div class="col-md-12">

			<div style="font-size:16px;">
				戴家昇會員您好：感謝您的訂購 ! 您已完成商品訂購，以下為訂單資訊：
			</div>
		</div>

	</div>

	<div style="height:20px"></div>

	<div class="row">
		<div class="col-md-12">
			<div class="frameTitle">
				訂單編號: {{ $eventAttend['code'] }}
			</div>
		</div>
	</div>

	<hr>

	<div style="height:10px"></div>

	<div class="row">
		<!-- <div class="col-md-12">
		<div class="frameTitle">
		訂單內容:
		</div>
		</div> -->

		<div class="">

			<div class="col-md-4">
				<div class="tableTitle">
					商品名稱
				</div>
				<div class="">
					{{ $event['name'] }}
				</div>
			</div>

			<div class="col-md-2">
				<div class="tableTitle">
					場次
				</div>
				<div class="">
					{{ $eventAttend['date'] }} - {{ $event['timeText'] }}
				</div>
			</div>

			<div class="col-md-3">
				<div class="tableTitle">
					定價：
				</div>
				<div class="">
					<!-- 網路價: $900  A+會員價: $850 -->
					${{ $eventAttend['priceOrigin'] }}
				</div>

			</div>
			<div class="col-md-1">
				<div class="tableTitle">
					參加人數：
				</div>
				<div class="">
					{{ $eventAttend['countPerson'] }}
				</div>
			</div>
			<div class="col-md-2">
				<div class="tableTitle">
					小計：
				</div>
				<div class="">
					<!-- <span class=""> A+會員價: $850</span> -->
					<span class=""> A+會員價: ${{ $eventAttend['sum'] }}</span>
				</div>
			</div>

		</div>

	</div>

	<hr>

	<div style="height:10px"></div>

	<div class="row">
		<div class="col-md-12 text-right sum">
			合計: ${{ $eventAttend['price'] }}元

		</div>
	</div>

	<!-- <hr> -->

	<div style="height:20px"></div>

	<div class="row">
		<div class="col-md-12 ">

			<div style="border:1px #bbb solid; padding:20px">
				付款方式：ATM轉帳或匯款
				<br>
				付款人：{{ $eventAttend['name'] }}
				<br>
				發票類型：{{ $receiptType }}
				<br>
				<br>
				* 並請於3日之內，轉帳或匯入：
				<br>
				中國信託銀行新莊分行
				<br>
				帳戶：台北市專業秘書暨行政人員協會
				<br>
				帳號：2990000999900
			</div>
		</div>
	</div>

	<div style="height:30px"></div>

	<div class="row">
		<div class="col-md-12">
			<div class="labelGrey" style="padding:20px">

				<b>注意事項：</b>

				<br>
				• 範例文, 當您收到送貨簡訊通知時！
				<br>
				• 範例文, 請於7日內宅配至收件人，若沒有簽名收件日後將無法再使用信用卡付款服務！
				<br>
				• 範例文, 取貨時請確認送貨人員您的姓名，付款前請再次確認包裹上的收件人資料，若您遺忘本次訂購人姓名，
				<br>
				* 煩請至TPSAA - 台北市專業秘書暨行政人員協會 網站「訂單查詢」中確認。
			</div>

		</div>

	</div>

	<div style="height:30px"></div>

	<div class="row">
		<div class="col-md-12 text-center">

			<a href="/" class="btn btn-grey" style="background:#666; color:#fff;"> 回首頁 </a>

		</div>
	</div>

</div>

@stop

@section('js')

<script></script>

@stop

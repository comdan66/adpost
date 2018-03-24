@extends('_layouts/main')

@section('content')

<style>
	.sideNews {
		list-style-type: none;
		margin-left: 0;
		padding-left: 0;
	}
	.sideNews li {
		margin-bottom: 20px;
		padding-bottom: 5px;
		border-bottom: 1px #ccc solid;
	}

	.dateSquare {
		color: #fff;
		background: #990000;
		padding: 30px;
		text-align: center;
	}
	.description {
		color: #777;
	}
</style>
<div class="container">

	<div class="row">

		<div class="col-md-12">
			<h3>近期活動 Event Update</h3>

			<div class="redLine"></div>

		</div>
	</div>

	<div class="row">

		<div class="col-md-9">

			<!-- <img src="/img/u0.jpg" class="w100" /> -->
			<img src="/storage/photo/{{ $item['photo'] }}" class="w100" />

			<div style="height:20px"></div>
			<!-- <div class="row">

			<div class="col-md-2 ">
			<div class="dateSquare">
			20 九月
			</div>
			</div>

			<div class="col-md-10 ">
			<h3> 2017 TPSAA進階班 - AI來襲 秘書行政全面升級啟動，這是危機還是轉機？三大領域專家，將與我們分享！ </h3>
			</div>

			</div> -->

			<div>

				時間：{{ $item['timeText'] }}
				<br>

				地點：{{ $item['addressText'] }}
				<br>

				定價：網路價 ${{ $item['priceInternet'] }} / A+會員價 ${{ $item['priceUser'] }}
			</div>
			<div style="height:10px"></div>

			<div class="row">

				<div class="col-md-6 ">

				</div>

				<div class="col-md-6 text-right ">
					瀏覽數: {{ $item['countViews'] }}
				</div>

				<div class="col-md-2 "></div>

			</div>

			<div style="height:30px"></div>

			<div class="row">

				<div class="col-md-12  ">

					活動:
				</div>

				<div class="col-md-12  ">

					<h3> {{ $item['name'] }} </h3>

					<div class="redLine"></div>

					<div class="description">
						{!! nl2br($item['content']) !!}

					</div>

					<div style="height:20px"></div>

					<div>
						地圖:
					</div>
					<div style="height:10px"></div>
					<div class="  ">

						<!-- <iframe id=" " scrolling="auto" frameborder="1"  style="width:100%;height:400px;border:none" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14458.866147695233!2d121.5606419!3d25.0436921!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc82b0f87ff7df9dc!2z5p2-5bGx5paH5Ym15ZyS5Y2A!5e0!3m2!1szh-TW!2stw!4v1503146370779"></iframe> -->

		<iframe id=" " scrolling="auto" frameborder="1"  style="width:100%;height:400px;border:none" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDYVYmNOAijStawCm1fyk0gaan8KVU9TYY&q={{ $item['addressText'] }}"></iframe>
 
    
					</div>

				</div>
			</div>

		</div>

		<div class="col-md-3">

			<div style="border:1px #aaa solid;padding:20px 15px;">

				選擇活動日期

				<div style="height:10px"></div>

				@foreach($item['dateJson'] as $x)

				<label>
					<input type="radio" name="date" value="{{ $x }}" />
					{{ $x }}</label>

				<br>

				@endforeach
				<!--

				<label>
				<input type="radio" />
				2017/5/2</label>
				<br>

				<label>
				<input type="radio" />
				2017/5/3</label>

				<hr> -->

				選擇參加人數: (尚餘5人)

				<div style="height:10px"></div>

				<select class="form-control" id="person">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>

				<div style="height:15px"></div>

				網路價: ${{ $item['priceInternet'] }}
				<br>

				A+會員價: ${{ $item['priceUser'] }}

				<div style="height:20px"></div>

				<!-- <a class="w100 btn btn-red" href="/event/bookStep1/{{ $item['id'] }}"> 確認 </a> -->
				<a class="w100 btn btn-red" onclick="confirmDo()"> 確認 </a>

			</div>
			<div style="height:15px"></div>

		</div>

	</div>
</div>

@stop

@section('js')

{{ printJson('id', $item['id']) }}

<script>
	function confirmDo() {

		if ($('*[name=date]:checked').length <= 0) {
			alert('請選擇日期');
		} else {

			var date = $('*[name=date]:checked').val();
			var person = $('#person').val();

			document.location = '/event/bookStep1/' + id + '/' + date + '/' + person;

		}

	}

</script>

@stop
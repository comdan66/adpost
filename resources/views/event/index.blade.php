@extends('_layouts/main')

@section('content')

<style>
	.headerSpace {
		height: 80px;
	}

</style>

<div class="text-center" style="background:url(/img/u131.jpg) center no-repeat;background-size:cover;width:100%;padding-top:80px; padding-bottom:60px; ">

	<h2>近期活動</h2>
	<h3>Event Updates</h3>

</div>

<div style="height:60px"></div>

<div class="container">

	@foreach($items as $x)

	@if($x['sideID'] == 1)
	<div class="row featurette">
		<div class="col-md-7 col-md-push-5">
			<h2 class="">{{ $x['name'] }}</h2>

			<h4>時間：{{ $x['timeText'] }}</h4>
			<h4>地點：{{ $x['addressText'] }}</h4>
			<p class="lead">
				{{ $x['content'] }}
			</p>

			<a class="btn btn-red" href="/event/item/{{ $x['id'] }}"> 詳細內容 </a>

		</div>
		<div class="col-md-5 col-md-pull-7">
			<img class="featurette-image img-responsive center-block w100" src="/storage/photo/{{ $x['photo'] }}" alt="Generic placeholder image">
		</div>
	</div>

	@else

	<div class="row featurette">
		<div class="col-md-7 ">
			<h2 class="">{{ $x['name'] }}</h2>

			<h4>時間：{{ $x['timeText'] }}</h4>
			<h4>地點：{{ $x['addressText'] }}</h4>

			<p class="lead">
				{{ $x['content'] }}
			</p>

			<a class="btn btn-red" href="/event/item/{{ $x['id'] }}"> 詳細內容 </a>

		</div>
		<div class="col-md-5 ">
			<img class="featurette-image img-responsive center-block w100" src="/storage/photo/{{ $x['photo'] }}" alt="Generic placeholder image">
		</div>
	</div>
	@endif

	<hr class="featurette-divider">

	@endforeach
	<!--
	<div class="row featurette">
	<div class="col-md-7 col-md-push-5">
	<h2 class="">2017 TPSAA進階班 - AI來襲 秘書行政全面升級啟動</h2>

	<h4>時間：5/1/2017 - 上午10:30 ~ 下午2:00</h4>
	<h4>地點：110台北市信義區光復南路133號，松菸文創園區</h4>
	<p class="lead">
	面對強大的人工智慧浪潮，新一波的職場革命即將啟動，而這是危機還是轉機？三大領域專家，將與我們分享，如何立足於秘書行政職務4.0時代的新職場。而這是危機還是轉機？三大領域專家，將與我們分享，如何立足於秘書行政職務4.0時代的新職場...
	</p>

	<a class="btn btn-red" href="/event/item/123"> 詳細內容 </a>

	</div>
	<div class="col-md-5 col-md-pull-7">
	<img class="featurette-image img-responsive center-block" src="/img/u126.jpg" alt="Generic placeholder image">
	</div>
	</div>

	<hr class="featurette-divider">

	<div class="row featurette">
	<div class="col-md-7 ">
	<h2 class="">2017 TPSAA進階班 - AI來襲 秘書行政全面升級啟動</h2>

	<h4>時間：5/1/2017 - 上午10:30 ~ 下午2:00</h4>
	<h4>地點：110台北市信義區光復南路133號，松菸文創園區</h4>

	<p class="lead">
	面對強大的人工智慧浪潮，新一波的職場革命即將啟動，而這是危機還是轉機？三大領域專家，將與我們分享，如何立足於秘書行政職務4.0時代的新職場。而這是危機還是轉機？三大領域專家，將與我們分享，如何立足於秘書行政職務4.0時代的新職場...
	</p>
	<a class="btn btn-red" href="/event/item/123"> 詳細內容 </a>

	</div>
	<div class="col-md-5 ">
	<img class="featurette-image img-responsive center-block" src="/img/u126.jpg" alt="Generic placeholder image">
	</div>
	</div>

	<hr class="featurette-divider"> -->

</div>

@stop @section('js')

<script></script>

@stop
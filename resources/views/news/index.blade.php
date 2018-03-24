@extends('_layouts/main')

@section('content')

<style>
	.dateSquare {
		color: #aaa;
	}

	.newsItem {
		margin-bottom: 30px;
	}

	.newsItem:nth-child(2n+1) {
		clear: left;
	}

</style>
<div class="container">

	<div class="row">

		<div class="col-md-12">
			<h3>最新消息 News Update</h3>

			<div class="redLine"></div>

		</div>
	</div>

	<div class="row">

		@foreach($items as $x)
		<div class="col-md-6 newsItem">

			<div class="row">

				<div class="col-md-12 ">

					<a href="/news/item/{{ $x['id'] }}" class="newsButton w100" style="border:none" > <!-- <img class="featurette-image img-responsive w100" src="/img/u135.jpg" alt="Generic placeholder image"> --> <img class="featurette-image img-responsive w100" src="/storage/photo/{{ $x['photo'] }}" alt="Generic placeholder image"> </a>

				</div>
			</div>
			<div style="height:20px"></div>
			<div class="row">

				<!-- <div class="col-md-2 ">
				<div class="dateSquare">
				20 九月
				</div>
				</div>
				-->

				<div class="col-md-12 ">
					<h3> {{ $x['name'] }}</h3>
				</div>

			</div>
			<div style="height:10px"></div>
			<div class="row">
				<div class="col-md-12 " style="color:#666">
					{{ $x['content'] }}
				</div>

			</div>

			<div style="height:10px">

			</div>
			<div class="row">

				<div class="col-md-5 " >

					<a href="/news/item/{{ $x['id'] }}" class="newsButton w100" > 詳細內容 </a>
				</div>

				<div class="col-md-7 " >
					瀏覽數: 	{{ $x['countViews'] }}
				</div>

			</div>

		</div>

		@endforeach

		<!--
		<div class="col-md-6 newsItem">

		<div class="row">

		<div class="col-md-12 ">

		<img class="featurette-image img-responsive w100" src="/img/u135.jpg" alt="Generic placeholder image">

		</div>
		</div>
		<div style="height:20px"></div>
		<div class="row">

		<div class="col-md-2 ">
		<div class="dateSquare">
		20 九月
		</div>
		</div>

		<div class="col-md-10 ">
		<h3> 2017 TPSAA進階班 - AI來襲 秘書行政全面升級啟動 </h3>
		</div>

		</div>
		<div style="height:10px"></div>
		<div class="row">

		<div class="col-md-12 " style="color:#666">
		面對強大的人工智慧浪潮，新一波的職場革命即將啟動，而這是危機還是轉機？三大領域專家，將與我們分享，如何立足於秘書行政職務4.0時代的新職場。而這是危機還是轉機？三大領域專家，將與我們分享，如何立足於秘書行政職務4.0時代的新職場...
		領域專家，將與我們分享，如何立足於秘書行政職務4.0時代的新職場...
		領域專家，將與我們分享，如何立足於秘書行政職務4.0時代的新職場...
		領域專家，將與我們分享，如何立足於秘書行政職務4.0時代的新職場...
		領域專家，將與我們分享，如何立足於秘書行政職務4.0時代的新職場...
		</div>

		</div>

		<div style="height:10px">

		</div>
		<div class="row">

		<div class="col-md-5 " >

		<a class="newsButton w100" > 詳細內容 </a>
		</div>

		<div class="col-md-7 " >
		瀏覽數: 150
		</div>

		</div>

		</div> -->

	</div>
</div>

</div>

</div>

@stop
@section('js')

<script></script>

@stop
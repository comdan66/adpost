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
			<h3>最新消息 News Update</h3>

			<div class="redLine"></div>

		</div>
	</div>

	<div class="row">

		<div class="col-md-9">

			<!-- <img src="/img/u135.jpg" class="w100" /> -->
			<img src="/storage/photo/{{ $item['photo'] }}" class="w100"  />

			<div style="height:20px"></div>
			<div class="row">

				<!-- <div class="col-md-2 ">
				<div class="dateSquare">
				20 九月
				</div>
				</div> -->
				<div class="col-md-12 ">
					<!-- <h3> 2017 TPSAA進階班 - AI來襲 秘書行政全面升級啟動，這是危機還是轉機？三大領域專家，將與我們分享！ </h3> -->
					<h3>{{ $item['name'] }}</h3>
				</div>

			</div>

			<div style="height:10px"></div>

			<div class="row">

				<div class="col-md-6 ">
					文：{{ $item['author'] }} | 圖：{{ $item['authorPhoto'] }}
				</div>

				<div class="col-md-2 ">
					瀏覽數: {{ $item['countViews'] }}
				</div>

				<div class="col-md-2 "></div>

			</div>
			<div style="height:30px"></div>

			<div class="row">

				<div class="col-md-12 description">

					{!! $item['content'] !!}
				</div>
			</div>

		</div>

		<div class="col-md-3">

			<div class="titleGrey">
				最新消息
			</div>

			<div style="height:15px"></div>
			<ul class="sideNews">

				@foreach($items as $x)
				<li>
					<a href="/news/item/{{ $x['id'] }}" style="color:#666">
						{{ $x['name'] }}
					</a>
				</li>
				@endforeach
				<!-- <li>
					2017 TPSAA進階班 - AI來襲 秘書行政全面升級啟動 ...2017-05-30
				</li> -->
			</ul>

		</div>

	</div>
</div>

@stop

@section('js')

<script></script>

@stop
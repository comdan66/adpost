@extends('_layouts/main')

@section('content')

<!--main-area-->
<section id="main-area">
	<div class="kv inter">
		<h2>關於我們</h2>
	</div>

	<div class="about">
		<div class="container">

			<p class="introduction" style="white-space: pre-line">
				{{ $json['brief'] }}
			</p>

			@foreach($json['items'] as $x)
			<div class="box col-xs-12 col-sm-6">

				<div class="row">
					<div class="col-xs-6 col-sm-5"><img src="/storage/photo/{{ $x['photo'] }}" class="img-responsive center-block">
					</div>
					<div class="col-xs-6 col-sm-7">
						<p  style="white-space: pre-line;margin-top:0">{{ $x['brief'] }}</p>
					</div>
				</div>
			</div>
			@endforeach

			<!-- <div class="box col-xs-12 col-sm-6">
			<div class="row">
			<div class="col-xs-6 col-sm-5"><img src="/images/pic-about.jpg" class="img-responsive center-block">
			</div>
			<div class="col-xs-6 col-sm-7">
			<p>
			本平台提供全廣告上刊服務，同時致力於引導流量
			</p>
			</div>
			</div>
			<div class="row">
			<div class="col-xs-6 col-sm-5"><img src="/images/pic-about.jpg" class="img-responsive center-block">
			</div>
			<div class="col-xs-6 col-sm-7">
			<p>
			本平台提供全廣告上刊服務，同時致力於引導流量
			</p>
			</div>
			</div>
			</div>

			<div class="box col-xs-12 col-sm-6">
			<div class="row">
			<div class="col-xs-6 col-xs-push-6 col-sm-5"><img src="/images/pic-about.jpg" class="img-responsive center-block">
			</div>
			<div class="col-xs-6 col-xs-pull-6 col-sm-7">
			<p>
			本平台提供全廣告上刊服務，同時致力於引導流量
			</p>
			</div>
			</div>
			<div class="row">
			<div class="col-xs-6 col-xs-push-6 col-sm-5"><img src="/images/pic-about.jpg" class="img-responsive center-block">
			</div>
			<div class="col-xs-6 col-xs-pull-6 col-sm-7">
			<p>
			本平台提供全廣告上刊服務，同時致力於引導流量
			</p>
			</div>
			</div>
			</div> -->
		</div>
	</div>

	<div class="about bg-gray">
		<div class="container">
			<div class="box col-xs-12 col-sm-6">
				<h2>上傳我的廣告</h2>
				<p>
					想讓廣告效果達到最大值嗎？
					<br>
					歡迎現在就加入我們！
				</p>
				<div class="bt-action col-xs-12 col-sm-4">
					<a class="btn btn-post" href="/register" role="button">馬上註冊</a>
				</div>
			</div>

			<div class="box col-xs-12 col-sm-6">
				<h2>了解更多</h2>
				<p>
					合作方式、服務內容、廣告主權益等相關提問，
					<br>
					請至聯絡我們寫下您的意見。
				</p>
				<div class="bt-action col-xs-12 col-sm-4">
					<a class="btn btn-post" href="/contact" role="button">聯絡我們</a>
				</div>
			</div>
		</div>
	</div>

</section>

@stop

@section('js')

<script>
	var vue = new Vue({
		el : '#vue',
		data : {
			name : '',
			email : '',
			password : '',
			password2 : '',

			textRegister : '同意並註冊',
			isProcessing : false,

		},

		methods : {

		}
	});

</script>

@stop
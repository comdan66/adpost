@extends('_layouts/main')

@section('content')

<!--main-area-->
<section id="main-area">
	<div class="kv inter">
		<h2>廣告刊登與合作提案</h2>
	</div>

	<div class="article proposal">
		<div class="container">

			<div class="box col-xs-12">
				<div class="col-xs-12 col-sm-6">
					<img src="/storage/photo/{{ $json['photoJson'][0] }}" class="img-responsive center-block">
				</div>
				<div class="col-xs-12 col-sm-6 text-center">
					<h2>{{ $json['title'] }}</h2>
					<p  style="white-space: pre-line">
						{{ $json['brief'] }}
					</p>
					<div class="bt-action">
						<a class="btn btn-post" href="/register" role="button">馬上註冊</a>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="article proposal">
		<div class="container">
			<div class="box col-xs-12">
				<div class="col-xs-12 col-sm-6 col-sm-push-6">
					<img src="/storage/photo/{{ $json2['photoJson'][0] }}" class="img-responsive center-block">
				</div>
				<div class="col-xs-12 col-sm-6 col-sm-pull-6 text-center">
					<h2>{{ $json2['title'] }}</h2>
					<p  style="white-space: pre-line">
						{{ $json2['brief'] }}
					</p>
					<div class="bt-action">
						<a class="btn btn-post" href="/contact" role="button">聯絡我們</a>
					</div>
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

		},

		methods : {

		}
	});

</script>

@stop
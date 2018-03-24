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
					<img src="/images/pic-proposal-01.jpg" class="img-responsive center-block">
				</div>
				<div class="col-xs-12 col-sm-6 text-center">
					<h2>廣告刊登</h2>
					<p>
						AD-POST廣告上刊非常簡便，只要註冊會員資料，便可以自行操作、輕鬆上架廣告，無論是圖文、影音、商場連結，還是產品討論，我們一應俱全。
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
					<img src="/images/pic-proposal-01.jpg" class="img-responsive center-block">
				</div>
				<div class="col-xs-12 col-sm-6 col-sm-pull-6 text-center">
					<h2>合作提案</h2>
					<p>
						同時，透過網際網路的無疆域特性和支援多屏瀏覽的系統，更能讓廣告不限制於某一區域及特定用戶的曝光效果，即時讓廣告接觸到受眾。
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
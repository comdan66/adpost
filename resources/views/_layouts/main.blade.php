<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>ADPost</title>

		<meta property="og:title" content="{{ $metaTitle }}" />
		<meta property="og:description" content="{{ $metaDescription }}" />
		<meta property="og:image" content="{{ $metaImage }}" />
		<meta property="keywords" content="{{ $metaKeywords }}" />

		<link href="https://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">

		<link href="/css/bootstrap.css" rel="stylesheet">
		<link href="/css/main.css" rel="stylesheet">
		<link href="/bitty/main.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		{{ printJson('isLogin', getSession('isLogin')) }}
		{{ @printJson('userName', getSession('user')['name']) }}
		{{ @printJson('userPhoto', getSession('user')['photo']) }}

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114990077-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}

			gtag('js', new Date());

			gtag('config', 'UA-114990077-1');
		</script>

	</head>
	<body>

		<!--header-->

		<header>
			<div class="container">
				<div class="row">

					<div class="logo">
						<a href="/" onclick="document.location='/'"><img src="/images/adpost-logo.svg" class="center-block"></a>
					</div>
					<div class="search pull-right visible-lg">

						<div class="form-group pull-left">
							<input type="text" class="form-control" placeholder="Search" onkeyup="searchDo(this, event)">
						</div>

						<!--已登入-->
						@if(@$isLogin)
						<ul class="pull-left">
							<li class="dropdown">
								<a href="/member/profile" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="pic col-sm-5"> <!-- <img src="images/pic-guest.jpg" class="img-responsive img-circle"> --> <img src="/storage/photo/{{ $user['photo'] }}" class="img-responsive img-circle" style="max-height:50px;max-width:50px"> </span> <!-- {{ $user['name'] }} --> <span class="caret"></span> </a>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="/member/profile">個人資料</a>
									</li>

									@if(@$user['roleID'] == 2)
									<li>
										<a href="/member/dashboard">我的廣告</a>
									</li>
									@endif

									<li>
										<a onclick="logoutDo()">登出</a>
									</li>

								</ul>
							</li>
						</ul>
						@else
						<div class="login-non pull-left">
							<div class="btn-line-grad sh btn-block">
								<!-- <em><a href="/register">註冊</a> / <a href="/login">登入</a></em> -->
								<em><a href="/login">登入</a></em>
							</div>
						</div>

						@endif

						<!---->

					</div>

					<nav class="nav-collapse">
						<ul class="hidden-sm hidden-xs">

							@if(isset($postType))
							@foreach($postType as $k=>$x)
							<li>
								<a href="/post/listing?typeID={{ $k }}">{{ $x }}</a>
							</li>
							@endforeach
							@endif

							<!--
							<li>
							<a href="/post/listing?typeID=1">汽車</a>
							</li>
							<li>
							<a href="/post/listing?typeID=2">影視</a>
							</li>
							<li>
							<a href="/post/listing?typeID=3">酒類</a>
							</li>
							<li>
							<a href="/post/listing?typeID=4">3C</a>
							</li>
							<li>
							<a href="/post/listing?typeID=5">家電</a>
							</li>
							<li>
							<a href="/post/listing?typeID=6">精品</a>
							</li>
							<li>
							<a href="/post/listing?typeID=7">運動</a>
							</li>
							<li>
							<a href="/post/listing?typeID=8">旅遊</a>
							</li>
							<li>
							<a href="/post/listing?typeID=9">房產</a>
							</li>
							<li>
							<a href="/post/listing?typeID=10">藥品</a>
							</li>
							<li>
							<a href="/post/listing?typeID=1">其它</a>
							</li> -->
						</ul>
						<ul class="visible-sm visible-xs">
							<li>
								<a href="/">首頁</a>
							</li>

							@if(@$isLogin)

							<li>
								<a href="/member/profile">會員中心</a>
							</li>

							@else

							<li>
								<a href="/register">註冊 / 登入</a>
							</li>

							@endif

							<li>
								<a href="/post/listing">探索廣告</a>
							</li>
							<li>
								<a href="/about">關於我們</a>
							</li>
							<li>
								<a href="/propossal">廣告刊登與合作提案</a>
							</li>
							<li>
								<a href="/rule">服務條款</a>
							</li>
							<li>
								<a href="/privacy">隱私權政策</a>
							</li>
							<li>
								<a href="/contact">聯絡我們</a>
							</li>

							@if(@$isLogin)
							<li>
								<a onclick="logoutDo()">登出</a>
							</li>

							@endif

						</ul>
					</nav>

				</div>
			</div>
		</header>
		@yield('content')

		<!--footer-->
		<section id="footer-area">
			<div class="container">
				<div class="row">
					<div class="logo col-xs-12 col-sm-2">
						<a href="/"><img src="/images/adpost-logo.svg" class="center-block"></a>
					</div>
					<ul class="footer-list col-sm-6 hidden-xs">
						<li class="col-sm-3">
							<a href="/">首頁</a>
						</li>
						<li class="col-sm-5">
							<a href="/propossal">廣告刊登與合作提案</a>
						</li>
						<li class="col-sm-4">
							<a href="/privacy">隱私權政策</a>
						</li>
						<li class="col-sm-3">
							<a href="/about">關於我們</a>
						</li>
						<li class="col-sm-5">
							<a href="/rule">服務條款</a>
						</li>
						<li class="col-sm-4">
							<a href="/contact">聯絡我們</a>
						</li>
					</ul>

					<div class="service col-xs-12 col-sm-4">
						<p>
							連絡電話：+886-2-2345-1199
							<br>
							服務時間：周一至周五  09:00 - 18:30
						</p>
					</div>
				</div>
			</div>
			<footer class="text-center">
				<!-- 瑪樂愛迪股份有限公司 版權所有，非經授權，不許轉載本網站內容 © Occpy  All Rights Reserved. -->

				瑪樂愛迪有限公司 版權所有，非經授權，不許轉載本網站內容
				<br>

				ALL RIGHTS RESERVED. Copyright © 2018 AD-POST.

			</footer>
		</section>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="/js/bootstrap.js"></script>
		<!-- nav-->
		<script src="/js/responsive-nav.js"></script>
		<script src="/js/fastclick.js"></script>
		<script src="/js/scroll.js"></script>
		<script src="/js/fixed-responsive-nav.js"></script>
		<!--slider -->
		<script src="/js/highlight.pack.js"></script>
		<script src="/js/jquery.bxslider-rahisified.js"></script>
		<!--upload-->
		<script src="/js/dropzone.js"></script>
		<!--customer -->
		<script src="/js/main.js"></script>

		<script src="/bitty/main.js"></script>

		<!-- vue -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>

		{{ @printJson('vueData', $vueData) }}
		@yield('js')

	</body>
</html>
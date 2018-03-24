<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ $title }}</title>

		<!-- Bootstrap -->
		<link href="{{ url('/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="{{ url('/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		<!-- NProgress -->
		<link href="{{ url('/vendors/nprogress/nprogress.css') }}" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="{{ url('/build/css/custom.min.css') }}" rel="stylesheet">
		<link href="{{ url('bitty/admin.css?v=3') }}" rel="stylesheet">

		{{ printJson('user', $user) }}

		<style>
			{{ $permissionCSS }}
		</style>
		<?php
		//	<link rel="stylesheet" href="{{ mix('/bitty/admin.css') }}">
		?>


	</head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a href="{{ url('admin/post/listing') }}" class="site_title"> <!-- <i class="fa fa-paw"></i> --> <!-- <img src="/img/logo2.png" style="max-height:26px;margin-bottom:6px;display:inline-block"/> --> <span style="padding-top:2px;display:inline-block">AD-POST</span></a>
						</div>

						<div class="clearfix"></div>

						<!-- menu profile quick info -->

						<!--
						<div class="profile clearfix">
						<div class="profile_pic">
						<img src="{{ url('/storage/photo/' . $user['photo']) }}" alt="" class="img-circle profile_img">
						</div>

						<div class="profile_info">
						<span>Welcome,</span>
						<h2> {{ $userName }} </h2>
						</div>
						<div class="clearfix"></div>
						</div>
						-->

						<!-- /menu profile quick info -->

						<br />

						<!-- sidebar menu -->
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
							<div class="menu_section">
								<!-- <h3>General</h3> -->
								<ul class="nav side-menu">
									<!--
									<li>
									<a href="{{ adminUrl('dashboard/index') }}"><i class="fa fa-music fa-fw"></i> Dashboard</a>
									</li> -->

									<!-- <li productRead> -->
									<li >
										<a href="{{ adminUrl('post/listing') }}"><i class="fa fa-newspaper-o fa-fw"></i> <span>廣告管理</span></a>
									</li>

									<li >
										<a href="{{ adminUrl('postType/listing') }}"><i class="fa fa-tag fa-fw"></i> <span>廣告分類</span></a>
									</li>

									<li >
										<a href="{{ adminUrl('contact/listing') }}"><i class="fa fa-image fa-fw"></i> <span>意見反映</span></a>
									</li>

									<li >
										<a href="{{ adminUrl('user/listing') }}"><i class="fa fa-users fa-fw"></i> <span>會員</span></a>
									</li>

									<li >
										<a href="{{ adminUrl('message/update') }}"><i class="fa fa-bolt fa-fw"></i> <span>站內訊息發送</span></a>
									</li>

									<li >
										<a href="{{ adminUrl('setting/listing') }}"><i class="fa fa-gear fa-fw"></i> <span>網站資訊管理</span></a>
									</li>

									<li >
										<a href="{{ adminUrl('admin/listing') }}"><i class="fa fa-key fa-fw"></i> <span>管理員管理</span></a>
									</li>

									<!--

									<li >
									<a href="{{ adminUrl('slider/listing') }}"><i class="fa fa-image fa-fw"></i> <span>首頁輪播</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('event/listing') }}"><i class="fa fa-product-hunt fa-fw"></i> <span>活動</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('news/listing') }}"><i class="fa fa-newspaper-o fa-fw"></i> <span>最新消息</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('flickr/listing') }}"><i class="fa fa-newspaper-o fa-fw"></i> <span>活動花絮</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('journal/listing') }}"><i class="fa fa-reorder fa-fw"></i> <span>網誌</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('course/listing') }}"><i class="fa fa-bolt fa-fw"></i> <span>課程介紹</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('consultant/listing') }}"><i class="fa fa-comment-o fa-fw"></i> <span>講師顧問</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('job/listing') }}"><i class="fa fa-book fa-fw"></i> <span>求才專區</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('joint/listing') }}"><i class="fa fa-bell-o fa-fw"></i> <span>廠商合作提案</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('memberSpecial/listing') }}"><i class="fa fa-cube fa-fw"></i> <span>會員優惠</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('memberNews/listing') }}"><i class="fa fa-feed fa-fw"></i> <span>會員知識交流</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('press/listing') }}"><i class="fa fa-flash fa-fw"></i> <span>媒體報導</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('application/listing?typeID=2') }}"><i class="fa fa-pencil fa-fw"></i> <span>申請課程</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('application/listing?typeID=1') }}"><i class="fa fa-users fa-fw"></i> <span>求才刊登</span></a>
									</li>

									<li >
									<a href="{{ adminUrl('application/listing?typeID=3') }}"><i class="fa fa-flag fa-fw"></i> <span>合作提案</span></a>
									</li>
									<li >
									<a href="{{ adminUrl('career/listing') }}"><i class="fa fa-flag fa-fw"></i> <span>歷程</span></a>
									</li>
									<li >
									<a href="{{ adminUrl('annualTheme/listing') }}"><i class="fa fa-flag fa-fw"></i> <span>年度主題</span></a>
									</li> -->
									<!--
									<li adminRead>
									<a href="{{ adminUrl('admin/listing') }}"><i class="fa fa-users fa-fw"></i> <span>Admin</span></a>
									</li> -->

									<li>
										<a href="{{ url('adminLogin/logoutDo') }}"><i class="fa fa-sign-out fa-fw"></i> <span>登出</span></a>
									</li>

									<!-- <li>
									<a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
									<li>
									<a href="index.html">Dashboard</a>
									</li>
									<li>
									<a href="index2.html">Dashboard2</a>
									</li>
									<li>
									<a href="index3.html">Dashboard3</a>
									</li>
									</ul>
									</li> -->
								</ul>
							</div>

						</div>
						<!-- /sidebar menu -->

						<!-- /menu footer buttons -->
						<div hide class="sidebar-footer hidden-small">
							<a data-toggle="tooltip" data-placement="top" title="Settings"> <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> </a>
							<a data-toggle="tooltip" data-placement="top" title="FullScreen"> <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span> </a>
							<a data-toggle="tooltip" data-placement="top" title="Lock"> <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> </a>
							<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html"> <span class="glyphicon glyphicon-off" aria-hidden="true"></span> </a>
						</div>
						<!-- /menu footer buttons -->
					</div>
				</div>

				<!-- top navigation -->
				<div class="top_nav">
					<div class="nav_menu">
						<nav>
							<!-- <div class="nav toggle"> -->
							<div class="nav toggle " style="width:75%;padding-top:10px;">
								<a id="menu_toggle" class="pull-lefdt"><i class="fa fa-bars"></i></a>

								<div class="navTitle">
									{{ $pageTitle }}
								</div>

							</div>

							<ul class="nav navbar-nav navbar-right ">
								<li class="">
									<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="{{ url('/storage/photo/' . $user['photo']) }}" alt=""> <span class="hidden-xs">{{ $userName }}</span> <span class=" fa fa-angle-down"></span> </a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">

										<li>
											<a href="{{ url('adminLogin/logoutDo') }}"><i class="fa fa-sign-out pull-right"></i> 登出</a>
										</li>
									</ul>
								</li>

							</ul>
						</nav>
					</div>
				</div>
				<!-- /top navigation -->

				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
						@yield('content')
					</div>
				</div>
				<!-- /page content -->
				<form id="formFileUpload" action="uploadFileDo" hide method="post" enctype="multipart/form-data">
					<input type="file" name="files" multiple accept="image/*">
					<input type="submit" />
				</form>

				<!-- footer content -->
				<footer>
					<div class="pull-right">
						<!-- Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a> -->
						AD-POST
					</div>
					<div class="clearfix"></div>
				</footer>
				<!-- /footer content -->
			</div>
		</div>

		<!-- vue -->
		<!-- <script src="https://unpkg.com/vue"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>

		<?php
		//	<script src="{{ mix('/bitty/admin.js') }}"></script>
		?>
		<!-- jQuery -->
		<script src="{{ url('/vendors/jquery/dist/jquery.min.js') }}"></script>

		<!-- <script src="{{ url('/vendor/select2/js/select2.min.js') }}"></script> -->

		<!-- <link rel="stylesheet" href="{{ url('/vendor/select2/css/select2.min.css') }}"> -->

		<!-- fileupload -->
		<script src="{{ url('/js/jquery-fileupload.min.js') }}"></script>

		<!-- summernote -->
		<link rel="stylesheet" href="{{ url('/js/summernote/summernote.css') }}">
		<script type="text/javascript" src="{{ url('/js/summernote/summernote.js') }}"></script>

		<!-- Bootstrap -->
		<script src="{{ url('/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>

		<!-- FastClick -->
		<script src="{{ url('/vendors/fastclick/lib/fastclick.js') }}"></script>
		<!-- NProgress -->
		<script src="{{ url('/vendors/nprogress/nprogress.js') }}"></script>

		<!-- bootstrap-daterangepicker -->
		<script src="{{ url('/vendors/moment/min/moment.min.js') }}"></script>
		<script src="{{ url('/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

		<script src="{{ url('/js/moment.min.js') }}"></script>

		<!-- bootstrap-daterangepicker -->
		<link href="{{ url('/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

		<!-- Custom Theme Scripts -->
		<script src="{{ url('/build/js/custom.min.js') }}"></script>

		<!-- bitty -->
		<script src="{{ url('/bitty/admin.js?v=4') }}"></script>
		<!-- <script src="{{ url('/bitty/list.js') }}"></script> -->

		{{ printJson('vueData', $vueData) }}

		@yield('js')

	</body>
</html>

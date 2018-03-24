<!DOCTYPE html>
<html >

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="/img/favicon.ico">

		<title>AD POST</title>

	</head>
	<!-- NAVBAR
	================================================== -->

	<hr>
	<body>

		@yield('content')

		<!-- vue -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

		<script src="{{ url('dist/js/bootstrap.min.js') }}"></script>

		<script src="{{ url('bitty/main.js') }}"></script>

		<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
		<!-- <script src="{{ url('assets/js/vendor/holder.min.js') }}"></script> -->
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<!-- <script src="{{ url('assets/js/ie10-viewport-bug-workaround.js') }}"></script> -->

		{{ printJson('vueData', $vueData) }}

		@yield('js')

	</body>

</html>
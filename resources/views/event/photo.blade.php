@extends('_layouts/main')

@section('content')

<style>
	.headerSpace {
		height: 80px;
	}

	.ooxx {
		margin-bottom: 20px;
		font-size: 18px;
	}

	.time {
		color: #999;
		font-weight: bold;
		font-size: 30px;
		text-align: right;
		clear: left;
		margin-bottom: 20px;
	}

	.timeDescription {
		font-size: 16px;
		color: #999;
		padding-top: 5px;
	}

	.timeLine {
		border-bottom: 1px #ddd solid;
		margin: 10px 20px;
		margin-bottom: 20px;
		clear: both;
	}

	.reference {
		margin-top: 20px;
	}
	.listItem {
		color: #666;
		font-size: 14px;
		margin-bottom: 80px;
		background: #fff;
		padding: 20px;
	}
	.reference a {
		color: rgb(153, 153, 153);
	}
	.table thead {
		background: #f2f2f2;
	}

	.ttt td, .ttt th {
		padding: 10px 15px !important;
	}

	.listTitle {
		font-size: 20px;
		font-weight: bold;
		margin-bottom: 5px;
	}

	.listCompany {
		font-size: 16px;
		margin-bottom: 20px;
	}

	.brief {
		margin-bottom: 20px;
		margin-top: 10px;
	}

	.listDate {
		color: #999;
	}
	.qq img {
		max-width: 100%;
	}
	.qq iframe {
		max-width: 100%;
	}
	.qq:nth-child(3n+1) {
		clear: left;
	}
</style>

<div style="height:30px"></div>

<div class="container">

	<div class="row">
		<div class="col-lg-12 text-left" style="margin:auto;float:none;">

			<h3>活動花絮</h3>
			<div class="redLine" style="margin:10px 0;width:50px;"></div>

			<div class="clear"></div>

			<div style="height:10px"></div>

			<div class="row ">

				@foreach($items as $x)
				<div class="col-lg-4 qq ">

					{!! $x['embedCode'] !!}

				</div>

				@endforeach
			</div>
		</div>
	</div>

</div>

@stop @section('js')

<script></script>

@stop
@extends('layouts.default')

@section('title_page')
Home - @parent
@stop

@section('content')

@auth
    <div>OK Access</div>
@endauth

<style type="text/css">
		body{
			font-family: 'Noto Sans Thai', sans-serif;
			font-size: 150%;
		}



		.alert {
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			z-index: 9999; /* Set a high value for z-index */
		}

		/* .zr-element {
			font-family: 'Noto Sans Thai', sans-serif !important;
		}

		.echarts-tooltip {
		font-family: 'Noto Sans Thai', sans-serif !important;
		} */
	</style>

	<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/visualization/echarts/echarts.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/charts/echarts/bright_bar.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/charts/echarts/bright_donuts.js')}}"></script>


<!-- Main content -->
			<div class="content-wrapper">
			

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"></span> สรุปภาพรวม</h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.html"><i class="icon-home2 position-left"></i> หน้าหลัก</a></li>
							<li class="active">สรุปภาพรวม</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">
				<p>Blank Content	</p>
					
				</div>
				<!-- /content area -->
@stop
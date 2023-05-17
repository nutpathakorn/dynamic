@extends('layouts.default_admin')

@section('title_page')
Sign-in @parent
@stop

@section('content')
<style type="text/css">
		body{
			font-family: 'Noto Sans Thai', sans-serif;
      font-size: 150%;
		}
	</style>
<!-- GMaps -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

<script type="text/javascript" src="{{URL::asset('resources/assets/js/maps/google/markers/animation.js')}}"></script>

<!-- Main content -->
<div class="content-wrapper">

<!-- Page header -->
<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">แผนที่</span></h4>
    </div>
  </div>

  <div class="breadcrumb-line">
    <ul class="breadcrumb">
      <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
      <li><a href="maps_google_markers.html">แผนที่</a></li>
    </ul>
  </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">


  <!-- Animated markers -->
  <div class="panel panel-flat">
    <div class="panel-heading">
      <h5 class="panel-title">พิกัดงาน</h5>
    </div>

    <div class="panel-body">
      <button class="btn btn-info btn-xs drop-markers content-group">ดูพนักงาน</button>
      <div class="map-container map-marker-animation"></div>
    </div>
  </div>
  <!-- /animated markers -->

</div>
<!-- /content area -->

</div>
<!-- /main content -->

@stop
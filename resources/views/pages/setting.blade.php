@extends('layouts.default')

@section('title_page')
Home - @parent
@stop

@section('content')
<style type="text/css">
		body{
			font-family: 'Noto Sans Thai', sans-serif;
			font-size: 150%;
		}
	</style>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/forms/selects/select2.min.js')}}"></script>	
<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/form_layouts.js')}}"></script>

<!-- Main content -->
<div class="content-wrapper">

<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">ตั้งค่า</span></h4>
		</div>

	</div>

	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
			<li><a href="form_layout_vertical.html">ตั้งค่า</a></li>
		</ul>

	</div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">

	<!-- 2 columns form -->
	<form action="#">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">ตั้งค่า</h5>
				
			</div>

			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<fieldset>
							<legend class="text-semibold"><i class="icon-reading position-left"></i> Personal details</legend>

							<div class="form-group">
								<label>Enter your name:</label>
								<input type="text" class="form-control" placeholder="Eugene Kopyov">
							</div>

							<div class="form-group">
								<label>Enter your password:</label>
								<input type="password" class="form-control" placeholder="Your strong password">
							</div>

							<div class="form-group">
								<label>Select your state:</label>
								<select data-placeholder="Select your state" class="select">
									<option></option>
									<optgroup label="Alaskan/Hawaiian Time Zone">
										<option value="AK">Alaska</option>
										<option value="HI">Hawaii</option>
									</optgroup>
									<optgroup label="Pacific Time Zone">
										<option value="CA">California</option>
										<option value="NV">Nevada</option>
										<option value="WA">Washington</option>
									</optgroup>
									<optgroup label="Mountain Time Zone">
										<option value="AZ">Arizona</option>
										<option value="CO">Colorado</option>
										<option value="WY">Wyoming</option>
									</optgroup>
									<optgroup label="Central Time Zone">
										<option value="AL">Alabama</option>
										<option value="AR">Arkansas</option>
										<option value="KY">Kentucky</option>
									</optgroup>
									<optgroup label="Eastern Time Zone">
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="WV">West Virginia</option>
									</optgroup>
								</select>
							</div>

							<div class="form-group">
								<label>Attach screenshot:</label>
								<input type="file" class="file-styled">
							</div>

							<div class="form-group">
								<label>Your message:</label>
								<textarea rows="5" cols="5" class="form-control" placeholder="Enter your message here"></textarea>
							</div>
						</fieldset>
					</div>

					<div class="col-md-6">
						<fieldset>
							<legend class="text-semibold"><i class="icon-truck position-left"></i> Shipping details</legend>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>First name:</label>
										<input type="text" placeholder="Eugene" class="form-control">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Last name:</label>
										<input type="text" placeholder="Kopyov" class="form-control">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email:</label>
										<input type="text" placeholder="eugene@kopyov.com" class="form-control">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Phone #:</label>
										<input type="text" placeholder="+99-99-9999-9999" class="form-control">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Country:</label>
										<select data-placeholder="Select your country" class="select">
											<option></option>
											<option value="Cambodia">Cambodia</option> 
											<option value="Cameroon">Cameroon</option> 
											<option value="Canada">Canada</option> 
											<option value="Cape Verde">Cape Verde</option> 
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>State/Province:</label>
										<input type="text" placeholder="Bayern" class="form-control">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>ZIP code:</label>
										<input type="text" placeholder="1031" class="form-control">
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label>City:</label>
										<input type="text" placeholder="Munich" class="form-control">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Address line:</label>
										<input type="text" placeholder="Ring street 12" class="form-control">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label>Additional message:</label>
								<textarea rows="5" cols="5" class="form-control" placeholder="Enter your message here"></textarea>
							</div>
						</fieldset>
					</div>
				</div>

				<div class="text-right">
					<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
				</div>
			</div>
		</div>
	</form>
	<!-- /2 columns form -->


	<!-- Footer -->
	<div class="footer text-muted">
		&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
	</div>
	<!-- /footer -->

</div>
<!-- /content area -->

</div>
<!-- /main content -->
@stop
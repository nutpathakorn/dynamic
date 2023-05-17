@extends('layouts.default_admin')

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
<script> 
    function create_submit()
    {
		var dataString = "company_id=123456"
							+"&company_name=test"
							+"&company_addr=test"
							+"&company_rd=test"
							+"&company_dist=test"
							+"&company_prov=test"
							+"&company_subd=test"
							+"&company_post=test"
							+"&company_phon=test"
							+"&company_mobi=test"
							+"&company_mail=test";

        $.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });
     
		$.ajax({
			type: "POST",
			url: 'api/ins_customer',
			data: dataString,
			success: function(data){  
				console.log(data);
			}             
		}); 
    
    } 
    </script>

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
				@if(!session()->has('token'))
				<script type="text/javascript">
					window.location = "{{URL::to('/')}}";//here double curly bracket
				</script>
				@endif
				<div>
					<div class="alert alert-warning alert-styled-left alert-bordered">
						<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
						<span class="text-semibold">Comming Soon!</span> นี่คือข้อมูลตัวอย่าง ข้อมูลจริงหน้าสรุปรวมจะเข้ามาหลังจากใช้งานจริงแล้วระยะหนึ่ง.
					</div>
				</div>
					<!-- Main charts -->
					<div class="row">
						<div class="col-md-6">

							<!-- Basic column chart -->
							<div class="panel panel-flat">

								<div class="panel-body">
									<div class="chart-container">
										<div class="chart has-fixed-height" id="basic_columns"></div>
									</div>
								</div>
							</div>
							<!-- /basic column chart -->

						</div>

						<div class="col-md-6">

							<!-- Basic donut chart -->
							<div class="panel panel-flat">

								<div class="panel-body">
									<div class="chart-container">
										<div class="chart has-fixed-height" id="basic_donut"></div>
									</div>
								</div>
							</div>
							<!-- /basic donut chart -->

						</div>
					</div>
					<!-- /main charts -->


					<!-- Dashboard content -->
					<div class="row">
						<div class="col-lg-8">

							<!-- Marketing campaigns -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">สรุปคุณภาพการส่งงาน</h6>
									<span class="text-size-mini text-muted">รายบริษัท</span>
									
								</div>

								<div class="table-responsive">
									<table class="table table-lg text-nowrap">
										<tbody>
											<tr>
												<td class="col-md-5">
													<div class="media-left">
														<div id="campaigns-donut"></div>
													</div>

													<div class="media-left">
														<h5 class="text-semibold no-margin">38,289 <small class="text-success text-size-base"><i class="icon-arrow-up12"></i> (+16.2%)</small></h5>
														<ul class="list-inline list-inline-condensed no-margin">
															<li>
																<span class="status-mark border-success"></span>
															</li>
															<li>
																<span class="text-muted">ส่งสำเร็จ</span>
															</li>
														</ul>
													</div>
												</td>

												<td class="col-md-5">
													<div class="media-left">
														<div id="campaign-status-pie"></div>
													</div>

													<div class="media-left">
														<h5 class="text-semibold no-margin">2,458 <small class="text-danger text-size-base"><i class="icon-arrow-down12"></i> (- 4.9%)</small></h5>
														<ul class="list-inline list-inline-condensed no-margin">
															<li>
																<span class="status-mark border-danger"></span>
															</li>
															<li>
																<span class="text-muted">ส่งไม่สำเร็จ</span>
															</li>
														</ul>
													</div>
												</td>

												<td class="text-right col-md-2">
													<a href="#" class="btn bg-indigo-300"><i class="icon-statistics position-left"></i> ดูรายงาน</a>
												</td>
											</tr>
										</tbody>
									</table>	
								</div>

								<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th>บริษัท</th>
												<th class="col-md-2">ส่งสำเร็จ</th>
												<th class="col-md-2">ส่งไม่สำเร็จ</th>
												<th class="col-md-2">งานรวม</th>
												<th class="col-md-2">ค่าใช้จ่าย</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{URL::asset('resources/assets/images/brands/bing.png')}}" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold">Bing campaign</a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-success position-left"></span>
															15:00 - 16:00
														</div>
													</div>
												</td>
												<td><span class="text-muted">Metrics</span></td>
												<td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> - 5.78%</span></td>
												<td><h6 class="text-semibold">$970</h6></td>
												<td><span class="label bg-success-400">Pending</span></td>
												
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{URL::asset('resources/assets/images/brands/amazon.png')}}" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold">Amazon ads</a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-danger position-left"></span>
															18:00 - 19:00
														</div>
													</div>
												</td>
												<td><span class="text-muted">Blueish</span></td>
												<td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i> 6.79%</span></td>
												<td><h6 class="text-semibold">$1,540</h6></td>
												<td><span class="label bg-blue">Active</span></td>
												
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{URL::asset('resources/assets/images/brands/dribbble.png')}}" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold">Dribbble ads</a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-blue position-left"></span>
															20:00 - 21:00
														</div>
													</div>
												</td>
												<td><span class="text-muted">Teamable</span></td>
												<td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> 9.83%</span></td>
												<td><h6 class="text-semibold">$8,350</h6></td>
												<td><span class="label bg-danger">Closed</span></td>
												
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="{{URL::asset('resources/assets/images/brands/dribbble.png')}}" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><a href="#" class="text-default text-semibold">Dribbble ads</a></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-blue position-left"></span>
															20:00 - 21:00
														</div>
													</div>
												</td>
												<td><span class="text-muted">Teamable</span></td>
												<td><span class="text-danger"><i class="icon-stats-decline2 position-left"></i> 9.83%</span></td>
												<td><h6 class="text-semibold">$8,350</h6></td>
												<td><span class="label bg-danger">Closed</span></td>
												
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- /marketing campaigns -->
						</div>

						<div class="col-lg-4">

							<!-- Daily sales -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">สรุปค่าใช้จ่าย</h6>
									<div class="heading-elements">
										<span class="heading-text">รวมทั้งสิ้น: <span class="text-bold text-danger-600 position-right">4,378</span> บาท</span>
										<ul class="icons-list">
					                		<li class="dropdown text-muted">
					                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
													<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
													<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
													<li class="divider"></li>
													<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
												</ul>
					                		</li>
					                	</ul>
									</div>
								</div>

								<div class="panel-body">
									<div id="sales-heatmap"></div>
								</div>

								<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th>เดือน</th>
												<th>จำนวน</th>
												<th>ราคา</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<div class="media-heading">
															<a href="#" class="letter-icon-title">Sigma application</a>
														</div>

														<div class="text-muted text-size-small"><i class="icon-checkmark3 text-size-mini position-left"></i> New order</div>
													</div>
												</td>
												<td>
													<span class="text-muted text-size-small">06:28 pm</span>
												</td>
												<td>
													<h6 class="text-semibold no-margin">$49.90</h6>
												</td>
											</tr>

											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-danger-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<div class="media-heading">
															<a href="#" class="letter-icon-title">Alpha application</a>
														</div>

														<div class="text-muted text-size-small"><i class="icon-spinner11 text-size-mini position-left"></i> Renewal</div>
													</div>
												</td>
												<td>
													<span class="text-muted text-size-small">04:52 pm</span>
												</td>
												<td>
													<h6 class="text-semibold no-margin">$90.50</h6>
												</td>
											</tr>

											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-indigo-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<div class="media-heading">
															<a href="#" class="letter-icon-title">Delta application</a>
														</div>

														<div class="text-muted text-size-small"><i class="icon-lifebuoy text-size-mini position-left"></i> Support</div>
													</div>
												</td>
												<td>
													<span class="text-muted text-size-small">01:26 pm</span>
												</td>
												<td>
													<h6 class="text-semibold no-margin">$60.00</h6>
												</td>
											</tr>

											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<div class="media-heading">
															<a href="#" class="letter-icon-title">Omega application</a>
														</div>

														<div class="text-muted text-size-small"><i class="icon-lifebuoy text-size-mini position-left"></i> Support</div>
													</div>
												</td>
												<td>
													<span class="text-muted text-size-small">11:46 am</span>
												</td>
												<td>
													<h6 class="text-semibold no-margin">$55.00</h6>
												</td>
											</tr>

											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#" class="btn bg-danger-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</a>
													</div>

													<div class="media-body">
														<div class="media-heading">
															<a href="#" class="letter-icon-title">Alpha application</a>
														</div>

														<div class="text-muted text-size-small"><i class="icon-spinner11 text-size-mini position-left"></i> Renewal</div>
													</div>
												</td>
												<td>
													<span class="text-muted text-size-small">10:29 am</span>
												</td>
												<td>
													<h6 class="text-semibold no-margin">$90.50</h6>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- /daily sales -->


							

						</div>
					</div>
					<!-- /dashboard content -->

				</div>
				<!-- /content area -->
@stop
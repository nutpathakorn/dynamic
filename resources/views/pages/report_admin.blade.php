@extends('layouts.default_admin')

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
<!--script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/table_responsive.js')}}"></script-->
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/forms/selects/select2.min.js')}}"></script>	
<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/datatables_responsive.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/ui/dragula.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/extension_dnd.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/footable/footable.min.js')}}"></script>
<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">รายงาน</span></h4>
						</div>

						
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="table_responsive.html">รายงาน</a></li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Basic responsive configuration -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">รายงานประจำวัน</h5>
						</div>

						<table class="table datatable-responsive">
							<thead>
								<tr>
									<th>ต้นทาง</th>
									<th>ปลายทาง</th>
									<th>รายละเอียด</th>
									<th>เริ่มงาน</th>
									<th>จบงาน</th>
									<th>สถานะ</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Marth</td>
									<td><a href="#">Enright</a></td>
									<td>Traffic Court Referee</td>
									<td>22 Jun 1972</td>
									<td>22 Jun 1972</td>
									<td><span class="label label-success">สำเร็จ</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Jackelyn</td>
									<td>Weible</td>
									<td><a href="#">Airline Transport Pilot</a></td>
									<td>3 Oct 1981</td>
									<td>3 Oct 1981</td>
									<td><span class="label label-default">ไม่สำเร็จ</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>ทดสอบ</td>
									<td>Hard</td>
									<td>Business Services Sales Representative</td>
									<td>19 Apr 1969</td>
									<td>19 Apr 1969</td>
									<td><span class="label label-danger">ยกเลิก</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Nathalie</td>
									<td><a href="#">Pretty</a></td>
									<td>Drywall Stripper</td>
									<td>13 Dec 1977</td>
									<td>13 Dec 1977</td>
									<td><span class="label label-info">กำลังส่ง</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Sharan</td>
									<td>Leland</td>
									<td>Aviation Tactical Readiness Officer</td>
									<td>30 Dec 1991</td>
									<td>30 Dec 1991</td>
									<td><span class="label label-default">ไม่สำเร็จ</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Maxine</td>
									<td><a href="#">Woldt</a></td>
									<td><a href="#">Business Services Sales Representative</a></td>
									<td>17 Oct 1987</td>
									<td>17 Oct 1987</td>
									<td><span class="label label-info">กำลังส่ง</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Sylvia</td>
									<td><a href="#">Mcgaughy</a></td>
									<td>Hemodialysis Technician</td>
									<td>11 Nov 1983</td>
									<td>11 Nov 1983</td>
									<td><span class="label label-danger">ยกเลิก</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Lizzee</td>
									<td><a href="#">Goodlow</a></td>
									<td>Technical Services Librarian</td>
									<td>1 Nov 1961</td>
									<td>1 Nov 1961</td>
									<td><span class="label label-danger">ยกเลิก</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Kennedy</td>
									<td>Haley</td>
									<td>Senior Marketing Designer</td>
									<td>18 Dec 1960</td>
									<td>18 Dec 1960</td>
									<td><span class="label label-success">สำเร็จ</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Chantal</td>
									<td><a href="#">Nailor</a></td>
									<td>Technical Services Librarian</td>
									<td>10 Jan 1980</td>
									<td>10 Jan 1980</td>
									<td><span class="label label-default">ไม่สำเร็จ</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Delma</td>
									<td>Bonds</td>
									<td>Lead Brand Manager</td>
									<td>21 Dec 1968</td>
									<td>21 Dec 1968</td>
									<td><span class="label label-info">กำลังส่ง</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Roland</td>
									<td>Salmos</td>
									<td><a href="#">Senior Program Developer</a></td>
									<td>5 Jun 1986</td>
									<td>5 Jun 1986</td>
									<td><span class="label label-default">ไม่สำเร็จ</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Coy</td>
									<td>Wollard</td>
									<td>Customer Service Operator</td>
									<td>12 Oct 1982</td>
									<td>12 Oct 1982</td>
									<td><span class="label label-success">สำเร็จ</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Maxwell</td>
									<td>Maben</td>
									<td>Regional Representative</td>
									<td>25 Feb 1988</td>
									<td>25 Feb 1988</td>
									<td><span class="label label-danger">ยกเลิก</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Cicely</td>
									<td>Sigler</td>
									<td><a href="#">Senior Research Officer</a></td>
									<td>15 Mar 1960</td>
									<td>15 Mar 1960</td>
									<td><span class="label label-info">กำลังส่ง</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-folder-remove"></i> ยกเลิกงาน</a></li>
													<li><a href="#"><i class="icon-location3"></i> พิกัดงานล่าสุด</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- /basic responsive configuration -->

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
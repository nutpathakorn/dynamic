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
<!--script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/table_responsive.js')}}"></script-->
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/forms/selects/select2.min.js')}}"></script>	
<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/datatables_responsive.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/ui/dragula.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/extension_dnd.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/footable/footable.min.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/anytime.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/pickadate/legacy.js')}}"></script>
<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">ค่าใช้จ่าย</span></h4>
						</div>

						
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.html"><i class="icon-home2 position-left"></i> หน้าหลัก</a></li>
							<li><a href="table_responsive.html">ค่าใช้จ่าย</a></li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-flat border-left-xlg border-left-info">
							<div class="panel-heading">
								<h4 class="panel-title"><span class="text-bold">ค่าใช้จ่ายระหว่างเดือน</span></h4>
								<span class="text-success">April 1 – 16, 2023</span>
							</div>
							
							<div class="panel-body">
								<h6 class="panel-title"><span class="text-semibold">Month to date total cost :</span></h6>
								<span class="text-primary">5,200.00 บาท</span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-flat border-left-xlg border-left-info">
							<div class="panel-heading">
								<h4 class="panel-title"><span class="text-bold">ค่าใช้จ่ายประจำเดือน</span></h4>
								<span class="text-success">April 1 – 31, 2023</span>
							</div>
							
							<div class="panel-body">
								<h6 class="panel-title"><span class="text-semibold">End-of-month total cost :</span></h6>
								<span class="text-primary">16,800.00 บาท</span>
							</div>
						</div>
					</div>
				</div>

					<!-- Basic responsive configuration -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">รายงานค่าใช้จ่าย</h5>
						</div>

						<div class="panel-body">
							<div class="col-md-3">
								<div class="form-group">
									<label class="cursor-move">วันที่เริ่ม:</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar3"></i></span>
										<input id="job_start_date" name="job_start_date" type="text" class="form-control" placeholder="วันที่">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="cursor-move">วันที่สิ้นสุด:</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar3"></i></span>
										<input id="job_end_date" name="job_end_date" type="text" class="form-control" placeholder="วันที่">
										<span class="input-group-btn">
											<button id="selectฺBetweenData" type="button" class="btn btn-info">ค้นหา</button>
										</span>
										
									</div>
								</div>
							</div>
						</div>

						<table  id="selectJobMasterBetweenDate" class="table datatable-button-print-columns">
							<thead>
								<tr>
									<th>รหัสบริษัท</th>
									<th>บริษัท</th>
									<th>ที่อยู่</th>
									<th>ประเภทงาน</th>
									<th>ผู้รับ</th>
									<th>โทรศัพท์</th>
									<th>มือถือ</th>
									<th>ยอดเงิน</th>
									<th>วันที่ส่งงาน</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<!-- /basic responsive configuration -->
				</div>
				<!-- /content area -->

<script>
	$(document).ready(function() {		

		var notes = [];

		// Text options
		notes['alert'] = 'Best check yo self, you\'re not looking too good.';
		notes['error'] = 'พบปัญหาบางประการลองทำรายการใหม่อีกครั้ง';
		notes['success'] = 'บันทึกรายการเรียบร้อย';
		notes['information'] = 'This alert needs your attention, but it\'s not super important.';
		notes['warning'] = 'Warning! Best check yo self, you\'re not looking too good.';
		notes['confirm'] = 'คุณต้องการจะบันทึกรายการใช่หรือไม่?';

		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

		$('#selectฺBetweenData').on('click', function() {
			var table = $('#selectJobMasterBetweenDate').DataTable();
			
			if (table.settings()[0]) {
				table.destroy();
			}

			$('#selectJobMasterBetweenDate').DataTable({
				"processing": true,
				"serverSide": true,
				"searching": true,
				pagingType: 'full_numbers',
				"ajax": {
					"url": "api/getJobMasterByBetweenDate",
					"type": "POST",
					"data": {"company_owner_id": "{{ Session::get('user_id') }}",
					"job_start_date": $("#job_start_date").val(),
					"job_end_date": $("#job_end_date").val()},
					"dataSrc": function (data) {
						var totalRecords = data.recordsTotal;
						var filteredRecords = data.recordsFiltered;

						console.log(data.data);
						console.log(totalRecords);
						console.log(filteredRecords);

						if (data.data.length === 0) {
							$('#selectJobMasterBetweenDate tbody').append('<tr><td colspan="7"><center>ไม่พบข้อมูล</center></td></tr>');
						}
						return data.data;
					}
				},
				"columns": [
					{ "data": "company_user_cid" },
					{ "data": "cus_name" },
					{ "data": "cus_address" },
					{ "data": "job_type_name" },
					{ "data": "cus_recive_name" },
					{ "data": "cus_recive_phone" },
					{ "data": "cus_recive_mobile" },
					{ "data": "shipping_price" },
					{ "data": "job_start_date" }
				]
			});
		});
		$("#selectฺBetweenData").triggerHandler('click');
	});
</script>

<script>
	var today = new Date();
	var firstDayOfMonth = moment(new Date(today.getFullYear(), today.getMonth(), 1)).format("DD/MM/YYYY");
	var lastDayOfMonth = moment(new Date(today.getFullYear(), today.getMonth() + 1, 0)).format("DD/MM/YYYY");

	console.log(firstDayOfMonth);
	console.log(lastDayOfMonth);

	$("#job_start_date").AnyTime_picker({
		format: "%d/%m/%Z",
		defaultDate: firstDayOfMonth
	});

	$("#job_end_date").AnyTime_picker({
		format: "%d/%m/%Z",
		defaultDate: lastDayOfMonth
	});

	$("#job_start_date").val(firstDayOfMonth).trigger('change');
	$("#job_end_date").val(lastDayOfMonth).trigger('change');
	
</script>
@stop
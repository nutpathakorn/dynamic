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
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/extensions/select.min.js')}}"></script>
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

<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/datatables_extension_buttons_print.js')}}"></script>


			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">สถานะงาน</span></h4>
						</div>

					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.html"><i class="icon-home2 position-left"></i> หน้าหลัก</a></li>
							<li><a href="table_responsive.html">งาน</a></li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Basic responsive configuration -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">ตารางงาน</h5>
						</div>

						<div class="panel-body">
							<div class="col-md-3">
								<div class="form-group">
									<label class="cursor-move">วันที่:</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-calendar3"></i></span>
										<input id="job_start_date" name="job_start_date" type="text" class="form-control" placeholder="วันที่">
										<span class="input-group-btn">
											<button id="selectDataAll" type="button" class="btn btn-info">ดูทั้งหมด</button>
										</span>
										
									</div>
								</div>
							</div>

						</div>
						
						<table  id="selectJobMaster" class="table datatable-button-print-columns">
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
									<th>สถานะงาน</th>
									<th class="text-center">จัดการ</th>
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

		$('#selectDataAll').on('click', function() {
			var table = $('#selectJobMaster').DataTable();
			
			if (table.settings()[0]) {
				table.destroy();
			}

			$('#job_start_date').val('');

			$('#selectJobMaster').DataTable({
				"processing": true,
				"serverSide": true,
				"searching": true,
				pagingType: 'full_numbers',
				"ajax": {
					"url": "api/getJobMaster",
					"type": "POST",
					"data": {"company_owner_id": "{{ Session::get('user_id') }}"},
					"dataSrc": function (data) {
						var totalRecords = data.recordsTotal;
						var filteredRecords = data.recordsFiltered;

						if (data.data.length === 0) {
							$('#selectJobMaster tbody').append('<tr><td colspan="7"><center>ไม่พบข้อมูล</center></td></tr>');
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
					{ "data": "job_start_date" },
					{ 
						"data": "job_status",
						"render": function ( data, type, row ) {
							switch (data) {
								case 1:
									status = "<span class='label bg-slate'>เตรียมงาน</span>";
									break;
								case 2:
									status = "<span class='label bg-pink'>จัดงาน</span>";
									break;
								case 3:
									status = "<span class='label label-info'>กำลังส่ง</span>";
									break;
								case 4:
									status = "<span class='label label-success'>ส่งสำเร็จ</span>";
									break;
								case 5:
									status = "<span class='label bg-violet'>ส่งไม่สำเร็จ</span>";
									break;
								case 6:
									status = "<span class='label label-warning'>ขอยกเลิก</span>";
									break;
								default:
									status = "<span class='label label-danger'>พบปัญหา</span>";
								}
							return status;
						}
					},
					{ 
						"data": "company_user_cid",
						"render": function ( data, type, row ) {
							if (row.job_status === 6) {
								return '';
							} else {
								return '<button type="button" class="btn btn-danger delete-row" data-cid="' + data + '">ขอยกเลิก</button>';
							}
						}
					}
				],
				buttons: [
					{
						extend: 'print',
						text: '<i class="icon-printer position-left"></i> Print table',
						className: 'btn btn-default',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'colvis',
						text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
						className: 'btn btn-default btn-icon'
					}
				]
			});
		});
		
		$('#job_start_date').on('change', function() {
			console.log($(this).val());

			var table = $('#selectJobMaster').DataTable();
			
			if (table.settings()[0]) {
				table.destroy();
			}

			$('#selectJobMaster').DataTable({
				"processing": true,
				"serverSide": true,
				"searching": true,
				"ajax": {
					"url": "api/getJobMasterByDate",
					"type": "POST",
					"data": {"company_owner_id": "{{ Session::get('user_id') }}", "job_start_date": $(this).val()},
					"dataSrc": function (data) {
						var totalRecords = data.recordsTotal;
						var filteredRecords = data.recordsFiltered;
						if (data.data.length === 0) {
							$('#selectJobMaster tbody').append('<tr><td colspan="7"><center>ไม่พบข้อมูล</center></td></tr>');
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
					{ "data": "job_start_date" },
					{ 
						"data": "job_status",
						"render": function ( data, type, row ) {
							switch (data) {
								case 1:
									status = "<span class='label bg-slate'>เตรียมงาน</span>";
									break;
								case 2:
									status = "<span class='label bg-pink'>จัดงาน</span>";
									break;
								case 3:
									status = "<span class='label label-info'>กำลังส่ง</span>";
									break;
								case 4:
									status = "<span class='label label-success'>ส่งสำเร็จ</span>";
									break;
								case 5:
									status = "<span class='label bg-violet'>ส่งไม่สำเร็จ</span>";
									break;
								case 6:
									status = "<span class='label label-warning'>ขอยกเลิก</span>";
									break;
								default:
									status = "<span class='label label-danger'>พบปัญหา</span>";
								}
							return status;
						}
					},
					{ 
						"data": "company_user_cid",
						"render": function ( data, type, row ) {
							if (row.job_status === 6) {
								return '';
							} else {
								return '<button type="button" class="btn btn-danger delete-row" data-cid="' + data + '">ขอยกเลิก</button>';
							}
						}
					}
				],
				buttons: [
					{
						extend: 'print',
						text: '<i class="icon-printer position-left"></i> Print table',
						className: 'btn btn-default',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'colvis',
						text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
						className: 'btn btn-default btn-icon'
					}
				]
			});

		});

		var currentDate = new Date();

		var formattedDate = (currentDate.getDate() < 10 ? '0' : '') + currentDate.getDate() + '/'
						+ ((currentDate.getMonth()+1) < 10 ? '0' : '') + (currentDate.getMonth()+1) + '/'
						+ currentDate.getFullYear();

		$("#job_start_date").val(formattedDate).trigger('change');


		$('#selectJobMaster').on('click', '.delete-row', function() {
			var table = $('#selectJobMaster').DataTable();
			var row = $(this).closest('tr');
			var cid = $(this).data('cid');
			
			console.log(cid);

			
			var dataString = "company_user_cid="+cid+"&company_owner_id="+"{{ Session::get('user_id') }}"+"&job_status="+"6"+"&job_status_name="+"ขอยกเลิก";

			$.ajaxSetup({
				headers: {
					'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
					'X-CSRF-Token': $('meta[name=_token]').attr('content')
				},
			});

			noty({
				width: 200,
				text: 'คุณต้องการจะขอยกเลิกรายการใช่หรือไม่?',
				type: confirm,
				dismissQueue: true,
				timeout: 4000,
				layout: 'center',
				buttons: [
					{
						addClass: 'btn btn-primary btn-xs',
						text: 'ตกลง',
						onClick: function ($noty) { //this = button element, $noty = $noty element
							$noty.close();

							$.ajax({
								url: 'api/updateJobStatus',
								type: "POST",
								data: dataString,
								success: function(data) {
									console.log(data);
									if(data[0].msg == "ok"){
										noty({
												force: true,
												text: 'บันทึกรายการเรียบร้อย',
												type: 'success',
												layout: 'center'
											});
									   table.row(row).remove().draw();
									}
									else{
										noty({
												force: true,
												text: 'รายการนี้ไม่สามารถยกเลิกได้',
												type: 'error',
												layout: 'center'
											});
									   table.row(row).remove().draw();
									}
								},
								error: function(xhr, textStatus, error) {
									console.log(xhr.statusText);
									console.log(textStatus);
									console.log(error);
								}
							});
						}
					},
					{
						addClass: 'btn btn-danger btn-xs',
						text: 'ยกเลิก',
						onClick: function ($noty) {
							$noty.close();
							noty({
								force: true,
								text: 'ยกเลิกการทำรายการ',
								type: 'error',
								layout: 'center'
							});
						}
					}
				]
			});

		});

	});



</script>
<script>
	// Month and day
    $("#job_start_date").AnyTime_picker({
        format: "%d/%m/%Z"
    });
</script>
@stop
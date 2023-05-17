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
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/forms/inputs/duallistbox.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/form_dual_listboxes.js')}}"></script>

<script>
$(document).ready(function() {

	$('.listbox-staff-mas').bootstrapDualListbox({
        moveOnSelect: false,
        infoText: 'จำนวน {0}',
        infoTextFiltered: '<span class="label label-warning">พบจำนวน</span> {0} จาก {1}',
        infoTextEmpty: 'พนักงานหมด',
        filterPlaceHolder: 'ค้นหา',
        filterTextClear: 'แสดงทั้งหมด'
    });
});

	
</script>


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
									<th>ตะกร้า</th>
									<th>บริษัทผู้ค้า</th>
									<th>รหัสบริษัทลูกค้า</th>
									<th>บริษัทลูกค้า</th>
									<th>ที่อยู่</th>
									<th>ประเภทงาน</th>
									<th>ผู้รับ</th>
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
				<!-- Full width modal -->
				<div id="modal_default" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
									<legend class="text-bold"><h3>รหัสบริษัทลูกค้า: <span class="text-semibold text-indigo-800" id="job_id"></span></h3></legend>
									<input type="hidden" id="hcid"></input>
									<input type="hidden" id="howner_id"></input>
									<input type="hidden" id="hbasket"></input>
									<label>ตะกร้า:</label><i class="icon-basket ml-10"></i>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<select data-placeholder="เลือกตะกร้า" class="select" id="basket" name="basket">
													<option></option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<select data-placeholder="เลือกกลุ่มภายใน" class="select" id="groupBasket" name="groupBasket">
													<option value="1">กลุ่ม 1</option>
													<option value="2">กลุ่ม 2</option>
													<option value="3">กลุ่ม 3</option>
												</select>
											</div>
										</div>
									</div>
									<legend class="text-bold"></legend>
									<div class="form-group">
										<input type="hidden" id="hjobstaff"></input>
										<label>พนักงานส่ง:</label><i class="icon-pencil5 ml-10"></i>
										<select data-placeholder="พนักงานส่ง" class="select" id="jobstaff" name="jobstaff">
											<option></option>
										</select>
									</div>
									<legend class="text-bold"></legend>
									<div class="form-group">
										<input type="hidden" id="hjobstatus"></input>
										<label>สถานะ:</label><i class="icon-pencil5 ml-10"></i>
										<select data-placeholder="เลือกสถานะ" class="select" id="jobstatus" name="jobstatus">
											<option></option>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary noty-runner">บันทึก</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /full width modal -->
				</div>
				<!-- /content area -->
<script>
	var notes = [];

	// Text options
	notes['alert'] = 'Best check yo self, you\'re not looking too good.';
	notes['error'] = 'พบปัญหาบางประการลองทำรายการใหม่อีกครั้ง';
	notes['success'] = 'บันทึกรายการเรียบร้อย';
	notes['information'] = 'This alert needs your attention, but it\'s not super important.';
	notes['warning'] = 'Warning! Best check yo self, you\'re not looking too good.';
	notes['confirm'] = 'คุณต้องการจะบันทึกรายการใช่หรือไม่?';

	$('.noty-runner').click(function () {

	noty({
		width: 200,
		text: notes['confirm'],
		type: notes['confirm'],
		dismissQueue: true,
		timeout: 4000,
		layout: "center",
		buttons: [
			{
				addClass: 'btn btn-primary btn-xs',
				text: 'ตกลง',
				onClick: function ($noty) {
					$noty.close();
					updateJob();
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
						layout: "center"
					});
				}
			}
		]
	});
	return false;
	});

	function updateJob(){
		
		var basketid = document.getElementById("basket");
    	var basketname = basketid.options[basketid.selectedIndex].text;

		var jobstaff_id = document.getElementById("jobstaff");
    	var jobstaff_name = jobstaff_id.options[jobstaff_id.selectedIndex].text;

		var jobstatus_id = document.getElementById("jobstatus");
    	var jobstatus_name = jobstatus_id.options[jobstatus_id.selectedIndex].text;

		var hcid = document.getElementById("hcid").value
		var howner_id = document.getElementById("howner_id").value;

		var dataString = "company_user_cid="+hcid
							+"&company_owner_id="+howner_id
							+"&basket_id="+document.getElementById("basket").value
							+"&basket_name="+basketname
							+"&staff_id="+document.getElementById("jobstaff").value
							+"&staff_name="+jobstaff_name
							+"&job_status="+document.getElementById("jobstatus").value
							+"&job_status_name="+jobstatus_name;

		$.ajax({
			url: 'api/updateJobStatusBSJ',
			type: "POST",
			data: dataString,
			success: function(data) {
				console.log(data); 
				noty({
					force: true,
					text: 'บันทึกรายการเรียบร้อย',
					type: 'success',
					layout: 'center'
				});
			setTimeout(function() {
				location.reload();
			}, 1000); 
			},
			error: function(xhr, textStatus, error) {
				console.log(xhr.statusText);
				console.log(textStatus);
				console.log(error);
				reject(error);
			}
		});

	}
</script>
<script>
	$("#basket").change(function() {
    	var id = $(this).val();
		var gid = $("#groupBasket").val();
		console.log(id, gid);
		addStaff(id, gid);
	});

	$("#groupBasket").change(function() {
		var gid = $(this).val();
		var id = $("#basket").val();
		addStaff(id, gid);
	});

	function addStaff(basketid, gid){

		function delay(time) {
			return new Promise(resolve => setTimeout(resolve, time));
		}

		$.ajax({
			url: 'api/getMasterBasketStaffId',
			type: "POST",
			data: { basket_id: basketid, basket_group_id: gid},
			success: function(data1) {
				console.log(data1);

				var select = $("#jobstaff");
				select.empty();
				
				$.each(data1, function(index2, item2) {
					console.log("item2.id "+item2.staff_id);
					var option = $("<option>").val(item2.staff_id).text(item2.staff_name);  
					select.append(option);  
				});  
				
				async function ddl3(){
							await delay(1000);
							console.log("#jobstaff:"+$("#hjobstaff").val());
							$("#jobstaff").val($("#hjobstaff").val()).trigger('change');
						}

						ddl3();

			},
			error: function(xhr, textStatus, error) {
				console.log(xhr.statusText);
				console.log(textStatus);
				console.log(error);
				reject(error);
			}
		});
	}
</script>
<script>
	function deleteStaffBasket(shid){
		console.log("delelete: "+shid);
		
		$.ajax({
			url: 'api/deleteMasterBasketStaffId',
			type: "POST",
			data: { basket_id: shid},
				success: function(data) {
					console.log("delelete return: "+data);
				},
				error: function(xhr, textStatus, error) {
					console.log(xhr.statusText);
					console.log(textStatus);
					console.log(error);
				}
		});

	}
</script>
<script>
	function getBasket(){
		function delay(time) {
			return new Promise(resolve => setTimeout(resolve, time));
		}
		$.ajax({
				url: 'api/getMasterBasketAll',
				type: "POST",
					success: function(data) {
						console.log(data.data);
						var select = $("#basket");
						select.empty();
						$.each(data.data, function(index, item) {
							var option = $("<option>").val(item.id).text(item.basket_name);
							select.append(option);
						});

						async function ddl2(){
							await delay(1000);
							console.log("#basket"+$("#hbasket").val());
							$("#basket").val($("#hbasket").val()).trigger('change');
						}

						ddl2();
					},
					error: function(xhr, textStatus, error) {
						console.log(xhr.statusText);
						console.log(textStatus);
						console.log(error);
					}
			});
	}
</script>
<script>
	function getJobStatusAll(){

		function delay(time) {
			return new Promise(resolve => setTimeout(resolve, time));
		}

		$.ajax({
				url: 'api/getJobStatusAll',
				type: "POST",
					success: function(data) {
						console.log(data.data);
						var select = $("#jobstatus");
						select.empty();
						$.each(data.data, function(index, item) {
							var option = $("<option>").val(item.job_status_id).text(item.job_status_name);
							select.append(option);
						});

						async function ddl1(){
							await delay(1000);
							console.log("#jobstatus"+$("#hjobstatus").val());
							$("#jobstatus").val($("#hjobstatus").val()).trigger('change');
						}

						ddl1();
					},
					error: function(xhr, textStatus, error) {
						console.log(xhr.statusText);
						console.log(textStatus);
						console.log(error);
					}
			});
	}
</script>
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
					"url": "api/getJobMasterAll",
					"type": "POST",
					"data": {"company_owner_id": "{{ Session::get('user_id') }}"},
					"dataSrc": function (data) {
						var totalRecords = data.recordsTotal;
						var filteredRecords = data.recordsFiltered;

						console.log(data.data);

						if (data.data.length === 0) {
							$('#selectJobMaster tbody').append('<tr><td colspan="7"><center>ไม่พบข้อมูล</center></td></tr>');
						}
						return data.data;
					}
				},
				"columns": [
					{ "data": "basket_name" },
					{ "data": "company_name" },
					{ "data": "company_user_cid" },
					{ "data": "cus_name" },
					{ "data": "cus_address" },
					{ "data": "job_type_name" },
					{ "data": "cus_recive_name" },
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
								return '<button type="button" class="btn bg-purple addSelected" data-toggle="modal" data-owner_id="' + row.company_owner_id + '"data-cid="' + data + '" data-basket="' + row.basket_id + '" data-job_staff="' + row.staff_id + '" data-job_status="' + row.job_status + '" data-target="#modal_default" onclick="getCusId(' + data + ')">จัดการงาน</button>';
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
					"url": "api/getJobMasterByDateAll",
					"type": "POST",
					"data": {"job_start_date": $(this).val()},
					"dataSrc": function (data) {
						var totalRecords = data.recordsTotal;
						var filteredRecords = data.recordsFiltered;
						console.log(data.data);
						if (data.data.length === 0) {
							$('#selectJobMaster tbody').append('<tr><td colspan="7"><center>ไม่พบข้อมูล</center></td></tr>');
						}
						return data.data;
					}
				},
				"columns": [
					{ "data": "basket_name" },
					{ "data": "company_name" },
					{ "data": "company_user_cid" },
					{ "data": "cus_name" },
					{ "data": "cus_address" },
					{ "data": "job_type_name" },
					{ "data": "cus_recive_name" },
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
								return '<button type="button" class="btn bg-purple addSelected" data-toggle="modal" data-owner_id="' + row.company_owner_id + '"data-cid="' + data + '" data-basket="' + row.basket_id + '" data-job_status="' + row.job_status + '" data-job_staff="' + row.staff_id + '" data-target="#modal_default" onclick="getCusId(' + data + ')">จัดการงาน</button>';
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

	});
</script>
<script>
	$('#selectJobMaster').on('click', '.addSelected', function() {
			var job_status = $(this).data('job_status');
			var basket = $(this).data('basket');
			var owner_id = $(this).data('owner_id');
			var cid = $(this).data('cid');
			var job_staff = $(this).data('job_staff');
			$("#hjobstatus").val(job_status);
			$("#hjobstaff").val(job_staff);
			$("#hbasket").val(basket);
			$("#howner_id").val(owner_id);
			$("#hcid").val(cid);
			console.log('job_status: '+job_status);
			console.log('basket: '+basket);
			console.log('owner_id: '+owner_id);
			console.log('cid: '+cid);
			addStaff(basket);
	});		
</script>
<script>
	function getCusId(cusId) {
		console.log(cusId);
		$("#job_id").text(cusId);
		
		getBasket();
		getJobStatusAll();
	}
</script>
<script>
	// Month and day
    $("#job_start_date").AnyTime_picker({
        format: "%d/%m/%Z"
    });
</script>
@stop
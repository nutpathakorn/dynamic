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
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/extensions/select.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/forms/selects/select2.min.js')}}"></script>	
<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/datatables_responsive.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/form_layouts.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/forms/inputs/duallistbox.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/form_dual_listboxes.js')}}"></script>

<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/anytime.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/pickadate/legacy.js')}}"></script>

<script>
$(document).ready(function() {

	var currentDate = new Date();

	var formattedDate = (currentDate.getDate() < 10 ? '0' : '') + currentDate.getDate() + '/'
						+ ((currentDate.getMonth()+1) < 10 ? '0' : '') + (currentDate.getMonth()+1) + '/'
						+ currentDate.getFullYear();

	$("#job_start_date").val(formattedDate).trigger('change');

	$('.listbox-staff-mas').bootstrapDualListbox({
        moveOnSelect: false,
        infoText: 'จำนวน {0}',
        infoTextFiltered: '<span class="label label-warning">พบจำนวน</span> {0} จาก {1}',
        infoTextEmpty: 'พนักงานหมด',
        filterPlaceHolder: 'ค้นหา',
        filterTextClear: 'แสดงทั้งหมด'
    });

	$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });
	
	// $('#selectMasterBasket').DataTable({
	// 			"processing": true,
	// 			"serverSide": true,
	// 			"searching": true,
	// 			"ajax": {
	// 				"url": "api/getMasterBasket",
	// 				"type": "POST",
	// 				"data" : "job_start_date="+ $("#job_start_date").val(formattedDate),
	// 				"dataSrc": function (data) {
	// 					var totalRecords = data.recordsTotal;
	// 					var filteredRecords = data.recordsFiltered;

	// 					console.log(data.data);
	// 					console.log(totalRecords);
	// 					console.log(filteredRecords);

	// 					if (data.data.length === 0) {
	// 						$('#selectMasterBasket tbody').append('<tr><td colspan="7"><center>ไม่พบข้อมูล</center></td></tr>');
	// 					}
	// 					return data.data;
	// 				}
	// 			},
	// 			"columns": [
	// 				{ "data": "id" },
	// 				{ "data": "basket_name" },
	// 				{ "data": "basket_province" },
	// 				{ "data": "basket_district" },
	// 				{ "data": "basket_sub_district" },
	// 				{ "data": "count" },
	// 				{ 
	// 					"data": "id",
	// 					"render": function ( data, type, row ) {
	// 						return '<button type="button" class="btn btn-warning btn-icon text-center mr-5" data-toggle="modal" data-target="#add_Staff" onclick="addStaff(' + data + ')"><i class="icon-users"></i></button><button type="button" class="btn btn-primary btn-icon text-center mr-5" data-toggle="modal" data-target="#edit_basket" onclick="getCusId(' + data + ')"><i class="icon-pencil5"></i></button><button type="button" class="btn btn-danger btn-icon text-center mr-5" onclick="getCusIdDelete(' + data + ')"><i class="icon-bin"></i></button>';
	// 					}
	// 				}
	// 			],
	// 			"columnDefs": [
	// 			{
	// 				"targets": 5,
	// 				"className": "nowrap text-center"
	// 			}
	// 			]
	// 		});
	
	
	var notes = [];

    // Text options
    notes['alert'] = 'Best check yo self, you\'re not looking too good.';
    notes['error'] = 'พบปัญหาบางประการลองทำรายการใหม่อีกครั้ง';
    notes['success'] = 'บันทึกรายการเรียบร้อย';
    notes['information'] = 'This alert needs your attention, but it\'s not super important.';
    notes['warning'] = 'Warning! Best check yo self, you\'re not looking too good.';
    notes['confirm'] = 'คุณต้องการจะบันทึกรายการใช่หรือไม่?';

		// Initialize
		$('.noty-runner').click(function () {
		if(document.getElementById("txtbasket").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกชื่อตะกร้า',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("txtdistrict").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกอำเภอ',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("txtsubdistrict").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกตำบล',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("txtprovince").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้เลือกจังหวัด',
				type: 'warning',
				layout: "center"
			});
		}else{
			var self = $(this);
			noty({
				width: 200,
				text: notes[self.data('type')],
				type: self.data('type'),
				dismissQueue: true,
				timeout: 4000,
				layout: self.data('layout'),
				buttons: (self.data('type') != 'confirm') ? false : [
					{
						addClass: 'btn btn-primary btn-xs',
						text: 'ตกลง',
						onClick: function ($noty) { //this = button element, $noty = $noty element
							$noty.close();
							create_master_basket();
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
								layout: self.data('layout')
							});
						}
					}
				]
			});
			return false;
		}
    });

	$('.enoty-runner').click(function () {
		if(document.getElementById("etxtbasket").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกชื่อตะกร้า',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("etxtdistrict").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกอำเภอ',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("etxtsubdistrict").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกตำบล',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("etxtprovince").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้เลือกจังหวัด',
				type: 'warning',
				layout: "center"
			});
		}else{
			var self = $(this);
			noty({
				width: 200,
				text: notes[self.data('type')],
				type: self.data('type'),
				dismissQueue: true,
				timeout: 4000,
				layout: self.data('layout'),
				buttons: (self.data('type') != 'confirm') ? false : [
					{
						addClass: 'btn btn-primary btn-xs',
						text: 'ตกลง',
						onClick: function ($noty) { //this = button element, $noty = $noty element
							$noty.close();
							edit_master_basket();
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
								layout: self.data('layout')
							});
						}
					}
				]
			});
			return false;
		}
    });

	$('.snoty-runner').click(function () {

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
						onClick: function ($noty) { //this = button element, $noty = $noty element
							$noty.close();
							staff_master_basket();
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
});
</script>
<script> 
    function create_master_basket()
    {
		var txtprovince = document.getElementById("txtprovince");
    	var txtprovince_txt = txtprovince.options[txtprovince.selectedIndex].text;
		
		var txtdistrict = document.getElementById("txtdistrict");
    	var txtdistrict_txt = txtdistrict.options[txtdistrict.selectedIndex].text;

		var txtsubdistrict = document.getElementById("txtsubdistrict");
    	var txtsubdistrict_txt = txtsubdistrict.options[txtsubdistrict.selectedIndex].text;

		var dataString = "basket_name="+document.getElementById("txtbasket").value
							+"&basket_province_id="+document.getElementById("txtprovince").value
							+"&basket_district_id="+document.getElementById("txtdistrict").value
							+"&basket_sub_district_id="+document.getElementById("txtsubdistrict").value
							+"&basket_province="+txtprovince_txt
							+"&basket_district="+txtdistrict_txt
							+"&basket_sub_district="+txtsubdistrict_txt;
							
		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

		$.ajax({
			type: "POST",
			url: 'api/insMasterBasket',
			data: dataString,
			success: function(data){  
				console.log(data);
				if(data[0].msg === "name_exist"){
					noty({
							force: true,
							text: 'มีชื่อนี้ในตะกร้าอื่นแล้ว',
							type: 'error',
							layout: 'center'
						});
					
				}else if(data[0].msg === "record_exists"){
					noty({
							force: true,
							text: 'มีการตั้งค่านี้ในตะกร้าอื่นแล้ว',
							type: 'error',
							layout: 'center'
						});
				}else if(data[0].msg === "ok"){
					noty({
						force: true,
						text: 'บันทึกรายการเรียบร้อย',
						type: 'success',
						layout: 'center'
					});
					setTimeout(function() {
						location.reload();
					}, 1000);
				}
				
			}           
		});
	}
</script>
<script> 
    function edit_master_basket()
    {

		var txtprovince = document.getElementById("etxtprovince");
    	var txtprovince_txt = txtprovince.options[txtprovince.selectedIndex].text;
		
		var txtdistrict = document.getElementById("etxtdistrict");
    	var txtdistrict_txt = txtdistrict.options[txtdistrict.selectedIndex].text;

		var txtsubdistrict = document.getElementById("etxtsubdistrict");
    	var txtsubdistrict_txt = txtsubdistrict.options[txtsubdistrict.selectedIndex].text;

		var dataString = "id="+document.getElementById("hid").value
							+"&basket_name="+document.getElementById("etxtbasket").value
							+"&basket_province_id="+document.getElementById("etxtprovince").value
							+"&basket_district_id="+document.getElementById("etxtdistrict").value
							+"&basket_sub_district_id="+document.getElementById("etxtsubdistrict").value
							+"&basket_province="+txtprovince_txt
							+"&basket_district="+txtdistrict_txt
							+"&basket_sub_district="+txtsubdistrict_txt;
							
		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

		$.ajax({
			type: "POST",
			url: 'api/updateMasterBasket',
			data: dataString,
			success: function(data){  
				console.log(data);
				if(data[0].msg === "ok"){
					noty({
						force: true,
						text: 'บันทึกรายการเรียบร้อย',
						type: 'success',
						layout: 'center'
					});
					setTimeout(function() {
						location.reload();
					}, 1000);
				}else{
					noty({
							force: true,
							text: 'พบปัญหาการบันทึกกรุณาลองใหม่อีกครั้ง',
							type: 'error',
							layout: 'center'
						});
				}
				
			}           
		});
	}
</script>

<!-- Main content -->
<div class="content-wrapper">
<button type="button" id="btn_success" class="btn btn-default btn-sm noty-runner" data-layout="center" data-type="confirm" style="display:none;"><i class="icon-play3 position-right"></i></button>
<button type="button" id="btn_error" class="btn btn-default btn-sm noty-runner" data-layout="center" data-type="error" style="display:none;"><i class="icon-play3 position-right"></i></button>
<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">จัดการตะกร้างาน</span></h4>
		</div>

	</div>

	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="index.html"><i class="icon-home2 position-left"></i> หน้าหลัก</a></li>
			<li><a href="form_layout_vertical.html">จัดการตะกร้างาน</a></li>
		</ul>

	</div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">

	<!-- 2 columns form -->
	<form>
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">สร้างตะกร้างาน</h5>
				
			</div>

			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<fieldset>
							<legend class="text-semibold"><i class="icon-basket position-left"></i> ข้อมูลตะกร้า</legend>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>ชื่อตะกร้า: <span class="text-danger text-size-small">*</span></label>
										<input type="text" id="txtbasket" name="txtbasket" class="form-control" placeholder="ชื่อตะกร้า">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>จังหวัด: <span class="text-danger text-size-small">*</span></label>
										<select data-placeholder="เลือกจังหวัด" class="select" id="txtprovince" name="txtprovince">
											<option></option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>อำเภอ: <span class="text-danger text-size-small">*</span></label>
										<select data-placeholder="เลือกอำเภอ" class="select" id="txtdistrict" name="txtdistrict">
											<option></option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>ตำบล: <span class="text-danger text-size-small">*</span></label>
										<select data-placeholder="เลือกตำบล" class="select" id="txtsubdistrict" name="txtsubdistrict">
											<option></option>
										</select>
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				</div>

				<div class="text-right">
					<button type="button" id="btnsubmit" class="btn btn-primary noty-runner" data-layout="center" data-type="confirm">บันทึก <i class="icon-arrow-right14 position-right"></i></button>
				</div>
			</div>
		</div>
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">รายการตะกร้างาน</h5>
				
			</div>
			<div class="panel-body">
				
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="cursor-move">วันที่:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="icon-calendar3"></i></span>
								<input id="job_start_date" name="job_start_date" type="text" class="form-control" placeholder="วันที่">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<table  id="selectMasterBasket" class="table">
							<thead>
								<tr>
									<th>รหัส</th>
									<th>ชื่อตะกร้า</th>
									<th>ค่าจังหวัด</th>
									<th>ค่าอำเภอ</th>
									<th>ค่าตำบล</th>
									<th>จำนวนงาน</th>
									<th class="text-center">จัดการ</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
	</form>
	<!-- /2 columns form -->
<script>
$(document).ready(function() {

		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });
     
		$.ajax({
			type: "GET",
			url: 'api/provinces',
			success: function(data){  
				var select = $("#txtprovince");
				var select2 = $("#etxtprovince");
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select.append(option);
				});
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select2.append(option);
				});
			}
		});  
});
</script>
<script>
$(document).ready(function() {
  	$("#txtprovince").change(function() {
    	var selectValue = $(this).val();
		$.ajax({
			type: "POST",
			url: 'api/districts',
			data: "province_id="+selectValue,
			success: function(data){  
				var select = $("#txtdistrict");
				select.empty();
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select.append(option);
				});
			}
		});
	});

	$("#txtdistrict").change(function() {
    	var selectValue = $(this).val();
		$.ajax({
			type: "POST",
			url: 'api/subdistricts',
			data: "district_id="+selectValue,
			success: function(data){  
				$("#txtpost").val("");
				$("#txtpost").val(data[0].zip_code);
				var select = $("#txtsubdistrict");
				select.empty();
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select.append(option);
				});
			}
		});
	});


	$("#groupBasket").change(function() {
    	var gid = $(this).val();
		var id = $("#shid").val();
		console.log(id+" "+gid);
		addStaff(id, gid);
	});
});
</script>

<script>
	$('#job_start_date').on('change', function() {
			console.log($(this).val());

			var table = $('#selectMasterBasket').DataTable();
			
			if (table.settings()[0]) {
				table.destroy();
			}

			$.ajaxSetup({
				headers: {
					'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
					'X-CSRF-Token': $('meta[name=_token]').attr('content')
				},
			});

			$('#selectMasterBasket').DataTable({
				"processing": true,
				"serverSide": true,
				"searching": true,
				"ajax": {
					"url": "api/getMasterBasket",
					"type": "POST",
					"data": {"job_start_date": $("#job_start_date").val()},
					"dataSrc": function (data) {
						var totalRecords = data.recordsTotal;
						var filteredRecords = data.recordsFiltered;

						console.log(data.data);
						console.log(totalRecords);
						console.log(filteredRecords);

						if (data.data.length === 0) {
							$('#selectMasterBasket tbody').append('<tr><td colspan="7"><center>ไม่พบข้อมูล</center></td></tr>');
						}
						return data.data;
					}
				},
				"columns": [
					{ "data": "id" },
					{ "data": "basket_name" },
					{ "data": "basket_province" },
					{ "data": "basket_district" },
					{ "data": "basket_sub_district" },
					{ "data": "count" },
					{ 
						"data": "id",
						"render": function ( data, type, row ) {
							return '<button type="button" class="btn btn-warning btn-icon text-center mr-5" data-toggle="modal" data-target="#add_Staff" onclick="addStaff2(' + data + ',1)"><i class="icon-users"></i></button><button type="button" class="btn btn-primary btn-icon text-center mr-5" data-toggle="modal" data-target="#edit_basket" onclick="getCusId(' + data + ')"><i class="icon-pencil5"></i></button><button type="button" class="btn btn-danger btn-icon text-center mr-5" onclick="getCusIdDelete(' + data + ')"><i class="icon-bin"></i></button>';
						}
					}
				],
				"columnDefs": [
				{
					"targets": 5,
					"className": "nowrap text-center"
				}
				]
			});
	});
</script>

<script>
$(document).ready(function() {

  	$("#etxtprovince").change(function() {
    	var selectValue = $(this).val();
		$.ajax({
			type: "POST",
			url: 'api/districts',
			data: "province_id="+selectValue,
			success: function(data){  
				var select = $("#etxtdistrict");
				select.empty();
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select.append(option);
				});
			}
		});
	});

	$("#etxtdistrict").change(function() {
    	var selectValue = $(this).val();
		$.ajax({
			type: "POST",
			url: 'api/subdistricts',
			data: "district_id="+selectValue,
			success: function(data){  
				var select = $("#etxtsubdistrict");
				select.empty();
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select.append(option);
				});
			}
		});
	});
});
</script>

<script>
	function getCusIdDelete(id){
	
	var notes = [];

    // Text options
    notes['alert'] = 'Best check yo self, you\'re not looking too good.';
    notes['error'] = 'พบปัญหาบางประการลองทำรายการใหม่อีกครั้ง';
    notes['success'] = 'บันทึกรายการเรียบร้อย';
    notes['information'] = 'This alert needs your attention, but it\'s not super important.';
    notes['warning'] = 'Warning! Best check yo self, you\'re not looking too good.';
    notes['confirm'] = 'คุณต้องการจะบันทึกรายการใช่หรือไม่?';

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
						onClick: function ($noty) { //this = button element, $noty = $noty element
							$noty.close();
							$.ajax({
								url: 'api/delMasterBasket',
								type: "POST",
								data: "id="+id,
									success: function(data) {
										console.log(data);
										if(data[0].msg == "ok"){
											noty({
													force: true,
													text: 'บันทึกรายการเรียบร้อย',
													type: 'success',
													layout: 'center'
												});
												setTimeout(function() {
													location.reload();
												}, 1000);
										}
										else{
											noty({
													force: true,
													text: 'รายการนี้ไม่สามารถลบได้',
													type: 'error',
													layout: 'center'
												});
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
								layout: "center"
							});
						}
					}
				]
			});
	}

	function getCusId(id){

		function delay(time) {
			return new Promise(resolve => setTimeout(resolve, time));
		}

		$.ajax({
			url: 'api/getMasterBasketId',
			type: "POST",
			data: "id="+id,
				success: function(data) {
					console.log(data);
					$("#etxtbasket").val(data[0].basket_name);
						$("#hid").val(data[0].id);

					async function ddl1(){
						$("#etxtprovince").val(data[0].basket_province_id).trigger('change');
						await delay(1000);
						$("#etxtdistrict").val(data[0].basket_district_id).trigger('change');
						await delay(1000);
						$("#etxtsubdistrict").val(data[0].basket_sub_district_id).trigger('change');
						await delay(1000);
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

	function addStaff2(id, gid){
		$("#shid").val(id);
		$("#groupBasket").val(gid).trigger('change');
	}

	function addStaff(id, gid){
	$("#shid").val(id);
	//console.log("clear");
	$.ajax({
		url: 'api/getMasterBasketStaffId',
		type: "POST",
		data: { basket_id: id, basket_group_id: gid},
		success: function(data1) {
			console.log(data1);

			$.ajax({
				url: 'api/getStaffMas',
				type: "POST",
				data: { basket_id: id, basket_group_id: gid},
				success: function(data2) {
					console.log(data2);
					var select = $("#selectStaffMas");
					select.empty();
					$.each(data2, function(index, item) {
						console.log("item.id "+item.id);
						var option = $("<option>").val(item.id).text(item.staff_name);  
						select.append(option);  
					});

					$.each(data1, function(index2, item2) {
						console.log("item2.id "+item2.staff_id);
						var option = $("<option selected='selected'>").val(item2.staff_id).text(item2.staff_name);  
						select.append(option);  
					});
					select.bootstrapDualListbox('refresh');
				},
				error: function(xhr, textStatus, error) {
					console.log(xhr.statusText);
					console.log(textStatus);
					console.log(error);
				}
			});         
		},
		error: function(xhr, textStatus, error) {
			console.log(xhr.statusText);
			console.log(textStatus);
			console.log(error);
			reject(error);
		}
	});
	}



	function deleteStaffBasket(shid, gid){
		console.log("delelete: "+shid);
		
		$.ajax({
			url: 'api/deleteMasterBasketStaffId',
			type: "POST",
			data: { basket_id: shid, basket_group_id: gid},
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
	function staff_master_basket(){

		var shid = document.getElementById("shid").value;
		var gid = document.getElementById("groupBasket").value;
		deleteStaffBasket(shid, gid);
		console.log("shid"+shid);

		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
		});

		const selectedOptions = $('#selectStaffMas option:selected');

		const selectedData = selectedOptions.map(function() {
			return { value: $(this).val(), text: $(this).text() };
		}).get();

		selectedData.forEach(data => {

			console.log(data.value);
			console.log(data.text);

			$.ajax({
				url: 'api/insStaffMas',
				type: 'POST',
				data: { basket_id: shid, basket_group_id: gid, value: data.value, text: data.text },
				success: function(data) {
					console.log(data);
				},
				error: function(xhr, textStatus, error) {
					console.log('Error posting data: ' + error);
				}
			});

		});
		
		noty({
			force: true,
			text: 'บันทึกรายการเรียบร้อย',
			type: 'success',
			layout: 'center'
		});
		setTimeout(function() {
			location.reload();
		}, 1000);
		
	}
</script>
<script>
	// Month and day
    $("#job_start_date").AnyTime_picker({
        format: "%d/%m/%Z"
    });
</script>
</div>
<!-- /content area -->
					<!-- edit basket modal -->
					<div id="edit_basket" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
								<!-- Basic table -->
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<fieldset>
												<legend class="text-semibold"><i class="icon-basket position-left"></i> ข้อมูลตะกร้า</legend>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>ชื่อตะกร้า: <span class="text-danger text-size-small">*</span></label>
															<input type="text" id="etxtbasket" name="etxtbasket" class="form-control" placeholder="ชื่อตะกร้า" disabled>
															<input type="hidden" id="hid" name="hid">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>จังหวัด: <span class="text-danger text-size-small">*</span></label>
															<select data-placeholder="เลือกจังหวัด" class="select" id="etxtprovince" name="etxtprovince">
																<option></option>
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>อำเภอ: <span class="text-danger text-size-small">*</span></label>
															<select data-placeholder="เลือกอำเภอ" class="select" id="etxtdistrict" name="etxtdistrict">
																<option></option>
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>ตำบล: <span class="text-danger text-size-small">*</span></label>
															<select data-placeholder="เลือกตำบล" class="select" id="etxtsubdistrict" name="etxtsubdistrict">
																<option></option>
															</select>
														</div>
													</div>
												</div>
											</fieldset>
										</div>
									</div>
								</div>
									<!-- /basic table -->
								</div>

								<div class="modal-footer">
									<button id="close_modal" type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="button" id="ebtnsubmit" class="btn btn-primary enoty-runner" data-layout="center" data-type="confirm">บันทึก <i class="icon-arrow-right14 position-right"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- /basic modal -->
					<!-- add staff modal -->
					<div id="add_Staff" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
									<!-- Custom text support -->
									<div class="panel panel-flat">
										<div class="panel-heading">
											<h5 class="panel-title">พนักงานดูแลตะกร้า</h5>
											<input type="hidden" id="shid" name="shid">
										</div>

										<div class="panel-body">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
													<select data-placeholder="เลือกกลุ่มภายใน" class="select" id="groupBasket" name="groupBasket">
														<option value="1">กลุ่ม 1</option>
														<option value="2">กลุ่ม 2</option>
														<option value="3">กลุ่ม 3</option>
													</select>
													</div>
												</div>
												<div class="col-md-12">
													<select id="selectStaffMas" name="selectStaffMas[]" multiple="multiple" class="form-control listbox-staff-mas">
													</select>
												</div>
											</div>
										</div>
									</div>
									<!-- /custom text support -->
								</div>

								<div class="modal-footer">
									<button id="close_modal" type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="button" id="btnstaffsave" class="btn btn-primary snoty-runner" data-layout="center" data-type="confirm">บันทึก <i class="icon-arrow-right14 position-right"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- /basic modal -->

</div>
<!-- /main content -->
@stop
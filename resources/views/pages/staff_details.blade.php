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

	function checkType1Status(){
		var type1 = '';

		if (document.getElementById("company_addr1_province_id").value === "" && 
			document.getElementById("company_addr1_district_id").value === "" && 
			document.getElementById("company_addr1_subdistrict_id").value === "") {
			return 1;
		}
		else{
			return 0;
		}
	}

	function checkType2Status(){
		var type2 = '';

		if (document.getElementById("company_addr2_province_id").value === "" && 
			document.getElementById("company_addr2_district_id").value === "" && 
			document.getElementById("company_addr2_subdistrict_id").value === "") {
			return 1;
		}
		else{
			return 0;
		}

	}

		// Initialize
		$('.noty-runner').click(function () {
		if(document.getElementById("company_user_cid").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกรหัสบริษัทลูกค้า',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("company_user_name").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกชื่อริษัท',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("company_addr1_condition").value ===  "" && checkType1Status()==0){
			noty({
				force: true,
				text: 'คุณยังไม่ได้ใส่เงื่อนไขการวางบิล',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("company_addr2_condition").value ===  "" && checkType2Status()==0){
			noty({
				force: true,
				text: 'คุณยังไม่ได้ใส่เงื่อนไขการรับเช็ค',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("company_addr1_addr").value ===  "" && checkType1Status()==0){
			noty({
				force: true,
				text: 'คุณยังไม่ได้ใส่ที่อยู่การวางบิล',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("company_addr2_addr").value ===  "" && checkType2Status()==0){
			noty({
				force: true,
				text: 'คุณยังไม่ได้ใส่ที่อยู่การรับเช็ค',
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
							create_customer_user();
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
});
</script>
<script> 
    function create_customer_user()
    {
		var company_addr1_province_id = document.getElementById("company_addr1_province_id");
    	var company_addr1_province = company_addr1_province_id.options[company_addr1_province_id.selectedIndex].text;

		var company_addr1_district_id = document.getElementById("company_addr1_district_id");
    	var company_addr1_district = company_addr1_district_id.options[company_addr1_district_id.selectedIndex].text;

		var company_addr1_subdistrict_id = document.getElementById("company_addr1_subdistrict_id");
    	var company_addr1_subdistrict = company_addr1_subdistrict_id.options[company_addr1_subdistrict_id.selectedIndex].text;

		var company_addr2_province_id = document.getElementById("company_addr2_province_id");
    	var company_addr2_province = company_addr2_province_id.options[company_addr2_province_id.selectedIndex].text;

		var company_addr2_district_id = document.getElementById("company_addr2_district_id");
    	var company_addr2_district = company_addr2_district_id.options[company_addr2_district_id.selectedIndex].text;

		var company_addr2_subdistrict_id = document.getElementById("company_addr2_subdistrict_id");
    	var company_addr2_subdistrict = company_addr2_subdistrict_id.options[company_addr2_subdistrict_id.selectedIndex].text;

		var dataString = "company_owner_id="+"{{ Session::get('user_id') }}"
							+"&company_user_cid="+document.getElementById("company_user_cid").value
							+"&company_user_name="+document.getElementById("company_user_name").value
							+"&company_addr1_name="+document.getElementById("company_addr1_name").value
							+"&company_addr1_addr="+document.getElementById("company_addr1_addr").value
							+"&company_addr1_province_id="+document.getElementById("company_addr1_province_id").value
							+"&company_addr1_province="+company_addr1_province
							+"&company_addr1_district_id="+document.getElementById("company_addr1_district_id").value
							+"&company_addr1_district="+company_addr1_district
							+"&company_addr1_subdistrict_id="+document.getElementById("company_addr1_subdistrict_id").value
							+"&company_addr1_subdistrict="+company_addr1_subdistrict
							+"&company_addr1_post="+document.getElementById("company_addr1_post").value
							+"&company_addr1_condition="+document.getElementById("company_addr1_condition").value
							+"&company_addr2_name="+document.getElementById("company_addr2_name").value
							+"&company_addr2_addr="+document.getElementById("company_addr2_addr").value
							+"&company_addr2_province_id="+document.getElementById("company_addr2_province_id").value
							+"&company_addr2_province="+company_addr2_province
							+"&company_addr2_district_id="+document.getElementById("company_addr2_district_id").value
							+"&company_addr2_district="+company_addr2_district
							+"&company_addr2_subdistrict_id="+document.getElementById("company_addr2_subdistrict_id").value
							+"&company_addr2_subdistrict="+company_addr2_subdistrict
							+"&company_addr2_post="+document.getElementById("company_addr2_post").value
							+"&company_addr2_condition="+document.getElementById("company_addr2_condition").value;

		console.log(dataString);
							
		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

		$.ajax({
			type: "POST",
			url: 'api/updateCompanyUserId',
			data: dataString,
			success: function(data){  
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
					}, 2000);
				}else{
					noty({
						force: true,
						text: 'พบปัญหาในการบันทึกกรุณาลองใหม่อีกครั้งe',
						type: 'error',
						layout: "center"
					});
				}
				
			},
			error: function(e){
				console.log(e);
			}             
		});
	}
</script>
<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">ลูกค้า</span></h4>
						</div>

					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="/bright/main"><i class="icon-home2 position-left"></i> หน้าหลัก</a></li>
							<li><a href="table_responsive.html">รายการลูกค้า</a></li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Basic responsive configuration -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">รายการลูกค้า</h5>
						</div>

						<table id="selectCustUser" class="table">
							<thead>
								<tr>
									<th>รหัสบริษัท</th>	
									<th>ชื่อบริษัท</th>
									<th>ที่อยู่รับเช็ค</th>
									<th>รายละเอียด</th>
									<th>ที่อยู่วางบิล</th>
									<th>รายละเอียด</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
					<!-- /basic responsive configuration -->

				<!-- Full width modal -->
				<div id="modal_full" class="modal fade">
						<div class="modal-dialog modal-full">
							<div class="modal-content">
								<div class="modal-body">
								<form>
										<div class="row">
										<div class="col-md-12">
													<div class="panel panel-flat">
														<div class="panel-heading">
															<h6 class="panel-title">แก้ไขข้อมูลลูกค้า</h6>
														</div>

														<div class="panel-body">
															<div class="row">
																<div class="col-md-4">
																	<div id="feedback" class="form-group">
																		<label class="cursor-move">รหัสลูกค้า:</label>
																		<input type="text" id="company_user_cid" name="company_user_cid" placeholder="รหัสลูกค้า" class="form-control">
																	</div>
																</div>
																<div class="col-md-8">
																	<div class="form-group">
																		<label class="cursor-move">ชื่อบริษัท: <span class="text-danger text-size-small">*</span></label>
																		<input type="text" id="company_user_name" name="company_user_name" placeholder="ชื่อบริษัท" class="form-control">
																	</div>
																</div>
															</div>
															<div class="tabbable">
																<ul class="nav nav-tabs nav-tabs-highlight text-center">
																	<li class="active"><a href="#centered-tab1" data-toggle="tab">ที่อยู่วางบิล</a></li>
																	<li><a href="#centered-tab2" data-toggle="tab">ที่อยู่รับเช็ค</a></li>
																</ul>

																<div class="tab-content">
																	<div class="tab-pane active" id="centered-tab1">
																	<div class="col-md-12">
																		<div class="panel panel-flat">
																			<div class="panel-heading">
																				<h6 class="panel-title">ที่อยู่วางบิล</h6>
																			</div>

																			<div class="panel-body" id="forms-target-right">
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group">
																							<label class="cursor-move">ชื่อบริษัท:</label>
																							<input type="text" id="company_addr1_name" name="company_addr1_name" placeholder="ชื่อบริษัท" class="form-control">
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="form-group">
																							<label>จังหวัด:</label>
																							<select data-placeholder="เลือกจังหวัด" class="select" id="company_addr1_province_id" name="company_addr1_province_id">
																								<option></option>
																							</select>
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="form-group">
																							<label>อำเภอ:</label>
																							<select data-placeholder="เลือกอำเภอ" class="select" id="company_addr1_district_id" name="company_addr1_district_id">
																								<option></option>
																							</select>
																						</div>
																					</div>

																					<div class="col-md-6">
																						<div class="form-group">
																							<label class="cursor-move">ที่อยู่: <span class="text-danger text-size-small">*</span></label>
																							<input type="text" id="company_addr1_addr" name="company_addr1_addr" placeholder="ที่อยู่" class="form-control">
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="form-group">
																							<label>ตำบล:</label>
																							<select data-placeholder="เลือกตำบล" class="select" id="company_addr1_subdistrict_id" name="company_addr1_subdistrict_id">
																								<option></option>
																							</select>
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="form-group">
																							<label>รหัสไปรษณีย์:</label>
																							<input type="text" id="company_addr1_post" name="company_addr1_post"  class="form-control" placeholder="ex: 10800, 10210">
																						</div>
																					</div>
																					
																				</div>

																				<div class="row">
																					<div class="col-md-12">
																						<div class="form-group">
																							<label class="cursor-move">เงื่อนไข: <span class="text-danger text-size-small">*</span></label>
																							<textarea rows="3" cols="3" id="company_addr1_condition" name="company_addr1_condition" placeholder="เงื่อนไข" class="form-control"></textarea>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	</div>

																	<div class="tab-pane" id="centered-tab2">
																	<div class="col-md-12">
																		<div class="panel panel-flat">
																			<div class="panel-heading">
																				<h6 class="panel-title">ที่อยู่รับเช็ค</h6>
																			</div>

																			<div class="panel-body" id="forms-target-right">
																				<div class="row">
																					<div class="col-md-6">
																						<div class="form-group">
																							<label class="cursor-move">ชื่อบริษัท:</label>
																							<input type="text" id="company_addr2_name" name="company_addr2_name" placeholder="ชื่อบริษัท" class="form-control">
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="form-group">
																							<label>จังหวัด:</label>
																							<select data-placeholder="เลือกจังหวัด" class="select" id="company_addr2_province_id" name="company_addr2_province_id">
																								<option></option>
																							</select>
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="form-group">
																							<label>อำเภอ:</label>
																							<select data-placeholder="เลือกอำเภอ" class="select" id="company_addr2_district_id" name="company_addr2_district_id">
																								<option></option>
																							</select>
																						</div>
																					</div>

																					<div class="col-md-6">
																						<div class="form-group">
																							<label class="cursor-move">ที่อยู่: <span class="text-danger text-size-small">*</span></label>
																							<input type="text" id="company_addr2_addr" name="company_addr2_addr" placeholder="ที่อยู่" class="form-control">
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="form-group">
																							<label>ตำบล:</label>
																							<select data-placeholder="เลือกตำบล" class="select" id="company_addr2_subdistrict_id" name="company_addr2_subdistrict_id">
																								<option></option>
																							</select>
																						</div>
																					</div>
																					<div class="col-md-3">
																						<div class="form-group">
																							<label>รหัสไปรษณีย์:</label>
																							<input type="text" id="company_addr2_post" name="company_addr2_post"  class="form-control" placeholder="ex: 10800, 10210">
																						</div>
																					</div>
																					
																				</div>

																				<div class="row">
																					<div class="col-md-12">
																						<div class="form-group">
																							<label class="cursor-move">เงื่อนไข: <span class="text-danger text-size-small">*</span></label>
																							<textarea rows="3" cols="3" id="company_addr2_condition" name="company_addr2_condition" placeholder="เงื่อนไข" class="form-control"></textarea>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	</div>
																</div>
															</div>
															<div class="text-center">
																<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
																<button type="button" class="btn btn-primary noty-runner" data-layout="center" data-type="confirm">บันทึก <i class="icon-arrow-right14 position-right"></i></button>
															</div>
														</div>
													</div>
												</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- /full width modal -->
				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

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
				var select = $("#company_addr1_province_id");
				var select2 = $("#company_addr2_province_id");
				console.log(data);
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select.append(option);
				var option2 = $("<option>").val(item.id).text(item.name_in_thai);
				select2.append(option2);
				});
			}
		});  
});
</script>

<script>
$(document).ready(function() {
  	$("#company_addr1_province_id").change(function() {
    	var selectValue = $(this).val();
		$.ajax({
			type: "POST",
			url: 'api/districts',
			data: "province_id="+selectValue,
			success: function(data){  
				var select = $("#company_addr1_district_id");
				select.empty();
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select.append(option);
				});
			}
		});
	});

	$("#company_addr2_province_id").change(function() {
    	var selectValue = $(this).val();
		$.ajax({
			type: "POST",
			url: 'api/districts',
			data: "province_id="+selectValue,
			success: function(data){  
				var select = $("#company_addr2_district_id");
				select.empty();
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select.append(option);
				});
			}
		});
	});

	$("#company_addr1_district_id").change(function() {
    	var selectValue = $(this).val();
		$.ajax({
			type: "POST",
			url: 'api/subdistricts',
			data: "district_id="+selectValue,
			success: function(data){  
				$("#company_addr1_post").val("");
				$("#company_addr1_post").val(data[0].zip_code);
				var select = $("#company_addr1_subdistrict_id");
				select.empty();
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select.append(option);
				});
			}
		});
	});
	$("#company_addr2_district_id").change(function() {
    	var selectValue = $(this).val();
		$.ajax({
			type: "POST",
			url: 'api/subdistricts',
			data: "district_id="+selectValue,
			success: function(data){  
				$("#company_addr2_post").val("");
				$("#company_addr2_post").val(data[0].zip_code);
				var select = $("#company_addr2_subdistrict_id");
				select.empty();
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select.append(option);
				});
			}
		});
	});

	$("#company_addr1_subdistrict_id").change(function() {
    	var selectValue = $(this).val();
		$.ajax({
			type: "POST",
			url: 'api/subdistricts_post',
			data: "subdistrict_id="+selectValue,
			success: function(data){  
				$("#company_addr1_post").val("");
				$("#company_addr1_post").val(data[0].zip_code);
			}
		});
	});
	$("#company_addr2_subdistrict_id").change(function() {
    	var selectValue = $(this).val();
		$.ajax({
			type: "POST",
			url: 'api/subdistricts_post',
			data: "subdistrict_id="+selectValue,
			success: function(data){  
				$("#company_addr2_post").val("");
				$("#company_addr2_post").val(data[0].zip_code);
			}
		});
	});
});
</script>
<script>
function getCusId(cusId) {

	console.log(cusId);

	document.getElementById("company_user_cid").value = cusId;
	document.getElementById("company_user_cid").text = cusId;

	function delay(time) {
		return new Promise(resolve => setTimeout(resolve, time));
	}

	$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

        $.ajax({
            url: 'api/getCompanyUserById',
            type: "POST",
            data: "company_owner_id="+"{{ Session::get('user_id') }}"+"&company_user_id="+cusId,
            success: function(data) {
				console.log(data);
				
				document.getElementById("company_addr1_addr").value = data[0].company_addr1_addr;
				document.getElementById("company_addr1_addr").text = data[0].company_addr1_addr;

				document.getElementById("company_addr1_condition").value = data[0].company_addr1_condition;
				document.getElementById("company_addr1_condition").text = data[0].company_addr1_condition;

				document.getElementById("company_addr1_name").value = data[0].company_addr1_name;
				document.getElementById("company_addr1_name").text = data[0].company_addr1_name;

				document.getElementById("company_addr1_post").value = data[0].company_addr1_post;
				document.getElementById("company_addr1_post").text = data[0].company_addr1_post;

				async function ddl1(){
					$("#company_addr1_province_id").val(data[0].company_addr1_province_id).trigger('change');
					await delay(1000);
					$("#company_addr1_district_id").val(data[0].company_addr1_district_id).trigger('change');
					await delay(1000);
					$("#company_addr1_subdistrict_id").val(data[0].company_addr1_subdistrict_id).trigger('change');
					await delay(1000);
				}

				ddl1();
				
				
				document.getElementById("company_addr2_addr").value = data[0].company_addr2_addr;
				document.getElementById("company_addr2_addr").text = data[0].company_addr2_addr;

				document.getElementById("company_addr2_condition").value = data[0].company_addr2_condition;
				document.getElementById("company_addr2_condition").text = data[0].company_addr2_condition;

				document.getElementById("company_addr2_name").value = data[0].company_addr2_name;
				document.getElementById("company_addr2_name").text = data[0].company_addr2_name;

				document.getElementById("company_addr2_post").value = data[0].company_addr2_post;
				document.getElementById("company_addr2_post").text = data[0].company_addr2_post;

				document.getElementById("company_addr2_post").value = data[0].company_addr2_post;
				document.getElementById("company_addr2_post").text = data[0].company_addr2_post;

				async function ddl2(){
					$("#company_addr2_province_id").val(data[0].company_addr2_province_id).trigger('change');
					await delay(1000);
					$("#company_addr2_district_id").val(data[0].company_addr2_district_id).trigger('change');
					await delay(1000);
					$("#company_addr2_subdistrict_id").val(data[0].company_addr2_subdistrict_id).trigger('change');
					await delay(1000);
				}

				ddl2();

				document.getElementById("company_user_cid").value = data[0].company_user_cid;
				document.getElementById("company_user_cid").text = data[0].company_user_cid;

				document.getElementById("company_user_name").value = data[0].company_user_name;
				document.getElementById("company_user_name").text = data[0].company_user_name;

            },
            error: function(xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            }
        });

}

function getCusIdDelete(cusId) {
	console.log(cusId);
	var table = $('#selectCustUser').DataTable();
			
			if (table.settings()[0]) {
				table.destroy();
			}
	
			noty({
				width: 200,
				text: 'คุณต้องการจะลบรายการใช่หรือไม่?',
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
							$.ajaxSetup({
									headers: {
										'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
										'X-CSRF-Token': $('meta[name=_token]').attr('content')
									},
								});

							
							$.ajax({
									url: 'api/delCompanyUser',
									type: "POST",
									data: "company_user_id="+cusId,
									success: function(data) {
										console.log(data);
										if(data[0].msg == "ok"){
											noty({
													force: true,
													text: 'ลบรายการเรียบร้อย',
													type: 'success',
													layout: 'center'
												});
											setTimeout(function() {
												location.reload();
											}, 1000);
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
}

$(document).ready(function() {
	var textBox = document.getElementById("company_user_cid");
  	textBox.disabled = true;

		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

		$('#selectCustUser').DataTable({
				"processing": true,
				"serverSide": true,
				"searching": true,
				pagingType: 'full_numbers',
				"ajax": {
					"url": "api/getStaffAll",
					"type": "POST",
					"data": {"company_owner_id": "{{ Session::get('user_id') }}"},
					"dataSrc": function (data) {
						var totalRecords = data.recordsTotal;
						var filteredRecords = data.recordsFiltered;

						console.log(data.data);

						if (data.data.length === 0) {
							$('#selectCustUser tbody').append('<tr><td colspan="7"><center>ไม่พบข้อมูล</center></td></tr>');
						}
						return data.data;
					}
				},
				"columns": [
					{ "data": "staff_id" },
					{ "data": "staff_name" },
					{ "data": "staff_addr" },
					{ "data": "staff_dept_name" },
					{ "data": "staff_mobi" },
					{ "data": "staff_mail" },
					// { 
					// 	"data": "company_user_cid",
					// 	"render": function ( data, type, row ) {
					// 		return '<button type="button" class="btn btn-primary btn-icon text-center" data-toggle="modal" data-target="#modal_full" onclick="getCusId(' + data + ')"><i class="icon-pencil5"></i></button><button type="button" class="btn btn-danger btn-icon text-center ml-10" onclick="getCusIdDelete(' + data + ')"><i class="icon-bin"></i></button>';
					// 	}
					// }
				]
			});

	});
</script>
@stop
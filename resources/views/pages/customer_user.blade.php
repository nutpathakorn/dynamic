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
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/forms/selects/select2.min.js')}}"></script>	
<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/form_layouts.js')}}"></script>
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
		}else if(document.getElementById("hdd_company_user_cid").value ===  "notok"){
			noty({
				force: true,
				text: 'รหัสลูกค้านี้มีอยู่ในระบบแล้ว',
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
			url: 'api/insCompanyUserId',
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
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">สร้างลูกค้า</span></h4>
						</div>

					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.html"><i class="icon-home2 position-left"></i> หน้าหลัก</a></li>
							<li><a href="#">สร้างลูกค้า</a></li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

				<!-- Form components -->
			<form>
				<div class="row">
				<div class="col-md-12">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">สร้างลูกค้า</h6>
								</div>

								<div class="panel-body">
									<div class="row">
										<div class="col-md-4">
											<div id="feedback" class="form-group has-feedback">
												<label class="cursor-move">รหัสลูกค้า: <span class="text-danger text-size-small">*</span></label>
												<input type="text" id="company_user_cid" name="company_user_cid" placeholder="รหัสลูกค้า" class="form-control">
												<input type="text" id="hdd_company_user_cid" name="hdd_company_user_cid" style="display: none;">
													<div id="checkmark" class="form-control-feedback">
														<i class="icon-checkmark-circle"></i>
													</div>
													<div id="errormark" class="form-control-feedback">
														<i class="icon-cancel-circle2"></i>
													</div>
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
														<h6 class="panel-title">ที่อยู่วางบิล : </h6>
														<button id="btnAddr1" class="btn btn-info" type="button">ใช้ที่อยู่รับเช็ค</button>
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
														<h6 class="panel-title">ที่อยู่รับเช็ค :</h6>
														<button id="btnAddr2" class="btn btn-info cloneAddr1" type="button">ใช้ที่อยู่วางบิล</button>
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
										<button type="button" class="btn btn-primary noty-runner" data-layout="center" data-type="confirm">บันทึก <i class="icon-arrow-right14 position-right"></i></button>
									</div>
								</div>
							</div>
						</div>
				</div>
			</form>
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
	function delay(time) {
			return new Promise(resolve => setTimeout(resolve, time));
			console.log("delay");
		}
	$('#btnAddr1').on('click', function() {
			$("#company_addr1_name").val($("#company_addr2_name").val());		
			$("#company_addr1_post").val($("#company_addr2_post").val());
			$("#company_addr1_addr").val($("#company_addr2_addr").val());

			async function ddl1(){
						$("#company_addr1_province_id").val(document.getElementById("company_addr2_province_id").value).trigger('change');
						await delay(1000);
						$("#company_addr1_district_id").val(document.getElementById("company_addr2_district_id").value).trigger('change');
						await delay(1000);
						$("#company_addr1_subdistrict_id").val(document.getElementById("company_addr2_subdistrict_id").value).trigger('change');
						await delay(1000);
					}

			ddl1();
	});	
	
	$('#btnAddr2').on('click', function() {
			$("#company_addr2_name").val($("#company_addr1_name").val());		
			$("#company_addr2_post").val($("#company_addr1_post").val());
			$("#company_addr2_addr").val($("#company_addr1_addr").val());
			
			async function ddl1(){
						$("#company_addr2_province_id").val(document.getElementById("company_addr1_province_id").value).trigger('change');
						await delay(1000);
						$("#company_addr2_district_id").val(document.getElementById("company_addr1_district_id").value).trigger('change');
						await delay(1000);
						$("#company_addr2_subdistrict_id").val(document.getElementById("company_addr1_subdistrict_id").value).trigger('change');
						await delay(1000);
					}

			ddl1();
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
const inputElement = document.querySelector('#company_user_cid');
const feedbackDiv = document.getElementById("feedback");
const checkmark = document.getElementById("checkmark");
const errormark = document.getElementById("errormark");
checkmark.style.display = "none";
errormark.style.display = "none";

inputElement.addEventListener('keyup', function(event) {

  if (inputElement.value.length >= 3) {
	$.ajax({
			type: "POST",
			url: 'api/checkCompanyUserId',
			data: "company_user_cid="+inputElement.value+"&company_owner_id="+"{{ Session::get('user_id') }}",
			success: function(data){  
				console.log(data);
				if (data.length === 0) {
					checkmark.style.display = "block";
					feedbackDiv.classList.add("has-success");

					errormark.style.display = "none";
					feedbackDiv.classList.remove("has-error");
					$("#hdd_company_user_cid").val("ok");
					
				} else {
					errormark.style.display = "block";
					feedbackDiv.classList.add("has-error");

					checkmark.style.display = "none";
					feedbackDiv.classList.remove("has-success");

					$("#hdd_company_user_cid").val("notok");
				}
			}
		});
  }
  else{
	checkmark.style.display = "none";
	feedbackDiv.classList.remove("has-success");

	errormark.style.display = "none";
	feedbackDiv.classList.remove("has-error");
  }
});

</script>

<script>

const inputElementName = document.querySelector('#company_user_name');
const add1 = document.getElementById("company_addr1_name");
const add2 = document.getElementById("company_addr2_name");

inputElementName.addEventListener('keyup', function(event) {
	const inputText = event.target.value;
	add1.value = inputText;
	add1.innerText = inputText;
	add2.value = inputText;
	add2.innerText = inputText;
});
</script>
@stop
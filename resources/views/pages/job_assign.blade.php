@extends('layouts.default')

@section('title_page')
Home - @parent
@stop

@section('content')
<style>
#map {
	height: 320px;
	width: 100%;
}
</style>
<style type="text/css">
		body{
			font-family: 'Noto Sans Thai', sans-serif;
			font-size: 150%;
		}
	</style>
<!--script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/table_responsive.js')}}"></script-->
<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/form_layouts.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/forms/selects/select2.min.js')}}"></script>	

<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
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

		// Initialize
		$('.noty-runner').click(function () {
		if(document.getElementById("cus_id").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกรหัสบริษัท',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("cus_name").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกชื่อบริษัท',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("cus_recive_name").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกชื่อผู้รับ',
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
		}else if(document.getElementById("txtpost").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกรหัสไปรย์ษณี',
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
		}else if(document.getElementById("cus_recive_mobile").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกเบอร์โทรศัพท์มือถือ',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("shipping_price").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกจำนวนเงิน',
				type: 'warning',
				layout: "center"
			});
		}
		else if(document.getElementById("job_time_preriod").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้เลือกช่วงเวลาส่ง',
				type: 'warning',
				layout: "center"
			});
		}
		else if(document.getElementById("latitude").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้เลือกพิกัดสถานที่',
				type: 'warning',
				layout: "center"
			});
		}
		else{
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
							create_job_single();
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
    function create_job_single()
    {
		var job_type_id = document.getElementById("job_type_id");
    	var job_type_name = job_type_id.options[job_type_id.selectedIndex].text;

		var txtprovince = document.getElementById("txtprovince");
    	var txtprovince_name = txtprovince.options[txtprovince.selectedIndex].text;

		var txtdistrict = document.getElementById("txtdistrict");
    	var txtdistrict_name = txtdistrict.options[txtdistrict.selectedIndex].text;

		var txtsubdistrict = document.getElementById("txtsubdistrict");
    	var txtsubdistrict_name = txtsubdistrict.options[txtsubdistrict.selectedIndex].text;

		var dataString = "company_user_cid="+document.getElementById("cus_id").value
							+"&company_owner_id="+"{{ Session::get('user_id') }}"
							+"&cus_name="+document.getElementById("cus_name").value
							+"&cus_recive_name="+document.getElementById("cus_recive_name").value
							+"&job_type_id="+document.getElementById("job_type_id").value
							+"&job_type_name="+job_type_name
							+"&job_start_date="+ document.getElementById("job_start_date").value
							+"&cus_address="+document.getElementById("cus_address").value
							+"&cus_addr_province_id="+document.getElementById("txtprovince").value
							+"&cus_addr_province_name="+txtprovince_name
							+"&cus_addr_district_id="+document.getElementById("txtdistrict").value
							+"&cus_addr_district_name="+txtdistrict_name
							+"&cus_addr_sub_district_id="+document.getElementById("txtsubdistrict").value
							+"&cus_addr_sub_district_name="+txtsubdistrict_name
							+"&cus_addr_sub_post="+document.getElementById("txtpost").value
							+"&shipping_price="+document.getElementById("shipping_price").value
							+"&shipping_condition="+document.getElementById("shipping_condition").value
							+"&cus_recive_phone="+document.getElementById("cus_recive_phone").value
							+"&cus_recive_mobile="+document.getElementById("cus_recive_mobile").value
							+"&shipping_details_docs="+document.getElementById("shipping_details_docs").value
							+"&job_time_preriod="+document.getElementById("job_time_preriod").value
							+"&cus_addr_lat="+document.getElementById("latitude").value
							+"&cus_addr_long="+document.getElementById("longitude").value
							+"&shipping_details_condition="+document.getElementById("shipping_details_condition").value;

		console.log(dataString);	

		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

		$.ajax({
			type: "POST",
			url: 'api/ins_job_details',
			data: dataString,
			success: function(data){  
				console.log(data);
				noty({
                            force: true,
                            text: 'บันทึกรายการเรียบร้อย',
                            type: 'success',
                            layout: 'center'
                        });
					$("input[type='text']").val("");
					setTimeout(function() {
						location.reload();
					}, 1000);
			},
			error: function(e){
				notes['error'] = e;
				noty({
						force: true,
						text: 'พบปัญหาในการบันทึกกรุณาลองใหม่อีกครั้ง',
						type: 'error',
						layout: "center"
					});
			}             
		});
	}
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

				<!-- Form components -->
				<div class="row">
				<div class="col-md-12">
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">จ่ายงานเข้าระบบ</h6>
								</div>

								<div class="panel-body">
									<div class="tabbable">
										<ul class="nav nav-tabs nav-tabs-highlight text-center">
											<li class="active"><a href="#centered-tab1" data-toggle="tab">เพิ่มงานเดี่ยว</a></li>
											<li><a href="#centered-tab2" data-toggle="tab">เพิ่มงานกลุ่ม</a></li>
										</ul>

										<div class="tab-content">
											<div class="tab-pane active" id="centered-tab1">
											<div class="col-md-12">
												<div class="panel panel-flat">
													<div class="panel-heading">
														<h6 class="panel-title">เพิ่มการจ่ายงาน</h6>
													</div>
													<div class="panel-body">
														<div class="row">
															<div class="col-md-4">
																<form>
																	<div class="input-group">
																		<input type="text" id="address" name="address" class="form-control" placeholder="ค้นหาสถานที่">
																		<span class="input-group-btn">
																			<button class="btn bg-teal" type="button" onclick="search()">Search</button>
																		</span>
																	</div>
																</form>
															</div>
															<div class="col-md-4">
																<div class="input-group">
																	<input type="text" id="latitude" name="latitude" class="form-control" placeholder="Latitude">
																	<span class="input-group-addon bg-slate-400"><i class="icon-pin-alt"></i></span>
																</div>
															</div>
															<div class="col-md-4">
																<div class="input-group">
																	<input type="text" id="longitude" name="longitude" class="form-control" placeholder="Longitude">
																	<span class="input-group-addon bg-slate-400"><i class="icon-pin-alt"></i></span>
																</div>
															</div>
														</div>
													</div>
													<form>
													<div class="panel-body" id="forms-target-right">
															
															<div class="row">
																<div class="col-md-12">
																	<div id="map"></div>
																	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIV8AmOz47MZezVA7nUfaeutcO4fobgto"></script>
																	<script>
																		var geocoder = new google.maps.Geocoder();
																		var map;
																		
																		var currentMarker;

																		function initMap() {
																		map = new google.maps.Map(document.getElementById('map'), {
																			center: { lat: 13.7410737, lng: 100.6230183 },
																			zoom: 13
																		});

																		map.addListener('click', function(event) {
																			var clickedLocation = event.latLng;
																			var latitude = clickedLocation.lat();
																			var longitude = clickedLocation.lng();

																			// Remove the current marker if it exists
																			if (currentMarker) {
																			currentMarker.setMap(null);
																			}

																			var marker = new google.maps.Marker({
																			map: map,
																			position: clickedLocation,
																			draggable: true
																			});

																			document.getElementById('latitude').value = latitude;
																			document.getElementById('longitude').value = longitude;

																			marker.addListener('dragend', function(event) {
																			var draggedLocation = event.latLng;
																			var latitude = draggedLocation.lat();
																			var longitude = draggedLocation.lng();
																			document.getElementById('latitude').value = latitude;
																			document.getElementById('longitude').value = longitude;
																			});

																			// Store the current marker
																			currentMarker = marker;
																		});
																		}


																		
																		function search() {
																			var address = document.getElementById('address').value;
																			geocoder.geocode({ address: address }, function(results, status) {
																				if (status === 'OK') {
																					var lat = results[0].geometry.location.lat();
																					var lng = results[0].geometry.location.lng();
																					map.setCenter(results[0].geometry.location);
																					var marker = new google.maps.Marker({
																						map: map,
																						position: results[0].geometry.location,
																						title: results[0].formatted_address,
																						draggable: true
																					});
																					document.getElementById('latitude').value = lat;
																					document.getElementById('longitude').value = lng;

																					map.addListener('click', function(event) {
																						var clickedLocation = event.latLng;
																						var latitude = clickedLocation.lat();
																						var longitude = clickedLocation.lng();
																						document.getElementById('latitude').value = latitude;
																						document.getElementById('longitude').value = longitude;
																						marker.setPosition(clickedLocation);
																						console.log('New Marker Position: ' + clickedLocation.toString());
																					});

																				} else {
																					// Try searching for a nearby landmark or well-known location
																					geocoder.geocode({ address: 'landmark near ' + address }, function(results, status) {
																						if (status === 'OK') {
																							// Display the first result on the map and update the input fields
																							var lat = results[0].geometry.location.lat();
																							var lng = results[0].geometry.location.lng();
																							map.setCenter(results[0].geometry.location);
																							var marker = new google.maps.Marker({
																								map: map,
																								position: results[0].geometry.location,
																								title: results[0].formatted_address,
																								draggable: true
																							});
																							document.getElementById('address').value = results[0].formatted_address;
																							document.getElementById('latitude').value = lat;
																							document.getElementById('longitude').value = lng;
																						} else {
																							// Display an error message
																							noty({
																								force: true,
																								text: 'ไม่พบที่อยู่ที่คุณค้นหา โปรดลองใช้รูปแบบที่ต่างกันหรือค้นหาจากที่ใกล้เคียง',
																								type: 'error',
																								layout: "center"
																							});
																						}
																					});
																				}
																			});
																		}

																		
																		window.onload = initMap;
																	</script>
																</div>
														</div>
														<div class="row mt-20">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="cursor-move">รหัสลูกค้า:</label>
																	<div class="input-group">
																		<input type="text" id="cus_id" name="cus_id" placeholder="รหัสลูกค้า" class="form-control">
																		<span class="input-group-btn">
																				<button class="btn bg-teal" type="button" data-toggle="modal" data-target="#modal_default" onclick="searchCust()">Search</button>
																		</span>
																	</div>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label class="cursor-move">ชื่อลูกค้า:</label>
																	<input type="text" id="cus_name" name="cus_name" placeholder="ชื่อผู้รับ" class="form-control">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label class="cursor-move">ชื่อผู้รับ:</label>
																	<input type="text" id="cus_recive_name" name="cus_recive_name" placeholder="ชื่อผู้รับ" class="form-control">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<label class="cursor-move">ประเภท:</label>
																	<select data-placeholder="ประเภท"  id="job_type_id" name="job_type_id" class="select">
																		<option></option>
																		<option value="1">อื่นๆ</option> 
																		<option value="2">รับเช็ค</option> 
																		<option value="3">วางบิล</option> 
																		<option value="4">ส่งพัสดุ</option> 
																		<option value="5">ส่งเอกสาร</option>
																		
																	</select>
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label class="cursor-move">วันที่ส่ง:</label>
																	<div class="input-group">
																		<span class="input-group-addon"><i class="icon-calendar3"></i></span>
																		<input id="job_start_date" name="job_start_date" type="text" class="form-control" placeholder="วันที่ส่ง">
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="cursor-move">ที่อยู่ส่งเอกสาร:</label>
																	<input type="text" id="cus_address" name="cus_address" placeholder="บริษัท/บุคคล" class="form-control">
																	<input type="hidden" id="h_cus_address_1" name="h_cus_address_1">
																	<input type="hidden" id="h_cus_address_2" name="h_cus_address_2">

																	<input type="hidden" id="h_province_id_1" name="h_province_id_1">
																	<input type="hidden" id="h_district_id_1" name="h_district_id_1">
																	<input type="hidden" id="h_subdistrict_id_1" name="h_subdistrict_id_1">

																	<input type="hidden" id="h_province_id_2" name="h_province_id_2">
																	<input type="hidden" id="h_district_id_2" name="h_district_id_2">
																	<input type="hidden" id="h_subdistrict_id_2" name="h_subdistrict_id_2">
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

																<div class="col-md-3">
																	<div class="form-group">
																		<label>รหัสไปรษณีย์: <span class="text-danger text-size-small">*</span></label>
																		<input type="text" id="txtpost" name="txtpost"  class="form-control" placeholder="ex: 10800, 10210">
																	</div>
																</div>

																<div class="col-md-3">
																<div class="form-group">
																	<label class="cursor-move">ช่วงเวลาส่งงาน: <span class="text-danger text-size-small">*</span></label>
																	<select data-placeholder="ช่วงเวลาส่งงาน"  id="job_time_preriod" name="job_time_preriod" class="select">
																		<option></option>
																		<option value="0">เช้า</option> 
																		<option value="1">บ่าย</option>
																	</select>
																</div>
															</div>
																
															<div class="col-md-3">
																<div class="form-group">
																	<label class="cursor-move">จำนวนเงิน: <span class="text-danger text-size-small">*</span></label>
																	<input type="text" id="shipping_price" name="shipping_price" placeholder="รายละเอียด" class="form-control">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label class="cursor-move">เงื่อนไขการชำระเงิน:</label>
																	<input type="text" id="shipping_condition" name="shipping_condition" placeholder="รายละเอียด" class="form-control">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label class="cursor-move">เบอร์โทรผู้ประสานงาน:</label>
																	<input type="text" id="cus_recive_phone" name="cus_recive_phone" placeholder="เบอร์โทร" class="form-control">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label class="cursor-move">เบอร์โทรผู้ประสานงาน(มือถือ): <span class="text-danger text-size-small" id="errorMessage">*</span></label>
																	<input type="text" id="cus_recive_mobile" name="cus_recive_mobile" placeholder="เบอร์โทร" class="form-control">
																</div>
															</div>
															
														</div>

														<div class="row">

															<div class="col-md-6">
																<div class="form-group">
																	<label class="cursor-move">หมายเหตุ(เอกสาร):</label>
																	<input type="text" id="shipping_details_docs" name="shipping_details_docs" placeholder="หมายเหตุ" class="form-control">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="cursor-move">หมายเหตุจัดส่ง:</label>
																	<input type="text" id="shipping_details_condition" name="shipping_details_condition" placeholder="เงื่อนไข" class="form-control">
																</div>
															</div>
														</div>
																		
														<div class="text-right">
															<button type="button" class="btn btn-primary noty-runner" data-layout="center" data-type="confirm">บันทึก <i class="icon-arrow-right14 position-right"></i></button>
														</div>
														
													</div>
													</form>
												</div>
											</div>
											</div>
											

											
											<div class="tab-pane" id="centered-tab2">
											
											<div class="col-md-12">
												<div class="panel panel-flat">
													<div class="panel-heading">
														<h6 class="panel-title">อัพโหลดด้วยไฟล์</h6>
														<a href="resources/assets/files/bright_example.xlsx" download>Download Example Form</a>
													</div>
													<form id="import-form">
													<div class="panel-body" id="forms-target-left">

														<div class="form-group">
															<label class="cursor-move">ไฟล์ :</label>
															<input type="file" id="file" name="file" class="file-styled">
														</div>

														<div class="form-group">
															<label class="cursor-move">รายละเอียด :</label>
															<textarea rows="5" cols="5" class="form-control" placeholder="รายละเอยดเพิ่มเติม"></textarea>
														</div>

														<div class="text-right">
															<button type="button" class="btn btn-primary" id="import-button">อัพโหลด <i class="icon-arrow-right14 position-right"></i></button>
														</div>
													</div>
													</form>
												</div>
											</div>
											
											</div>
											

										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
					<!-- /form components -->

				</div>

				<!-- Basic modal -->
				<div id="modal_default" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
								<!-- Basic table -->
									<div class="panel panel-flat">
										<div class="panel-heading">
											<h5 class="panel-title">ข้อมูลแนะนำ</h5>
										</div>

										<div class="table-responsive">
											<table id="selectCustId" class="table">
												<thead>
													<tr>
														<th>#</th>
														<th>รหัส</th>
														<th>ชื่อลูกค้า</th>
														<th>จัดการ</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
									<!-- /basic table -->
								</div>

								<div class="modal-footer">
									<button id="close_modal" type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /basic modal -->


				<!-- /content area -->

<script>
const cus_recive_mobile = document.getElementById("cus_recive_mobile");
cus_recive_mobile.addEventListener("input", function() {
const phoneNumber = cus_recive_mobile.value;
const phoneNumberPattern = /^(08|09)\d{8}$/;

if (!phoneNumberPattern.test(phoneNumber)) {
	errorMessage.innerHTML = "* เบอร์มือถือไม่ถูกต้อง";
} else {
	errorMessage.innerHTML = "*";
}
});

const shipping_price = document.getElementById("shipping_price");
shipping_price.addEventListener("keypress", function(event) {
const key = event.which || event.keyCode;
const keyChar = String.fromCharCode(key);
const regex = /[0-9]/;

if (!regex.test(keyChar)) {
	event.preventDefault();
}
});

const txtpost = document.getElementById("txtpost");
txtpost.addEventListener("keypress", function(event) {
const key = event.which || event.keyCode;
const keyChar = String.fromCharCode(key);
const regex = /[0-9]/;

if (!regex.test(keyChar) || txtpost.value.length >= 5) {
	event.preventDefault();
}
});

protectTextbox("latitude");
protectTextbox("longitude");

function protectTextbox(elementId) {

  const textbox = document.getElementById(elementId);
  textbox.addEventListener("keydown", (event) => {
    event.preventDefault();
  });

  textbox.addEventListener("mousedown", (event) => {
    event.preventDefault();
  });
}

</script>
<script>
	$(document).on('click', '#import-button', function(e) {
		
		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

        e.preventDefault();

		noty({
				width: 200,
				text: 'คุณต้องการจะอัพโหลดรายการใช่หรือไม่?',
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
							var formData = new FormData($('#import-form')[0]);
							formData.append('company_owner_id', "{{ Session::get('user_id') }}");

							$.ajax({
								url: 'api/import-excel',
								type: "POST",
								data: formData,
								contentType: false,
								processData: false,
								success: function(data) {
									if(data.msg == "ok"){
										noty({
												force: true,
												text: 'บันทึกรายการเรียบร้อย',
												type: 'success',
												layout: 'center'
											});
										document.getElementById("file").value = "";
										setTimeout(function() {
											location.reload();
										}, 2000);
									}
									else{
										notes['error'] = data.error;
										$("#btn_error").click();
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
</script>
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
				$.each(data, function(index, item) {
				var option = $("<option>").val(item.id).text(item.name_in_thai);
				select.append(option);
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

	$("#txtsubdistrict").change(function() {
    	var selectValue = $(this).val();
		$.ajax({
			type: "POST",
			url: 'api/subdistricts_post',
			data: "subdistrict_id="+selectValue,
			success: function(data){  
				$("#txtpost").val("");
				$("#txtpost").val(data[0].zip_code);
			}
		});
	});
});
</script>
<script>
	function searchCust()
    {
		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

        var cus_id = document.getElementById("cus_id").value;
		console.log(cus_id);

		var dataString = "company_user_cid="+cus_id+"&company_owner_id="+"{{ Session::get('user_id') }}";

        $.ajax({
            url: 'api/checkCompanyUserId',
            type: "POST",
            data: dataString,
            success: function(data) {
				$('#selectCustId tbody').empty();
				if (data.length === 0) {
					$('#selectCustId tbody').append('<tr><td colspan="4"><center>ไม่พบข้อมูล</center></td></tr>');
				} else {
					var rows = '';
					for (var i = 0; i < data.length; i++) {
						rows += '<tr><td>' + data[i].id + '</td><td>' + data[i].cus_id + '</td><td>' + data[i].cus_name + '</td><td><button type="button" class="btn btn-primary btn-icon addSelected" data-cusid="' + data[i].cus_id + '"><i class="icon-user-check"></i></button></td></tr>';
					}
					$('#selectCustId tbody').append(rows);
				}
				
				$('#cus_id').val(''); 
            },
            error: function(xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            }
        });
	}

	function getCusId(cusId) {
    	console.log(cusId);
		document.getElementById("cus_id").value = cusId;
		document.getElementById("cus_id").text = cusId;
		document.getElementById("close_modal").click();

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

				document.getElementById("cus_name").value = data[0].company_user_name;
				document.getElementById("cus_name").text = data[0].company_user_name;

				document.getElementById("cus_address").value = data[0].company_addr1_addr;
				document.getElementById("cus_address").text = data[0].company_addr1_addr;

				document.getElementById("h_cus_address_1").value = data[0].company_addr1_addr;
				document.getElementById("h_cus_address_2").value = data[0].company_addr1_addr;
				document.getElementById("h_province_id_1").value = data[0].company_addr1_province_id;
				document.getElementById("h_district_id_1").value = data[0].company_addr1_district_id;
				document.getElementById("h_subdistrict_id_1").value = data[0].company_addr1_subdistrict_id;
				document.getElementById("h_province_id_2").value = data[0].company_addr2_province_id;
				document.getElementById("h_district_id_2").value = data[0].company_addr2_district_id;
				document.getElementById("h_subdistrict_id_2").value = data[0].company_addr2_subdistrict_id;

				async function ddl1(){
					$("#txtprovince").val(data[0].company_addr1_province_id).trigger('change');
					await delay(1000);
					$("#txtdistrict").val(data[0].company_addr1_district_id).trigger('change');
					await delay(1000);
					$("#txtsubdistrict").val(data[0].company_addr1_subdistrict_id).trigger('change');
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

	$('#selectCustId').on('click', '.addSelected', function() {

		var cusid = $(this).data('cusid');
		var deletecusid = $(this).data('deletecusid');
		console.log(cusid);
		getCusId(cusid);


		});
</script>
<script>
	$("#job_type_id").change(function() {

		function delay(time) {
			return new Promise(resolve => setTimeout(resolve, time));
		}
			
		var job_id = $("#job_type_id").val();
			console.log(job_id);

		if(job_id == 2){
			console.log(job_id);

			document.getElementById("cus_address").value = $("#h_cus_address_1").val();
			document.getElementById("cus_address").text = $("#h_cus_address_1").val();

			async function ddl1(){
					$("#txtprovince").val($("#h_province_id_1").val()).trigger('change');
					await delay(1000);
					$("#txtdistrict").val($("#h_district_id_1").val()).trigger('change');
					await delay(1000);
					$("#txtsubdistrict").val($("#h_subdistrict_id_1").val()).trigger('change');
					await delay(1000);
				}

				ddl1();

		}else if(job_id == 3){
			console.log(job_id);
			document.getElementById("cus_address").value = $("#h_cus_address_2").val();
			document.getElementById("cus_address").text = $("#h_cus_address_2").val();

			async function ddl1(){
					$("#txtprovince").val($("#h_province_id_2").val()).trigger('change');
					await delay(1000);
					$("#txtdistrict").val($("#h_district_id_2").val()).trigger('change');
					await delay(1000);
					$("#txtsubdistrict").val($("#h_subdistrict_id_2").val()).trigger('change');
					await delay(1000);
				}

				ddl1();
		}
	});
</script>
<script>
	// Month and day
    $("#job_start_date").AnyTime_picker({
        format: "%d/%m/%Z"
    });
</script>
@stop
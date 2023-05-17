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

	document.getElementById("txtcompany").value
							+"&company_addr="+document.getElementById("txtaddress").value
							+"&company_rd="+document.getElementById("txtroad").value
							+"&company_dist="+document.getElementById("txtdistrict").value
							+"&company_prov="+document.getElementById("txtprovince").value
							+"&company_subd="+document.getElementById("txtsubdistrict").value
							+"&company_post="+document.getElementById("txtpost").value
							+"&company_phon="+document.getElementById("txtphone").value
							+"&company_mobi="+document.getElementById("txtmobile").value
							+"&company_mail="+document.getElementById("txtmails").value;

		// Initialize
		$('.noty-runner').click(function () {
		if(document.getElementById("txtcompany").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกชื่อบริษัท',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("txtaddress").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกที่อยู่บริษัท',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("txtroad").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกถนน',
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
		}else if(document.getElementById("txtmobile").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกเบอร์โทรศัพท์มือถือ',
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
		}else if(document.getElementById("txtmobile").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกเบอร์โทรศัพท์มือถือ',
				type: 'warning',
				layout: "center"
			});
		}else if(document.getElementById("txtmails").value ===  ""){
			noty({
				force: true,
				text: 'คุณยังไม่ได้กรอกอีเมล',
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
		var dataString = "name="+document.getElementById("txtusername").value
							+"&email="+document.getElementById("txtmails").value
							+"&password="+document.getElementById("txtpassword2").value;
							
		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

		$.ajax({
			type: "POST",
			url: 'api/register',
			data: dataString,
			success: function(data){  
				if(data.token != ""){
					create_customer_submit(data.user_id)
				}
				else{
					noty({
						force: true,
						text: 'พบปัญหาในการบันทึกกรุณาลองใหม่อีกครั้ง',
						type: 'error',
						layout: "center"
					});
				}
				
			},
			error: function(e){
				notes['error'] = e;
				$("#btn_error").click();
				
			}             
		});
	}
</script>

<script> 
    function create_customer_submit(user_id)
    {
		var notes = [];
		var randomNumber = "CM"+generateNumber();
		var dataString = "company_id="+randomNumber
							+"&user_id="+user_id
							+"&company_name="+document.getElementById("txtcompany").value
							+"&company_addr="+document.getElementById("txtaddress").value
							+"&company_rd="+document.getElementById("txtroad").value
							+"&company_dist="+document.getElementById("txtdistrict").value
							+"&company_prov="+document.getElementById("txtprovince").value
							+"&company_subd="+document.getElementById("txtsubdistrict").value
							+"&company_post="+document.getElementById("txtpost").value
							+"&company_phon="+document.getElementById("txtphone").value
							+"&company_mobi="+document.getElementById("txtmobile").value
							+"&company_mail="+document.getElementById("txtmails").value;

		$.ajax({
			type: "POST",
			url: 'api/ins_customer',
			data: dataString,
			success: function(data){  
				if(data.msg == "ok"){
					noty({
                            force: true,
                            text: 'บันทึกรายการเรียบร้อย',
                            type: 'success',
                            layout: 'center'
                        });
					$("input[type='text']").val("");
					setTimeout(function() {
						location.reload();
					}, 2000);
				}
				else{
					notes['error'] = data.error;
					$("#btn_error").click();
				}
				
			},
			error: function(e){
				notes['error'] = e;
				$("#btn_error").click();
				
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
			<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">สร้างลูกค้า</span></h4>
		</div>

	</div>

	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
			<li><a href="form_layout_vertical.html">สร้างลูกค้า</a></li>
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
				<h5 class="panel-title">สร้างลูกค้า</h5>
				
			</div>

			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<fieldset>
							<legend class="text-semibold"><i class="icon-reading position-left"></i> ข้อมูลใช้งาน</legend>

							<div class="form-group">
								<label>ชื่อบริษัท: <span class="text-danger text-size-small">*</span></label>
								<input type="text" id="txtcompany" name="txtcompany" class="form-control" placeholder="ชื่อบริษัท">
							</div>

							<div class="form-group">
								<label>ชื่อผู้ใช้งาน: <span class="text-danger text-size-small">*</span></label>
								<input type="text" id="txtusername" name="txtusername" class="form-control" placeholder="Your Username">
							</div>

							<div class="form-group">
								<label>รหัสผู้ใช้งาน: <span class="text-danger text-size-small">*</span></label>
								<input type="password" id="txtpassword" name="txtpassword"  class="form-control" placeholder="Your strong password">
							</div>

							<div class="form-group">
								<label>ยืนยันรหัสผู้ใช้งาน: <span id="pwd_message" class="text-danger text-size-small">*</span></label>
								<input type="password" id="txtpassword2" name="txtpassword2"  class="form-control" placeholder="Your strong password">
							</div>

							<!-- <div class="form-group">
								<label>รายละเอียดเพิ่มเติม:</label>
								<textarea rows="5" cols="5" class="form-control" placeholder="Remark"></textarea>
							</div> -->
						</fieldset>
					</div>

					<div class="col-md-6">
						<fieldset>
							<legend class="text-semibold"><i class="icon-office position-left"></i> ที่อยู่บริษัท</legend>

							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label>ที่อยู่: <span class="text-danger text-size-small">*</span></label>
										<input type="text" id="txtaddress" name="txtaddress" class="form-control">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>ถนน: <span class="text-danger text-size-small">*</span></label>
										<input type="text" id="txtroad" name="txtroad" class="form-control">
									</div>
								</div>
							</div>

							<div class="row">
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

								
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>ตำบล: <span class="text-danger text-size-small">*</span></label>
										<select data-placeholder="เลือกตำบล" class="select" id="txtsubdistrict" name="txtsubdistrict">
											<option></option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>รหัสไปรษณีย์: <span class="text-danger text-size-small">*</span></label>
										<input type="text" id="txtpost" name="txtpost"  class="form-control" placeholder="ex: 10800, 10210">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>โทรศัพท์:</label>
										<input type="text" id="txtphone" name="txtphone" class="form-control"  placeholder="ex: 029998999">
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label>มือถือ: <span class="text-danger text-size-small" id="errorMessage">*</span></label>
										<input type="text" id="txtmobile" name="txtmobile" class="form-control" placeholder="ex: 0819998999">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>อีเมล: <span class="text-danger text-size-small">* ใช้ในการเข้าระบบ</span></label>
										<input type="text" id="txtmails" name="txtmails"  class="form-control" placeholder="ex: example@bright.com">
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
	</form>
	<!-- /2 columns form -->
<script>
const password = document.getElementById("txtpassword");
const confirm_password = document.getElementById("txtpassword2");
const message = document.getElementById("pwd_message");
const submit = document.getElementById("btnsubmit");

password.addEventListener("input", checkPasswordMatch);
confirm_password.addEventListener("input", checkPasswordMatch);
submit.disabled = true;
function checkPasswordMatch() {
  if (password.value !== confirm_password.value) {
    message.innerHTML = "* รหัสผ่านไม่ตรงกัน";
    submit.disabled = true;
  } else {
    message.innerHTML = "*";
    submit.disabled = false;
  }
}
</script>

<script>
  const phoneNumberInput = document.getElementById("txtmobile");
  const phoneNumberInput2 = document.getElementById("txtphone");
  const postNumberInput = document.getElementById("txtpost");
  const errorMessage = document.getElementById("errorMessage");
  const posterrorMessage = document.getElementById("posterrorMessage");
  
  phoneNumberInput.addEventListener("input", function() {
    const phoneNumber = phoneNumberInput.value;
    const phoneNumberPattern = /^(08|09)\d{8}$/;

    if (!phoneNumberPattern.test(phoneNumber)) {
      errorMessage.innerHTML = "* เบอร์มือถือไม่ถูกต้อง";
    } else {
      errorMessage.innerHTML = "*";
    }
  });

  phoneNumberInput.addEventListener("keypress", function(event) {
    const key = event.which || event.keyCode;
    const keyChar = String.fromCharCode(key);
    const regex = /[0-9]/;

    if (!regex.test(keyChar)) {
      event.preventDefault();
    }
  });
  phoneNumberInput2.addEventListener("keypress", function(event) {
    const key = event.which || event.keyCode;
    const keyChar = String.fromCharCode(key);
    const regex = /[0-9]/;

    if (!regex.test(keyChar)) {
      event.preventDefault();
    }
  });
  postNumberInput.addEventListener("keypress", function(event) {
    const key = event.which || event.keyCode;
    const keyChar = String.fromCharCode(key);
    const regex = /[0-9]/;

    if (!regex.test(keyChar) || postNumberInput.value.length >= 5) {
      event.preventDefault();
    }
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
</div>
<!-- /content area -->

</div>
<!-- /main content -->
@stop
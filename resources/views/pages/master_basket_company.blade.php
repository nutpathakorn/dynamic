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

<!-- Main content -->
<div class="content-wrapper">
<button type="button" id="btn_success" class="btn btn-default btn-sm noty-runner" data-layout="center" data-type="confirm" style="display:none;"><i class="icon-play3 position-right"></i></button>
<button type="button" id="btn_error" class="btn btn-default btn-sm noty-runner" data-layout="center" data-type="error" style="display:none;"><i class="icon-play3 position-right"></i></button>
<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">จัดการตะกร้างานลูกค้า</span></h4>
		</div>

	</div>

	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="index.html"><i class="icon-home2 position-left"></i> หน้าหลัก</a></li>
			<li><a href="form_layout_vertical.html">จัดการตะกร้างานลูกค้า</a></li>
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
				<h5 class="panel-title">จัดการตะกร้างานลูกค้า</h5>
				
			</div>

			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<fieldset>
							<legend class="text-semibold"><i class="icon-basket position-left"></i> ข้อมูลตะกร้า</legend>
							<div class="row">
								<div class="col-md-6">
									<label>รหัสลูกค้า:</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-office"></i></span>
										<input type="text" id="txtcompany_id" name="txtcompany_id" class="form-control" placeholder="รหัสลูกค้า">
										<span class="input-group-btn">
											<button id="selectDataAll" type="button" class="btn btn-info">ค้นหา</button>
										</span>
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">รายการตะกร้าลูกค้า</h5>
				
			</div>
			<div class="panel-body">
				
				<div class="row">
					<div class="col-md-12">
						<table  id="selectMasterBasket" class="table">
							<thead>
								<tr>
									<th>รหัสลูกค้า</th>
									<th>ชื่อ</th>
									<th>จังหวัด</th>
									<th>อำเภอ</th>
									<th>ตำบล</th>
									<th>ตะกร้า</th>
									<th>ประเภท</th>
									<th>จัดการ</th>
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

</div>
<!-- /content area -->
<script> 
    function updateBasketCompany()
    {
		var basket_id = document.getElementById("basket");
    	var basket_name = basket_id.options[basket_id.selectedIndex].text;

		var dataString = "company_owner_id="+document.getElementById("howner_id").value
							+"&company_user_id="+document.getElementById("hcid").value
							+"&basket_id="+document.getElementById("basket").value
							+"&basket_name="+basket_name
							+"&addr_type="+document.getElementById("haddrtype").value;
							
		$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

		$.ajax({
			type: "POST",
			url: 'api/updateBasketCompany',
			data: dataString,
			success: function(data){  
				console.log(data);
				if(data[0].msg === "ok"){
					setTimeout(function() {
						$('#selectMasterBasket').DataTable().ajax.reload();
						$('#modal_small').modal('hide');
					}, 1000);
				}
				
				
			}           
		});
	}
</script>
<script>
$(document).ready(function() {
	console.log("ok");
	$.ajaxSetup({
			headers: {
				'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
        });

	$('#selectMasterBasket').DataTable({
	});
});
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
					updateBasketCompany();
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
	function getOwnerId(callback){

		var dataString = "company_id="+document.getElementById("txtcompany_id").value;

		$.ajax({
			type: "POST",
			url: 'api/getCompanyOwnerId',
			data: dataString,
			success: function(data){  
				console.log(data[0].user_id);
				callback(data[0].user_id);
			}           
		});
	}
</script>
<script>
	$('#selectDataAll').on('click', function() {
			var table = $('#selectMasterBasket').DataTable();
			
			if (table.settings()[0]) {
				table.destroy();
			}

			getOwnerId(function(ownerId) {

				$('#selectMasterBasket').DataTable({
					"processing": true,
					"serverSide": true,
					"searching": true,
					pagingType: 'full_numbers',
					"ajax": {
						"url": "api/getMasterBasketCompany",
						"type": "POST",
						"data": {"company_owner_id": ownerId},
						"dataSrc": function (data) {
							var totalRecords = data.recordsTotal;
							var filteredRecords = data.recordsFiltered;
							console.log(data.data);

							if (data.data.length === 0) {
								$('#selectMasterBasket tbody').append('<tr><td colspan="7"><center>ไม่พบข้อมูล</center></td></tr>');
							}
							return data.data;
						}
					},
					"columns": [
						{ "data": "company_user_cid" },
						{ "data": "company_user_name" },
						{ "data": "province" },
						{ "data": "district" },
						{ "data": "subdistrict" },
						{ "data": "basket_name" },
						{ "data": "addr_type" },
						{ 
							"data": "company_user_cid",
							"render": function ( data, type, row ) {
								if (row.job_status === 6) {
									return '';
								} else {
									return '<button type="button" data-toggle="modal" data-target="#modal_small" class="btn bg-purple changeBasket" data-basketid="' + row.basket_id + '" data-cid="' + data + '" data-oid="' + row.company_owner_id + '" data-addrType="' + row.addr_type + '">เปลี่ยนตะกร้า</button>';
								}
							}
						}
					]
				});
			});
		});
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
	$('#selectMasterBasket').on('click', '.changeBasket', function() {
			var owner_id = $(this).data('oid');
			var cid = $(this).data('cid');
			var basketid = $(this).data('basketid');
			var addrType = $(this).data('addrtype');
			
			
			$("#howner_id").val(owner_id);
			$("#hcid").val(cid);
			$("#hbasket").val(basketid);
			$("#haddrtype").val(addrType);
			
			console.log('basket: '+basketid);
			console.log('owner_id: '+owner_id);
			console.log('cid: '+cid);
			console.log('addrType: '+addrType);
			getBasket();
	});		
</script>
<!-- Modal area -->

<!-- Full width modal -->
	<div id="modal_small" class="modal fade">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
					<div class="form-group">
						<legend class="text-bold"><h3>รหัสบริษัทลูกค้า: <span class="text-semibold text-indigo-800" id="job_id"></span></h3></legend>
						<input type="hidden" id="hcid"></input>
						<input type="hidden" id="howner_id"></input>
						<input type="hidden" id="hbasket"></input>
						<input type="hidden" id="haddrtype"></input>
						<label>ตะกร้า:</label><i class="icon-basket ml-10"></i>
						<select data-placeholder="เลือกตะกร้า" class="select" id="basket" name="basket">
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


<!-- /Modal area -->
					

</div>
<!-- /main content -->
@stop
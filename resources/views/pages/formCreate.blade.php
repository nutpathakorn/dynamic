@extends('layouts.default_form')

@section('title_page')
Home - @parent
@stop

@section('content')

@auth
    <div>OK Access</div>
@endauth

<style type="text/css">
		body{
			font-family: 'Noto Sans Thai', sans-serif;
			font-size: 150%;
		}



		.alert {
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			z-index: 9999; /* Set a high value for z-index */
		}

		/* .zr-element {
			font-family: 'Noto Sans Thai', sans-serif !important;
		}

		.echarts-tooltip {
		font-family: 'Noto Sans Thai', sans-serif !important;
		} */
	</style>

	<script type="text/javascript" src="{{URL::asset('resources/assets/js/pages/tasks_grid.js')}}"></script>


<!-- Main content -->
			<div class="content-wrapper">
			

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"></span> สร้างฟอร์ม</h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="{{URL::to('main')}}"><i class="icon-home2 position-left"></i> หน้าหลัก</a></li>
							<li class="active">สร้างฟอร์ม</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">
					<!-- Detached content -->
					<div class="container-detached">
						<div class="content-detached">

							<div class="row">
								<div class="col-md-12">
									<div class="panel border-green-800">
										<div class="panel-heading bg-green-800">
											<div class="fhead">



											</div>
											
										</div>
										<div class="panel-body">
											<form class="form-horizontal" action="#">
												<fieldset class="content-group">
													<div class="fbody">

														<legend class="text-bold"></legend>
													

													</div>
													
												</fieldset>
											</form>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					<!-- Detached sidebar -->
						<div class="sidebar-detached">
							<div class="sidebar sidebar-default">
								<div class="sidebar-content">

									<!-- Task navigation -->
									<div class="sidebar-category">
										<div class="category-title">
											<span>TEXT</span>
												<ul class="icons-list">
													<li><a href="#" data-action="collapse"></a></li>
												</ul>
										</div>
										<div class="category-content no-padding">
												<ul class="navigation navigation-alt navigation-accordion">
													<li><a data-toggle="modal" data-target="#modal_text_header"><i class="icon-typography"></i> Header </a></li>
													<li><a data-toggle="modal" data-target="#modal_text_sheader"><i class="icon-font-size"></i> Sub-Header </a></li>
												</ul>
										</div>
									</div>
									<div class="sidebar-category">
										<div class="category-title">
											<span>INPUT</span>
												<ul class="icons-list">
													<li><a href="#" data-action="collapse"></a></li>
												</ul>
										</div>
										<div class="category-content no-padding">
												<ul class="navigation navigation-alt navigation-accordion">
													<li><a class="tbox"><i class="icon-checkbox-unchecked2"></i> Textbox </a></li>
													<li><a class="tarea"><i class="icon-bubble-lines4"></i> Textarea </a></li>
												</ul>
										</div>
									</div>
									<div class="sidebar-category">
										<div class="category-title">
											<span>NUMBER</span>
												<ul class="icons-list">
													<li><a href="#" data-action="collapse"></a></li>
												</ul>
										</div>
										<div class="category-content no-padding">
												<ul class="navigation navigation-alt navigation-accordion">
													<li><a href="#"><i class="icon-list-numbered"></i> Text Number </a></li>
												</ul>
										</div>
									</div>
									<div class="sidebar-category">
										<div class="category-title">
											<span>CHOICES</span>
												<ul class="icons-list">
													<li><a href="#" data-action="collapse"></a></li>
												</ul>
										</div>
										<div class="category-content no-padding">
												<ul class="navigation navigation-alt navigation-accordion">
													<li><a href="#"><i class="icon-minus3"></i> Select Single </a></li>
													<li><a href="#"><i class="icon-menu9"></i> Select Multiple </a></li>
													<li><a href="#"><i class="icon-checkbox-checked2"></i> Checkbox </a></li>
													<li><a href="#"><i class="icon-checkmark-circle"></i> Radio (True/False) </a></li>
													<li><a href="#"><i class="icon-circles2"></i> Radio Multiple </a></li>
												</ul>
										</div>
									</div>
									<div class="sidebar-category">
										<div class="category-title">
											<span>DATE</span>
												<ul class="icons-list">
													<li><a href="#" data-action="collapse"></a></li>
												</ul>
										</div>
										<div class="category-content no-padding">
												<ul class="navigation navigation-alt navigation-accordion">
													<li><a href="#"><i class="icon-calendar52"></i> Date </a></li>
													<li><a href="#"><i class="icon-calendar2"></i> Date and Time </a></li>
													<li><a href="#"><i class="icon-watch"></i> Time </a></li>
												</ul>
										</div>
									</div>
									<div class="sidebar-category">
										<div class="category-title">
											<span>FILE</span>
												<ul class="icons-list">
													<li><a href="#" data-action="collapse"></a></li>
												</ul>
										</div>
										<div class="category-content no-padding">
												<ul class="navigation navigation-alt navigation-accordion">
													<li><a href="#"><i class="icon-files-empty"></i> File </a></li>
													<li><a href="#"><i class="icon-image3"></i> Image </a></li>
													<li><a href="#"><i class="icon-link"></i> URL </a></li>
												</ul>
										</div>
									</div>
									<div class="sidebar-category">
										<div class="category-title">
											<span>DIALOG</span>
												<ul class="icons-list">
													<li><a href="#" data-action="collapse"></a></li>
												</ul>
										</div>
										<div class="category-content no-padding">
												<ul class="navigation navigation-alt navigation-accordion">
												<li><a href="#"><i class="icon-ipad"></i> Modal </a></li>
												</ul>
										</div>
									</div>
									<!-- /task navigation -->

								</div>
							</div>
						</div>
						<!-- /detached sidebar -->
					
				</div>
				<!-- /content area -->

				<!-- Modal -->
				<!-- Header modal -->
				<div id="modal_text_header" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content text-center">

								<form action="#" class="form-inline">
									<div class="modal-body">
										<div class="form-group has-feedback">
											<label>Text Header : </label>
											<input type="text" id="txtheader" placeholder="Your text header" class="form-control">
										</div>
									</div>

									<div class="modal-footer text-center">
										<button type="button" class="btn btn-primary btn_theader" data-dismiss="modal">Add to form <i class="icon-plus22"></i></button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /Header modal -->

				<!-- subHeader modal -->
				<div id="modal_text_sheader" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content text-center">

								<form action="#" class="form-inline">
									<div class="modal-body">
										<div class="form-group has-feedback">
											<label>Text Sub Header : </label>
											<input type="text" id="txtsheader" placeholder="Your sub text header" class="form-control">
										</div>
									</div>

									<div class="modal-footer text-center">
										<button type="button" class="btn btn-primary btn_tsheader" data-dismiss="modal">Add to form <i class="icon-plus22"></i></button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /subHeader modal -->
				<!-- /Modal -->

<script>
	$('.btn_theader').on('click', function() {
		textheader = $('#txtheader').val();
		string = '<div class="form-group">'+ 
		'<h5 class="panel-title">'+textheader+'</h5>'+
					'<div class="heading-elements">'+
					'<ul class="icons-list">'+
					'<li><a data-action="collapse"></a></li>'+
					'<li><a data-action="reload"></a></li>'+
					'<li><a data-action="close"></a></li></ul></div>'+
					'<span class="input-group-btn">'+
					 '<button type="button" class="btn bg-danger delete-button"> X </button>'+
					 '</span></div></div></div>'+
					 '</div>';
		$('.fhead').append(string);
	});

	$('.btn_tsheader').on('click', function() {
		textsheader = $('#txtsheader').val();
		string = '<p class="content-group">'+textsheader+'.</p>'+
		'<span class="input-group-btn">'+
					 '<button type="button" class="btn bg-danger delete-button"> X </button>'+
					 '</span></div></div></div>';
		$('.fbody').append(string);
	});

	$('.tbox').on('click', function() {
		var string = '<div class="form-group">'+
		'<label class="control-label col-lg-2">Default text input</label>'+
		'<div class="col-lg-10"><div class="input-group">'+
		'<input type="text" class="form-control"><span class="input-group-btn"><button type="button" class="btn bg-danger delete-button"> X </button></span></div></div></div>';
		$('.fbody').append(string);
	});

	$('.tarea').on('click', function() {
		var string = '<div class="form-group">'+
					 '<label class="control-label col-lg-2">Text Area</label>'+
					 '<div class="col-lg-10">'+
					 '<div class="input-group">'+
					 '<textarea rows="5" cols="5" class="form-control" placeholder="Default textarea"></textarea>'+
					 '<span class="input-group-btn">'+
					 '<button type="button" class="btn bg-danger delete-button"> X </button>'+
					 '</span></div></div></div>';
		$('.fbody').append(string);
	});
	
	$('.fhead').on('click', '.delete-button', function() {
		console.log('click');
		$(this).closest('.form-group').remove();
	});

	$('.fbody').on('click', '.delete-button', function() {
		$(this).closest('.form-group').remove();
	});
</script>
@stop
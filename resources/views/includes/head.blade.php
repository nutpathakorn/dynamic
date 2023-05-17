	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="_token" content="{!! csrf_token() !!}"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{URL::asset('resources/assets/images/4nlogo/bright.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{URL::asset('resources/assets/images/4nlogo/bright.ico')}}" type="image/x-icon">
	<title>FINTECH|DYNAMIC FORM</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai&display=swap" rel="stylesheet">

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{URL::asset('resources/assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{URL::asset('resources/assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
	<link href="{{URL::asset('resources/assets/css/core.css')}}" rel="stylesheet" type="text/css">
	<link href="{{URL::asset('resources/assets/css/components.css')}}" rel="stylesheet" type="text/css">
	<link href="{{URL::asset('resources/assets/css/colors.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/loaders/pace.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/core/libraries/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/core/libraries/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/ui/moment/moment.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/pickers/daterangepicker.js')}}"></script>

	<script type="text/javascript" src="{{URL::asset('resources/assets/js/core/app.js')}}"></script>
	
	<script type="text/javascript" src="{{URL::asset('resources/assets/js/plugins/notifications/noty.min.js')}}"></script>
	<script>
function generateNumber() {
        var date = new Date();
        var year = date.getFullYear().toString().slice(-2);
        var month = (date.getMonth() + 1).toString().padStart(2, "0");
        var randomPart = Math.floor(Math.random() * 10000).toString().padStart(4, "0");
        return randomPart + month + year;
    }
	</script>
	<!-- /theme JS files -->
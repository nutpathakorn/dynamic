<!DOCTYPE html>
<html lang="en">
<head>
@include('includes.head_admin') 
</head>
<body>
@include('includes.headmenu_admin')
 <!-- Page container -->
  <div class="page-container">
    <!-- Page content -->
    <div class="page-content">
    @include('includes.mainnavigation_admin')
  <!-- Footer -->
<div class="footer text-muted">
      <p>&nbsp;&copy; 2023. <a href="https://www.google.com/"> FINTECH | DYNAMIC FORM</a> by Fintechinno CO.,Ltd</a></p>
</div>
					<!-- /footer -->
	@yield('content')
</body>
</html>
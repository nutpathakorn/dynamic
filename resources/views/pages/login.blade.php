@extends('layouts.default_login')

@section('title_page')
Sign-in @parent
@stop

@section('content')
<style>
  .center-panel {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
  }

  body {
    background-image: url("{{URL::asset('resources/assets/images/bg_blur.jpg')}}");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
  }
</style>

  <!-- Page container -->
  <div class="page-container">

    <!-- Page content -->
    <div class="page-content">

      <!-- Main content -->
      <div class="content-wrapper">

        <!-- Advanced login -->
        <div class="center-panel">
          <div class="panel panel-body login-form width-500"> <!-- content d-flex justify-content-center align-items-center -->
            <div class="text-center">

              <!-- <div class="border-slate-300 text-slate-300"><a><img src="{{URL::asset('resources/assets/images/4nlogo/logo-bright.png')}}" alt="" height="100"></a></div> -->
              <h1 class="no-margin text-black">FINTECH <small>Dynamic form</small></h1>
              
              <h5 class="content-group"><small>Login to your Site</small> </h5>
            </div>

            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" placeholder="Email" name="email" id="email">
              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
            </div>

            <div class="form-group has-feedback has-feedback-left">
              <input type="password" class="form-control" placeholder="Password" name="password" id="password">
              <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
              </div>
            </div>

            <!-- <div class="form-group login-options">
              <div class="row">
                <div class="col-sm-6">
                  <label class="checkbox-inline">
                    <input type="checkbox" class="styled" checked="checked">
                    Remember
                  </label>
                </div>
              </div>
            </div> -->

            <div class="form-group">
              <button type="button" class="btn btn-primary btn-rounded btn-xlg btn-block" onclick="Login_Submit();">Login <i class="icon-arrow-right14 position-right"></i></button>
            </div>
            
          </div>
        </div>
        <!-- /advanced login -->

      </div>
      <!-- /main content -->

    </div>
    <!-- /page content -->

  </div>
  <!-- /page container -->
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


    });
  </script>
  <script> 

    document.addEventListener("DOMContentLoaded", function() {
      var passwordInput = document.getElementById("password");

      passwordInput.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
          event.preventDefault();
          Login_Submit();
        }
      });
    });

    function Login_Submit()
    {
        var vemail = $('#email').val();
        var vpassword = $('#password').val();
        var dataString = "email="+vemail+"&password="+vpassword;
    
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
    
       if($('#email').val() == "" || $('#password').val() == ""){
        
            $('#btn_incomplete').trigger('click');
        
        }
        else if($('#email').val() != "" || $('#password').val() != "")
        {
          $.ajax({
              type: "POST",
              url: 'api/login',
              data: dataString,
              success: function(data){  
                  console.log(data);
                  add_session(data.token, data.email, data.user_id);
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log('Error:', textStatus, errorThrown);
                  noty({
                    force: true,
                    text: 'User หรือ Password ของคุณไม่ถูกต้อง',
                    type: 'warning',
                    layout: "center"
                  });
              }
          });
        }
    } 
    </script>

    <script>
      function add_session($token, $email, $user_id)
    {
      var dataString = "token="+$token+"&email="+$email+"&user_id="+$user_id;
      console.log("dataString");
      console.log(dataString);
      $.ajaxSetup({
            headers: { 
              'X-CSRF-Token' : $('meta[name=_token]').attr('content'),
              'Authorization' : 'Bearer '+ $token
             }
        });

        $.ajax({
                  type: "POST",
                  url: 'addsession',
                  data: dataString,
                  success: function(data){
                    if(data.email == 'nutadmin@nut.com'){
                      window.location.href = "{{URL::to('main_admin')}}";
                    }else{
                      window.location.href = "{{URL::to('main')}}";
                    }
                  }             
                }); 
    }
    </script>

@stop
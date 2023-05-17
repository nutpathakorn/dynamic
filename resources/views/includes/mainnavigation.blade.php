  <!-- Main sidebar -->
      <div class="sidebar sidebar-main sidebar-expand-lg">
        <div class="sidebar-content">

          <!-- Main navigation -->
          <div class="sidebar-category sidebar-category-visible">
            <div class="category-content sidebar-user">
              <div class="media">
                <div class="media-body">
                @if(!session()->has('token'))
                <script type="text/javascript">
                  window.location = "{{URL::to('/')}}";//here double curly bracket
                </script>
                @endif
                  <span class="media-heading text-semibold" id="txt_company_name">Fintechinno CO.,Ltd</span>
                  <div class="text-size-mini text-muted">
                    <i class="icon-pin text-size-small"></i> &nbsp;<span id="txt_company_province">กรุงเทพ</span>, ประเทศไทย
                  </div>
                </div>
              </div>
            </div>

            <div class="category-content no-padding">
              <ul class="navigation navigation-main navigation-accordion">

                <!-- Main -->
                <li class="navigation-header"><span>MENU</span> <i class="icon-menu" title="Main pages"></i></li>
                <li class="dashboard"><a href="{{URL::to('main')}}"><i class="icon-pie-chart3"></i> <span>เรียกฟอร์ม</span></a></li>
                <li class="dashboard"><a href="{{URL::to('formCreate')}}"><i class="icon-stats-growth"></i> <span>สร้างฟอร์ม</span></a></li>
                <!-- <li class="dashboard">
                  <a href="#"><i class="icon-office"></i> <span>ลูกค้า</span></a>
                  <ul>
                      <li><a href="{{URL::to('customer_user')}}">สร้างลูกค้า</a></li>
                      <li><a href="{{URL::to('customer_user_details')}}">รายการลูกค้า</a></li>
                  </ul>
                </li>
                <li class="dashboard">
                  <a href="#"><i class="icon-import"></i> <span>งาน</span></a>
                  <ul>
                      <li><a href="{{URL::to('job_assign')}}">เพิ่มงาน</a></li>
                      <li><a href="{{URL::to('job_assign_details')}}">รายละเอียดงาน</a></li>
                  </ul>
                </li> -->
                
              </ul>
            </div>
          </div>
          <!-- /main navigation -->

        </div>
      </div>
      <!-- /main sidebar -->
      <!-- <script>
         $(document).ready(function() {

            $.ajaxSetup({
              headers: {
                'Authorization': 'Bearer ' + "{{ Session::get('token') }}",
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
              },
            });
            
            var dataString = "company_owner_id="+"{{ Session::get('user_id') }}";
            $.ajax({
              url: 'api/getCompanyDetails',
              type: "POST",
              data: dataString,
                success: function(data) {
                  console.log("Login details: ");
                  console.log(data); 
                  $("#txt_company_name").text(data[0].company_name);
                  $("#txt_company_province").text(data[0].name_in_thai);
                },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log('Error:', textStatus, errorThrown);
              }
            });

         });
      </script> -->
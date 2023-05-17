 
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
                  <span class="media-heading text-semibold">บริษัท Blank Application</span>
                  <div class="text-size-mini text-muted">
                    <i class="icon-pin text-size-small"></i> &nbsp;กรุงเทพ, ประเทศไทย
                  </div>
                </div>
              </div>
            </div>

            <div class="category-content no-padding">
              <ul class="navigation navigation-main navigation-accordion">

                <!-- Main -->
                <li class="navigation-header"><span>MENU</span> <i class="icon-menu" title="Main pages"></i></li>
                <li class="dashboard"><a href="{{URL::to('main_admin')}}"><i class="icon-pie-chart3"></i> <span>สรุปภาพรวม</span></a></li>
                <li class="dashboard">
                  <a href="#"><i class="icon-office"></i> <span>ลูกค้า</span></a>
                  <ul>
                      <li><a href="{{URL::to('customer')}}">สร้างลูกค้า</a></li>
                      <li><a href="{{URL::to('customer_admin_details')}}">รายการลูกค้า</a></li>
                  </ul>
                </li>
                  
                <li class="dashboard">
                  <a href="#"><i class="icon-user"></i> <span>พนักงาน</span></a>
                  <ul>
                      <li><a href="{{URL::to('staff')}}">สร้างพนักงาน</a></li>
                      <li><a href="{{URL::to('staff_details')}}">รายการพนักงาน</a></li>
                  </ul>
                </li>
                <li class="dashboard"><a href="{{URL::to('job_assign_admin')}}"><i class="icon-import"></i> <span>งาน</span></a></li>
                <li class="dashboard"><a href="{{URL::to('master_basket')}}"><i class="icon-basket"></i> <span>จัดการตะกร้างานหลัก</span></a></li>
                <li class="dashboard"><a href="{{URL::to('master_basket_company')}}"><i class="icon-basket"></i> <span>จัดการตะกร้างานลูกค้า</span></a></li>
                
                <!-- <li class="dashboard"><a href="{{URL::to('map_admin')}}"><i class="icon-location4"></i> <span>แผนที่</span></a></li>
                <li class="dashboard"><a href="{{URL::to('report_admin')}}"><i class="icon-stats-growth"></i> <span>รายงาน</span></a></li>               
                <li class="dashboard"><a href="{{URL::to('setting_admin')}}"><i class="icon-cog2"></i> <span>ตั้งค่า</span></a></li> -->
              </ul>
            </div>
          </div>
          <!-- /main navigation -->

        </div>
      </div>
      <!-- /main sidebar -->
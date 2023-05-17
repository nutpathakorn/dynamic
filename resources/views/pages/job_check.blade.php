@extends('layouts.default')

@section('title_page')
Sign-in @parent
@stop

@section('content')

 <!--=================================
wrapper -->

<!-- GMaps -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvQvT-FHJnheKA8vuoIMN0uMUGVOI3jJE">
</script>
<script type="text/javascript" src="{{URL::asset('resources/assets/widgets/maps/gmaps/gmaps.js')}}"></script>
<!--<script type="text/javascript" src="{{URL::asset('resources/assets/widgets/maps/gmaps/gmaps-demo.js')}}"></script>-->
<script type="text/javascript" src="{{URL::asset('resources/assets/widgets/maps/gmaps/24hos_register_maps.js')}}"></script>





    <div class="content-wrapper">
      <!-- widgets -->
      <!-- Orders Status widgets-->
      <div class="row">
        <div class="col-md-12 mb-30">
       <div class="card h-100">
         <div class="card-body">
           <h5 class="card-title"> ตรวจสอบงาน</h5>
           <div id="map-marker" style="height: 650px"></div>
         </div> 
       </div> 
      </div>
    </div>


    
      <!-- Modal -->
      <div class="modal fade" id="RegisterModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
             <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <h5 class="card-title">ตรวจสอบงาน</h5>
                                    <form id="frmgmapadd" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputPhone">Job ID</label>
                                                 <input type="text" class="form-control" id="jobId" name="jobId">
                                            </div>
                                        </div>
                                        <a type="submit" class="button" href="#"> Check</a>
                                    </form>
                                </div>
                            </div>
            </div>
          </div>
        </div>
      </div>

    
  
<!--=================================
 wrapper -->

@stop
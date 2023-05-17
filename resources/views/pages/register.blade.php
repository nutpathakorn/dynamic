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
           <h5 class="card-title"> Register</h5>
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
                                    <h5 class="card-title">Register Details</h5>
                                    <form id="frmgmapadd" enctype="multipart/form-data">
                                    <input type="hidden" id="txtstatus" name="txtstatus" class="form-control">

                                         <input type="text" id="txtindex" name="txtindex" class="form-control">
                                         <input type="hidden" id="txtdocid" name="txtdocid" class="form-control">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputFirst">First name</label>
                                                 <input type="text" class="form-control" id="inputFirst" name="inputFirst">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputLast">Last name</label>
                                                <input type="text" class="form-control" id="inputLast" name="inputLast">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail">Email</label>
                                                <input type="email" class="form-control" id="inputEmail" name="inputEmail">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPhone">Phone</label>
                                                 <input type="text" class="form-control" id="inputPhone" name="inputPhone">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputLat">Lat</label>
                                                <input type="text" class="form-control" id="inputLat" name="inputLat" >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputLong">Long</label>
                                                <input type="text" class="form-control" id="inputLong" name="inputLong">
                                            </div>
                                        </div>
                                        <a type="submit" class="button btnsave" href="#"> Save</a>
                                        <a type="button" class="button gray" href="#" data-dismiss="modal"> Close</a>
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
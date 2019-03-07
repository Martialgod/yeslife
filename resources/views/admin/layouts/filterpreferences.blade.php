@php

   $filters = (isset($filters)) ? $filters : [];

@endphp

<a class="btn btn-success btn-sm" data-toggle="collapse" href="#filterpreferences" aria-expanded="false" aria-controls="filterpreferences">
  	Toggle Filter Preferences 
</a>

<br>

<div class="collapse" id="filterpreferences">

	<br>
  
  	<div class="well">

  		<form action="" class="" method="GET">

  			<div class="row">

  				@foreach($filters as $f)

  					@switch( $f )

  						@case(1) {{--date range--}}

  							@php
  								//responses from the controller
							    $datefrom = (isset($datefrom)) ? $datefrom : date('Y-m-d');
							    $dateto = (isset($dateto)) ? $dateto : date('Y-m-d');
  							@endphp

							<div class="col-md-3">

				  				<div class="form-group">
						            <label for="datefrom">Date From </label>
						            <input type="date" class="form-control" id="datefrom" name="datefrom" placeholder="" value="{{$datefrom}}" >
						            <label for="dateto">Date To </label>
						            <input type="date" class="form-control" id="dateto" name="dateto" placeholder="" value="{{$dateto}}" >
						        </div>

				  			</div><!--END col-md-3 date range-->

  						@break


  						@case(2) {{--paymentstatus--}}

  							@php 
  								//responses from the controller
  								$paymentstatus = (isset($paymentstatus)) ? $paymentstatus : 'Authorized';
    							$mscpaymentstatus = (isset($mscpaymentstatus)) ? $mscpaymentstatus : [];
  							@endphp	

  							<div class="col-md-3">

				  				<div class="form-group">
						            <label for="paymentstatus">Payment Status</label>
						            <select name="paymentstatus" id="paymentstatus" class="form-control">
						            	
                          <option value="All" {{ $paymentstatus == 'All' ? 'selected' : '' }} >All</option>

						            	@foreach($mscpaymentstatus as $key=> $v)
						            		<option value="{{$v->name}}" {{ $paymentstatus == $v->name ? 'selected' : '' }} >{{$v->name}}</option>
						            	@endforeach

								    </select>
						          
						        </div>

				  			</div><!--END col-md-3 paymentstatus-->

  						@break


              @case(3) {{--isnotified--}}

                @php 
                  //responses from the controller
                  $notified = (isset($notified)) ? $notified : 'No';
                @endphp 

                <div class="col-md-3">

                  <div class="form-group">
                        <label for="notified">Already Notified?</label>
                        <select name="notified" id="notified" class="form-control">
                          
                          <option value="No" {{ $notified == 'No' ? 'selected' : '' }} >No</option>
                          <option value="Yes" {{ $notified == 'Yes' ? 'selected' : '' }} >Yes</option>

                    </select>
                      
                    </div>

                </div><!--END col-md-3 notified-->

              @break

  						@default

  					@endswitch


  				@endforeach


	  		</div><!--END row-->


	  		<button type="submit" class="btn btn-info btn-sm hvr-underline-from-left">Apply Filter</button>
	  			


  		</form>

  		
  	</div><!--END well-->

</div><!--eND collapse-->

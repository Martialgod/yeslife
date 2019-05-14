@extends('admin.layouts.master')

@section('title', 'Admin Certifications Edit Page')

@section('optional_styles')

@endsection

@section('content-header')
	<h2>
		<a href="{{url('/admin/certifications')}}" title="" style="color:#68AE00;">Certifications</a> 
		<span style="font-size: 16px;"> / Edit </span>
	</h2> 
@endsection
	
	
@section('content-body')


	<div class="row">

		<form method="POST" class="jqvalidate-form swa-confirm"  action="{{route('certifications.update', $certifications->pk_certificatemstr)}}" enctype="multipart/form-data" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}

        	<div class="col-md-6">

        		@include('admin.layouts.alert')

        		<div class="form-group">
		            <label for="fk_products">Product<span class="label-required">*</span> </label>
		            <select name="fk_products" id="fk_products" class="form-control" required="">
		            	
		            	<option value="-1">
		            		Not Applicable
		            	</option>

		                @foreach($products as $key => $v)
		                    <option value="{{$v->pk_products}}" {{ ($v->pk_products == $certifications->fk_products ) ? 'selected' :'' }}> 
		                    	{{$v->name}} 
		                    </option>
		                @endforeach
		            </select>
		          
		        </div>




                @include('admin.layouts.selectstatus', ['source'=>$certifications])

                <br>
		    	@include('admin.layouts.buttonsubmit')
		

			</div><!--END col-md-6-->


			<div class="col-md-6">


		        <div class="form-group">

		         
		            @if( count($gallery) > 0 )

                        @foreach($gallery as $v)
                            
                            <div class="row col-md-6">


                                <input type="checkbox" id="{{$v->pk_certificatedtls}}" name="removegallery[{{$v->pictx}}]"  class="i-checks"  >
                                <label for="{{$v->pk_certificatedtls}}">Remove </label>
 

                                <br>

                                @if( strpos($v->pictx, '.pdf') !== false )

                                	<object data="{{asset('/storagelink/'.$v->pictx)}}" type="application/pdf" width="100%" height="150px"> 
			                            
			                            <p>
			                                It appears you don't have a PDF plugin for this browser.
			                                No biggie... you can 
			                                <a href="{{asset('/storagelink/'.$v->pictx)}}">click here to
			                                download the PDF file.</a>
			                            </p>  

			                        </object>
	                               

                                @else

                                	<a href="{{url(asset('/storagelink/'.$v->pictx))}}" title="" target="_blank">
                              			<img src="{{asset('/storagelink/'.$v->pictx)}}" alt="" style="width:200px;height:150px;">
                              		</a>

                                @endif

 
                                <br>
                                
                                Lot Code: {{$v->lotcode}}
                               	<br><br>
                               

                            </div>
                        @endforeach

                    @endif

		        </div>

		        <div class="row">
					
				</div>

				<hr>
				
			</div>


		
			
		</form>

	
	</div><!--END row-->

	<hr>
	@include('admin.layouts.buttonback', ['backurl'=>'/admin/certifications'])

@endsection



@section('optional_scripts')

@endsection



	


				    
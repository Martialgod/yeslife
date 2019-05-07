@extends('admin.layouts.master')

@section('title', 'Admin Certifications Page')

@section('optional_styles')
	<link rel="stylesheet" href="/trumbowyg/dist/ui/trumbowyg.min.css">
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search name'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')


    @include('admin.layouts.submenus')

	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/certifications')}}" title="" style="color:#68AE00;">Certifications</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($certifications) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                    <th>Name</th>
	                    <th>Certificate(s)</th>
	                    <th>Status</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($certifications as $a)

	                    <tr>
	                        <td> {{$a->pk_certificatemstr}}  </td>

	                        <td> {{$a->productname}} </td>

	                        <td> {{$a->totalfiles}} </td>

	                        <td style="color:{{ $a->stat == '1' ? 'green' : 'red'}} ;"> 
	                            &nbsp;
	                            {{ ($a->stat) ? 'Active' : 'In-Active'}} 

	                        </td>

	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('certifications.destroy', $a->pk_certificatemstr)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

		                            @include('admin.layouts.submenus', ['data_id'=> $a->pk_certificatemstr])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/certifications'])

	@endif

    @if(count($certifications) > 0)
    	<div class="pagination-margin-top">
    		{{ $certifications->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif


    <br><br><br>
    <form method="POST" class="jqvalidate-form swa-confirm"  action="{{url('/admin/certifications-main-content/'.$globalmessage->pk_globalmessage)}}" enctype="multipart/form-data" >

		{{method_field('PUT')}}
	    {{ csrf_field() }}

	    <div class="form-group">
	        <label for="content">Index Content <span class="label-required"></span> </label>
	        <textarea class="form-control trumbowyg" id="content" name="content" placeholder="" style="resize: none;" >{{$globalmessage->content}}</textarea>
	      		            
	    </div>


	    <br>
		@include('admin.layouts.buttonsubmit')
		

	</form>
	


@endsection



@section('optional_scripts')

	<script src="/trumbowyg/dist/trumbowyg.min.js"></script>

    <script type="text/javascript">
        $('.trumbowyg').trumbowyg();
    </script>

@endsection



	


				    
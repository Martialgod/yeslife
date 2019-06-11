@extends('admin.layouts.master')

@section('title', 'Admin FAQs Page')

@section('optional_styles')
	<link rel="stylesheet" href="/trumbowyg/dist/ui/trumbowyg.min.css">
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search question'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')


    @include('admin.layouts.submenus')

	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/faqs')}}" title="" style="color:#68AE00;">FAQs</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($faqs) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                    <th>Question</th>
	                    <th>Indexno</th>
	                    <th>Status</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($faqs as $a)

	                    <tr>
	                        <td> {{$a->pk_faqs}}  </td>

	                        <td> {{$a->question}} </td>

	                        <td> {{$a->indexno}} </td>

	                        <td style="color:{{ $a->stat == '1' ? 'green' : 'red'}} ;"> 
	                            &nbsp;
	                            {{ ($a->stat) ? 'Active' : 'In-Active'}} 

	                        </td>

	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('faqs.destroy', $a->pk_faqs)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

		                            @include('admin.layouts.submenus', ['data_id'=> $a->pk_faqs])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/faqs'])

	@endif

    @if(count($faqs) > 0)
    	<div class="pagination-margin-top">
    		{{ $faqs->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif


    <br><br>
    <form method="POST" class="jqvalidate-form swa-confirm"  action="{{url('/admin/faqs-references/'.$globalmessage->pk_globalmessage)}}" enctype="multipart/form-data" >

		{{method_field('PUT')}}
	    {{ csrf_field() }}

	    <div class="form-group">
	        <label for="content">References <span class="label-required"></span> </label>
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



	


				    
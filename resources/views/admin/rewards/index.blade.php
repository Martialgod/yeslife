@extends('admin.layouts.master')

@section('title', 'Admin Rewards Page')

@section('optional_styles')
	
@endsection


@section('global-search')
	@include('admin.layouts.globalsearch', ['placeholder'=> 'search fullname, reward type'])
@endsection

	
@section('content-body')

	@include('admin.layouts.alert')

    @include('admin.layouts.submenus')


   	{{--filters[4=fk_users, 5=rewardactions]--}}
   	@include('admin.layouts.filterpreferences', ['filters'=>[4, 5]])

   	{{-- default value for select2. set @bottom script --}}
   	<input type="hidden" id="userid" value="{{$fk_users}}">
   	<input type="hidden" id="fullname" value="{{ $fullname != '' ? $fullname : 'Display All' }}">


	<br><br>

	@section('content-header')
		<h2>
		 	<a href="{{url('/admin/rewards')}}" title="" style="color:#68AE00;">Rewards</a> <span style="font-size: 16px;"> / List </span> 
		</h2> 
	@endsection

	@if(count($rewards) > 0)

		<div class="table-responsive">
	        
	        <table class="table table-hover">
	            
	            <thead>

	                <tr>
	                   	<th>ID</th>
	                   	<th>Fullname</th>
	                    {{--<th>Phone</th> --}}
	                    <th>Email</th>
	                    <th>Action</th>
	                    <th>Points</th>
	                    <th></th>
	                    {{--<th>Referredby</th>--}}
	                    {{--<th>Referral</th> --}}
	                    <th>Remarks</th>
	                    <th></th>
	              </tr>

	          	</thead>
	          	
	          	<tbody>

	                @foreach($rewards as $a)

	                    <tr>
	                        <td> {{$a->pk_userrewards}}  </td>

	                        <td> {{$a->fullname}} </td>

	                        {{-- <td> {{$a->phone}} </td> --}}

	                        <td> {{$a->email}} </td>

	                        <td> 
	                        	{{$a->actionname}} 

	                        </td>


	                        <td> {{$a->points}} </td>


	                        <td>


                        		@php
                        			$test = "Referral: $a->downline <br> Order No: $a->trxno <br>   Order Amount: $$a->orderamount <br> Reward Type: $a->type <br> Reward Amount: $a->actionpoints";
	                        	@endphp

                        	 	<span data-html="true"  data-toggle="tooltip" title="{{$test}}" style="cursor: help;">	
	                        		<i class="fa fa-question"></i>
	                        	</span>

	                        </td>

	                        {{--<td> 
	                        	<span data-toggle="tooltip" title="{{$a->mainline}}" style="cursor: help;">
                                    {{
                                        (strlen($a->mainline)) > 8 ? substr($a->mainline,0,8).'..' : $a->mainline 
                                    }}
                                </span>
	                        </td> --}}

	                        {{--<td>

	                        	<span data-toggle="tooltip" title="{{$a->downline}}" style="cursor: help;">
                                    {{
                                        (strlen($a->downline)) > 8 ? substr($a->downline,0,8).'..' : $a->downline 
                                    }}
                                </span>

	                        </td> --}}

	                        <td>

	                        	<span data-toggle="tooltip" title="{{$a->remarks}}" style="cursor: help;">
                                    {{
                                        (strlen($a->remarks)) > 10 ? substr($a->remarks,0,10).'..' : $a->remarks 
                                    }}
                                </span>

	                     	</td>



	                        <td>

	                    		<form class="form-inline swa-confirm" method="POST" action="{{route('rewards.destroy', $a->pk_userrewards)}}" >
	                                                    
	                                {{method_field('DELETE')}}
	                                {{ csrf_field() }}

		                            @include('admin.layouts.submenus', ['data_id'=> $a->pk_userrewards])

	                            </form>

	                    	</td>

	                    </tr>

	                  

	                @endforeach
		          
	      		</tbody>


		  	</table><!--END table table-hover-->

		</div><!--END table-responsive-->


	@else

		@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/rewards'])

	@endif

    @if(count($rewards) > 0)
    	<div class="pagination-margin-top">
    		{{ $rewards->appends(
            	['search' => $search,]
        	)->links() }}
    	</div>
    @endif




@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
		//initialize select2
		//$("#fk_users").select2({width:'100%'});//initialize jquery select2 plugin; 

		$(document).ready(function(){

			var tempfkusers = $('#userid').val();
			var tempfullname = $('#fullname').val();

			//console.log(tempfkusers);
			//console.log(tempfullname);

			$('#select2_fkusers').empty().append('<option value="'+tempfkusers+'">'+tempfullname+'</option>').val(tempfkusers).trigger('change');
					
		});


	</script>

@endsection



	


				    
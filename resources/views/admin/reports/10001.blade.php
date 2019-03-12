{{--10001 = Customer List--}}
@if(count($result) > 0)

	<div class="">
		<blockquote style="font-size: 14px">
			Type: {{$type}}
		</blockquote>
	</div>


	<div class="table-responsive">
	        
	    <table class="table table-hover">
	        
	        <thead>

	            <tr>
	               	<th>Fullname</th>
	               	<th>Phone</th>
	                <th>Email</th>
	                <th>Address</th>

	                @if($type == 'opt-out')

	                	<th> Opt-out </th>

	                @endif

	                @if($type == 'abandoned')

	                	<th> Item(s) </th>

	                @endif

	          	</tr>

	      	</thead>
	      	
	      	<tbody>

	            @foreach($result as $a)

	                <tr>
	                    <td> {{$a->fullname}}  </td>

	                    <td> {{$a->phone}} </td>

	                    <td> {{$a->email}} </td>

	                    <td> {{$a->address}}  </td>

	                    @if($type == 'opt-out')

		                    <td>
		                    	
		                    	@if( $a->issubscribed == 0 )
		                    		Email
		                    	@endif

		                    	@if( $a->istext == 0 )
		                    		Text
		                    	@endif

		                    </td>

		                @endif


	                    @if($type == 'abandoned')

	                    	<td> {{$a->totalitems}}  </td>

	                    @endif
	                   
	                </tr>

	              

	            @endforeach
	          
	  		</tbody>


	  	</table><!--END table table-hover-->

	</div><!--END table-responsive-->

	@include('admin.reports.generated')


@else

	@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/users'])

@endif

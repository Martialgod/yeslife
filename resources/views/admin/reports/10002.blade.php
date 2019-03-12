{{--10002 = Sales Orders--}}
@if(count($result) > 0)

	
	<a href="{{url()->current()."?datefrom=$datefrom&dateto=$dateto&displaytype=$displaytype&export=true"}}" title="" > 
	    Export Data
	</a>

	<div class="">
		<blockquote style="font-size: 14px">
			Date: {{$datefrom. ' / ' . $dateto}} <br>
			Display: {{$displaytype}}
		</blockquote>
	</div>

	
	@if($displaytype == 'summary')

		@include('admin.reports.10002-summary')

	@else 

		@include('admin.reports.10002-details')

	@endif


@else

	@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/users'])

@endif

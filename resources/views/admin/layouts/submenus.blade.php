@if(isset($sub_menu))

	@php
		//data_id = arguments passed by the caller blades, determine the id of the data to be passed in the route menu
		$data_id = isset($data_id) ? $data_id : null;

		//specific options. determine if we need to show certain submenu or hide it
		$options = isset($options) ? $options : null;

	@endphp
	
	@foreach($sub_menu as $key => $sub)

		{{--Add New--}}
		@if( $sub->indexno == 0 && $data_id == null  )
			
			{{--redirect to another page, no params--}}
			<a href="{{route($sub->route)}}" class="btn btn-primary btn-sm hvr-underline-from-left">
		        {{$sub->description}}
		    </a>

		@endif {{--$sub->indexno == 0 && $data_id == null--}}


		@if( $sub->indexno >= 1 && $data_id != null ) 

			@if( $sub->method == 'DELETE' )

				<button class="btn btn-default btn-sm label-required hvr-underline-from-left"  type="submit" >
	               {{$sub->description}}
	           	</button>


	        @else 


        		{{--specific checking. broadcast or mailer menu. used in Orders Master List--}}
        		@if( $sub->pk_permalink == 2003 )

        			{{--Show only menu when unbroadcastusers are greater than zero --}}
        			@if( isset($options) && $options['unbroadcastusers'] > 0 )

        				{{--default. display all--}}
			        	<a href="{{route($sub->route, $data_id)}}" class="btn btn-default btn-sm hvr-underline-from-left">
			               {{$sub->description}}
			            </a>	 


        			@endif


        		{{--Login as virtual user--}}
        		@elseif( $sub->pk_permalink == 5006 )

		        	<a href="{{route($sub->route, $data_id)}}" class="btn btn-default btn-sm hvr-underline-from-left" target="_blank">
		               {{$sub->description}}
		            </a>	 

        		@else

        			{{--default. display all menu--}}
		        	<a href="{{route($sub->route, $data_id)}}" class="btn btn-default btn-sm hvr-underline-from-left">
		               {{$sub->description}}
		            </a>	 

        		@endif


			@endif {{--END $sub->method == 'DELETE' --}}

		@endif {{--END $sub->indexno >= 1 && $data_id != null --}}


	@endforeach

@endif

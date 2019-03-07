<div class="col-md-4 pull-right">
	
	<form class="form-inline my-2 my-lg-0" method="GET" >
     
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{$search}}" autofocus="">
            	
            @if(isset($type))
            	{{--for subscriptions verified and unverified type--}}
            	<input type="hidden" name="type" value="{{$type}}" /> 
            @endif
            

            <button class="btn btn-default notika-btn-default waves-effect" type="submit">Search</button>
         

	</form>

</div>

<br><br><br>
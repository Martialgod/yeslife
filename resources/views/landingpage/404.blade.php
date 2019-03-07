@extends('landingpage.layouts.master')

@section('title', 'YesLife 404 Page')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')

	<br><br><br><br>
				    
	<div class="" style="text-align: center;">

		
		<div class="error-404">  	
			<div class="error-page-left">
				<br>
				{{--<img src="/adminpage/images/nosearchfound.png" alt="">--}}
				<h3>Nothing to display....</h3>
				<br>
			</div>
			<div class="error-right">
		    	
		    	
	    		<div class="col-12" style="text-align:center">
	    			<a href="{{url('/')}}" class="btn btn-round btn-lg"> 
	    				Go Back
	    			</a>
                   
                </div>
		    	

			</div>
		</div>


	</div><!--END row-->

	<br>



    

@endsection



@section('optional_scripts')

	<script type="text/javascript">
		
	</script>

@endsection



	


	


				    

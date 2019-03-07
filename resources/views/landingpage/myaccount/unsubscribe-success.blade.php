@extends('landingpage.layouts.master')

@section('title', 'YesLife Unsubscribe Page')

@section('meta')

    <meta name="robots" content="yeslife,cbd,index" />
    <meta name="description" content="yeslife,cbd,index">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


@endsection

@section('optional_styles')
	

@endsection

	
@section('content-body')

				    
	<div class="" style="text-align: center;">

		<div class="error-404">  	
			
			<div class="error-page-left">
				<br><br><br><br><br>
				<h3>
					You have been successfully removed from this subscribers list.
				</h3>
    		
				

			</div>

			<div class="error-right">
		    	
	    		<div class="col-12" style="text-align:center">
	    			
	    			<br>
	    			<hr>
	    			Didn't mean to unsubscribe? No Problem, 
	    			<a href="{{url('/myaccount/resubscribe')}}" title="" style="color:blue">
	    				click here to re-subscribe to this list.
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



	


	


				    

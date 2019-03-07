@php 
	
	//did not know url()->previous() before so i manually setup the backurl for every caller view
	//in this line of code i just overwrite whatever backurl value passed to this view since i forgot to track down every view who calls this one
	//$backurl = (isset($backurl)) ? $backurl : '#';
	
	$backurl = url()->previous(); //laravel builtin function


@endphp

<div class="error-404">  	
	<div class="error-page-left">
		<img src="/adminpage/images/nosearchfound.png" alt="">
	</div>
	<div class="error-right">
    	
    	<a href="{{url($backurl)}}">Go Back</a>
	</div>
</div>
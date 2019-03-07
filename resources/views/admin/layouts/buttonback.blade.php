@php 
	
	//did not know url()->previous() before so i manually setup the backurl for every caller view
	//in this line of code i just overwrite whatever backurl value passed to this view since i forgot to track down every view who calls this one
	//$backurl = (isset($backurl)) ? $backurl : '#';
	
	$backurl = url()->previous(); //laravel builtin function

@endphp 

<a href="{{url($backurl)}}" class="btn btn-default hvr-underline-from-left">
    <i class="fa fa-arrow-left" aria-hidden="true"> Go back</i>
</a>
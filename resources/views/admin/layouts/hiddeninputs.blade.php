{{--this values are returned in OrderController.php@index  --}}
@if( strpos(url()->current(), '/admin/orders') !== false )

	<input type="hidden" name="datefrom" value="{{$datefrom}}">
	<input type="hidden" name="dateto" value="{{$dateto}}">
	<input type="hidden" name="paymentstatus" value="{{$paymentstatus}}">

@endif
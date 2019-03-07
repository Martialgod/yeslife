@if( Auth::check() )

	@php 
		$twittershareurl = url('/').'&refno='.Auth::user()->affiliate_token;
	
	@endphp 

	<a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large" data-text="YesLife We provide the best CBD oil in almost all US states." data-url="{{url('/')}}?refno={{Auth::user()->affiliate_token}}" data-hashtags="yeslife,CBD" > 
	  	Tweet
	</a>

@else

	{{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}
	<!-- Your share button code -->
	<a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large" data-text="YesLife We provide the best CBD oil in almost all US states." data-url="{{url('/')}}{{$refnourl}}" data-hashtags="yeslife,CBD"> 
	  	Tweet 
	</a>

@endif



@if( Auth::check() )

	@php 
		$twittershareurl = url('/').'&refno='.Auth::user()->affiliate_token;
	
	@endphp 

	{{--class="twitter-share-button"--}}
	<a class="" href="https://twitter.com/intent/tweet" data-size="large" data-text="YesLife We provide the best CBD oil in almost all US states." data-url="{{url('/')}}?refno={{Auth::user()->affiliate_token}}" data-hashtags="yeslife,CBD" > 
	  	<img src="/landingpage/assets/images/social/twitter-blue.png" width="30px"></img>
	</a>

@else

	{{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}
	<!-- Your share class="button code twitter-share-button"-->
	<a class="" href="https://twitter.com/intent/tweet" data-size="large" data-text="YesLife We provide the best CBD oil in almost all US states." data-url="{{url('/')}}{{$refnourl}}" data-hashtags="yeslife,CBD"> 
	  	<img src="/landingpage/assets/images/social/twitter-blue.png" width="30px"></img>
	</a>

@endif



<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
	(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

@if( Auth::check() )

	<!-- Your share button code -->
	<div class="fb-share-button" data-href="{{url('/')}}?refno={{Auth::user()->affiliate_token}}" data-layout="button_count" data-size="large">
	</div>

@else

	{{--$refnourl initialized at App/Providers/AppServiceProvider.php--}}
	<!-- Your share button code -->
	<div class="fb-share-button" data-href="{{url('/')}}{{$refnourl}}" data-layout="button_count" data-size="large">
	</div>

@endif


<!-- My Account Tab Menu Start -->
<div class="col-lg-3 col-12 mb-30">
    
    <div class="myaccount-tab-menu nav" role="tablist"  style="background-color: #f4f5f7;">

        <a href="{{url('/myaccount/home')}}" class="{{(session('myaccount_tab') == 'Dashboard') ? 'active' : ''}}" >
            <i class="fa fa-dashboard"></i>Dashboard
        </a>

        <a href="{{url('/myaccount/orders')}}" class="{{(session('myaccount_tab') == 'Orders') ? 'active' : ''}}" >
            <i class="fa fa-cart-arrow-down"></i>My Orders
        </a>

        <a href="{{url('/myaccount/recurring')}}" class="{{(session('myaccount_tab') == 'Recurring') ? 'active' : ''}}" >
            <i class="fa fa-refresh"></i>Recurring
        </a>

        {{--<a href="{{url('/myaccount/paymentmethod')}}" class="{{(session('myaccount_tab') == 'Payment') ? 'active' : ''}}">
            <i class="fa fa-credit-card"></i>Payment
        </a> --}}

        <a href="{{url('/myaccount/reviews')}}" class="{{(session('myaccount_tab') == 'Reviews') ? 'active' : ''}}">
            <i class="fa fa-star"></i>Reviews
        </a>

        <a href="{{url('/myaccount/address')}}" class="{{(session('myaccount_tab') == 'Address') ? 'active' : ''}}" >
            <i class="fa fa-map-marker"></i>Address
        </a>

        <a href="{{url('/myaccount/details')}}" class="{{(session('myaccount_tab') == 'Details') ? 'active' : ''}}" >
            <i class="fa fa-user"></i>Account
        </a>

        <a href="{{url('/myaccount/affiliate')}}" class="{{(session('myaccount_tab') == 'Affiliate') ? 'active' : ''}}" >
            <i class="fa fa-address-book-o"></i>Affiliate
        </a>

        <a href="{{url('/logout')}}"><i class="fa fa-sign-out"></i>Logout</a>

    </div><!--END myaccount-tab-menu nav-->

</div>
<!-- My Account Tab Menu End -->
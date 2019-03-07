@extends('admin.layouts.master')

@section('title', 'Admin Users Create Page')

@section('optional_styles')
    

@endsection



@section('content')
    
    @section('breadcrumb-details')

        <div class="breadcomb-icon">
        
            <a href="{{route('orders.index')}}" data-toggle="tooltip" title="Index Orders">
                <i class="fa fa-opencart fa" aria-hidden="true"></i>
            </a>

        </div>

        <div class="breadcomb-ctn">
            <h2 >
                <a href="{{route('orders.index')}}" class="text-success">
                    Orders List
                </a>
            </h2> 
            
            
            <p>
                Create Page
            </p>

  
        </div>

    @endsection


   <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                @include('admin.layouts.alert')

                 
            
            </div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
        </div> <!-- row end -->
    </div> <!-- container end -->

@endsection


@section('optional_scripts')



@endsection



    
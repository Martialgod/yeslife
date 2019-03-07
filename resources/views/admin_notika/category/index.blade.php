@extends('admin.layouts.master')

@section('title', 'Admin Category List Page')

@section('optional_styles')
    

@endsection



@section('content')
    
    @section('breadcrumb-details')

        <div class="breadcomb-icon">
        
            <a href="{{route('category.create')}}" data-toggle="tooltip" title="Add Product">
               <i class="fa fa-plus "></i>
            </a>

        </div>

        <div class="breadcomb-ctn">
            <h2 >
                <a href="{{route('category.index')}}" class="text-success">
                    Category List
                </a>
            </h2> 
            
            <p>
                Index Table 

            </p>

  
        </div>

    @endsection


   <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                @include('admin.layouts.alert')

                <div class="normal-table-list sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0">
                    
                    <div class="basic-tb-hd">
                        @include('admin.layouts.search')
                    </div><!--END basic-tb-hd-->

                    @if( count($category) > 0 )
                        
                        <div class="bsc-tbl-st">
                            
                            <table class="table">
                                
                                   <thead>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th></th>
                                    </thead>
                                
                                <tbody >
                
                                    @foreach($category as $a)

                                        <tr>
                                            <td width=";"> {{$a->pk_category}} </td>
                                            <td width=";"> {{$a->description}} </td>

                                            

                                            <td width=";" style="color:{{ $a->stat=='0' ? 'red' : 'green'}} ;"> 
                                                &nbsp;
                                                {{ ($a->stat) ? 'Active' : 'In-Active'}} 

                                            </td>


                                            <td width=";">

                                                <form class="form-inline my-2 my-lg-0 swa-confirm" method="POST" action="{{route('category.destroy', $a->pk_category)}}" >
                                                    
                                                    {{method_field('DELETE')}}
                                                    {{ csrf_field() }}

                                                    <a href="{{route('category.edit', $a->pk_category)}}" class="btn btn-default notika-btn-default waves-effect">
                                                        Edit
                                                    </a> &nbsp;

                                                    <button class="btn btn-default notika-btn-default waves-effect" type="submit"  >
                                                        <span class="text-danger">Delete</span>
                                                    </button>  &nbsp;

                                                </form>

                                            </td><!--END 150px-->

                                        </tr>

                                    @endforeach

                                </tbody>


                            </table><!--END table table-striped-->

                            
                            @if(count($category) > 0)

                                {{ $category->appends(
                                    ['search' => $search,]
                                )->links() }}

                            @endif


                        </div><!--END bsc-tbl-st-->

                     @else

                        @include('admin.layouts.nosearchfound')

                    @endif


                </div><!--END normal-table-list-->
            

  
            </div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->



        </div> <!-- row end -->
    </div> <!-- container end -->

@endsection


@section('optional_scripts')



@endsection



    
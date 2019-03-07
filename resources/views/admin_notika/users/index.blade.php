@extends('admin.layouts.master')

@section('title', 'Admin Users List Page')

@section('optional_styles')
    

@endsection



@section('content')
    
    @section('breadcrumb-details')

        <div class="breadcomb-icon">
        
            <a href="{{route('users.create')}}" data-toggle="tooltip" title="Add User">
                <i class="fa fa-plus "></i>
            </a>

        </div>

        <div class="breadcomb-ctn">
            <h2 >
                <a href="{{route('users.index')}}" class="text-success">
                    Users List
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

               
                    <div class="normal-table-list sm-res-mg-t-30 tb-res-mg-t-30 tb-res-mg-t-0 bglight">
                       
                        <div class="basic-tb-hd">
                            @include('admin.layouts.search')
                        </div>

                        @if( count($users) > 0 )

                            <div class="bsc-tbl-st">
                                
                                <table class="table">
                                    
                                    <thead>
                                        <th>ID</th>
                                        <th>Role</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th></th>
                                    </thead>
                                    
                                    <tbody>
                    
                                        @foreach($users as $a)

                                            <tr >
                                             
                                                <td> {{$a->id}} </td>

                                                <td> {{$a->utype}} </td>

                                                <td> {{$a->fullname}} </td>

                                                <td> {{$a->uname}} </td>

                                                <td style="color:{{ $a->stat=='0'?'red':'green'}} ;"> 
                                                    {{($a->stat) ? 'Active' : 'In-Active'}} 
                                                </td>

                                                <td width="300px;">    
                                                    {{-- onsubmit="return confirm('Are you sure you want to delete user?')" --}}
                                                    <form class="swa-confirm form-inline my-2 my-lg-0" method="POST" action="{{route('users.destroy', $a->id)}}" >
                                                        
                                                            
                                                        {{method_field('DELETE')}}
                                                        {{ csrf_field() }}
                                                        
                                             
                                                        <a href="{{route('users.edit', $a->id)}}" class="btn btn-default notika-btn-default waves-effect">
                                                            Edit
                                                        </a> &nbsp;

                                                        <button class="btn btn-default notika-btn-default waves-effect" type="submit"  >
                                                            <span class="text-danger">Delete</span>
                                                        </button>  &nbsp;

                                                    </form>

                                                    

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table><!--END table table-striped-->

                                @if(count($users) > 0)


                                    {{ $users->appends(
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



    
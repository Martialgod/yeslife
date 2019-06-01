{{--10002 = Sales Orders--}}
@if(count($result) > 0)

	
	<a href="{{url()->current()."?export=true"}}" title="" > 
	    Export Data
	</a>

	<div class="">
		
	</div>

	<div class="table-responsive">

    <table class="table table-hover">
        
        <thead>

            <tr>
               	<th>Category</th>
               	<th>Flavor</th>
                <th>Product Name</th>
                <th>Slug</th>
                <th></th>
          	</tr>

      	</thead>
      	
      	<tbody>

            @foreach($result as $a)

                <tr>
                    <td> {{$a->category}}  </td>

                    <td> {{$a->flavor}}  </td>

                    <td> {{$a->name}}  </td>

                    <td> {{$a->slug}}  </td>

                    <td>
                    	<a href="{{url('/admin/products/'.$a->pk_products.'/edit')}}" class="btn btn-primary btn-sm hvr-underline-from-left" target="_blank">
					        Edit
					    </a>
                    </td>
                   
                </tr>

              

            @endforeach
          
  		</tbody>


  	</table><!--END table table-hover-->

</div><!--END table-responsive-->

@include('admin.reports.generated')



@else

	@include('admin.layouts.nosearchfound', ['backurl'=> '/admin/users'])

@endif

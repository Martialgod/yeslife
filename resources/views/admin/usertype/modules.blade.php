@extends('admin.layouts.master')

@section('title', 'Admin User Type Edit Modules')

@section('optional_styles')

	<script src="/customjs/UserTypeModulesController.js?v={{time()}}" type="text/javascript"></script>

@endsection



@section('content-header')
	<h2>
		<a href="{{url('/admin/usertype')}}" title="" style="color:#68AE00;">User Type</a> 
		<span style="font-size: 16px;"> / Modules </span>
	</h2> 
@endsection
	

	
@section('content-body')


	@include('admin.layouts.alert')


	<div class="row" id="main-div" ng-app="app" ng-controller="UserTypeModulesController as vm" >


		<form method="POST" class="" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}


			<div class="col-md-2 well">

        		<div class="form-group" hidden>
                    <label for="pk_usertype">Name <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="pk_usertype" name="pk_usertype" placeholder="" required="" value="{{$usertype->pk_usertype}}" readonly="">
                  
                </div>

        		<div class="form-group">
                    <label for="name">Name <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" required="" value="{{$usertype->name}}" maxlength="15" readonly="">
                  
                </div>

        		<div class="form-group">
                    <label for="description">Description <span class="label-required">*</span> </label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="" required="" maxlength="255" value="{{$usertype->description}}" readonly="">
                  
                </div>

			</div><!--END col-md-4-->


			<div class="col-md-8">

				<br>
    			<div class="form-group">
                    <input type="text" placeholder="search module" name="name" class="form-control " ng-model="vm.searchmodule">
                </div><!--END form-group label-floating-->

				
                <!--BEGIN div module well well-small well-shadow overflow-y:scroll; display:block;height:400px-->
			    <div class="" style="" >

			    	<div class="" ng-repeat="list in vm.modules | filter:vm.searchmodule">


			    		<div rel="tooltip" title="Parent Module" class="" ng-show="list.type == 'A'" ><!--box-header-->
					       	<hr>
	                    	<div class="checkbox">
		                        <label >
		                            <input type="checkbox" ng-model="list.selected" ng-change="vm.SelectDeselect(list, 'modules')" ng-disabled="@{{list.isdefault}}" >
		                            <span style="color:black;">
		                             	@{{list.description}}
		                            </span>
		                           
		                        </label>
		                    </div>

		                    <hr>
		              
					    </div><!--END type == A-->



			    		<div rel="tooltip" title="@{{list.tips}}"  class="" ng-show="list.type == 'B'">

		    				<div class="checkbox"  >
		                        <label>&nbsp;&nbsp;&nbsp;
		                            <input type="checkbox" ng-model="list.selected" ng-change="vm.SelectDeselect(list, 'modules')" >
		                            <span style="color:black;">
		                             	@{{list.description}}
		                            </span>
		                        </label>
		                        <span class="pull-right text-danger" style="font-size: 12px; ">
					            	@{{list.tips}}
					            </span>
		                    </div>


					    </div><!--END type == B-->


					    <div rel="tooltip" title="@{{list.tips}}" class=" collapse in " ng-show="list.type == 'C' " >

					        <ul class="collapse in">
					        
				            	<div class="checkbox">
			                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                            <input type="checkbox" ng-model="list.selected" ng-change="vm.SelectDeselect(list, 'modules')" >
			                            @{{list.description}}
			                        </label>
			                        <span class="pull-right text-danger" style="font-size: 12px; ">
						            	@{{list.tips}}
						            </span>
			                    </div>

					        </ul><!--END ul -->

					    </div><!--END type == C-->    


			    	</div><!--END ng-repeat-->


			    </div><!--END overflow-->

		    	<br>
		    	<hr>
            	<div class="checkbox">
                    <label>
                        <input type="checkbox" ng-model="vm.isSelectAllModules" ng-change="vm.SelectDeselect(null, 'modules')" >
                        [ Select / Deselect ]
                    </label>
                </div>



                <br>
		    	@include('admin.layouts.buttonajaxsubmit')

		    	<hr>
				@include('admin.layouts.buttonback', ['backurl'=>'/admin/usertype'])
		
			</div><!--END col-md-8-->



		</form>

	
	</div><!--END row-->



@endsection



@section('optional_scripts')

@endsection



	


				    
@extends('admin.layouts.master')

@section('title', 'Admin User Type Edit Modules')

@section('optional_styles')

@endsection



@section('content-header')
	<h2>
		<a href="{{url('/admin/usertype')}}" title="" style="color:#68AE00;">User Type</a> 
		<span style="font-size: 16px;"> / Modules </span>
	</h2> 
@endsection
	

@section('content-body')


	@include('admin.layouts.alert')

	<div class="row" id="main-div" >


		<form method="POST" class="" v-on:submit.prevent="confirmSubmit" >

		    {{method_field('PUT')}}
	        {{ csrf_field() }}


			<div class="col-md-2 well">

        		<div class="form-group" hidden >
                    <label for="pk_usertype">Name <span class="label-required">*</span> </label>
                    <input type="text" ref="pk_usertype" class="form-control" id="pk_usertype" name="pk_usertype" placeholder="" required="" value="{{$usertype->pk_usertype}}" readonly="">
                  
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
                    <input type="text" placeholder="search module" name="name" class="form-control " v-model="searchmodule">
                </div><!--END form-group label-floating-->


                <div class="" style="" >

					<div class="" v-for="list in filteredModules">

						<div rel="tooltip" title="Parent Module" class="" v-if="list.type == 'A'" ><!--box-header-->
							<hr>
							<div class="checkbox">
								<label >
									<input type="checkbox" v-model="list.selected" v-on:change="SelectDeselect(list, 'modules')" v-bind:disabled="list.isdefault" >
									<span style="color:black;">
										@{{list.description}}
									</span>
								   
								</label>
							</div>

							<hr>
					  
						</div><!--END type == A-->

						<div rel="tooltip" v-bind:title="list.tips"  class="" v-show="list.type == 'B'">

							<div class="checkbox"  >
								<label>&nbsp;&nbsp;&nbsp;
									<input type="checkbox" v-model="list.selected" v-on:change="SelectDeselect(list, 'modules')" >
									<span style="color:black;">
										@{{list.description}} 
									</span>
								</label>
								<span class="pull-right text-danger" style="font-size: 12px; ">
									@{{list.tips}}
								</span>
							</div>


						</div><!--END type == B-->


						<div rel="tooltip" v-bind:title="list.tips" class=" collapse in " v-show="list.type == 'C' " >

							<ul class="collapse in">
							
								<div class="checkbox">
									<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" v-model="list.selected" v-on:change="SelectDeselect(list, 'modules')" >
										@{{list.description}} @{{list.selected}}
									</label>
									<span class="pull-right text-danger" style="font-size: 12px; ">
										@{{list.tips}}
									</span>
								</div>

							</ul><!--END ul -->

						</div><!--END type == C-->    



					</div><!--END v-for-->


				</div><!--END overflow-->
				
				<br>
				<hr>
				<div class="checkbox">
					<label>
						<input type="checkbox" v-model="isSelectAllModules" v-on:change="SelectDeselect(null, 'modules')" >
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

	<script src="/vuejs/vue.min.js" type="text/javascript"></script>
	<script src="/vuejs/lodash.min.js" type="text/javascript"></script>
	<script src="/vuejs/axios.min.js" type="text/javascript"></script>


	<script type="text/javascript">      
	  	
	  	//laravel token session
	  	window.csrf_token = "{{ csrf_token() }}"

	  	axios.defaults.headers.common = {
		    'X-Requested-With': 'XMLHttpRequest',
		    'X-CSRF-TOKEN': window.csrf_token
		};

	</script>


	<script src="/customjs/_UserTypeModulesVue.js?v={{time()}}" type="text/javascript"></script>


@endsection



	


				    
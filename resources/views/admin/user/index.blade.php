@extends('layouts.admin')
@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #117A65; color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-fw fa-user"></i> New User</h3>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                {!!Form::open(['action'=>'UserController@store','method'=>'POST'])!!}
                  {{csrf_field()}}
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group {{ $errors->has('nameDisplay') ? ' has-error' : '' }}">
                        {!!Form::label('nameDisplay','Name:',[])!!}
                        {!!Form::text('nameDisplay',null,['class'=>'form-control','required'=>'true'])!!}
                        @if ($errors->has('nameDisplay'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nameDisplay') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group {{ $errors->has('sex') ? ' has-error' : '' }}">
                            {!!Form::label('sex','Gender : ',[])!!}
                            {!!Form::select('sex', ['1' => 'Male', '0' => 'Female'], null, ['class'=>'form-control','required'=>'true','placeholder'=> '--Select gender--'])!!}
                            @if ($errors->has('sex'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sex') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        {!!Form::label('name','Username',[])!!}
                        {!!Form::text('name',null,['class'=>'form-control','required'=>'true'])!!}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div> 
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        {!!Form::label('password','Password',[])!!}
                        {!!Form::password('password',['class'=>'form-control','required'=>'true'])!!}
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>        
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                          {!!Form::label('password-confirm','Confirm Password',[])!!}
                          {!!Form::password('password_confirmation',['class'=>'form-control','required'=>'true','id'=>'password-confirm'])!!}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        {!!Form::label('email','Email',[])!!}
                        {!!Form::text('email',null,['class'=>'form-control'])!!}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group {{ $errors->has('contactNum') ? ' has-error' : '' }}">
                        {!!Form::label('contactNum','Phone',[])!!}
                        {!!Form::number('contactNum',null,['class'=>'form-control','min'=>'0'])!!}
                        @if ($errors->has('contactNum'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contactNum') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group {{ $errors->has('position_id') ? ' has-error' : '' }}">
                        {!!Form::label('position_id','Position Name :',[])!!}
                        {!!Form::select('position_id',[null=>'---Select position---']+$positions,null,['class'=>'form-control','required'=>'true'])!!}
                        @if ($errors->has('position_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('position_id') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group {{ $errors->has('zone_id') ? ' has-error' : '' }}">
                        {!!Form::label('zone_id','Zone Name :',[])!!}
                        {!!Form::select('zone_id',[null=>'---Select zone---']+$zones,null,['class'=>'form-control'])!!}
                        @if ($errors->has('zone_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('zone_id') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group {{ $errors->has('brand_id') ? ' has-error' : '' }}">
                        {!!Form::label('brand_id','Brand Name :',[])!!}
                        {!!Form::select('brand_id',[null=>'---Please select brand---']+$brands,null,['class'=>'form-control'])!!}
                        @if ($errors->has('brand_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('brand_id') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>
                <div class="modal-footer" style="background-color: #117A65;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"> Create </button>
               </div>
            {!!Form::close()!!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-fw fa-user"></i> User</h4>
    </div>
                <!-- /.col-lg-12 -->
</div>
<div class="row">
	@include('nav.message')
</div>
<div class="row">
    <div class="col-lg-12">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"> <i class="fa fa-plus" aria-hidden="true"></i> Add New</button>
    </div>
</div>
<div class="row table-responsive">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
           All Users
        </div>
        <div class="panel-body">
       <table with="100%" id="example" class="table table-striped table-responsive table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
        				<th>Email</th>
        				<th>Phone</th>
        				<th>Position</th>
        				<th>Action</th>
              </tr>
            </thead>
    		<?php $no=1;?>
            <tbody>
    			@foreach($users as $user)
    		            <tr>
    						        <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                          {{$no++}}
                        </td>
    		                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                          {{$user->nameDisplay}}
                        </td>
    		                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                          {{$user->email}}
                        </td>
    						        <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                          {{$user->contactNum}}
                        </td>
    		                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                          {{$user->position->name}}
                        </td>
    						<td style="text-align: center;">
    							<a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
    							<form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
    		    					<input type="hidden" name="_method" value="DELETE">
    		              			<input type="hidden" name="_token" value="{{ csrf_token() }}">
    		    					<button title="Delete" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
    		    				</form>
                    <a href="{{ url('admin/resets',$user->id)}}" class="btn btn-primary btn-xs" title="Reset Password"><i class="fa fa-refresh"></i></a>
                    @if($user->is_log==0)
                    <a href="{{ url('admin/updatelogs1',$user->id)}}" class="btn btn-danger btn-xs" title="Disable"><i class="fa fa-ban fa-xs"></i></a>
                    @endif
                    @if($user->is_log==1)
                    <a href="{{ url('admin/updatelogs0',$user->id)}}" class="btn btn-success btn-xs" title="Enable"><i class="fa fa-check fa-xs"></i></a>
                    @endif
    						</td>
    		            </tr>
    			@endforeach
    			<script type="text/javascript">

		RemoveSpace();
		function RemoveSpace(){
	
        		var el = document.querySelector('.panel');
        		var doc = el.innerHTML;
        		//alert('Message : ' + doc);
        		el.innerHTML = el.innerHTML.replace(/&nbsp;/g,'');
	
			}

		</script>
            </tbody>
        </table>
    		</div>
    		</div>
    	</div>
    </div>
@stop
@section('script')
<script type="text/javascript">
 $(document).ready(function() {
         $('#example').DataTable({
            responsive: true
        });
    });
</script>
@stop
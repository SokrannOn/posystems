@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-fw fa-user"></i> Create New User</h4>
    </div>
               <!-- /.col-lg-12 -->
</div>
<div>
  @include('nav.message')
</div>
    <div class="row">
      <div class="col-lg-12">
        {!!Form::open(['action'=>'UserController@store','method'=>'POST'])!!}
          {{csrf_field()}}
          <div class="row">
          <div class="col-lg-6">
            <div class="form-group {{ $errors->has('nameDisplay') ? ' has-error' : '' }}">
              {!!Form::label('nameDisplay','Display Name:',[])!!}
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
              {!!Form::label('name','User name',[])!!}
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
              {!!Form::text('email',null,['class'=>'form-control','required'=>'true'])!!}
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
              {!!Form::text('contactNum',null,['class'=>'form-control'])!!}
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
              {!!Form::select('position_id',[null=>'---Please select position---']+$positions,null,['class'=>'form-control','required'=>'true'])!!}
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
              {!!Form::select('zone_id',[null=>'---Please select zone---']+$zones,null,['class'=>'form-control'])!!}
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
        <div class="well well-sm">
          <button type="submit" class="btn btn-success">Create</button>
          <a href="{{ url()->previous() }}" class="btn btn-info pull-right">Back</a>
        </div>  
      {!!Form::close()!!}
    </div>
  </div>
@stop

@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-fw fa-user"></i> Edit User</h4>
    </div>
               <!-- /.col-lg-12 -->
</div>
<div>
  @include('nav.message')
</div>
    <div class="row">
      <div class="col-lg-12">
        {!!Form::model($users,['action'=>['UserController@update',$users->id],'method'=>'PATCH'])!!}
          {{csrf_field()}}
          <div class="row">
          <div class="col-lg-6">
            <div class="form-group {{ $errors->has('nameDisplay') ? ' has-error' : '' }}">
              {!!Form::label('nameDisplay','Name',[])!!}
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
          <div class="col-lg-6">
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
              {!!Form::label('email','Email',[])!!}
              {!!Form::text('email',null,['class'=>'form-control','readonly'=>'readonly'])!!}
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
              {!!Form::select('position_id',[null=>'---Please select option---']+$positions,null,['class'=>'form-control','required'=>'true'])!!}
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
              {!!Form::select('zone_id',[null=>'---Please select option---']+$zones,null,['class'=>'form-control'])!!}
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
            <button type="submit" class="btn btn-success"> Update </button>
            <a href="{{ url()->previous() }}" class="btn btn-info pull-right"> Back</a>
          </div> 
        {!!Form::close()!!}
      </div>
    </div>
@stop

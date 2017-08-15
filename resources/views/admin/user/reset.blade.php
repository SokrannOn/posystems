@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-fw fa-gear"></i> Reset Password</h4>
    </div>
               <!-- /.col-lg-12 -->
</div>
<div>
  @include('nav.message')
</div>
    <div class="row">
      <div class="col-lg-12">
        {!!Form::model($users,['action'=>['UserController@updatepw',$users->id],'method'=>'PATCH'])!!}
          {{csrf_field()}}
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group {{ $errors->has('nameDisplay') ? ' has-error' : '' }}">
                {!!Form::label('nameDisplay','Name',[])!!}
                {!!Form::text('nameDisplay',null,['class'=>'form-control','readonly'=>'readonly'])!!}
                @if ($errors->has('nameDisplay'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nameDisplay') }}</strong>
                    </span>
                @endif
              </div>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
              {!!Form::label('password','New Password',[])!!}
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
          <div class="well well-sm">
            <button type="submit" class="btn btn-success"> Change </button>
            <a href="{{ url()->previous() }}" class="btn btn-info pull-right"> Back</a>
          </div> 
        {!!Form::close()!!}
      </div>
    </div>
@stop

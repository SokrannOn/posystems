@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-fw fa-briefcase"></i></i> Edit Brand</h4>
    </div>
               <!-- /.col-lg-12 -->
</div>
<div>
  @include('nav.message')
</div>
    <div class="row">
      <div class="col-lg-12">
        {!!Form::model($brands,['action'=>['BrandController@update',$brands->id],'method'=>'PATCH'])!!}
          {{csrf_field()}}
          <div class="row">
            <div class="col-lg-6">
                <div class="form-group {{ $errors->has('brandCode') ? ' has-error' : '' }}">
                  {!!Form::label('brandCode','Brand Code : ',[])!!}
                  {!!Form::text('brandCode',null,['class'=>'form-control','required'=>'true'])!!}
                  @if ($errors->has('brandCode'))
                      <span class="help-block">
                          <strong>{{ $errors->first('brandCode') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="col-lg-6">
                   <div class="form-group {{ $errors->has('brandName') ? ' has-error' : '' }}">
                  {!!Form::label('brandName','Brand Name : ',[])!!}
                  {!!Form::text('brandName',null,['class'=>'form-control'])!!}
                  @if ($errors->has('brandName'))
                      <span class="help-block">
                          <strong>{{ $errors->first('brandName') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                   <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                  {!!Form::label('description','Display Name : ',[])!!}
                  {!!Form::text('description',null,['class'=>'form-control'])!!}
                  @if ($errors->has('description'))
                      <span class="help-block">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
            </div>
          <div class="well well-sm">
            <button type="submit" class="btn btn-success"> Update </button>
            <a href="{{ url()->previous() }}" class="btn btn-info pull-right">Back</a>
          </div>
          
        {!!Form::close()!!}
      </div>
    </div>
@stop

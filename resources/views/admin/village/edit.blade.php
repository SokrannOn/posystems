@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-fw fa-home"></i> Edit Villages </h4>
    </div>
               <!-- /.col-lg-12 -->
</div>
<div>
  @include('nav.message')
</div>
    <div class="row">
      <div class="col-lg-12">
        {!!Form::model($village,['action'=>['VillageController@update',$village->id],'method'=>'PATCH'])!!}
          {{csrf_field()}}
            <div class="row">
              <div class="col-lg-6">
                   <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        {!!Form::label('name','Village Name : ',[])!!}
                        {!!Form::text('name',null,['class'=>'form-control','required'=>'true'])!!}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>
              <div class="col-lg-6">
                   <div class="form-group {{ $errors->has('commune_id') ? ' has-error' : '' }}">
                    {!!Form::label('commune_id','Commune Name :',[])!!}
                    {!!Form::select('commune_id',[null=>'---Please select a commune---']+$communes,null,['class'=>'form-control','required'=>'true'])!!}
                    @if ($errors->has('commune_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('commune_id') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
            </div>
          <div class="well well-sm">
            <button type="submit" class="btn btn-success"> Update </button>
            <a href="{{ url()->previous() }}" class="btn btn-info pull-right"> Back </a>
          </div>
          
        {!!Form::close()!!}
      </div>
    </div>
@stop

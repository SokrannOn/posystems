@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-money" aria-hidden="true"></i> Edit Price List </h4>
    </div>
               <!-- /.col-lg-12 -->
</div>
<div>
  @include('nav.message')
</div>
    <div class="row">
      <div class="col-lg-12">
        {!!Form::model($pricelist,['action'=>['PriceListController@update',$pricelist->id],'method'=>'PATCH'])!!}
          {{csrf_field()}}
             <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
                                {!!Form::label('product_id','Product Name',[])!!}
                                {!!Form::select('product_id',[null=>'---Please select product---']+$products,null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('product_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('fobprice') ? ' has-error' : '' }}">
                                {!!Form::label('fobprice','FOB Price : ',[])!!}
                                {!!Form::text('fobprice',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('fobprice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fobprice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('margin') ? ' has-error' : '' }}">
                                {!!Form::label('margin',' Margin : ',[])!!}
                                {!!Form::text('margin',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('margin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('margin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('landingprice') ? ' has-error' : '' }}">
                                {!!Form::label('landingprice',' Landing Price : ',[])!!}
                                {!!Form::text('landingprice',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('landingprice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landingprice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('sellingprice') ? ' has-error' : '' }}">
                                {!!Form::label('sellingprice',' Selling Price : ',[])!!}
                                {!!Form::text('sellingprice',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('sellingprice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sellingprice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                    <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('startdate') ? ' has-error' : '' }}">
                                {!!Form::label('startdate',' Begin Date : ',[])!!}
                                {!!Form::date('startdate',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('startdate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('startdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('enddate') ? ' has-error' : '' }}">
                                {!!Form::label('enddate',' End Date : ',[])!!}
                                {!!Form::date('enddate',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('enddate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('enddate') }}</strong>
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

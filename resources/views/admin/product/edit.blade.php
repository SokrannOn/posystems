@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-product-hunt" aria-hidden="true"></i> Edit Product </h4>
    </div>
               <!-- /.col-lg-12 -->
</div>
<div>
  @include('nav.message')
</div>
    <div class="row">
      <div class="col-lg-12">
        {!!Form::model($product,['action'=>['ProductController@update',$product->id],'method'=>'PATCH'])!!}
          {{csrf_field()}}
            <div class="row">
              <div class="col-lg-6">
                   <div class="form-group {{ $errors->has('product_code') ? ' has-error' : '' }}">
                        {!!Form::label('product_code','Product Code : ',[])!!}
                        {!!Form::text('product_code',null,['class'=>'form-control','required'=>'true'])!!}
                        @if ($errors->has('product_code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('product_code') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>
              <div class="col-lg-6">
                   <div class="form-group {{ $errors->has('product_barcode') ? ' has-error' : '' }}">
                    {!!Form::label('product_barcode','Product Barcode : ',[])!!}
                        {!!Form::text('product_barcode',null,['class'=>'form-control','required'=>'true'])!!}
                    @if ($errors->has('product_barcode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('product_barcode') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                   <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        {!!Form::label('name',' Product Name : ',[])!!}
                        {!!Form::text('name',null,['class'=>'form-control','required'=>'true'])!!}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>
              <div class="col-lg-6">
                   <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                    {!!Form::label('description','Description : ',[])!!}
                        {!!Form::text('description',null,['class'=>'form-control'])!!}
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                   <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                    {!!Form::label('category_id','Category Name :',[])!!}
                    {!!Form::select('category_id',[null=>'---Please select a category---']+$categories,null,['class'=>'form-control','required'=>'true'])!!}
                    @if ($errors->has('category_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category_id') }}</strong>
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

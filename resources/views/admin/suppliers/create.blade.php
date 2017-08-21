@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-building-o" aria-hidden="true"></i> Create New Suppliers </h4>
    </div>
               <!-- /.col-lg-12 -->
</div>
<div>
  @include('nav.message')
</div>
    <div class="row">
      <div class="col-lg-12">
        {!!Form::open(['action'=>'SupplierController@store','method'=>'POST'])!!}
          {{csrf_field()}}
              <div class="row">
                <div class="col-lg-12">
                   <div class="form-group {{ $errors->has('companyname') ? ' has-error' : '' }}">
                        {!!Form::label('companyname','Company Name : ',[])!!}
                        {!!Form::text('companyname',null,['class'=>'form-control','required'=>'true','placeholder'=> 'Company Name...'])!!}
                        @if ($errors->has('companyname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('companyname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                   <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                        {!!Form::label('address','Address : ',[])!!}
                        {!!Form::text('address',null,['class'=>'form-control','required'=>'true','placeholder'=> 'Address...'])!!}
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                   <div class="form-group {{ $errors->has('personname') ? ' has-error' : '' }}">
                        {!!Form::label('personname','Name : ',[])!!}
                        {!!Form::text('personname',null,['class'=>'form-control','required'=>'true','placeholder'=> 'Person Name...'])!!}
                        @if ($errors->has('personname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('personname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                   <div class="form-group {{ $errors->has('contactperson') ? ' has-error' : '' }}">
                        {!!Form::label('contactperson','Contact Number : ',[])!!}
                        {!!Form::text('contactperson',null,['class'=>'form-control','placeholder'=> 'Contact Person...'])!!}
                        @if ($errors->has('contactperson'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contactperson') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                   <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        {!!Form::label('email','Email : ',[])!!}
                        {!!Form::text('email',null,['class'=>'form-control','placeholder'=> 'Email...'])!!}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>
          <div class="well well-sm">
            <button type="submit" class="btn btn-success"> Create </button>
            <a href="{{ url()->previous() }}" class="btn btn-info pull-right"> Back </a>
          </div>
          
        {!!Form::close()!!}
      </div>
    </div>
@stop

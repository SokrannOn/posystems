@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-user" aria-hidden="true"></i> Edit Customer</h4>
    </div>
               <!-- /.col-lg-12 -->
</div>
<div>
  @include('nav.message')
</div>
    <div class="row">
      <div class="col-lg-12">
        {!!Form::model($customer,['action'=>['customerController@update',$customer->id],'method'=>'PATCH'])!!}
          {{csrf_field()}}
          <div class="row">
              <div class="col-lg-3">
                   <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        {!!Form::label('name','Customer Name : ',[])!!}
                        {!!Form::text('name',null,['class'=>'form-control','required'=>'true'])!!}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>
              <div class="col-lg-3">
                   <div class="form-group {{ $errors->has('contactNo') ? ' has-error' : '' }}">
                        {!!Form::label('contactNo','Contact No : ',[])!!}
                        {!!Form::number('contactNo',null,['class'=>'form-control','required'=>'true'])!!}
                        @if ($errors->has('contactNo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contactNo') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-3">
                   <div class="form-group {{ $errors->has('province_id') ? ' has-error' : '' }}">
                    {!!Form::label('province_id','Province Name :',[])!!}
                    {!!Form::select('province_id',[null=>'---Please select option---']+$provinces,null,['class'=>'form-control province_id','required'=>'true'])!!}
                    @if ($errors->has('province_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('province_id') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="col-lg-3">
                   <div class="form-group {{ $errors->has('district_id') ? ' has-error' : '' }}">
                    {!!Form::label('district_id','District Name :',[])!!}
                    {!!Form::select('district_id',[null=>'---Please select option---']+$districts,null,['class'=>'form-control district_id','required'=>'true','id'=>'dis_id'])!!}
                    @if ($errors->has('district_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('district_id') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="col-lg-3">
                   <div class="form-group {{ $errors->has('commune_id') ? ' has-error' : '' }}">
                    {!!Form::label('commune_id','Commune Name :',[])!!}
                    {!!Form::select('commune_id',[null=>'---Please select option---']+$communes,null,['class'=>'form-control commune_id','required'=>'true','id'=>'com_id'])!!}
                    @if ($errors->has('commune_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('commune_id') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="col-lg-3">
                   <div class="form-group {{ $errors->has('village_id') ? ' has-error' : '' }}">
                    {!!Form::label('village_id','Village Name :',[])!!}
                    {!!Form::select('village_id',[null=>'---Please select option---']+$villages,null,['class'=>'form-control','required'=>'true','id'=>'vil_id'])!!}
                    @if ($errors->has('village_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('village_id') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-3">
                   <div class="form-group {{ $errors->has('homeNo') ? ' has-error' : '' }}">
                        {!!Form::label('homeNo','Home No : ',[])!!}
                        {!!Form::text('homeNo',null,['class'=>'form-control','required'=>'true'])!!}
                        @if ($errors->has('homeNo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('homeNo') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>
              <div class="col-lg-3">
                   <div class="form-group {{ $errors->has('streetNo') ? ' has-error' : '' }}">
                    {!!Form::label('streetNo','Street No : ',[])!!}
                    {!!Form::text('streetNo',null,['class'=>'form-control','required'=>'true'])!!}
                    @if ($errors->has('streetNo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('streetNo') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
              <div class="col-lg-3">
                   <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                        {!!Form::label('location','Location : ',[])!!}
                        {!!Form::text('location',null,['class'=>'form-control'])!!}
                        @if ($errors->has('location'))
                            <span class="help-block">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>
              <div class="col-lg-3">
                   <div class="form-group {{ $errors->has('channel_id') ? ' has-error' : '' }}">
                        {!!Form::label('channel_id','Channel Name :',[])!!}
                        {!!Form::select('channel_id',[null=>'---Please select a channel name---']+$channels,null,['class'=>'form-control','required'=>'true'])!!}
                        @if ($errors->has('channel_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('channel_id') }}</strong>
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
@section('script')
<script type="text/javascript">
$(document).ready(function() {
  $('.province_id').on('change',function(e){
     var f =document.getElementById("dis_id");
     var province = $(this).val();
     var url = "/getProvince/";
     console.log(province);
     getValueCombo(province,url,f);
  });
   $('.district_id').on('change',function(e){
     var f =document.getElementById("com_id");
     var district = $(this).val();
     var url = "/getDistrict/";
     console.log(district);
     getValueCombo(district,url,f);
  });
   $('.commune_id').on('change',function(e){
     var f =document.getElementById("vil_id");
     var commune = $(this).val();
     var url = "/getCommune/";
     console.log(commune);
     getValueCombo(commune,url,f);
  });
});
</script>
@stop
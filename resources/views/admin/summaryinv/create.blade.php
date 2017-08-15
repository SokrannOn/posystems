@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-lg-12">                
    <h4 class="page-header"> <i class="fa fa-list-alt" aria-hidden="true"></i>  Create Summary Invoice</h4>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    {!!Form::open(['method'=>'POST','action'=>'CraditPOController@store'])!!}
     {{csrf_field()}}
          <div class="row">
              <div class="col-lg-4">
                   <div class="form-group {{ $errors->has('smiDate') ? ' has-error' : '' }}">
                        {!!Form::label('smiDate','Summary Invoice Date:',[])!!}
                        {!!Form::text('smiDate',Carbon\Carbon::parse(\Carbon\Carbon::now())->format('d-M-Y'),['class'=>'form-control','required'=>'true','readonly'=>'readonly'])!!}
                        @if ($errors->has('smiDate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('smiDate') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>
              <div class="col-lg-4">
                   <div class="form-group {{ $errors->has('rate') ? ' has-error' : '' }}">
                        {!!Form::label('rate','Exchage Rate: ',[])!!}
                        {!!Form::number('rate',null,['class'=>'form-control','required'=>'true','placeholder'=>'Exchage Rate...'])!!}
                        @if ($errors->has('rate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('rate') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>
              <div class="col-lg-4">
                   <div class="form-group {{ $errors->has('customer_id') ? ' has-error' : '' }}">
                        {!!Form::label('customer_id','Customer Name: ',[])!!}
                        <select id="cus" class="form-control" name="customer_id">
                        <option value="0">Please select customer name</option>
                          @foreach($po as $cus)
                            <option value="{{$cus->customer->id}}">{{$cus->customer->name}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('customer_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('customer_id') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-12">
                   <div class="form-group {{ $errors->has('purchaseorder_id[]') ? ' has-error' : '' }}">
                        {!!Form::label('purchaseorder_id[]','Select Invoice:',[])!!}
                        {!!Form::select('purchaseorder_id[]',[''=>''],null,['class'=>'form-control select2','required'=>'true','multiple'=>'multiple','id'=>'po'])!!}
                        @if ($errors->has('purchaseorder_id[]'))
                            <span class="help-block">
                                <strong>{{ $errors->first('purchaseorder_id[]') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="well well-sm">
                <a href="{{route('invoicePO.index')}}" class="btn btn-primary pull-right">Back</a>
                {!!Form::submit('Save',['class'=>'btn btn-primary'])!!}
              </div>
            </div>
          </div>
    {!!Form::close()!!}
  </div>
</div>
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
                $('.customerid').select2();
                $(".select2").select2();
      $("#cus").on('change',function(e) {
        var cusid = $(this).val();
        getPO(cusid);
      })
      function getPO(id) {
        $.ajax({
          type:'Get',
          url:"{{url('/getPO/')}}"+"/"+id,
          success:function(data){
            var option = '<option value=""></option>'
            $("#po").empty();
            $("#po").append(option);
            data.map(function(item){
              var poDate = formatDate(new Date(item.poDate));
              var mynumber = item.id;
              var test = ("000000" + mynumber).slice(-6);
              console.log(test);
              option = '<option value="'+item.id+'"> CAM-IN-'+test+'  |  '+poDate+'</option>';
              $("#po").append(option);
            });
          },
          error:function(er){

          },
        });
      }
      function formatDate(date) {
        var monthNames = [
          "January", "February", "March",
          "April", "May", "June", "July",
          "August", "September", "October",
          "November", "December"
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();

        return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }
    } );
</script>
@stop
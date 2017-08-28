@extends('layouts.admin')
@section('content')
    <div>
        @include('nav.message')
    </div>
    <div class="container-fluid">
        <br><br>
        <div class="panel panel-default">
            {{--Create Users--}}
            <div class="panel-heading">Export</div>
            <div class="panel panel-body">
                <div class="container-fluid">
                    <div class="row">
                        {!!Form::open(['action'=>'StockoutController@store','method'=>'post'])!!}
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {!! Form::label('stockoutdate','Stock Out Date') !!}
                                    {!! Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('InvoiceDate','Invoice Date') !!}
                                    {!! Form::date('invoiceDate',null,['class'=>'form-control','id'=>'invoiceDate','readOnly'=>true]) !!}
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('chanel','Chanel') !!}
                                    {!! Form::text('chanel',null,['class'=>'form-control','id'=>'chanel','readOnly'=>true]) !!}
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('customerName','Customer Name') !!}
                                    {!! Form::text('customerName',null,['class'=>'form-control','id'=>'customerName','readOnly'=>true]) !!}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('location','Location') !!}
                                    {!! Form::text('location',null,['class'=>'form-control','id'=>'province','readOnly'=>true]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {!! Form::label('invoiceN','Invoice Number ') !!}
                                        <select name="invoiceN" id="invoiceN" class="form-control" onchange="InvNChange()">
                                            <option value="0">Please select</option>
                                            @foreach($invoice as $row)
                                                <option value="{{$row['id']}}">{{"CAM-IN-" . sprintf('%06d',$row['id'])}}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {!! Form::submit('Submit',['class'=>'btn btn-primary btn-sm']) !!}
                                    {!! Form::button('Cancel',['class'=>'btn btn-danger btn-sm']) !!}
                                </div>
                            </div>
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript">
            function InvNChange() {
               var invN = $("#invoiceN").val();
               if(invN ==0){
                  $("#customerName").val(null);
                  $("#invoiceDate").val(null);
               }
               if(invN!=0){
                   $.ajax({
                       type : 'get',
                       url : "{{url('/stockout/change')}}"+"/"+invN,
                       dataType: 'json',
                       success:function (data) {
                           console.log(data);
                           $("#customerName").val(data['userName']);
                           $("#invoiceDate").val(data['invoiceDate']);
                       },
                       error:function (error) {
                         console.log(error);
                       }

                   });
               }

            }
    </script>

@stop

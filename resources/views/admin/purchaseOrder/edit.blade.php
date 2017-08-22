 @extends('layouts.admin')
@section('content')
{{----------------------------------}}
<div class="row">
    <div class="col-lg-12">
        {!!Form::model($pos,['action'=>['PurchaseOrderController@update',$pos->id],'method'=>'PATCH'])!!}
          {{csrf_field()}}
            <div hidden class="panel panel-footer panel-primary addOrder">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
                      {!!Form::label('product_id','Product Name',[])!!}
                      {!!Form::select('product_id',[null=>'---Please select product']+$products,null,['class'=>'form-control productId'])!!}
                        @if ($errors->has('product_id'))
                          <span class="help-block">
                              <strong>{{ $errors->first('product_id') }}</strong>
                            </span>
                          @endif
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group {{ $errors->has('product_code') ? ' has-error' : '' }}">
                        {!!Form::label('product_code','Product Code',[])!!}
                        {!!Form::text('product_code',null,['class'=>'form-control proId','readonly'=>'readonly'])!!}
                          @if ($errors->has('product_code'))
                            <span class="help-block">
                              <strong>{{ $errors->first('product_code') }}</strong>
                            </span>
                          @endif
                      </div>
                  </div>  
                  <div class="col-lg-2">
                     <div class="form-group {{ $errors->has('qty') ? ' has-error' : '' }}">
                        {!!Form::label('qty','Quantity',[])!!}
                        {!!Form::number('qty',null,['class'=>'form-control qty','readonly'=>'readonly','min'=>'0'])!!}
                          @if ($errors->has('qty'))
                            <span class="help-block">
                                <strong>{{ $errors->first('qty') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div> 
                  <div class="col-lg-2">
                    <div class="form-group {{ $errors->has('unitPrice') ? ' has-error' : '' }}">
                        {!!Form::label('unitPrice','Unit Price',[])!!}
                        {!!Form::text('unitPrice',0,['class'=>'form-control price','readonly'=>'readonly'])!!}
                          @if ($errors->has('unitPrice'))
                            <span class="help-block">
                              <strong>{{ $errors->first('unitPrice') }}</strong>
                            </span>
                          @endif
                    </div>
                  </div> 
                  <div class="col-lg-2">
                    <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                       {!!Form::label('amount','Amount',[])!!}
                       {!!Form::text('amount',0,['class'=>'form-control amount','readonly'=>'readonly'])!!}
                          @if ($errors->has('amount'))
                            <span class="help-block">
                              <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                          @endif
                    </div>
                  </div> 
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <a disabled class="btn btn-primary btn-sm add" onclick="addOderCus()" ><i class="fa fa-cart-plus" aria-hidden="true"></i> Add</a>
                     <button type="submit" name="btn_back" value="Back" class="btn btn-default pull-right btn-sm"> Back </button>
                  </div>
                </div>
              </div>
{{-----------------------------------}}
{{----------------------------------------------}}
<div class="row">
    <div class="col-lg-3 columnhide">
        <div class="form-group {{ $errors->has('dueDate') ? ' has-error' : '' }}">
            {!!Form::label('dueDate','Due Date :',[])!!}
            {!!Form::date('dueDate',null,['class'=>'form-control'])!!}
            @if ($errors->has('dueDate'))
                <span class="help-block">
                    <strong>{{ $errors->first('dueDate') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-lg-3">
                            
    </div>
    <div class="col-lg-1 columnhide">
        {!!Form::label('cod',' ',[])!!}
        <a class="btn btn-primary btn-sm btnadd form-control" onclick="add()" > Add</a>
    </div>
    <div class="col-lg-4"> 
                            
    </div>
    <div class="col-lg-1 showCheckbox">
    <div class="form-group {{ $errors->has('cod') ? ' has-error' : '' }}">
        {!!Form::label('cod','COD',[])!!}
        {!!Form::checkbox('cod',1,false,['class'=>'form-control cod'])!!}
        @if ($errors->has('cod'))
            <span class="help-block">
                <strong>{{ $errors->first('cod') }}</strong>
            </span>
        @endif
    </div>
</div>
</div>
{{----------------------------------------------}}
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default table-responsive">
            <table class="table table-responsive table-bordered table-striped" cellspacing="0">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Product Name</th>
                          <th>Quantity</th>
                          <th>UnitPrice</th>
                          <th>Amount</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <?php $no=1;?>
                  <tbody>
                      @foreach($pos->products as $pro)
                      <tr id="{{$pro->id}}">
                          <td style="text-align: center;">{{$no++}}</td>
                          <td style="font-size: 11px; font-family: 'Khmer OS System';">
                            {{$pro->name}}
                          </td>
                          <td style="font-size: 11px; font-family: 'Khmer OS System';text-align: center;">
                            {{$pro->pivot->qty}}
                          </td>
                          <td style="font-size: 11px; font-family: 'Khmer OS System';text-align: center;">
                            <?php 
                                echo "$ " . number_format($pro->pivot->unitPrice,2);
                            ?>
                          </td>
                          <td width="150px" style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                            <?php 
                                echo "$ " . number_format($pro->pivot->amount,2);
                            ?>
                          </td>
                          <td width="150px" style="text-align: center;">
                            <button class="btn btn-danger fa fa-remove btn-xs poid" type="button" onclick="removeOrderCus({{$pro->id}})"></button>
                            <a href="#" class="btn btn-warning btn-xs" title="Show Details"><i class="fa fa-edit"></i></a>       
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
  </div>
</div>
@stop
@section('script')
<script type="text/javascript">
    //---------------------------
    function add(id){
        $('.addOrder').fadeIn('slow');
        $('.btnadd').fadeOut('slow');
}
$('.productId').on('change',function(e){
      var proId= $(this).val();
      $('.qty').removeAttr('readonly','readonly');
      $('.qty').val('');
      $('.qty').focus();
      $('.qty').css('border','1px solid lightblue');
      $('.amount').val(0);
      if(proId==''){
        $('.add').attr('disabled','true');
        $('.qty').attr('readonly','readonly');
        $('.proId').val(null);
        $('.price').val(0);
        $('.amount').val(0);
      }
      getProduct(proId);
  });
  //---------------------------
    function getProduct(id){
  $.ajax({
    type: 'GET',
    url:"{{url('/getProduct')}}"+"/"+id,
    success:function(response){
      $('.proId').val(response.pro_code);
      $('.price').val(response.price); 
      },
      error:function(error){
        console.log(error);
      }
  });
}
//----------------------------------
 $( ".qty" ).keyup(function() {
   var qty = $('.qty').val();
    if (qty>=0) {
      $('.add').removeAttr('disabled','true');
      $('.qty').css('border','1px solid lightblue');
    }else if(qty==null){
      $('.add').attr('disabled','true');
    }else{
      $('.add').attr('disabled','true');
      $('.qty').css('border','1px solid red');
    }
    var price = $('.price').val();
    var total = qty * price;
    var amount = total.toFixed(2);
    $('.amount').val(amount);
});
 //-----------------------------------
</script>
@stop
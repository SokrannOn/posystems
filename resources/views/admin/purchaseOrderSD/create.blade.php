@extends('layouts.admin')
@section('content')
<div>
  @include('nav.message')
</div>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default panel-success">
          <div class="panel-heading"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Create New Purchase Order</div>
          <div class="panel panel-body">
            {!!Form::open(['action'=>'PurchaseOrderSDController@store','method'=>'POST','id'=>'myFormPO'])!!}
          {{csrf_field()}}
            <div class="row">
               <div class="col-lg-3">
                  <div class="form-group {{ $errors->has('poDate') ? ' has-error' : '' }}">
                    {!!Form::label('poDate','Purchase Order Date :',[])!!}
                    {!!Form::date('poDate',null,['class'=>'form-control'])!!}
                    @if ($errors->has('poDate'))
                        <span class="help-block">
                            <strong>{{ $errors->first('poDate') }}</strong>
                        </span>
                    @endif
                </div>
              </div>
              <div hidden class="col-sm-9">
                {!!Form::text('codsd',$codsd,['id'=>'codsd'])!!}
                {!!Form::text('dissd1',$dissd1,['id'=>'dissd1'])!!}
                {!!Form::text('dissd2',$dissd2,['id'=>'dissd2'])!!}
                {!!Form::text('setdissd1',$setdissd1,['id'=>'setdissd1'])!!}
                {!!Form::text('setdissd2',$setdissd2,['id'=>'setdissd2'])!!}
                {!!Form::text('vat',$vat,['id'=>'vatsd'])!!}
              </div>
            </div>
            {{--------------------------------}}
            <div class="panel panel-footer panel-primary">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
                      {!!Form::label('product_id','Product Name',[])!!}
                      {!!Form::select('product_id',[null=>'---Please select product']+$product_name,null,['class'=>'form-control productId'])!!}
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
                    <a disabled class="btn btn-primary btn-sm add" onclick="addOderSD()" ><i class="fa fa-cart-plus" aria-hidden="true"></i> Add</a>
                     <button type="submit" name="btn_back" value="Back" class="btn btn-default pull-right btn-sm"> Back </button>
                  </div>
                </div>
              </div>
            {{--------------------------------}}
            
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default table-responsive" id="MyProList">
           <!--  table -->
            </div>
          </div>
        </div>
      <div id="showto" hidden>
        <div class="row">
          <dir class="col-lg-8">
            
          </dir>
          <div class="col-md-2">
            {!!Form::label('total','Total :',[])!!}
          </div>
          <div class="col-lg-2">
            {!!Form::number('total',0,['class'=>'form-control totalsd','readonly'=>'readonly'])!!}
          </div>
        </div>
        <div class="row" id="discountsd" hidden>
          <dir class="col-lg-8">
            
          </dir>
          <div class="col-lg-2">
            {!!Form::label('discount','Discount% :',[])!!}
          </div>
          <div class="col-lg-2">
            {!!Form::number('discount',null,['class'=>'form-control discountsd','readonly'=>'readonly'])!!}
          </div>
        </div>
        <div class="row cod">
          <dir class="col-lg-8">
            
          </dir>
          <div class="col-lg-2">
            {!!Form::label('cod','COD% :',[])!!}
          </div>
          <div class="col-lg-2">
            {!!Form::number('cod',0,['class'=>'form-control codsd','readonly'=>'readonly'])!!}
          </div>
        </div>
        <div class="row" id="vat" hidden>
          <dir class="col-lg-8">
            
          </dir>
          <div class="col-lg-2">
            {!!Form::label('vat','VAT% :',[])!!}
          </div>
          <div class="col-lg-2">
            {!!Form::number('vat',0,['class'=>'form-control vat','readonly'=>'readonly'])!!}
          </div>
        </div>
        <div class="row">
          <dir class="col-lg-8">
            
          </dir>
          <div class="col-lg-2">
            {!!Form::label('grandTotal','Grand Total :',[])!!}
          </div>
          <div class="col-lg-2">
              {!!Form::text('grandTotal',0,['class'=>'form-control grandTotalsd','readonly'=>'readonly'])!!}
          </div>
        </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="well-sm">
                <button type="submit" disabled="true" name="btn_save" value="Save" class="btn btn-success btn-sm" id="btn_hide"><i class="icon-save"></i> Save </button>
                <button disabled="true" type="submit" name="btn_cancel" value="Cancel" class="btn btn-danger btn-sm btn_hide"> Cancel </button>
              </div>
            </div>
          </div>
        </div>
      </div>
        {!!Form::hidden('discount',null,['id'=>'dis'])!!}
        {!!Form::hidden('grandTotal',null,['id'=>'gtotal'])!!}
        {!!Form::close()!!}
          </div>
        </div>
    </div>
  </div>
@stop
@section('script')
<script type="text/javascript">
  $('.productId').on('change',function(e){
      var proId= $(this).val();
      $('.qty').removeAttr('readonly','readonly');
      $('.qty').val('');
      $('.qty').focus();
      $('.amount').val(0);
      if(proId==''){
        $('.add').attr('disabled','true');
        $('.qty').val('');
        $('.qty').attr('readonly','readonly');
        $('.proId').val(null);
        $('.price').val(0);
        $('.amount').val(0);
      }
      getProduct(proId);
  });
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
function addOderSD(){
  var proid =$(".productId").val();
  var qty = $(".qty").val();
  var price =$(".price").val();
  var amount = $(".amount").val();
  //console.log([scores,studentid]);
  $.ajax({
    type:'get',
    url:"{{url('/addOrderSD')}}"+"/"+proid+"/"+qty+"/"+price+"/"+amount,
    success:function(data){
       $('.add').attr('disabled','true');
      $(".productId").val('');
      $('.proId').val(null);
      $('.qty').val(null)
      $('.qty').attr('readonly','readonly');
      $(".price").val(0);
      $(".amount").val(0);
      $('#btn_hide').removeAttr('disabled','true');
      $('.btn_hide').removeAttr('disabled','true');
      $('.cod').fadeIn('slow');
      showProductSD()
      getTotalSD();
    },
    error:function(error){
      console.log(error)
    },
  });
}
//----------------------------------------
function getTotalSD() {
$.ajax({
  url:'{{url("/getTotalSD")}}',
  type:'get',
  success:function(data){ 
  var grandTotalsd =0;
  var totalsd = 0;
  var vatsd = 0;
  totalsd = data;
  var total = data.toFixed(2);
  $('.totalsd').val(total);
  $('#showto').fadeIn('slow');
  var setdissd1 = $('#setdissd1').val();
  var setdissd2 = $('#setdissd2').val();
  var codsd = $('#codsd').val();
  if(totalsd < setdissd1){
    $('#discountsd').fadeOut('slow');
    var codsd = $('#codsd').val();
    $('.codsd').val(codsd);
    vat = $('#vatsd').val();
    if(vat>0){
      $('.vatsd').val(vat);
    }else{
      $('.vatsd').val(0);
    }
    totalVat = totalsd * vat/100;
    grandTotal = totalsd - (totalsd * codsd)/100;
    graTotalsd = grandTotal + totalVat;
    grandTotalsd = graTotalsd.toFixed(2);
    $('.grandTotalsd').val(grandTotalsd);       
  }
  else if(totalsd >= setdissd2){
    var dissd2 = $('#dissd2').val();
    $('#discountsd').fadeIn('slow');
    $('.discountsd').val(dissd2);
    var codsd = $('#codsd').val();
    $('.codsd').val(codsd);
    vat = $('#vatsd').val();
    if(vat>0){
      $('.vatsd').val(vat);
    }else{
      $('.vatsd').val(0);
    }
    totalVat = totalsd * vat/100;
    grandTo = totalsd - (totalsd * dissd2)/100;
    grandTotal = grandTo - (grandTo * codsd)/100;
    graTotalsd = grandTotal + totalVat;
    grandTotalsd = graTotalsd.toFixed(2);
    $('.grandTotalsd').val(grandTotalsd);
  }else{
    var dissd1 = $('#dissd1').val();
    $('#discountsd').fadeIn('slow');
    $('.discountsd').val(dissd1);
    var codsd = $('#codsd').val();
    $('.codsd').val(codsd);
    vat = $('#vatsd').val();
    if(vat>0){
      $('.vatsd').val(vat);
    }else{
      $('.vatsd').val(0);
    }
    totalVat = totalsd * vat/100;
    grandTo = totalsd - (totalsd * dissd1)/100;
    grandTotal = grandTo - (grandTo * codsd)/100;
    graTotalsd = grandTotal + totalVat;
    grandTotalsd = graTotalsd.toFixed(2);
    $('.grandTotalsd').val(grandTotalsd);
  }
  $("#myFormPO").submit(function(){
    var dis = $('.discountsd').val();
    var grandTotal = $(".grandTotalsd").val();
    $('#dis').val(dis);
    $('#gtotal').val(grandTotal);
  });

  $(".discount").keyup(function(e){
      var total = 0;
      var dis = 0;
  total = $('#total').val();
  dis = $(this).val();
  var grandTotal = total - (total * dis)/100;
  $('.grandTotal').val(grandTotal);
  console.log(grandTotal);
//   });
  });
  },
  //end sucess
  error:function(e){
    console.log(e);
  },
});

  }
  //-------------------------
    function showProductSD(){
    $.ajax({
  url:"{{url('/showProductSD')}}",
  type: 'get',
  dataType: 'html',
  success:function(data){
    $('#MyProList').html(data);
  },
  error:function(e){
    console.log(e);
  },
});
  }
 //----------------------------------------------------------------
 function removeOrderSD(id){
      console.log(id);
  $.ajax({
    method: 'GET',
    url:"{{url('/removeOrderSD')}}"+"/"+id,
    success:function(data){
      var count = $('table tr').length;
      if(count==2){
      $('#btn_hide').attr('disabled','true');
      $('.btn_hide').attr('disabled','true');
      $('.cod').hide(100);
     }
      $(".table tr#"+data).remove();
      $('.cod').attr('checked',false);
      $('.discountcus').val(0);
      getTotalSD(); 
      
    },
    error:function(error){
      console.log(error)
    },
  });
}
 
 //--------------------------------------------------------------
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
// $('.discount').on('change',function(e){
//         var dis = $(this).val();
//         var total = $('.total').val();
//         var grandTotal = total - (total * dis)/100;
//         $('.grandTotal').val(grandTotal);
//   });

</script>
@stop
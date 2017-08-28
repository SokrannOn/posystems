 @extends('layouts.admin')
@section('content')
{{--Modal view import detail--}}
      <!-- Modal -->
    <div class="modal fade" id="myPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    </div>

{{--End model view import detail--}}
{{----------------------------------}}
<div class="row">
    <div class="col-lg-12">
          {{----------------------------------------------}}
          {!!Form::model($pos,['action'=>['PurchaseOrderController@update',$pos->id],'method'=>'PATCH'])!!}
          {{csrf_field()}}
              <div class="row">
                  <div class="col-lg-1 btnback">
                      {!!Form::label('',' ',[])!!}
                      <button type="submit" name="btn_back" value="Back" class="btn btn-danger btn-md"> Back </button>
                  </div>
                  <div class="col-lg-4">
                                          
                  </div>
                  <div class="col-lg-2 hi">
                                          
                  </div>
                  <div hidden class="col-lg-2 addOrder">
                      {!!Form::label('',' ',[])!!}
                      <a onclick="addOrder()" class="btn btn-primary btn-sm"> AddOrder </a>         
                  </div>
                  <div class="col-lg-4">
                                          
                  </div>
                  <div class="col-lg-1">
                      {!!Form::label('',' ',[])!!}
                       <button type="submit" name="btn_done" value="Back" class="btn btn-success btn-md"> Done </button>
                  </div>
              </div>
              {{----------------------------------------------}}
            <div class="panel panel-footer panel-primary add" style="margin-top: 10px;">
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
                        {!!Form::number('qty',null,['class'=>'form-control qty','readonly'=>'readonly','min'=>'0','autocomplete'=>'off'])!!}
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
                {!!Form::hidden('poid',$pos->id,['class'=>'form-control '])!!}
                <div class="row">
                  <div class="col-lg-12">
                    <button disabled type="submit" name="btn_add" onclick="add()" value="Add" class="btn btn-primary btn-sm add"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add </button>
                     <a onclick="back()" value="Back" class="btn btn-default pull-right btn-sm"> Close </a>
                  </div>
                </div>
              </div>
            {!!Form::close()!!}
{{-----------------------------------}}
<input type="hidden" name="poid" class="poid" id="poid" value="{{$pos->id}}">
<div class="row" style="margin-top: 10px;">
    <div class="col-lg-12">
        <div class="panel panel-default">
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
                      @foreach($potmps as $potmp)
                      <tr id="{{$potmp->id}}">
                          <td style="text-align: center;">{{$no++}}</td>
                          <td style="font-size: 11px; font-family: 'Khmer OS System';">
                            {{$potmp->product->name}}
                          </td>
                          <td style="font-size: 11px; font-family: 'Khmer OS System';text-align: center;">
                            {{$potmp->qty}}
                          </td>
                          <td style="font-size: 11px; font-family: 'Khmer OS System';text-align: center;">
                            <?php 
                                echo "$ " . number_format($potmp->unitPrice,2);
                            ?>
                          </td>
                          <td width="150px" style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                            <?php 
                                echo "$ " . number_format($potmp->amount,2);
                            ?>
                          </td>
                          <td width="150px" style="text-align: center;"> 
                            <a href="#" onclick="getPopupEditProduct({{$potmp->product->id}})" id="{{$pos->id}}"><i class="btn-warning btn-xs fa fa-edit" data-toggle="modal" data-target="#myPopup"></i></a>
                             {!!Form::open(['action'=>'PurchaseOrderController@deletePro','method'=>'POST','style'=>'display:inline'])!!}
                              {{csrf_field()}}
                                {!!Form::hidden('poid',$pos->id,['class'=>'form-control '])!!}
                                {!!Form::hidden('proid',$potmp->product->id,['class'=>'form-control '])!!}
                                <button title="Delete" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                             {!!Form::close()!!}
                          </td>
                      </tr>
                      @endforeach
                      <script type="text/javascript">

    RemoveSpace();
    function RemoveSpace(){
  
            var el = document.querySelector('.panel-default');
            var doc = el.innerHTML;
            //alert('Message : ' + doc);
            el.innerHTML = el.innerHTML.replace(/&nbsp;/g,'');
  
      }

    </script>
                  </tbody>
              </table>
            </div>
        </div>
    </div>
  </div>
</div>
@stop
@section('script')
<script type="text/javascript">


function getPopupEditProduct(proid){
        var poid = $('#poid').val();
        $.ajax({
            type:'get',
            url:"{{url('/getPopupEditProduct/')}}"+"/"+poid+"/"+proid,
            dataType:'html',
            success:function(data){
                $("#myPopup").html(data);
            },
            error:function(e){

            }
        });
    }
    //-----------------------
      function back(){
        $('.add').fadeOut('slow');
        $('.addOrder').fadeIn('slow');
        $('.hi').hide();
}
    //---------------------------
    function addOrder(){
        $('.addOrder').hide();
        $('.add').fadeIn('slow');
        $('.hi').show();
}
$('.productId').on('change',function(e){
      var proId= $(this).val();
      $('.proid').val(proId);
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
//  //-----------------------------------
$(window).load(function(){
       $('.productId').val(null);
       $('.proId').val('');
       $('.qty').val('');
       $('.price').val(0);
       $('.amount').val(0);
    });
//  //-------------------------
</script>
@stop
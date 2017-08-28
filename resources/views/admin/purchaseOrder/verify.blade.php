@extends('layouts.admin')
@section('content')
<div>
  @include('nav.message')
</div>

{{----------------------------------}}
    <div class="row">
      <div class="col-lg-12">
          <div class="panel panel-success">
            <div class="panel-heading"><i class="fa fa-check-circle" aria-hidden="true"></i> Verify Purchase Order</div>
              <div class="panel panel-body">
        {!!Form::open(['action'=>'TmpEditPurchaseorderController@store','method'=>'POST'])!!}
          {{csrf_field()}}
              <div class="row">
                <div class="col-lg-12">
                   <div class="form-group {{ $errors->has('purchaseorder_id') ? ' has-error' : '' }}">
                        <select class="form-control" name="purchaseorder_id" id="poid" onchange="getPopupTmpPo()">
                        <option value="0">Please Select Purchaseorder Number</option>
                          @foreach($pos as $po)
                            <option value="{{$po->purchaseorder_id}}">{{$po->purchaseorder_id}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('purchaseorder_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('purchaseorder_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </div>
              <div id="Popup">
                  <!-- table -->
              </div>
              <div hidden class="verify">
                <button hidden type="submit" class="btn btn-success"> Verify </button>
              </div>
        {!!Form::close()!!}
      </div>
    </div>
  </div>
</div>
@stop
@section('script')
  <script type="text/javascript">
function getPopupTmpPo(){
        var id=$('#poid').val();
        $('.verify').fadeIn('slow');
        $('#Popup').fadeIn('slow');
        if(id!=0){
              $.ajax({
              type:'get',
              url:"{{url('/getPopupTmpPo/')}}"+"/"+id,
              dataType:'html',
              success:function(data){
                  $("#Popup").html(data);
              },
              error:function(e){

              }
          });
        }else{
          $('.verify').fadeOut('slow');
          $('#Popup').fadeOut('slow');
        }
    }
//----------------------------------
  </script>
@stop

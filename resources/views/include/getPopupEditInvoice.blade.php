<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #117A65; color: white;">
          <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Invoice</h3>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                {!!Form::model($isDelivery,['action'=>['StockController@update',$isDelivery->id],'method'=>'PATCH'])!!}
                {{csrf_field()}}
                <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('id') ? ' has-error' : '' }}">
                                {!!Form::label('id','Invoice Number : ',[])!!}
                                {!!Form::text('id',sprintf('CAM-IN-%06d',$isDelivery->id),['class'=>'form-control','readonly'=>'readonly'])!!}
                                @if ($errors->has('id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('isDelivery') ? ' has-error' : '' }}">
                                {!!Form::label('isDelivery','Delivery Status : ',[])!!}
                                {!!Form::select('isDelivery', ['1' => 'Export', '0' => 'No Export'],null, ['class'=>'form-control','required'=>'true','placeholder'=> '--Select Option--'])!!}
                                @if ($errors->has('isDelivery'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('isDelivery') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                <div class="modal-footer" style="background-color: #117A65;">
                    <a href="{{ route('stocks.index')}}" class="btn btn-default" > Close </a>
                    <button type="submit" class="btn btn-success"> Update </button>
               </div>
            {!!Form::close()!!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@section('script')
<script type="text/javascript">
    $('.change').on('change',function(e){
      var change= $(this).val();
      $('.get').val(change);
  });
</script>
@stop
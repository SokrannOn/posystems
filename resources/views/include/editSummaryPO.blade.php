<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #117A65; color: white;">
          <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Invoice</h3>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                {!!Form::model($details,['action'=>['CraditPOController@update',$details->id],'method'=>'PATCH'])!!}
                {{csrf_field()}}
                <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('id') ? ' has-error' : '' }}">
                                {!!Form::label('id','Invoice Number : ',[])!!}
                                {!!Form::text('id',sprintf('CAM-IN-%06d',$details->id),['class'=>'form-control','readonly'=>'readonly'])!!}
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
                           <div class="form-group {{ $errors->has('cod') ? ' has-error' : '' }}">
                                {!!Form::label('cod','Payment Type : ',[])!!}
                                {!!Form::select('cod', ['1' => 'COD', '0' => 'No COD'],null, ['class'=>'form-control change','required'=>'true','placeholder'=> '--Select Option--'])!!}
                                @if ($errors->has('cod'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cod') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('isPayment') ? ' has-error' : '' }}">
                                {!!Form::label('isPayment','Payment Status : ',[])!!}
                                {!!Form::select('isPayment', ['1' => 'PAID', '0' => 'CRADIT'],null, ['class'=>'form-control get','required'=>'true','placeholder'=> '--Select Option--'])!!}
                                @if ($errors->has('isPayment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('isPayment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                <div class="modal-footer" style="background-color: #117A65;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"> Create </button>
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
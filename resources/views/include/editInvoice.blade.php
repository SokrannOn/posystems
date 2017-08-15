<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #117A65; color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Invoice</h3>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                {!!Form::model($details,['action'=>['InvoicePOController@update',$details->id],'method'=>'PATCH'])!!}

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
                           <div class="form-group {{ $errors->has('vat') ? ' has-error' : '' }}">
                                {!!Form::label('vat','VAT : ',[])!!}
                                {!!Form::select('vat', ['1' => 'VAT', '0' => 'No VAT'],null, ['class'=>'form-control','required'=>'true','placeholder'=> '--Select Option--'])!!}
                                @if ($errors->has('vat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('rate') ? ' has-error' : '' }}">
                                {!!Form::label('rate','Exchage Rate: ',[])!!}
                                {!!Form::text('rate',null,['class'=>'form-control rate'])!!}
                                @if ($errors->has('rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('diposit') ? ' has-error' : '' }}">
                                {!!Form::label('diposit','Diposit : ',[])!!}
                                {!!Form::text('diposit',null,['class'=>'form-control diposit'])!!}
                                @if ($errors->has('diposit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('diposit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                <div class="modal-footer" style="background-color: #117A65;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"> Edit Quantity Product</h4>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-lg-12">
              {!!Form::open(['action'=>'PurchaseOrderController@updatePro','method'=>'POST'])!!}
                {{csrf_field()}}
                    <div class="row">
                      <div class="col-lg-12">
                         <div class="form-group {{ $errors->has('qty') ? ' has-error' : '' }}">
                              {!!Form::label('qty','Quantity : ',[])!!}
                              {!!Form::text('qty',$qty,['class'=>'form-control','required'=>'true','autocomplete'=>'off'])!!}
                              @if ($errors->has('qty'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('qty') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                    </div>
                    {!!Form::hidden('poid',$poid,['class'=>'form-control'])!!}
                    {!!Form::hidden('proid',$proid,['class'=>'form-control'])!!}
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"> Update </button>
                </div>  
              {!!Form::close()!!}
            </div>
          </div>
      </div>
    </div>
</div>
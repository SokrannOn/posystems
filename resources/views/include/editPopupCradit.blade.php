<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #117A65; color: white;">
          <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Invoice</h3>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                {!!Form::model($cradit,['action'=>['CraditPOController@update',$cradit->id],'method'=>'PATCH'])!!}
                {{csrf_field()}}
                <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('id') ? ' has-error' : '' }}">
                                {!!Form::label('id','Invoice Number : ',[])!!}
                                {!!Form::text('id',sprintf('CAM-IN-%06d',$cradit->id),['class'=>'form-control','readonly'=>'readonly'])!!}
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
                           <div class="form-group {{ $errors->has('cradit') ? ' has-error' : '' }}">
                                {!!Form::label('cradit','Cradit: ',[])!!}
                                {!!Form::text('cradit',null,['class'=>'form-control cradit','readonly'=>'readonly'])!!}
                                @if ($errors->has('cradit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cradit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('paids') ? ' has-error' : '' }}">
                                {!!Form::label('paids','Paid: ',[])!!}
                                {!!Form::text('paids',null,['class'=>'form-control paids'])!!}
                                @if ($errors->has('paids'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('paids') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                <div class="modal-footer" style="background-color: #117A65;">
                    <a href="{{ route('invoicePO.index')}}" class="btn btn-default" > Close </a>
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
    
</script>
@stop
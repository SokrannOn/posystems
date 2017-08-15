              
              <table class="table table-bordered" style="text-align: center;">
                        <thead>
                          <th>Product Name</th>
                          <th>Product Code</th>
                          <th>Qty</th>
                          <th>Price</th>
                          <th>Discount</th>
                          <th>Amount</th>
                          <th style="text-align: center;"><a href="#" class="addRows"><i class="glyphicon glyphicon-plus"></i></a></th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                                 <div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
                                    {!!Form::select('product_id',[null=>'Select product---']+$product_name,null,['class'=>'form-control productId','required'=>'true'])!!}
                                    @if ($errors->has('product_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product_id') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                            </td>
                            <td>
                                 <div class="form-group {{ $errors->has('product_code') ? ' has-error' : '' }}">
                                  {!!Form::text('product_code',null,['class'=>'form-control proId','readonly'=>'readonly'])!!}
                                  @if ($errors->has('product_code'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('product_code') }}</strong>
                                      </span>
                                  @endif
                                </div>
                            </td>
                            <td>
                                 <div class="form-group {{ $errors->has('qty') ? ' has-error' : '' }}">
                                  {!!Form::text('qty',null,['class'=>'form-control'])!!}
                                  @if ($errors->has('qty'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('qty') }}</strong>
                                      </span>
                                  @endif
                                </div>
                            </td>
                            <td>
                                 <div class="form-group {{ $errors->has('unitPrice') ? ' has-error' : '' }}">
                                  {!!Form::text('unitPrice',null,['class'=>'form-control'])!!}
                                  @if ($errors->has('unitPrice'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('unitPrice') }}</strong>
                                      </span>
                                  @endif
                                </div>
                            </td>
                            <td>
                                 <div class="form-group {{ $errors->has('discount') ? ' has-error' : '' }}">
                                  {!!Form::text('discount',null,['class'=>'form-control'])!!}
                                  @if ($errors->has('discount'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('discount') }}</strong>
                                      </span>
                                  @endif
                                </div>
                            </td>
                            <td>
                                 <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                                  {!!Form::text('amount',null,['class'=>'form-control','readonly'=>'readonly'])!!}
                                  @if ($errors->has('amount'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('amount') }}</strong>
                                      </span>
                                  @endif
                                </div>
                            </td>
                            <td>
                              <a href="#" class="btn btn-danger btn-sm remove"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
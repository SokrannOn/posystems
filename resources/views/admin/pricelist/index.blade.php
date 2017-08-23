@extends('layouts.admin')
@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #117A65; color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-money" aria-hidden="true"></i> New Price List</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                {!!Form::open(['action'=>'PriceListController@store','method'=>'POST'])!!}
                  {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
                                {!!Form::label('product_id','Product Name',[])!!}
                                {!!Form::select('product_id',[null=>'---Please select product---']+$products,null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('product_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('fobprice') ? ' has-error' : '' }}">
                                {!!Form::label('fobprice','FOB Price : ',[])!!}
                                {!!Form::text('fobprice',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('fobprice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fobprice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('margin') ? ' has-error' : '' }}">
                                {!!Form::label('margin',' Margin : ',[])!!}
                                {!!Form::text('margin',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('margin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('margin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('landingprice') ? ' has-error' : '' }}">
                                {!!Form::label('landingprice',' Landing Price : ',[])!!}
                                {!!Form::text('landingprice',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('landingprice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('landingprice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('sellingprice') ? ' has-error' : '' }}">
                                {!!Form::label('sellingprice',' Selling Price : ',[])!!}
                                {!!Form::text('sellingprice',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('sellingprice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sellingprice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                    <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('startdate') ? ' has-error' : '' }}">
                                {!!Form::label('startdate',' Begin Date : ',[])!!}
                                {!!Form::date('startdate',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('startdate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('startdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('enddate') ? ' has-error' : '' }}">
                                {!!Form::label('enddate',' End Date : ',[])!!}
                                {!!Form::date('enddate',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('enddate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('enddate') }}</strong>
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
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"> <i class="fa fa-money" aria-hidden="true"></i> Price Lists</h4>
    </div>
</div>
<div>
  @include('nav.message')
</div>
<div class="row">
    <div class="col-lg-12">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
           All Price Lists
        </div>
        <div class="panel-body">
            <table with="100%" id="example" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>FOB Price</th>
                <th>Margin</th>
                <th>Landing Price</th>
                <th>Selling Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php $no=1;?>
        <tbody>
            @foreach($pricelists as $pricelist)
            <tr>
                <td>{{$no++}}</td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$pricelist->product->name}}</td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                  <?php 
                        echo "$ " . number_format($pricelist->fobprice,2);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    <?php 
                        echo number_format($pricelist->margin,0) . " %";
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                  <?php 
                        echo "$ " . number_format($pricelist->landingprice,2);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                  <?php 
                        echo "$ " . number_format($pricelist->sellingprice,2);
                    ?>
                </td>
                <td>
                    <a href="{{ route('pricelists.edit',$pricelist->id)}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('pricelists.destroy', $pricelist->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Are you sure you want to delete?')) { return true } else {return false };">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button title="Delete" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            <script type="text/javascript">

            		RemoveSpace();
            		function RemoveSpace(){
        	
                		var el = document.querySelector('.panel');
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
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
         $('#example').DataTable({
            responsive: true
        });
    });
</script>
@stop
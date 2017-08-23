 @extends('layouts.admin')
@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #117A65; color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-product-hunt" aria-hidden="true"></i> New Prodcut</h4>
          </div>
            <div class="modal-body">
             <div class="row">
              <div class="col-lg-12">
                {!!Form::open(['action'=>'ProductController@store','method'=>'POST'])!!}
                  {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('product_code') ? ' has-error' : '' }}">
                                {!!Form::label('product_code','Product Code : ',[])!!}
                                {!!Form::text('product_code',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('product_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group {{ $errors->has('product_barcode') ? ' has-error' : '' }}">
                                {!!Form::label('product_barcode','Product Barcode : ',[])!!}
                                {!!Form::text('product_barcode',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('product_barcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product_barcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                {!!Form::label('name','Product Name : ',[])!!}
                                {!!Form::text('name',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                {!!Form::label('description','Description : ',[])!!}
                                {!!Form::text('description',null,['class'=>'form-control'])!!}
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            {!!Form::label('category_id','Category Name :',[])!!}
                            {!!Form::select('category_id',[null=>'---Please select a category name---']+$categories,null,['class'=>'form-control','required'=>'true'])!!}
                            @if ($errors->has('category_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category_id') }}</strong>
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
        <h4 class="page-header"><i class="fa fa-product-hunt" aria-hidden="true"></i> Products</h4>
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
<div class="row table-responsive">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
           All Products
        </div>
        <div class="panel-body">
        
       <table with="100%" id="example" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Product Code</th>
                <th>Product Barcode</th>
                <th>Product Name</th>
                <th>Category Name</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php $no=1;?>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">{{$no++}}</td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">                       
                    {{$product->product_code}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{$product->product_barcode}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$product->name}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$product->category->name}}
                </td>
                <td style="font-size: 12px; font-weight: bold; font-family: 'Khmer OS System'; text-align: center;">
                    <?php 
                        echo number_format($product->qty,0);
                    ?>
                </td>
                <td style="text-align: center;">
                    <a href="{{ route('products.edit',$product->id)}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Are you sure you want to delete?')) { return true } else {return false };">
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
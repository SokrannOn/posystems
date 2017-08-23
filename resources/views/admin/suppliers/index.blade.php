@extends('layouts.admin')
@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #117A65; color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-building-o" aria-hidden="true"></i> New Suppliers</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                {!!Form::open(['action'=>'SupplierController@store','method'=>'POST'])!!}
                  {{csrf_field()}}
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('companyname') ? ' has-error' : '' }}">
                                {!!Form::label('companyname','Company Name : ',[])!!}
                                {!!Form::text('companyname',null,['class'=>'form-control','required'=>'true','placeholder'=> 'Company Name...'])!!}
                                @if ($errors->has('companyname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('companyname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                {!!Form::label('address','Address : ',[])!!}
                                {!!Form::text('address',null,['class'=>'form-control','required'=>'true','placeholder'=> 'Address...'])!!}
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('personname') ? ' has-error' : '' }}">
                                {!!Form::label('personname',' Name : ',[])!!}
                                {!!Form::text('personname',null,['class'=>'form-control','placeholder'=> 'Person Name...'])!!}
                                @if ($errors->has('personname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('personname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('contactperson') ? ' has-error' : '' }}">
                                {!!Form::label('contactperson',' Contact Numer : ',[])!!}
                                {!!Form::text('contactperson',null,['class'=>'form-control','placeholder'=> 'Contact Number...'])!!}
                                @if ($errors->has('contactperson'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contactperson') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                {!!Form::label('email',' Email : ',[])!!}
                                {!!Form::text('email',null,['class'=>'form-control','placeholder'=> 'Email...'])!!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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
        <h4 class="page-header"> <i class="fa fa-building-o" aria-hidden="true"></i> Suppliers</h4>
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
           All Suppliers
        </div>
        <div class="panel-body">
            <table with="100%" id="example" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Company Name</th>
                <th>Address</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php $no=1;?>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{$no++}}</td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$supplier->companyname}}</td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                  {{$supplier->address}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$supplier->personname}}</td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                  {{$supplier->contactperson}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                  {{$supplier->email}}
                </td>
                <td>
                    <a href="{{ route('suppliers.edit',$supplier->id)}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Are you sure you want to delete?')) { return true } else {return false };">
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
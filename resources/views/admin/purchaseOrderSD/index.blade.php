 @extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-shopping-basket" aria-hidden="true"></i> All Purchase Order</h4>
    </div>
</div>
<div>
  @include('nav.message')
</div>
    <a href="{{ route('purchaseOrdersSD.create')}}" title="Create new order" class="btn btn-primary btn-sm" > Create Order </a>
<div class="row">
    <div class="col-lg-12 ">
        <div class="panel panel-default ">
            <div class="panel-heading">
           All Purchase Orders
        </div>
        <div class="panel-body table-responsive">
       <table with="100%" id="example" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>PO Number</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Discount</th>
                <th>Name</th>
                <th>COD</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posds as $posd)
            <tr>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{$posd->id}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{Carbon\Carbon::parse($posd->poDate)->format('d-M-Y')}}
                </td>
                 <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;"> 
                    <?php 
                        echo "$ " . number_format($posd->totalAmount,2);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{$posd->discount . " %"}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$posd->user->nameDisplay}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{$posd->cod . "%"}}
                </td>
                <td style="text-align: center;">
                    <a href="{{ route('purchaseOrdersSD.show',$posd->id)}}" class="btn btn-info btn-xs" title="Show Details"><i class="fa fa-indent" aria-hidden="true"></i></a>
                    <form action="{{ route('invoicePO.destroy',$posd->id) }}" method="POST" style="display: inline;" onsubmit="{ return true } else {return false };">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button title="Priview Invoice" type="submit" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></button>
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
            "aaSorting": [[ 0, "desc" ]]
        });
    });
</script>
@stop
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
<a href="{{ route('purchaseOrders.create')}}" title="Create new order" class="btn btn-primary btn-sm" > Create Order </a>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
           All Purchase Orders
        </div>
        <div class="panel-body table-responsive">
       <table with="100%" id="example" class="table table-striped table-responsive table-bordered table-hover">
        <thead>
            <tr>
                <th>PO Number</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Discount</th>
                <th>Customer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pocuss as $pocus)
            <tr>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{$pocus->id}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{Carbon\Carbon::parse($pocus->poDate)->format('d-M-Y')}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;"> 
                    <?php 
                        echo "$ " . number_format($pocus->totalAmount,2);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;"> 
                    {{$pocus->discount . " %"}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$pocus->customer->name}}
                </td>
                <td style="text-align: center;">
                    <a href="{{ route('purchaseOrders.show',$pocus->id)}}" class="btn btn-info btn-xs" title="Show Details"><i class="fa fa-indent" aria-hidden="true"></i></a>
                    <a href="{{ route('purchaseOrders.edit',$pocus->id)}}" class="btn btn-warning btn-xs" title="Show Details"><i class="fa fa-edit"></i></a>                
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
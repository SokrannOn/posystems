 @extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-files-o" aria-hidden="true"></i> All Invoices Created</h4>
    </div>
</div>
<div>
  @include('nav.message')
</div>
<div class="row" id="myPopup">
    <a href="#" class="update_po" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" data-keyboard="false"  data-backdrop="static"></a>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
           <div class="panel-heading">
           All Invoices Created
        </div>
        <div class="panel-body">
        
       <table with="100%" id="example" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>Customer Name</th>
                <th>Delivery Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($po as $pocus)
            <tr>
                <td style="font-size: 11px; font-family: 'Khmer OS System';text-align: center;">
                    <?php 
                        echo "CAM-IN-" . sprintf('%06d',$pocus->id);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';text-align: center;">
			{{Carbon\Carbon::parse($pocus->invoiceDate)->format('d-M-Y')}}
		</td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';text-align: center;">
                    <?php 
                        echo "$ " . number_format($pocus->totalAmount,2);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';text-align: center;">
                	{{$pocus->discount . " %"}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                <?php 
                        if($pocus->customer_id!=null){
                           echo $pocus->customer->name;
                        }else{
                            echo $pocus->user->name;
                        }
                    ?>
                  </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';text-align: center;">
                    <?php 
                    if($pocus->isDelivery==1){
                        echo 'Exported';
                    }else
                    {
                        echo "No Export";
                    }
                ?>
                </td>
                <td style="text-align: center;">
                    @if($pocus->isDelivery==0)
                    <a href="{{ route('stocks.edit',$pocus->id)}}" class="btn btn-primary btn-xs" title="Export"><i class="fa fa-truck" aria-hidden="true"></i></a>
                    @endif
                    @if($pocus->isDelivery==1)
                    <a href="{{ route('stocks.edit',$pocus->id)}}" class="btn btn-primary btn-xs" title="Exported" disabled><i class="fa fa-truck" aria-hidden="true"></i></a>
                    @endif
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
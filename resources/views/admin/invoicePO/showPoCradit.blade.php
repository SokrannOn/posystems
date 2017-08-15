 @extends('layouts.admin')
@section('content')
@include('include.editSummaryPO')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Invoice Details</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
        <button type="button" onclick="getPOInfo({{$details->id}})" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Edit Invoice</button>
    </div>
</div>
<div class="row">
    <div class="col-lg-11">

    </div>
    <div class="col-lg-1">
       
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-responsive" cellspacing="0">
            <thead>
                <tr class="bg-primary">
                    <th>PO ID</th>
                    <th>PO Date</th>
                    <th>Customer</th>
                    <th>Sale Name</th>
                    <th>COD</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-size: 11px; font-family: 'Khmer OS System';">
                        {{$details->id}}
                    </td>
                    <td style="font-size: 11px; font-family: 'Khmer OS System';">
                        {{Carbon\Carbon::parse($details->poDate)->format('d-M-Y')}}
                    </td>
                        <?php 
                        if($details->customer_id!=null){
                            echo "<td>" . $details->customer->name . "</td>";
                            echo "<td>" . $details->user->name . "</td>";
                        }else{
                            echo "<td>" . $details->user->name . "</td>";
                            echo "<td>" . "SD" . "</td>";
                        }

                        ?>
                    <td style="font-size: 11px; font-family: 'Khmer OS System';">
                        <?php 
                            if($details->cod!=0){
                                echo "Yes";
                            }else{
                                echo "No";
                            }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <table with="100%" id="example" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Product Code</th>
                <th>Product Barcode</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <?php $n = 1; ?>
        <tbody>
            @foreach($details->products as $detail)
            <tr>
                <td>{{$n++}}</td>
                <td>{{$detail->product_code}}</td>
                <td>{{$detail->product_barcode}}</td>
                <td>{{$detail->name}}</td>
                <td>{{$detail->pivot->qty}}</td>
                <td>{{$detail->pivot->unitPrice . " $"}}</td>
                <td>{{$detail->pivot->amount . " $"}}</td>
                
            </tr>
            @endforeach
            <tr>
               	<td style="border-left:none; border-right:none;border-button:none;"></td>
                <td style="border-left:none; border-right:none;border-button:none;"></td>
                <td style="border-left:none; border-right:none;border-button:none;"></td>
                <td style="border-left:none; border-right:none;border-button:none;"></td>
                <td style="border-left:none; border-button:none;"></td>
                <td>Total Amount</td>
                <td>{{$details->totalAmount . "$"}}</td>
            </tr>
            <tr>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border-left:none; border-button:none; border-top:none;"></td>
                <td>Discount</td>
                <td>{{$details->discount . " %"}}</td>
            </tr>
            <tr>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border-left:none; border-button:none; border-top:none;"></td>
                <td>COD</td>
                <td>{{$details->cod . " %"}}</td>
            </tr>
            <tr>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border-left:none; border-button:none; border-top:none;"></td>
                <td>VAT(%)</td>
                <td>{{$details->vat . " %"}}</td>
            </tr>
            <tr>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border-left:none; border-button:none; border-top:none;"></td>
                <td>Diposit</td>
                <td>{{$details->diposit . " $"}}</td>
            </tr>
            <tr>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border-left:none; border-button:none; border-top:none;"></td>
                <td>Grand Total</td>
                <td>{{$VgrandTotal . " $"}}</td>
            </tr>
        </tbody>
    </table>
        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
           
    });
    //-------------------
</script>
@stop
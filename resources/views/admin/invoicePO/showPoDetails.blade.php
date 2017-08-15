 @extends('layouts.admin')
@section('content')
@include('include.editInvoice')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Invoice Details</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-2">
        <a href="{{ route('invoicePO.index')}}" class="btn btn-info btn-sm" > Back </a>
    </div>
    <div class="col-lg-3">
        
    </div>
    <div class="col-lg-3">
        <button type="button" onclick="getPOInfo({{$details->id}})" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-edit"> </i> Edit Invoice</button>
    </div>
    <div class="col-lg-2">
        
    </div>
    <div class="col-lg-2">
        <form action="{{ route('invoicePO.destroy',$details->id) }}" method="POST" style="display: inline;" onsubmit="{ return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button title="Delete" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Preview Invoice</button>
        </form>
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
                    <th>Invoice Number</th>
                    <th>Invoice Date</th>
                    <th>Customer Name</th>
                    <th>Sale Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-size: 12px; font-family: 'Khmer OS System';">
                        <?php 
                            echo "CAM-IN-" . sprintf('%06d',$details->id);
                        ?>
                    </td>
                    <td style="font-size: 12px; font-weight: bold; font-family: 'Khmer OS System';">
                        {{Carbon\Carbon::parse($details->poDate)->format('d-M-Y')}}</td>
                    <?php 
                        if($details->customer_id!=null){
                           echo "<td>" . $details->customer->name . "</td>";
                           echo "<td>" . $details->user->name . "</td>";
                        }else{
                            echo "<td>" . $details->user->name . "</td>";
                        }
                    ?>
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
                <td style="text-align: center;">{{$n++}}</td>
                <td style="text-align: center;font-size: 11px; font-family: 'Khmer OS System';">
                    {{$detail->product_code}}
                </td>
                <td style="text-align: center; font-size: 11px; font-family: 'Khmer OS System';">
                    {{$detail->product_barcode}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$detail->name}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$detail->pivot->qty}}
                </td>
                <td style="font-size: 12px; font-family: 'Khmer OS System';">
                    <?php 
                        echo "$ " . number_format($detail->pivot->unitPrice,2);
                    ?>
                </td>
                <td style="font-size: 12px; font-family: 'Khmer OS System';">
                    <?php 
                        echo "$ " . number_format($detail->pivot->amount,2);
                    ?>
                </td>
                
            </tr>
            @endforeach
            <tr>
                <td style="border-left:none; border-right:none;border-button:none;"></td>
                <td style="border-left:none; border-right:none;border-button:none;"></td>
                <td style="border-left:none; border-right:none;border-button:none;"></td>
                <td style="border-left:none; border-right:none;border-button:none;"></td>
                <td style="border-left:none; border-button:none;"></td>
                <td>Total Amount</td>
                <td>
                    <?php 
                        echo "$ " . number_format($details->totalAmount,2);
                    ?>
                </td>
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
                <td>
                    <?php 
                        echo "$ " . number_format($details->diposit,2);
                    ?>
                </td>
            </tr>
            <tr>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border-left:none; border-button:none; border-top:none;"></td>
                <td>Grand Total</td>
                <td>
                    <?php 
                        echo "$ " . number_format($VgrandTotal,2);
                    ?>
                </td>
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
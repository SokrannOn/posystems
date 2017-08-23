 @extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Summary Invoice Details</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
        
    </div>
    <div class="col-lg-2">
        <form action="{{ route('summaryInv.destroy',$smi->id) }}" method="POST" style="display: inline;" onsubmit="{ return true } else {return false };">
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
                    <th>Summary Invoice Number</th>
                    <th>Date</th>
                    <th>Rate</th>
                    <th>Customer</th>
                    <th>Billing Invoice</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                    <b><?php 
                        echo "CAM-CIN-" . sprintf('%06d',$smi->id);
                    ?></b>
                    </td>
                    <td><b>{{Carbon\Carbon::parse($smi->smiDate)->format('d-M-Y')}}</b></td>
                    <td><b>{{$smi->rate . "​ ៛"}}</b></td>
                    <td><b>{{$smi->customer->name}}</b></td>
                    <td><b>{{$smi->user->name}}</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <table class="table table-responsive table-bordered table-striped" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice Number</th>
                <th>Invoice Date</th>
                <th>Total ( $ )</th>
                <th>Total ( ៛ )</th>
            </tr>
        </thead>
        <?php $n = 1; ?>
        <tbody>
            @foreach($smi->purchaseorders as $detail)
            <tr>
                <td>{{$n++}}</td>
                <td>
                    <?php 
                        echo "CAM-IN-" . sprintf('%06d',$detail->id);
                    ?>
                </td>
                <td>{{$detail->poDate}}</td>
                <td>
                    <?php 
                         $totalAmount = $detail->totalAmount;
                         $dis = $detail->discount;
                         $vat = $detail->vat;
                         $cod = $detail->cod;
                         $diposit = $detail->diposit;
                         $Vtotal = $totalAmount  - $totalAmount * $dis /100;
                         $Vcod =$Vtotal * $cod /100;
                         $Vvat = $totalAmount * $vat/100;
                         $grandTotal = $Vtotal - $Vcod + $Vvat;
                         $VgrandTotal = $grandTotal - $diposit;
                         echo "$ " . number_format($VgrandTotal,2);
                       ?>
                </td>
                <td>
                    <?php 
                        $khTotal = 0;
                        $round = 0;
                        $khTotal = $VgrandTotal * $smi->rate;
                     if(substr($khTotal, -2,2)>0){
                        $round = 100-substr($khTotal, -2,2);
                        $khGrandTotal = $khTotal+$round;
                        echo "៛​ " . number_format($khGrandTotal,2);
                    }else{
                        $khGrandTotal = $khTotal;
                        echo "៛ " . number_format($khGrandTotal,2);
                    }
                     ?>
                </td>
            @endforeach
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
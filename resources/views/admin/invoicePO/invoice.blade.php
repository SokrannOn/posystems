<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="{{asset('js/js.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/printThis.js')}}" type="text/javascript"></script>
    <style type="text/css">
    	body{
    		font-size:10px;
	        line-height:20px;
	        font-family:"Khmer OS System";
    	}
    </style>
</head>

<body>

    <input type="hidden" class="poid" name="id" value="{{$po->id}}">

    <div class="row" style="width: 950px; margin: auto;">
        <div>
            @if(Auth::user()->position->name != 'SD')
            <a href="{{ route('invoicePO.index')}}" class="btn btn-info btn-sm" > Back </a>
            @endif
            @if(Auth::user()->position->name == 'SD')
            <a href="{{ route('purchaseOrdersSD.index')}}" class="btn btn-info btn-sm" > Back </a>
            @endif
            @if(Auth::user()->position->name == 'Accountant')
            <button onclick="updateGenerate({{$po->id}})" class="btn btn-primary btn-sm" style="float: right;" name="print" id="print" value=" Print "><span class="glyphicon glyphicon-print"></span> Print</button>
            @endif
            @if(Auth::user()->position->name != 'Accountant')
                <button class="btn btn-primary btn-sm" style="float: right;" name="print" id="print" value=" Print "><span class="glyphicon glyphicon-print"></span> Print</button>
            @endif
        </div>
    </div>
	<div class="centent" style="width:950px; height:1000px; margin:auto;">
    	<table width="100%" border="0px">
        	<tr>
            	<td width="10%">
                	<img src="{{url('/images/Logo.JPG')}}" alt="" style="height:60px;">
                </td>
                <td style="text-align:center; font-size:20px;font-family:'Khmer OS Muol Light';​ font-weight: bold; color: blue; ">
                	វិក្ក័យប័ត្រ<br />
                   	<b>Invoice</b>
                </td>
                <td width="25%">
                </td>
            </tr>
        </table>
        <table width="100%" height="10px" border="0px" style="border:none; font-size: 11px; font-family: 'Khmer OS System'; color: blue;">
        	<tr>
            	<td width="70%">
                	#S06, Street S, Toul Roka Village, Chak Angre Krom, Mean Chey <br />
                    District, Phnom Penh, Kingdom of Cambodia.<br />
                    Contact No:   087/095 808 011
                </td>
                <td style="border:none; font-size: 10px; color: black; font-weight: bold; font-family: 'Khmer OS System'; text-align: center;">
                	<br />
               		លេខវិក្ក័យប័ត្រ<br />
                    INVOICE NUMBER
                </td>
            </tr>
        </table>
        <table width="30%" height="90px" border="1px" style="float:right; text-align:center; border-collapse:collapse;" >
        	<tr>
            	<td width="100%" style="font-size: 10px; font-weight: bold; color: blue; font-family: 'Khmer OS System'; text-align: center;">
                    <?php 
                        echo "CAM-IN-" . sprintf('%06d',$po->id);
                    ?>
                </td>
            </tr>
            <tr>
            	<td style="font-size: 10px; color: blue; font-family: 'Khmer OS System'; text-align: center;">
                	{{Carbon\Carbon::parse($po->poDate)->format('d-M-Y')}}
                </td>
            </tr>
            <tr>
            	<td style="border:none; font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                	ថ្ងៃ ខែ ទូទាត់/Due Date
                </td>
            </tr>
            <tr>
                @if($po->dueDate!=null)
            	<td style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                	{{Carbon\Carbon::parse($po->dueDate)->format('d-M-Y')}}
                </td>
                @endif
                @if($po->dueDate==null)
                <td style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                    
                </td>
                @endif
            </tr>
        </table>
        <table width="69%" height="90px" border="1px" style="border-collapse: collapse;">
        	<tr>
            	<td width="17%" style="border:none; padding-left: 3px; font-size: 10px; font-family: 'Khmer OS System';">
                	ឈ្មោះអតិថិជន
                </td>
                <td width="2%" style="border:none;">
                	:
                </td>
                <td style="border:none; font-size: 12px; font-weight: bold; color: blue; font-family: 'Khmer OS System';">
                    <?php 
                        if($po->customer_id!=null){
                            echo $po->customer->name;
                        }else{
                            echo $po->user->nameDisplay;
                        }
                    ?>
                </td>
            </tr>
            <tr>
            	<td style="border:none; padding-left: 3px; font-size: 10px; font-family: 'Khmer OS System';">
                	អាស័យដ្ឋាន
                </td>
                <td style="border:none;">
                	:
                </td>
                @if($po->customer_id!=null)
                <td style="border:none; font-size: 9px; font-family: 'Khmer OS System';">
                	{{"No. " . $po->customer->homeNo . ", St." . $po->customer->streetNo . ", " . $po->customer->village->name . ", " . $po->customer->village->commune->name . ", " . $po->customer->village->commune->district->name . ", " . $po->customer->village->commune->district->province->name . "." . " ( " . $po->customer->location . " ) "}}
                </td>
                @endif
               @if($po->customer_id==null)
                <td style="border:none; margin-left: 50px; font-size: 10px; font-family: 'Khmer OS System';">
                    {{$po->user->brand}}
                </td>
               @endif
            </tr>
            <tr>
            	<td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
            </tr>
            <tr>
            	<td style="border:none; padding-left: 3px; font-size: 10px; font-family: 'Khmer OS System';">
                	លេខទូរស័ព្ទ
                </td>
                <td style="border:none;">
                	:
                </td>
                @if($po->customer_id!=null)
                <td style="border:none; font-size: 10px; font-family: 'Khmer OS System';">
                	{{$po->customer->contactNo}}
                </td>
                @endif
                @if($po->customer_id==null)
                <td style="border:none;  font-size: 10px; font-family: 'Khmer OS System';">
                    {{$po->user->contactNum}}
                </td>
                @endif
            </tr>
            <tr>
            	<td style="border:none; padding-left: 3px; font-size: 10px; font-family: 'Khmer OS System';">
                	ប្រភេទហាង
                </td>
                <td style="border:none;">
                	:
                </td>
                @if($po->customer_id!=null)
                <td style="border:none;  font-size: 10px; font-family: 'Khmer OS System';">
                   {{$po->customer->channel->name}}
                </td>
                @endif
                @if($po->customer_id==null)
                <td style="border:none;  font-size: 10px; font-family: 'Khmer OS System';">
                    {{$po->user->position->name}}
                </td>
                @endif
            </tr>
            <tr>
            	<td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
            </tr>
        </table>
        <table width="30%" height="60px" cellspacing="0" border="1px" style="float:right; text-align:center; margin-top: 10px; margin-right: 2px; border-collapse:collapse;">
        	<tr height="38px">
            	<td style="font-size: 7px; font-family: 'Khmer OS System';">
                	ប្រភេទទូទាត់/PAYMETN TYPE
                </td>
                <td style="font-size: 7px; font-family: 'Khmer OS System';">
                	(COD) DISCOUNT
                </td>
                <td style="font-size: 7px; font-family: 'Khmer OS System';">
                    Rate
                </td>
            </tr>
            <tr>
                @if($po->cod!=0)
                <td style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                    CASH(COD)
                </td>
            	<td style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                	{{$cod . "%"}}
                </td>
                @endif
                @if($po->cod==0)
                <td style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">

                </td>
                <td style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                    
                </td>
                @endif
                <td width="20%">
                    <b style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                    <?php
                        echo "៛ " . number_format($rate);
                     ?></b>
                </td>
            </tr>
        </table>
        <table width="69%" height="60px" border="1px" cellpadding="0" cellspacing="0" style="text-align:center; margin-top: 10px; border-collapse:collapse;">
        	<tr>
            	<td style="font-size: 10px; font-family: 'Khmer OS System';">
                	លេខកូដអតិថិជន<br />
                    Customer ID Code
                </td>
                <td style="font-size: 10px; font-family: 'Khmer OS System';">
                	អ្នកចេញវិក្ក័យប័ត្រ<br />
                    Billing By
                </td>
                <td style="font-size: 10px; font-family: 'Khmer OS System';">
                	ភ្នាក់ងារលក់<br />
                    Sale Representative
                </td>
            </tr>
            <tr>
            	<td style="font-size: 10px; font-weight: bold; color: blue; font-family: 'Khmer OS System';">
                
                    <?php 
                        if($po->customer_id!=null){
                        echo "CAM-CUS-" . sprintf('%06d',$po->customer->id);
                    }else{
                        echo "CAM-CUS-" . sprintf('%06d',$po->user->id);
                    }
                    ?>
                </td>
                <td style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                	<?php 
                        if($sex==1){
                            echo "Mr. " . $createdInv;
                        }else{
                            echo "Ms. " . $createdInv;
                        }   
                        ?>
                </td>
                @if($po->customer_id!=null)
                <td style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                    <?php 
                        if($po->user->sex==1){
                            echo "Mr. " . $po->user->nameDisplay;
                        }else{
                            echo "Ms. " . $po->user->nameDisplay;
                        }
                    ?>
                </td>
                @endif
                @if($po->customer_id==null)
                <td>
                </td>
                @endif
            </tr>
        </table>
       <div style="min-height:400px; margin-top: 10px;">
       		<table class="table-responsive" border="1px" width="100%" style="text-align:center; font-size: 10px; line-height: 20px; margin-bottom: 0px; border-collapse:collapse;" >
            <thead>
                <tr>
                    <th width="5%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        ល.រ<br />
                        No
                    </th>
                    <th width="10%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        កូដទំនិញ<br />
                        Item Code
                    </th>
                    <th width="12%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        លេខកូដ<br />
                        Bar Code
                    </th>
                    <th width="40%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        ឈ្មោះទំនិញ<br />
                        Product Description
                    </th>
                    <th width="4%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        ចំនួន<br />
                        Quantity
                    </th>
                    <th width="7%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        តម្លៃរាយ<br />
                        UnitPrice
                    </th>
                    <th width="6%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        បញ្ចុះ(%)<br />
                        Discount(%)
                    </th>
                    <th width="7%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        បញ្ចុះតម្លៃ<br />
                        NetPrice
                    </th>
                    <th width="7%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        សរុប($) <br />
                        Total
                    </th>
                </tr>
            </thead>
            <?php 
                $n = 1;
                $numRows = 0;
             ?>
            <tbody>
             @foreach($po->products as $podetail)
                <tr style="height: 20px;">
                    <td>
                       {{$numRows = $n++}}
                    </td>
                    <td style="font-size: 8px;"">
                        {{$podetail->product_code}}
                    </td>
                    <td style="font-size: 8px;"">
                       {{$podetail->product_barcode}}
                    </td>
                    <td style="font-size: 8px; padding-left: 3px; font-family: 'Khmer OS System'; text-align:left;">
                        {{$podetail->name}}
                    </td>
                    <td>
                       {{$podetail->pivot->qty}}
                    </td>
                    <td>
                        <?php 
                            echo number_format($podetail->pivot->unitPrice,2);
                        ?>
                    </td>
                    @if($discount >0)
                    <td>
                        {{$discount . "%"}}
                    </td>
                    @endif
                    @if($discount==0)
                    <td>
                        0 %
                    </td>
                    @endif
                    @if($discount >0)
                    <td>
                        <?php 
                            echo number_format($podetail->pivot->unitPrice-$podetail->pivot->unitPrice * $discount/100,2);
                        ?>

                    </td>
                    @endif
                    @if($discount==0)
                    <td>
                        $ 0.00
                    </td>
                    @endif
                    <td>
                        <?php 
                            echo number_format($podetail->pivot->amount- $podetail->pivot->amount * $discount/100,2);
                        ?>
                    </td>
                </tr>
                @endforeach
                @for($i=$numRows+1; $i<=14; $i++)
                <tr style="height: 20px;">
                    <td>
                        
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                </tr>
                @endfor
             </tbody>
            <tr style="height: 25px">
            	<td colspan="2" style="font-size: 9px; border:none; font-weight: bold; font-family: 'Khmer OS System'; text-align:left;">
                	ផ្សេងៗ
                </td>
                <td style="border:none;">
                	
                </td>
                <td style="font-size: 9px;padding-right: 2px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right; border:none;">
                	DISCOUNT
                </td>
                <td colspan="2" style="font-size: 9px;padding-right: 2px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right;">
                	បញ្ចុះតម្លៃ
                </td>
                <td colspan="3" style="font-weight: bold;font-size: 10px;">
                    <?php 
                            echo "$ " . number_format($totalAmount * $discount/100,2);
                    ?>
                </td>
            </tr>
            <tr style="height: 25px;">
            	<td colspan="2" style="font-size: 9px; font-weight: bold; font-family: 'Khmer OS System'; text-align:left; border:none;">
                	Remark
                </td>
                <td style="border:none;">
                	
                </td>
                <td style="font-size: 9px;padding-right: 2px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right; border:none;">
                	COD DISCOUNT
                </td>
                <td colspan="2" style="font-size: 9px;padding-right: 2px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right;">
                	(COD)បញ្ចុះតម្លៃ
                </td>
                <td colspan="3" style="font-weight: bold;font-size: 10px;">
                    <?php 
                            echo "$ " . number_format($Vcod,2);
                    ?>
                </td>
            </tr>
            <tr style="height: 25px">
            	<td colspan="2" style="border:none;">
                	
                </td>
                <td style="border:none;">
                	
                </td>
                <td style="font-size: 9px;padding-right: 2px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right; border:none;">
                	VAT(%)
                </td>
                <td colspan="2" style="font-size: 9px;padding-right: 2px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right;">
                	អាករលើតម្លៃបន្ថែម
                </td>
                <td colspan="3" style="font-weight: bold;font-size: 10px;">
                    <?php 
                            echo "$ " . number_format($Vvat,2);
                    ?>
                </td>
            </tr>
            <tr style="height: 25px">
            	<td colspan="2" style="border:none;">
                	
                </td>
                <td style="border:none;">
                	
                </td>
                <td style="font-size: 9px;padding-right: 2px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right; border:none;">
                	TOTAL DIPOSIT
                </td>
                <td colspan="2" style="font-size: 9px;padding-right: 2px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right;">
                	ប្រាក់កក់
                </td>
                <td colspan="3" style="font-weight: bold;font-size: 9px;">
                    <?php 
                            echo "$ " . number_format($diposit,2);
                    ?>
                </td>
            </tr>
            <tr style="height: 25px;">
            	<td colspan="2" style="border:none;">
                	
                </td>
                <td style="border:none;">
                	
                </td>
                <td style="font-size: 9px; font-weight: bold;padding-right: 2px; font-family: 'Khmer OS System'; text-align:right; border:none;">
                	GRAND TOTAL
                </td>
                <td colspan="2" style="font-size: 9px;padding-right: 2px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right;">
                	សរុបរួម
                </td>
                <td colspan="3" style="font-weight: bold; font-size: 10px;">
                    <?php 
                            echo "$ " . number_format($VgrandTotal,2);
                    ?>
                </td>
            </tr>
            <tr style="height: 25px">
            	<td colspan="2" style="border:none;">
                	
                </td>
                <td style="border:none;">
                	
                </td>
                <td style="font-size: 9px; padding-right: 2px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right; border:none;">
                	TOTAL OWED
                </td>
                <td colspan="2" style="font-size: 9px; padding-right: 2px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right;">
                	ជំពាក់សរុប
                </td>
                <td style="font-weight: bold; font-size: 11px;">
                    <?php 
                            echo "$ " . number_format($VgrandTotal,2);
                    ?>
                </td>
                <td colspan="2" style="font-weight: bold; font-size: 11px;">
                    <?php 
                            echo "៛ " . number_format($totalAmountkh,0);
                    ?>
                </td>
            </tr>
        </table>
       </div>
        <table width="100%" style="height: 120px; text-align: center; margin-top: 10px;" border="0px">
        	<tr>
            	<td width="25%" style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
            		គណនេយ្យ-ACCOUNTANT
            	</td>
                <td width="25%" style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                	ឃ្លាំង-WAREHOUSE
                </td>
                <td width="25%" style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                	អ្នកដឹកជញ្ជូន-DELIVERY
                </td>
                <td width="25%" style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                    អតិថិជន-CUSTOMER
                </td>
            </tr>
            <tr style="height: 100px">
            	<td></td>
            	<td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
            	<td>
            		<div style="border:1px solid #424949; width: 80%;margin-left: 18px"></div>
            	</td>
            	<td>
            		<div style="border:1px solid #424949; width: 80%;margin-left: 18px"></div>
            	</td>
                <td>
                	<div style="border:1px solid #424949; width: 80%;margin-left: 18px"></div>
                </td>
                <td>
                	<div style="border:1px solid #424949; width: 80%;margin-left: 18px"></div>
                </td>
            </tr>
        </table>
        <div style="font-size: 9px; line-height: 18px; margin-top: 5px; color: red; font-family: 'Khmer OS System';">
            <u>ចំណាំ:</u><br /><br />
             * អតិថិជនត្រូវត្រួតពិនិត្យនិងផ្ទៀងផ្ទាត់ចំនួន​ និងគុណភាពទំនិញអោយបានត្រឹមត្រូវ នៅពេលទទួលទំនិញ។ ទំនិញដែលទិញហើយមិនអាចដូរ​ ឫត្រឡប់វិញបានទេ។<br />
             * អតិថិជនអាចធ្វើការទំនាក់ទំនងសួរ ឫផ្ដល់ពត៌មានមកក្រុមហ៊ុនដោយផ្ទល់តាមទូរស័ព្ទលេខ <b>087/095 808 011</b> នៅរៀងរាល់ម៉ោងធ្វើការ ៕
        </div>
    </div>
<script>

$("#print" ).click(function() {
  $('.centent').printThis({
    loadCSS: "",
});
});

  //-------------------------------
function updateGenerate(id){
  var id = $(".poid").val();
  $.ajax({
    url:"{{url('/updateGenerate')}}"+"/"+id,
    type:'get',
    success:function(data){
    },
    error:function(error){
      console.log(error)
    },
  });
}
  //-------------------------
  
</script>
</body>
</html>

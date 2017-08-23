<!DOCTYPE html>
<html>
<head>
	<title>Summary Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="{{asset('js/js.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/printThis.js')}}" type="text/javascript"></script>
    <style type="text/css">
    	body{
    		font-size:11px;
	        line-height:20px;
	        font-family:"Khmer OS System";
    	}
    </style>
</head>

<body>
    <div class="row" style="width: 950px; margin: auto;">
        <div>
            <a href="{{ route('summaryInvs.index')}}" class="btn btn-info btn-sm" > Back </a>
            <button class="btn btn-primary btn-sm" style="float: right;" name="print" id="print" value=" Print "><span class="glyphicon glyphicon-print"></span> Print</button>
        </div>
    </div>
	<div class="centent" style="width:950px; height:1000px; margin:auto;">
    	<table width="100%" height="10px" border="0px">
        	<tr>
            	<td width="35%">
                	<img src="{{url('/images/Logo.JPG')}}" style="width:100%">
                </td>
                <td> 
                </td>
                <td width="30%">
                </td>
            </tr>
        </table>
        <div style="text-align:center; font-size:15px;font-family:'Khmer OS Muol Light';​ font-weight: bold; color: blue; ">វិក្ក័យប័ត្រទូទាត់ប្រាក់</div>
        <table width="100%" height="10px" border="0px" style="border:none; font-size: 11px; font-family: 'Khmer OS System'; color: blue;">
        	<tr>
            	<td width="70%">
                	#S06, Street S, Toul Roka Village, Chak Angre Krom, Mean Chey <br />
                    District, Phnom Penh, Kingdom of Cambodia.<br />
                    Contact No:   087/095 808 011
                </td>
                <td style="border:none; font-size: 10px; color: black; font-weight: bold; font-family: 'Khmer OS System'; text-align: center;">
                	<br />
               		លេខវិក្ក័យប័ត្រទូទាត់<br />
                    Payment Invoice Number
                </td>
            </tr>
        </table>
        <table width="30%" height="90px" border="1px" style="float:right; text-align:center; border-collapse:collapse;">
        	<tr>
            	<td width="100%" style="font-size: 10px; font-weight: bold; color: blue; font-family: 'Khmer OS System'; text-align: center;">
                    <?php 
                        echo "CAM-INS-" . sprintf('%06d',$smi->id);
                    ?>
                </td>
            </tr>
            <tr>
            	<td style="border:none;"></td>
            </tr>
            <tr>
            	<td style="font-size: 10px; border:none; font-family: 'Khmer OS System'; text-align: center;">
                	ថ្ងៃ ខែ ឆ្នាំ ចេញវិក្ក័យប័ត្រ / Invoice Date
                </td>
            </tr>
            <tr>
            	<td style="font-size: 10px; font-weight: bold; color: blue; font-family: 'Khmer OS System'; text-align: center;">
                	{{Carbon\Carbon::parse($smi->smiDate)->format('d-M-Y')}}
                </td>
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
                	{{$smi->customer->name}}
                </td>
            </tr>
            <tr>
            	<td style="border:none; padding-left: 3px; font-size: 10px; font-family: 'Khmer OS System';">
                	អាស័យដ្ឋាន
                </td>
                <td style="border:none;">
                	:
                </td>
                <td style="border:none; font-size: 10px; font-family: 'Khmer OS System';">
                    {{"No. " . $smi->customer->homeNo . ", St." . $smi->customer->streetNo . ", " . $smi->customer->village->name . ", " . $smi->customer->village->commune->name . ", " . $smi->customer->village->commune->district->name . ", " . $smi->customer->village->commune->district->province->name . "." . " ( " . $smi->customer->location . " ) "}}
                </td>
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
                <td style="border:none;  font-size: 10px; font-family: 'Khmer OS System';">
                	{{$smi->customer->contactNo}}
                </td>
            </tr>
            <tr>
            	<td style="border:none; padding-left: 3px; font-size: 10px; font-family: 'Khmer OS System';">
                	ប្រភេទហាង
                </td>
                <td style="border:none;">
                	:
                </td>
                <td style="border:none;  font-size: 10px; font-family: 'Khmer OS System';">
                    {{$smi->customer->channel->name}}
                </td>
            </tr>
            <tr>
            	<td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
            </tr>
        </table>
        <table width="30%" height="60px" border="1px" style="float:right; text-align:center; margin-top: 10px; margin-right: 2px; border-collapse:collapse;">
        	<tr height="38px">
            	<td colspan="2" style="font-size: 8px; font-family: 'Khmer OS System';">
                	ប្រភេទរូបិយប័ណ្ណ / Type of Currency
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                    1 ដុលារ
                </td>
            	<td>
                	<b style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                    <?php
                    echo "៛ " . number_format($smi->rate);
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
            </tr>
            <tr>
            	<td style="font-size: 10px; font-weight: bold; color: blue; font-family: 'Khmer OS System';">
                    <?php 
                        echo "CAM-CUS-" . sprintf('%06d',$smi->customer->id);
                    ?>
                </td>
                <td style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                    <?php 
                        if($sex==1){
                            echo "Mr. " . $smi->user->nameDisplay;
                        }else{
                            echo "Ms. " . $smi->user->nameDisplay;
                        }   
                    ?>
                </td>
            </tr>
        </table>
       <div style="min-height:400px; margin-top: 10px;">
       		<table class="" border="1px" width="100%" style="text-align:center; font-size: 10px; line-height: 20px; margin-bottom: 0px; border-collapse:collapse;">
            <thead>
                <tr>
                    <th width="5%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        ល.រ<br />
                        No
                    </th>
                    <th width="25%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        លេខវិក្ក័យប័ត្រ<br />
                        Invoice Number
                    </th>
                    <th width="18%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        ថ្ងៃចេញវិក្ក័យប័ត្រ<br />
                        Invoice Date
                    </th>
                    <th width="18%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        ចំនួនទឹកប្រាក់<br />
                        Amount
                    </th>
                    <th width="30%" style="font-size: 10px; font-family: 'Khmer OS System'; text-align: center;">
                        ផ្សេងៗ<br />
                        Other
                    </th>
                </tr>
            </thead>
            <?php 
                $n = 1;
                $numRows = 0;
             ?>
            <tbody>
             @foreach($smi->purchaseorders as $detail)
                <tr style="height: 21px;">
                    <td>
                       {{$numRows = $n++}}
                    </td>
                    <td>
                    <?php 
                        echo "CAM-IN-" . sprintf('%06d',$detail->id);
                    ?>
                    </td>
                    <td>
                       {{Carbon\Carbon::parse($detail->poDate)->format('d-M-Y')}}
                    </td>
                    <td>
                      <b style="font-size: 12px"> <?php 
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
                       ?></b>
                    </td>
                    <td>
                        
                    </td>
                </tr>
            @endforeach
                @for($i=$numRows+1; $i<=16; $i++)
                <tr style="height: 21px;">
                    <td style="border-top: none;border-bottom: none;">
                        
                    </td>
                    <td style="border-top: none;border-bottom: none;">

                    </td>
                    <td style="border-top: none;border-bottom: none;">

                    </td>
                    <td style="border-top: none;border-bottom: none;">

                    </td>
                    <td style="border-top: none;border-bottom: none;">

                    </td>
                </tr>
                @endfor
             </tbody>
            <tr style="height: 25px;">
            	<td style="border-bottom: none;border-right: none;border-left: none;">
                
                </td>
                <td style="border-bottom: none;border-right: none;border-left: none;">
                	
                </td>
                <td style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right;">
                    ប្រាក់ត្រូទូទាត់សរុប(ដុល្លារ):
                </td>
                <td style="text-align: right; font-weight: bold; padding: 5px">
                <?php $sum =0; ?>
                    @foreach($smi->purchaseorders as $detail)
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
                         $sum+= $VgrandTotal;
                       ?>
                    @endforeach
                    <b style="font-size: 13px;"><?php echo "$ " . number_format($sum,2); ?></b>
                </td>
                <td style="font-weight: bold;">
                	
                </td>
            </tr>
            <tr style="height: 31px">
                <td style="border:none;">
                
                </td>
                <td style="border:none;">
                    
                </td>
                <td style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System'; text-align:right;">
                    ប្រាក់ត្រូវទូទាត់សរុប(រៀល):
                </td>
                <td style="text-align: right; font-weight: bold;">
                    <b style="font-size: 13px; padding: 5px;"><?php 
                        $khTotal = 0;
                        $round = 0;
                        $khTotal = $sum * $smi->rate;
                     if(substr($khTotal, -2,2)>0){
                        $round = 100-substr($khTotal, -2,2);
                        $khGrandTotal = $khTotal+$round;
                        echo "៛​ " . number_format($khGrandTotal,2);
                    }else{
                        $khGrandTotal = $khTotal;
                        echo "៛ " . number_format($khGrandTotal,2);
                    }
                     ?></b>
                </td>
                <td style="font-weight: bold;">
                    
                </td>
            </tr>
        </table>
       </div>
        <table width="100%" style="height: 120px; text-align: center; margin-top: 20px;" border="0px">
        	<tr>
            	<td width="25%" style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
            		អ្នកទទួល<br />
                    <b>Recived By</b>
            	</td>
            	<td width="25%">
            		
            	</td>
                <td width="25%">
                	
                </td>
                <td width="25%" style="font-size: 10px; font-weight: bold; font-family: 'Khmer OS System';">
                	អ្នកទូទាត់ប្រាក់<br />
                    <b>Paid By</b>
                </td>
            </tr>
            <tr style="height: 100px;">
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
            		
            	</td>
                <td>
                	
                </td>
                <td>
                	<div style="border:1px solid #424949; width: 80%;margin-left: 18px"></div>
                </td>
            </tr>
        </table>
        <div style="font-size: 9px; line-height: 18px; margin-top: 10px; color: red; font-family: 'Khmer OS System';">
            <u>ចំណាំ:</u><br /><br />
             * អតិថិជនត្រូវត្រួតពិនិត្យនិងផ្ទៀងផ្ទាត់ចំនួន​ទឹកប្រាក់ ដែលត្រូវទូទាត់អោយបានត្រឹមត្រូវ មុនពេលបង់ប្រាក់។<br />
             * អតិថិជនអាចធ្វើការទំនាក់ទំនងសួរ ឫផ្ដល់ពត៌មានមកក្រុមហ៊ុនដោយផ្ទល់តាមទូរស័ព្ទលេខ <b>០៨៧​/០៩៥ ៨០៨ ០១១</b> នៅរៀងរាល់ម៉ោងធ្វើការ ៕
        </div>
    </div>
<script>

$("#print" ).click(function() {
  $('.centent').printThis({
    loadCSS: "",
});
});
</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
    	body{
    		font-size:11px;
	        line-height:20px;
	        font-family:"Khmer OS System";
    	}
    </style>
</head>

<body>
    <div>
        <a href="javascript:window.print()" class="print_it" title="Print page">Print Page</a>
    </div>
	<div class="print_it" style="width:980px; height:1200px; margin:auto; margin-top: 20px;">
    	<table width="100%" height="30px" border="0px">
        	<tr>
            	<td width="35%">
                	<img src="/images/Logo.JPG" style="width:100%">
                </td>
                <td style="text-align:center; font-size:20px;font-family:'Khmer OS Muol Light';​ font-weight: bold; color: blue; ">
                	វិក្ក័យប័ត្រ<br /><br />
                   	<b>Invoice</b>Test
                </td>
                <td width="30%">
                </td>
            </tr>
        </table>
        <table width="100%" height="60px" border="0px" style="font-size: 11px;">
        	<tr>
            	<td width="70%">
                	<h5 style="line-height: 20px;">#S06, Street S, Toul Roka Village, Chak Angre Krom, Mean Chey <br />
                    District, Phnom Penh, Kingdom of Cambodia.<br /><br />
                    Contact No:   087/095 808 011</h5>
                </td>
                <td style="text-align:center;">
                	<br /><br />
               		<b>លេខវិក្ក័យប័ត្រ<br />
                    INVOICE NUMBER</b>
                </td>
            </tr>
        </table>
        <table class="table-bordered" width="30%" height="120px" border="1px" style="float:right; text-align:center; border-left: none;" cellspacing="0" cellpadding="0">
        	<tr>
            	<td width="100%" rowspan="3">
                	<b style="color: blue;">{{"CAM-CIN-". $po->id}}</b>
                </td>
            </tr>
            <tr>
            	<td style="border:none;"></td>
            </tr>
            <tr>
            	<td style="border:none;"></td>
            </tr>
            <tr>
            	<td style="border:none;">
                	ថ្ងៃ ខែ ឆ្នាំ ចេញវិក្ក័យប័ត្រ/Invoice Date
                </td>
            </tr>
            <tr>
            	<td>
                	{{Carbon\Carbon::parse($InvDate)->format('d-M-Y')}}
                </td>
            </tr>
        </table>
        <table width="69%" height="120px" border="1px" cellspacing="0">
        	<tr>
            	<td width="20%" style="border:none; margin-left: 50px">
                	ឈ្មោះអតិថិជន
                </td>
                <td width="5%" style="border:none;">
                	:
                </td>
                <td style="border:none;font-size:12px;font-family:'Khmer OS Muol Light'; color: blue;">
                	{{$po->customer->name}}
                </td>
            </tr>
            <tr>
            	<td style="border:none;">
                	អាស័យដ្ឋាន
                </td>
                <td style="border:none;">
                	:
                </td>
                <td style="border:none;">
                	{{"No. " . $po->customer->homeNo . ", St." . $po->customer->streetNo . ", " . $po->customer->village->name . ", " . $po->customer->village->commune->name . ", " . $po->customer->village->commune->district->name . ", " . $po->customer->village->commune->district->province->name . "."}}
                </td>
            </tr>
            <tr>
            	<td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
            </tr>
            <tr>
            	<td style="border:none;">
                	លេខទូរស័ព្ទ
                </td>
                <td style="border:none;">
                	:
                </td>
                <td style="border:none;">
                	{{$po->customer->contactNo}}
                </td>
            </tr>
            <tr>
            	<td style="border:none;">
                	ប្រភេទហាង
                </td>
                <td style="border:none;">
                	:
                </td>
                <td style="border:none;">
                    {{$po->customer->channel->name}}
                </td>
            </tr>
            <tr>
            	<td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
            </tr>
        </table>
        <table width="30%" height="100px" border="1px" style="float:right; text-align:center; margin-top: 10px; margin-right: 2px;">
        	<tr height="30px">
            	<td colspan="2" style="font-size:10px">
                	ប្រភេទរូបិយប័ណ្ណ/TYPE OF CURRENCY
                </td>
            </tr>
            <tr>
                <td>
                    1 ដុលារ
                </td>
            	<td>
                	<b>{{"៛ " . $rate}}</b>
                </td>
            </tr>
        </table>
        <table width="69%" height="100px" border="1px" cellpadding="0" cellspacing="0" style="text-align:center; margin-top: 10px;">
        	<tr>
            	<td>
                	លេខកូដអតិថិជន<br />
                    Customer ID Code
                </td>
                <td>
                	អ្នកចេញវិក្ក័យប័ត្រ<br />
                    Billing By
                </td>
            </tr>
            <tr>
            	<td>
                	<b>{{"CAM-CUS-" . $po->customer->id}}</b>
                </td>
                <td>
                	<b>{{$createdInv}}</b>
                </td>
            </tr>
        </table>
       <div style="min-height:600px; margin-top: 10px;">
       		<table class="table table-sm" border="1px" width="100%" cellpadding="0" cellspacing="0" style="text-align:center; font-size: 10px; line-height: 20px; margin-bottom: 0px">
            <thead>
                <tr>
                    <th width="5%" style="text-align: center;">
                        ល.រ<br />
                        No
                    </th>
                    <th width="25%" style="text-align: center;">
                        លេខវិក្ក័យប័ត្រ<br />
                        Invoice Number
                    </th>
                    <th width="18%" style="text-align: center;">
                        ថ្ងៃចេញវិក្ក័យប័ត្រ<br />
                        Invoice Date
                    </th>
                    <th width="18%" style="text-align: center;">
                        ចំនួនទឹកប្រាក់<br />
                        Amount
                    </th>
                    <th width="30%" style="text-align: center;">
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
                <tr>
                    <td>
                       {{$numRows = $n++}}
                    </td>
                    <td>
                    {{"CAM-IN-". $po->id}}
                    </td>
                    <td>
                       {{$po->poDate}}
                    </td>
                    <td style="text-align: left;">
                        {{$VgrandTotal}}
                    </td>
                    <td>
                    
                    </td>
                </tr>
                @for($i=$numRows+1; $i<=16; $i++)
                <tr style="height: 30px;">
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
            <tr>
            	<td style="border:none; text-align: left; font-weight: bold;">
                
                </td>
                <td style="border:none;">
                	
                </td>
                <td style="text-align: right; font-weight: bold;">
                    ប្រាក់ទូទាត់សរុប(ដុលារ):
                </td>
                <td style="text-align: right; font-weight: bold;">
                    {{"$ " . $VgrandTotal}}
                </td>
                <td style="font-weight: bold;">
                	
                </td>
            </tr>
            <tr>
                <td style="border:none; text-align: left; font-weight: bold;">
                
                </td>
                <td style="border:none;">
                    
                </td>
                <td style="text-align: right; font-weight: bold;">
                    ប្រាក់ទូទាត់សរុប(រៀល):
                </td>
                <td style="text-align: right; font-weight: bold;">
                    {{"៛​ " . $KHchange}}
                </td>
                <td style="font-weight: bold;">
                    
                </td>
            </tr>
        </table>
       </div>
        <table width="100%" style="height: 200px; text-align: center; margin-top: 15px;" border="0px">
        	<tr>
            	<td width="25%">
            		អ្នកទទួល<br />
                    Reciver
            	</td>
            	<td width="25%">
            		
            	</td>
                <td width="25%">
                	
                </td>
                <td width="25%">
                	អ្នកទូទាត់ប្រាក់<br />
                    Payer
                </td>
            </tr>
            <tr>
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
        <div style="font-size: 10px; line-height: 20px; margin-top: 20px; color: red;">
            <span> - អតិថិជនត្រូវត្រួតពិនិត្យនិងផ្ទៀងផ្ទាត់ចំនួន​ និងគុណភាពទំនិញអោយបានត្រឹមត្រូវ នៅពេលទទួលទំនិញ។ ទំនិញដែលទិញហើយមិនអាចដូរ​ ឫត្រឡប់វិញបានទេ។</span><br />
            <span> - អតិថិជនអាចធ្វើការទំនាក់ទំនងសួរ ឫផ្ដល់ពត៌មានមកក្រុមហ៊ុនដោយផ្ទល់តាមទូរស័ព្ទលេខ <b>(+855) 15 596 168</b> នៅរៀងរាល់ម៉ោងធ្វើការ ៕</span>
        </div>
    </div>
</body>
</html>
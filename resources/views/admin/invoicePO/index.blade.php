 @extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-files-o" aria-hidden="true"></i> All Invoices</h4>
    </div>
</div>
<div>
  @include('nav.message')
</div>
<div class="row">
    <input type="hidden" name="num" value="{{$id}}" id="paid">
    <div class="col-lg-3"><h5>Invoice Payment Status:</h5></div>
    <div class="col-lg-2">
        <div class="form-group {{ $errors->has('isPayment') ? ' has-error' : '' }}">
            {!!Form::select('isPayment', ['2'=>'New Invoice','1' => 'Invoice Paid', '0' => 'Invoice Unpaid'], null, ['class'=>'form-control isPayment'])!!}
            @if ($errors->has('isPayment'))
                <span class="help-block">
                   <strong>{{ $errors->first('isPayment') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row" id="myPopup">
    <a href="#" class="update_po" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" data-keyboard="false"  data-backdrop="static"></a>
</div>
<div class="showAll table-responsive">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
           All Invoices
        </div>
        <div class="panel-body">
           <table with="100%" id="example" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>InvoiceNumber</th>
                <th>InvoiceDate</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>CustomerName</th>
                <th>Channel</th>
                <th>SaleRepresentative</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pos as $details)
            <tr>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    <?php 
                        echo "CAM-IN-" . sprintf('%06d',$details->id);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{Carbon\Carbon::parse($details->invoiceDate)->format('d-M-Y')}}
                </td>
                 <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    <?php 
                        echo "$ " . number_format($details->totalAmount,2);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{$details->discount . " %"}}
                </td>
                    <?php 
                        if($details->customer_id==null){
                            echo "<td style='font-size: 11px; font-family: Khmer OS System; '>" . $details->user->nameDisplay . "</td>";
                            echo "<td style='font-size: 11px; font-family: Khmer OS System; text-align: center;'>" . $details->customer->channel->name . "</td>";
                            echo "<td style='font-size: 11px; font-family: Khmer OS System; '> SD </td>";
                        }else
                        {
                            echo "<td style='font-size: 11px; font-family: Khmer OS System;'>" . $details->customer->name . "</td>";
                            echo "<td style='font-size: 11px; font-family: Khmer OS System; text-align: center;'>" . $details->customer->channel->name . "</td>";
                            echo "<td style='font-size: 11px; font-family: Khmer OS System; '>" . $details->user->nameDisplay . "</td>";
                        }
                    ?>
                <td style="text-align: center;">
                    <a href="{{ route('invoicePO.show',$details->id)}}" class="btn btn-info btn-xs" title="Show Details"><i class="fa fa-indent" aria-hidden="true"></i></a>
                    <form action="{{ route('invoicePO.destroy',$details->id) }}" method="POST" style="display: inline;" onsubmit="{ return true } else {return false };">
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
	
        		var el = document.querySelector('.showAll');
        		var doc = el.innerHTML;
        		//alert('Message showAll: ' + doc);
        		el.innerHTML = el.innerHTML.replace(/&nbsp;/g,'');
	
			}

		</script>
        </tbody>
    </table>
        </div>
        </div>
    </div>
</div>
</div>
<div hidden class="paid table-responsive">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
           All Invoices Paid
        </div>
        <div class="panel-body">
           <table with="100%" id="example1" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>InvoiceNumber</th>
                <th>InvoiceDate</th>
		<th>PaidDate</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>CustomerName</th>
                <th>Channel</th>
                <th>SaleRepresentative</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paids as $paid)
            <tr>
                <td style="font-size: 11px; font-family: 'Khmer OS System';text-align: center;">
                    <?php 
                        echo "CAM-IN-" . sprintf('%06d',$paid->id);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{Carbon\Carbon::parse($paid->invoiceDate)->format('d-M-Y')}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                @if($paid->paidDate!=null)
                    {{Carbon\Carbon::parse($paid->paidDate)->format('d-M-Y')}}
                @endif
                @if($paid->paidDate==null)
                	
                @endif
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    <?php 
                        echo "$ " . number_format($paid->totalAmount,2);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{$paid->discount . " %"}}
                </td>
                <?php 
                    if($paid->customer_id==null){
                        echo "<td style='font-size: 11px; font-family: Khmer OS System;'>" . $paid->user->nameDisplay . "</td>";
                        echo "<td style='font-size: 11px; font-family: Khmer OS System;' text-align: center;>" . $paid->customer->channel->name . "</td>";
                        echo "<td style='font-size: 11px; font-family: Khmer OS System;'> SD </td>";
                    }else
                    {
                        echo "<td style='font-size: 11px; font-family: Khmer OS System;'>" . $paid->customer->name . "</td>";
                        echo "<td style='font-size: 11px; font-family: Khmer OS System;text-align: center;'>" . $paid->customer->channel->name . "</td>";
                        echo "<td style='font-size: 11px; font-family: Khmer OS System;'>" . $paid->user->nameDisplay . "</td>";
                    }
                ?>
                <td style="text-align: center;">
                    <a href="{{ route('invoicePO.show',$paid->id)}}" class="btn btn-info btn-xs" title="Show Details"><i class="fa fa-indent" aria-hidden="true"></i></a>
                    <form action="{{ route('invoicePO.destroy',$paid->id) }}" method="POST" style="display: inline;" onsubmit="{ return true } else {return false };">
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
	
        		var el = document.querySelector('.paid ');
        		var doc = el.innerHTML;
        		//alert('Message paid : ' + doc);
        		el.innerHTML = el.innerHTML.replace(/&nbsp;/g,'');
	
			}

		</script>
        </tbody>
    </table>
	</div>
        </div>
    </div>
</div>
</div>
<div class="row" id="myPopup2">
    <a href="#" class="update_cradit" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo" data-keyboard="false"  data-backdrop="static"></a>
</div>
<div hidden class="cradit table-responsive">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
           All Invoices UnPaid
        </div>
        <div class="panel-body">
           <table with="100%" id="example2" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>InvoiceNumber</th>
                <th>InvoiceDate</th>
                <th>TotalAmount</th>
                <th>Discount</th>
                <th>CustomerName</th>
                <th>Channel</th>
                <th>SaleRepresentative</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cradits as $cradit)
            <tr>
                 <td style="font-size: 11px; font-family: 'Khmer OS System';text-align: center;">
                    <?php 
                        echo "CAM-IN-" . sprintf('%06d',$cradit->id);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{Carbon\Carbon::parse($cradit->invoiceDate)->format('d-M-Y')}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    <?php 
                        echo "$ " . number_format($cradit->totalAmount,2);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{$cradit->discount . " %"}}</td>
                <?php 
                        if($cradit->customer_id==null){
                            echo "<td style='font-size: 11px; font-family: Khmer OS System;'>" . $cradit->user->nameDisplay . "</td>";
                            echo "<td style='font-size: 11px; font-family: Khmer OS System;text-align: center;'>" . $cradit->customer->channel->name . "</td>";
                            echo "<td style='font-size: 11px; font-family: Khmer OS System;'> SD </td>";
                        }else
                        {
                            echo "<td style='font-size: 11px; font-family: Khmer OS System;'>" . $cradit->customer->name . "</td>";
                            echo "<td style='font-size: 11px; font-family: Khmer OS System text-align: center;'>" . $cradit->customer->channel->name . "</td>";
                            echo "<td style='font-size: 11px; font-family: Khmer OS System;'>" . $cradit->user->nameDisplay . "</td>";
                        }
                    ?>
                <td style="text-align: center;">
                    <a href="{{ url('admin/details',$cradit->id)}}" class="btn btn-info btn-xs" title="Show Details"><i class="fa fa-indent" aria-hidden="true"></i></a>
                </td>
            </tr>
            @endforeach
            <script type="text/javascript">

		RemoveSpace();
		function RemoveSpace(){
	
        		var el = document.querySelector('.cradit');
        		var doc = el.innerHTML;
        		//alert('Message cradit  : ' + doc);
        		el.innerHTML = el.innerHTML.replace(/&nbsp;/g,'');
	
			}

		</script>
        </tbody>
    </table>
        </div>
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
    $(document).ready(function() {
         $('#example1').DataTable({
            "aaSorting": [[ 0, "desc" ]]
        });
    });
    $(document).ready(function() {
         $('#example2').DataTable({
           "aaSorting": [[ 0, "desc" ]]
        });
    });
    $(document).ready(function() {
         var oTable = $('#example').DataTable();
        $('#example tbody').on('click', 'tr', function () {
        console.log( oTable.row( this ).data() );
        var data = oTable.row( this ).data();         
        var s = data[0];
        s = s.replace(/\./g,'').replace('CAM-IN-','0');
        var test = $("#example").DataTable().row(this).data();
        var i = parseInt(s);
        $(".update_po").click();
        getPopupEditPO(i);
    });
    });
    function getPopupEditPO(id){
        $.ajax({
            type:'get',
            url:"{{url('/getPopupEditPO/')}}"+"/"+id,
            dataType:'html',
            success:function(data){
                $("#myPopup").append(data);
            },
            error:function(e){

            }
        });
    }
    //---------------------------example2-----------------------------------
     $(document).ready(function() {
         var table = $('#example2').DataTable();
    $('#example2 tbody').on('click', 'tr', function () {
        console.log( table.row( this ).data() );
        var data = table.row( this ).data();         
        var s = data[0];
        s = s.replace(/\./g,'').replace('CAM-IN-','0');
        var test = $("#example2").DataTable().row(this).data();
        var i = parseInt(s);
        $(".update_cradit").click();
        getPopupEditCradit(i);
    });
    });
    
    //----------------------------------------------------------------------
    function getPopupEditCradit(id){
        $.ajax({
            type:'get',
            url:"{{url('/getPopupEditCradit/')}}"+"/"+id,
            dataType:'html',
            success:function(data){
                $("#myPopup2").append(data);
                $('.change').on('change',function(e){
                      var change= $(this).val();
                      console.log(change);
                      $('.get').val(change);
                  });
            },
            error:function(e){

            }
        });
    }
    
    //-------------------------------end------------------------
    $(document).on('change','.isPayment',function(e){
    var select = $(this).val();
      console.log(select);
      if(select==2){
        $('.showAll').show();
        $('.paid').hide();
        $('.cradit').hide();
      }
      else if(select==1){
         $('.paid').show();
         $('.showAll').hide();
         $('.cradit').hide();
      }else if(select==0){
        $('.cradit').show();
        $('.paid').hide();
        $('.showAll').hide();
      }else{
        //
      }
});
    $(window).load(function(){
       var num =  $('#paid').val();
        $('.isPayment').val(num);
        if(num==2){
            $('.showAll').show();
            $('.paid').hide();
            $('.cradit').hide();
        }else if(num==1){
            $('.paid').show();
            $('.showAll').hide();
            $('.cradit').hide();
        }else if(num==0){
            $('.cradit').show();
            $('.paid').hide();
            $('.showAll').hide();
        }else{
            //
        }
    });
</script>
@stop
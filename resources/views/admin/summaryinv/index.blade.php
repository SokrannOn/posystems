 @extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-list-alt" aria-hidden="true"></i>  All Summary Invoice</h4>
    </div>
</div>
<div>
  @include('nav.message')
</div>
<a href="{{ route('summaryInvs.create')}}" class="btn btn-primary btn-sm" > Create invoice </a>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
           All Summary Invoices
        </div>
        <div class="panel-body">
       <table with="100%" id="example" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Rate</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($smis as $smi)
            <tr>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    <?php 
                        echo "CAM-CIN-" . sprintf('%06d',$smi->id);
                    ?>
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{Carbon\Carbon::parse($smi->smiDate)->format('d-M-Y')}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$smi->customer->name}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$smi->rate . " ៛"}}
                </td>
                <td>
                 <a href="{{ route('summaryInv.show',$smi->id)}}" class="btn btn-info btn-xs" title="Show Details"><i class="fa fa-indent" aria-hidden="true"></i></a>
                <form action="{{ route('summaryInv.destroy',$smi->id) }}" method="POST" style="display: inline;" onsubmit="{ return true } else {return false };">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button title="Print Preview" type="submit" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></button>
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
            responsive: true
        });
    });
</script>
@stop
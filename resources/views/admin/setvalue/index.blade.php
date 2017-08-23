 @extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-fw f fa-money"></i> Set Value</h4>
    </div>
                <!-- /.col-lg-12 -->
</div>
<div>
  @include('nav.message')
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default table-responsive">
            <div class="panel-heading">
           All Set Values
        </div>
        <div class="panel-body">
       <table with="100%" id="example" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Value</th>
                <th>Desription</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php $no=1;?>
        <tbody>
            @foreach($setvalues as $setvalues)
            <tr>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{$no++}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$setvalues->name}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                    {{$setvalues->value}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$setvalues->description}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;"><?php
                        if($setvalues->status==1){
                            echo "<div style='color:green'>Activated</div>";
                        }else{
                            echo "<div style='color:red'>Disactivated</div>";
                        }
                    ?>    
                </td>
                <td style="text-align: center;">
                    <a href="{{ route('setValues.edit',$setvalues->id)}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('setValues.destroy', $setvalues->id) }}" method="POST" style="display: inline;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @if($setvalues->status==1)
                                <button type="submit" class="btn btn-danger btn-xs" title="Disactivate"><i class="fa fa-ban fa-xs"></i></button>
                                @endif
                                @if($setvalues->status==0)
                                <button hidden type="submit" class="btn btn-success btn-xs" title="Activate"><i class="fa fa-check"></i></button>
                                @endif
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
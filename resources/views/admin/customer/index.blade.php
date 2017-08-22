 @extends('layouts.admin')
@section('content')
@include('include.cusPopUp')
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"><i class="fa fa-user" aria-hidden="true"></i> Customer</h4>
    </div>
</div>
<div>
  @include('nav.message')
</div>
<div class="row">
    <div class="col-lg-12">
        <button title="Add New"  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
           All Customers
        </div>
        <div class="panel-body">
        
       <table with="100%" id="example" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Channel</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php $no=1;?>
        <tbody>
            @foreach($customer as $customer)
            <tr>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">{{$no++}}</td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';"> 
                    {{$customer->name}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{$customer->contactNo}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">  
                    {{$customer->channel->name}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                    {{"No." . 
                    $customer->homeNo . ", St." . 
                    $customer->streetNo . ", " . 
                    $customer->village->name . ", " . 
                    $customer->village->commune->name . ", " . 
                    $customer->village->commune->district->name . ", " . 
                    $customer->village->commune->district->province->name . "." . " ( " . $customer->location . " )"}}
                </td>
                <td style="text-align: center;">
                    <a href="{{ route('customers.edit',$customer->id)}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                    @if(Auth::user()->position->name != 'Sale')
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Are you sure you want to delete?')) { return true } else {return false };">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button title="Delete" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </form>
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
            responsive: true
        });
    });
    $(document).ready(function() {
  $('.province_id').on('change',function(e){
     var f =document.getElementById("dis_id");
     var province = $(this).val();
     if(province ==''){
     	$('.district_id').val('');
     }
     var url = "{{url('/getProvince')}}"+"/";
     console.log(province);
     getValueCombo(province,url,f);
  });
   $('.district_id').on('change',function(e){
     var f =document.getElementById("com_id");
     var district = $(this).val();
     if(district ==''){
     	$('.commune_id').val('');
     }
     var url = "{{url('/getDistrict')}}"+"/";
     console.log(district);
     getValueCombo(district,url,f);
  });
   $('.commune_id').on('change',function(e){
     var f =document.getElementById("vil_id");
     var commune = $(this).val();
     if(commune ==''){
     	$('.village_id').val('');
     }
     var url = "{{url('/getCommune')}}"+"/";
     console.log(commune);
     getValueCombo(commune,url,f);
  });
});
//-------------------------------------
function getValueCombo(id,ul,f)
{
   $.ajax({
    method: 'GET',
      url: ul+id,
      success:function(response){
        if(Array.isArray(response)){

            $(f).empty();
            var serialnumber="<option value=''>---Please select option---</option>";
            $(f).append(serialnumber);
            response.map(function(item){
              console.log(item.name);
              serialnumber="<option value=" + item.id + ">" + item.name + "</option>";;
              $(f).append(serialnumber);
            });
        }
      },
      error:function(error){
        console.log(error);
      }
   })
};
 //---------------------------
</script>
@stop
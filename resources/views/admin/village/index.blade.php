 @extends('layouts.admin')
@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #117A65; color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-fw fa-home"></i> New Village</h4>
          </div>
            <div class="modal-body">
             <div class="row">
              <div class="col-lg-12">
                {!!Form::open(['action'=>'VillageController@store','method'=>'POST'])!!}
                  {{csrf_field()}}
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                {!!Form::label('name','Village Name : ',[])!!}
                                {!!Form::text('name',null,['class'=>'form-control','required'=>'true'])!!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                           <div class="form-group {{ $errors->has('commune_id') ? ' has-error' : '' }}">
                            {!!Form::label('commune_id','Commune Name :',[])!!}
                            {!!Form::select('commune_id',[null=>'---Please select a commune---']+$communes,null,['class'=>'form-control','required'=>'true'])!!}
                            @if ($errors->has('commune_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('commune_id') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                      </div>
                <div class="modal-footer" style="background-color: #117A65;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"> Create </button>
               </div>
            {!!Form::close()!!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-lg-12">                
        <h4 class="page-header"> <i class="fa fa-fw fa-home"></i> Villages</h4>
    </div>
</div>
<div>
  @include('nav.message')
</div>

<div class="row">
    <div class="col-lg-12">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
           All Villages
        </div>
        <div class="panel-body">
       <table with="100%" id="example" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Commune Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php $no=1;?>
        <tbody>
            @foreach($village as $village)
            
            <tr>
                <td>{{$no++}}</td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                  {{$village->name}}
                </td>
                <td style="font-size: 11px; font-family: 'Khmer OS System';">
                  {{$village->commune->name}}
                </td>
                <td style="text-align: center;">
                    <a href="{{ route('villages.edit',$village->id)}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('villages.destroy', $village->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Are you sure you want to delete?')) { return true } else {return false };">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button title="Delete" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
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
        
        //var el = document.querySelector('.panel');
        //var doc = el.innerHTML;
        //alert('Message : ' + doc);
        //el.innerHTML = el.innerHTML.replace(/&nbsp;/g,'');
           
    });
    
</script>
@stop
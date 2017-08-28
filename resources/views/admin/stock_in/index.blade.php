@extends('layouts.admin')
@section('content')
    <div>
        @include('nav.message')
    </div>
    <div class="container-fluid">
        <br>
        <div class="panel panel-default">
            {{--Create Users--}}
            <div class="panel-heading">
                Stock Import
            </div>
            <div class="panel panel-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table">

                                <br>
                                <table id="example" class="table table-bordered " style="border-radius: 5px;">
                                <thead>
                                    <tr>
                                        <th class="font" style="text-align: center;">No</th>
                                        <th class="font" style="text-align: center;">Import Date</th>
                                        <th class="font" style="text-align: center;">Invoice Date</th>
                                        <th class="font" style="text-align: center;">Invoice Numbers</th>
                                        <th class="font" style="text-align: center;">Supplier</th>
                                        <th class="font" style="width:10%; text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach($import as $re)
                                        <tr>
                                            <td style="text-align: center;">{{$i++}}</td>
                                            <td style="text-align: center;">{{$re->impDate}}</td>
                                            <td style="text-align: center;">{{$re->invoiceDate}}</td>
                                            <td style="text-align: center;">{{$re->invoiceNumber}}</td>
                                            <td style="text-align: center;">{{$re->supplier->companyname}}</td>
                                            <td style="text-align: center;"><a href="#" onclick="testing(this.id)" id="{{$re->id}}"><i class="fa fa-outdent" data-toggle="modal" data-target="#myModal"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                            <a href="{{url('admin/dashbords')}}" class="btn btn-danger btn-sm">Close</a>
                        </div>
                        {{--Modal view import detail--}}
                    <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                        </div>

                        {{--End model view import detail--}}


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
       
        });
    });
            function testing(id) {
                $.ajax({
                    type:'get',
                    url: "{{url('/admin/stock')}}"+"/"+id,
                    dataType:'html',
                    success:function (data) {
                        $("#myModal").html(data);
                    },
                    error:function (error) {
                        console.log(error);
                    }

                });
            }
        </script>
@stop
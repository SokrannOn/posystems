<div class="row">
    <div class="col-lg-12">
        <div class="table table-responsive">
            <table class="table table-bordered" style="border-radius: 5px;">
                @if($tmpSelect->count())
                    <tr>
                        <th class="font" style="text-align: center;">No</th>
                        <th class="font">Product Name</th>
                        <th class="font" style="text-align: center;">Quantities</th>
                        <th class="font" style="text-align: center;">Manufactured Date</th>
                        <th class="font" style="text-align: center;">Expired Date</th>
                        <th class="font" style="width:10%; text-align: center;">Action</th>
                    </tr>
                    <?php $i=1;?>
                        @foreach($tmpSelect as $row)
                        <tr>
                            <td style="text-align: center;">{{$i++}}</td>
                            <td>{{$row->product->name}}</td>
                            <td style="text-align: center;">{{$row->qty}}</td>
                            <td style="text-align: center;">{{Carbon\Carbon::parse($row->mfd)->format('d-M-Y')}}</td>
                            <td style="text-align: center;">{{\Carbon\Carbon::parse($row->expd)->format('d-M-Y')}}</td>
                            <td style="text-align: center;"><a onclick="deleteRecord(this.id)" id="{{$row->product_id}}" class="btn btn-danger btn-xs">Remove</a></td>
                        </tr>
                        @endforeach
                @else
                        <h4>No Record </h4>
                @endif
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        @if($tmpSelect->count())
            <input type="submit" class="btn btn-primary btn-sm" value="Save Record">
            <input type="button" class="btn btn-danger btn-sm" value="Discard" onclick="discardRecord()">
        @endif
    </div>
</div>
{{--</div>{{Carbon\Carbon::parse($pocus->poDate)->format('d-M-Y')}}--}}
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Import Details Date : {{\Carbon\Carbon::parse($importId->impDate)->format('d-M-Y')}}</h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th style="text-align: center;">Product ID</th>
                        <th style="text-align: center;">Quantities</th>
                        <th style="text-align: center;">Manufactured Date</th>
                        <th style="text-align: center;">Expired Date</th>
                    </tr>
                    @foreach($importId->products as $id)
                    <tr>
                        <td style="text-align: center;">{{$id->id}}</td>
                        <td style="text-align: center;">{{$id->pivot->qty}}</td>
                        <td style="text-align: center;">{{\Carbon\Carbon::parse($id->pivot->mfd)->format('d-M-Y')}}</td>
                        <td style="text-align: center;">{{\Carbon\Carbon::parse($id->pivot->expd)->format('d-M-Y')}}</td>
                    </tr>
                   @endforeach
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
             
              <table class="table table-responsive table-bordered table-striped" cellspacing="0">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Product Name</th>
                          <th>Qty</th>
                          <th>UnitPrice</th>
                          <th>Amount</th>
                          <th>action</th>
                      </tr>
                  </thead>
                  <?php $no=1;?>
                  <tbody>
                      @foreach($tmpdata as $tmppo)
                      <tr id="{{$tmppo->id}}">
                          <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">{{$no++}}</td>
                          <td style="font-size: 11px; font-family: 'Khmer OS System';">
                            {{$tmppo->product->name}}
                          </td>
                          <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                            {{$tmppo->qty}}
                          </td>
                          <td style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                            <?php 
                                echo "$ " . number_format($tmppo->unitPrice,2);
                            ?>
                          </td>
                          <td width="150px" style="font-size: 11px; font-family: 'Khmer OS System'; text-align: center;">
                            <?php 
                                echo "$ " . number_format($tmppo->amount,2);
                            ?>
                          </td>
                          <td width="150px" style="text-align: center;">
                            <button class="btn btn-danger fa fa-remove btn-xs poid" type="button" onclick="removeOrderSD({{$tmppo->id}})"> Remove</button>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>

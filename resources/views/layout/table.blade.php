<div class="table-responsive">
<table class="table table-hover mt-3 table-white ">
    <thead style="background-color: #fcfcfc">
      <tr class="text-center">
        <th scope="col">CASHIER</th>
        <th scope="col">BARCODE</th>
        <th scope="col">NAME</th>
        <th scope="col">PRICE</th>
        <th scope="col">PRICE AT</th>
        <th scope="col">EXPIRE DATE</th>
        <th scope="col">CREATED AT</th>
        <th scope="col">SOLD AT</th>
        <th scope="col">PIECE</th>
        @if (Request::segment(1) != 'seller')
        <th scope="col">UNDO</th>
        @endif
        
      </tr>
    </thead>
    <tbody>
        @foreach ($sold as $sol)
        <tr class="text-center"> 
        <td>{{$sol->cashierr->name}}</td>
        <td>@if ($sol->oneStock->type == 0)
          {!!DNS1D::getBarcodeSVG("$sol->id", 'EAN13',1,25,'dark',true)!!}
          @else
          {!!DNS2D::getBarcodeSVG("$sol->id", 'QRCODE',1,1,'dark')!!}
          @endif</td>
        <td>{{$sol->oneStock->name}}</td>
        <td>{{number_format($sol->oneStock->price,0,',',',')}} IQD</td>
        <td> {{number_format($sol->price_at,0,',',',')}} IQD</td>
        <td>{{$sol->oneStock->expire_date}}</td>
        <td><small>{{$sol->oneStock->created_at}}</small></td>
        <td><small>{{$sol->created_at}}</small></td>
        <td>{{$sol->piece}}</td>
        @if (Request::segment(1) != 'seller')
        <td class="btn btn-warning rounded-0 text-white" onclick="undo(`{{$sol->id}}`)"><i class="ion-backspace-outline"></i></td>
        @endif
      </tr>
        @endforeach
    </tbody>
  </table>
</div>
<div class="row justify-content-center">
    
    @foreach ($stocks as $stock)
    
        <div class="card text-left   m-1" style="max-width: 10rem;">
            @if ($stock->is_debt ==1)
            <span class="btn btn-sm text-warning rounded-0 shadow-none" style="position: absolute; left:0px;top:0px;" ><i style="font-size: 200%" class=" ion-ios-lightbulb"></i></span>
            @else
            <span class="btn btn-sm text-secondary rounded-0 shadow-none" style="position: absolute; left:0px;top:0px;" ><i style="font-size: 200%" class=" ion-ios-lightbulb"></i></span>
            @endif
            
            <div class=" text-center mt-3" style="min-height:30px;">
                @if ($stock->type == 0)
                    {!!DNS1D::getBarcodeSVG("$stock->id", 'C128',1,40,'dark',false)!!}
                @else
                {!!DNS2D::getBarcodeSVG("$stock->id", 'QRCODE',2,2)!!}
                @endif
        </div>
            <div class="card-body ml--3 mt--2 ">
               @if (Str::length($stock->id)<13)
               <small class="card-title"><b>Code:</b> {{$stock->id}}</small><br>
               @else
               <small class="card-title"><b>Code:</b><small>{{$stock->id}}</small> </small><br>
               @endif
                <small class="card-title"><b>Name:</b> {{$stock->name}}</small><br>
                <small class="card-title"><b>Supplier:</b>  {{$stock->one_supplier->company_name}}</small><br>
                <small class="card-title"><b>Count: </b> {{$stock->count}}</small><br>
                <small class="card-title"><b>Price: </b> {{number_format($stock->price,0,',',',')}} IQD</small><br>
                <small class="card-title"><b>Expire:</b> {{$stock->expire_date}}</small><br>
                <small class="card-title font-weight-bold" style="font-size: 12px">CreateAt: </small><small> {{Str::limit($stock->created_at, 10,"")}}</small><br>   
            </div>
            <div class="col text-center mt--3">
                <span class="btn btn-sm rounded-0 text-primary text-center shadow-none" data-toggle="modal" data-target="#edit{{$stock->id}}"><i class="ion-edit text-center" style="font-size: 170%;"></i></span>
                <span class="btn btn-sm rounded-0 text-danger text-center shadow-none" data-toggle="modal" data-target="#delete{{$stock->id}}"><i class="ion-ios-trash text-center" style="font-size: 200%;"></i></span>  
            </div>
        </div>      
        <!--Modal Delete -->
        <div class="modal fade text-center" id="delete{{$stock->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-body">
                        <span> Do You Want Delete {{$stock->name}} ?</span>
                        <form action="buy/1/{{$stock->id}}" method="POST">
                            @csrf
                            <button class="btn btn-azure-secondary w-75 rounded-0 text-danger mt-3">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal Edit -->
        <div class="modal fade" id="edit{{$stock->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-0">
                    <div class="modal-body">
                        <form action="buy/2/{{$stock->id}}" method="POST">
                            @csrf
                            <div class="row mt-3 justify-content-center">
                                <div class="col text-center col-lg-5 col-12 mt-3">
                                    <label class=" text-darker">Barcode Stocks</label>
                                    <input name="id" value="{{$stock->id}}" type="text"placeholder="Barcode Stocks"class=" form-control rounded-0 border-azure">
                                </div>
                                <div class="col text-center col-lg-5 col-12 mt-3">
                                    <label class=" text-darker">Name Stocks</label>
                                    <input name="name" value="{{$stock->name}}" type="text"placeholder="Name Stocks"class=" form-control rounded-0 border-azure">
                                </div>
                                <div class="col text-center col-lg-5 col-12 mt-3">
                                    <label class=" text-darker">Supplier</label>
                                    <select name="supplier_id" id="" class="form-control rounded-0 border-azure" required>
                                    <option value="{{$stock->supplier_id}}">{{$stock->one_supplier->company_name}}</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->company_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col text-center col-lg-5 col-12 mt-3">
                                    <label class=" text-darker">Count</label>
                                    <input name="count" value="{{$stock->count}}" type="number"placeholder="Count"class=" form-control rounded-0 border-azure">
                                </div>
                                <div class="col text-center col-lg-5 col-12 mt-3">
                                    <label class=" text-darker">Price</label>
                                    <input name="price" value="{{$stock->price}}" type="number"placeholder="Price"class=" form-control rounded-0 border-azure">
                                </div>
                                <div class="col text-center col-lg-5 col-12 mt-3">
                                    <label class="text-darker">Expire Date</label>
                                    <input name="expire_date" value="{{$stock->expire_date}}" type="date"class="form-control rounded-0 border-azure">
                                </div>
                                <div class="col text-center col-lg-5 col-12 mt-3">
                                    <label class=" text-darker">Is debt</label>
                                    <select name="is_debt" value="{{$stock->is_debt}}" id="" class="form-control rounded-0 border-azure" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="col text-center col-lg-5 col-12 mt-3">
                                    <label class=" text-darker">Type</label>
                                    <select name="type" value="{{$stock->is_debt}}" id="" class="form-control rounded-0 border-azure" required>
                                        <option value="0">Barcode</option>
                                        <option value="1">QRcode</option>
                                    </select>
                                </div>
                                <button style="background-color:#025091;"class=" text-white btn rounded-0 mt-5 border-white">Update Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        
      @endforeach
</div>
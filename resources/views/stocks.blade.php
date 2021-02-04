@extends('layout.nav')
@section('content')
<div class="container">
    <br>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning rounded-0">{{$error}}
                <button type="button" class="close text-white" onclick="hid()" data-dismiss="alert">x</button>
            </div>
        @endforeach
    @endif
    @if (session('result'))
        <div class="alert alert-success rounded-0">{{session('result')}}
            <button type="button" class="close text-white" onclick="hid()" data-dismiss="alert">x</button>
        </div>
    @endif

    <form action="/buy/0/0" method="POST" class=" text-center">
        @csrf
        <div class="row mt-3 justify-content-center">
            <div class="col text-center col-lg-4 col-12 mt-2">
                <label class=" text-white">Barcode Stocks</label>
                <input name="id" type="text"placeholder="Barcode Stocks"class=" form-control   rounded-0 border-0">
            </div>
            <div class="col text-center col-lg-4 col-12 mt-2">
                <label class=" text-white">Name Stocks</label>
                <input name="name" type="text"placeholder="Name Stocks"class=" form-control   rounded-0 border-0">
            </div>
            <div class="col text-center col-lg-4 col-12 mt-2">
                <label class=" text-white">Supplier</label>
            <select name="supplier_id" id="" class="form-control rounded-0 border-0" required>
                @foreach ($suppliers as $supplier)
                <option value="{{$supplier->id}}">{{$supplier->company_name}}</option>
                @endforeach
            </select>
            </div>
            <div class="col text-center col-lg-4 col-12 mt-2">
                <label class=" text-white">Count</label>
                <input name="count" type="number"placeholder="Count"class=" form-control   rounded-0 border-0">
            </div>
            <div class="col text-center col-lg-4 col-12 mt-2">
                <label class=" text-white">Price</label>
                <input name="price" type="number"placeholder="Price"class=" form-control   rounded-0 border-0">
            </div>
            <div class="col text-center col-lg-4 col-12 mt-2">
                <label class="text-white">Expire Date</label>
                <input name="expire_date" type="date"class="form-control rounded-0 border-0">
            </div>
            <div class="col text-center col-lg-4 col-12 mt-2">
                <label class=" text-white">Is debt</label>
            <select name="is_debt" id="" class="form-control rounded-0 border-0" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            </div>
            <div class="col text-center col-lg-4 col-12 mt-2">
                <label class=" text-white">Type</label>
            <select name="type" id="" class="form-control rounded-0 border-0" required>
                <option value="0">Barcode</option>
                <option value="1">QRcode</option>
            </select>
            </div>
            
        </div>
        <button style="background-color:#025091;"class=" text-white btn rounded-0 mt-4 border-white">Buy New Item</button>
    </form>
    <hr>
    @include('layout.card')
    <div class="d-flex justify-content-center mt-4">
        {{$stocks->links('pagination::simple-tailwind')}};
    </div>
</div>

@endsection
@extends('layout.nav')
@section('content') 
<div class = "container" >
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
    <form action="/casher" method="POST" class=" text-center">
        @csrf
        <div class="row mt-3 justify-content-center">
            <div class="col text-center col-lg-5 col-12 mt-3">
                <label class=" text-white">Name Cashier</label>
                <input name="name" type="text"placeholder="Name Cashier"class=" form-control   rounded-0 border-0">
            </div>
                <div class="col text-center col-lg-5 col-12 mt-3">
                    <label class=" text-white">Email Cashier</label>
                    <input name="email" type="email"placeholder="Email Cashier"class=" form-control   rounded-0 border-0">
                </div>
                    <div class="col text-center col-lg-5 col-12 mt-3">
                        <label class=" text-white">Password Cashier</label>
                        <input name="password" type="password"placeholder="Password Cashier"class=" form-control   rounded-0 border-0">
                    </div>
                        <div class="col text-center col-lg-5 col-12 mt-3">
                            <label class=" text-white">Rule Cashier</label>
                            <select name="rule" class=" form-control   rounded-0 border-0">
                                <option value="0">Cashier</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
        </div>
        <button style="background-color:#025091;"class=" text-white btn rounded-0 mt-5 border-white">Add new Cashier</button>
    </form>
    <hr>
    <div class="row justify-content-center">
        @foreach ($cashiers as $cashier)
        <div class="card text-center rounded-0 m-2" style="width: 13rem;">
            <i class="ion-person" style="font-size: 100px;color:#0165b6;"></i>
            <div class="card-body">
              <small class="card-title">Name: {{$cashier->name}}</small><br>
              <small class="card-title">Email: {{$cashier->email}}</small><br>
              <small class="card-title">Rule: {{$cashier->rule == 1 ? "Admin" : "Cashier"}}</small><br>
              </div>
          </div>
          @endforeach
    </div>
</div>
<script>
    function hid(){
        $(".container .alert").hide();
    }
</script>
@endsection
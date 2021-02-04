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
<form action="/supplier/0/0" method="POST" class=" text-center">
    @csrf
    <div class="row mt-3 justify-content-center">
        <div class="col text-center col-lg-5 col-12 mt-3">
            <label class=" text-white">Name Supplier</label>
            <input name="name" type="text"placeholder="Name Supplier"class=" form-control   rounded-0 border-0">
        </div>
            <div class="col text-center col-lg-5 col-12 mt-3">
                <label class=" text-white">Email Supplier</label>
                <input name="email" type="email"placeholder="Email Supplier"class=" form-control   rounded-0 border-0">
            </div>
                <div class="col text-center col-lg-5 col-12 mt-3">
                    <label class=" text-white">Address Supplier</label>
                    <input name="address" type="text"placeholder="Address Supplier"class=" form-control   rounded-0 border-0">
                </div>
                <div class="col text-center col-lg-5 col-12 mt-3">
                    <label class=" text-white">Phone Number Supplier</label>
                    <input name="phonenumber" type="text"placeholder="Phone Number Supplier"class=" form-control   rounded-0 border-0">
                </div>
                    
    </div>
    <button style="background-color:#025091;"class=" text-white btn rounded-0 mt-5 border-white">Add new Supplier</button>
</form>
<hr>
    <div class="row justify-content-center">
        @foreach ($supplier as $sup)
        <div class="card text-center rounded-0 m-1" style="max-width: 12rem;">
            <i class="ion-android-bus" style="font-size: 350%;color:#0165b6;"></i>
            <div class="card-body">
                <div class="table-responsive ml--3" style="width: 125%">
                <table class="table table-striped table-sm" >
                    <tbody>
                      <tr>
                        <td>Name:</td><td >{{$sup->company_name}}</td>
                      </tr>
                      <tr>
                        <td>Email:</td><td>{{$sup->email}}</td>
                      </tr>
                      <tr>
                        <td>Address:</td><td>{{$sup->address}}</td>
                      </tr>
                      <tr>
                        <td>Mobile:</td><td>{{$sup->phonenumber}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                  <br>
              <span class="btn btn-azure-secondary btn-sm rounded-0 text-primary" data-toggle="modal" data-target="#edit{{$sup->id}}">Edit</span>
              <span class="btn btn-azure-secondary btn-sm rounded-0 text-danger" data-toggle="modal" data-target="#delete{{$sup->id}}">Delete</span>  
            </div>
            <!--Modal Delete -->
            <div class="modal fade" id="delete{{$sup->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-0">
                        <div class="modal-body">
                            <span> Do You Want Delete {{$sup->company_name}} ?</span>
                            <form action="supplier/1/{{$sup->id}}" method="POST">
                                @csrf
                                <button class="btn btn-azure-secondary w-75 rounded-0 text-danger mt-3">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal Edit -->
            <div class="modal fade" id="edit{{$sup->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-0">
                        <div class="modal-body">
                            <form action="supplier/2/{{$sup->id}}" method="POST">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col text-center col-12 mt-3">
                                        <label class=" text-darker">Name Supplier</label>
                                        <input name="name" type="text"placeholder="Name Supplier" value="{{$sup->company_name}}" class=" form-control rounded-0 border-azure ">
                                    </div>
                                        <div class="col text-center col-12 mt-3">
                                            <label class="text-darker">Email Supplier</label>
                                            <input name="email" type="email"placeholder="Email Supplier" value="{{$sup->email}}" class="form-control rounded-0 border-azure ">
                                        </div>
                                            <div class="col text-center col-12 mt-3">
                                                <label class="text-darker">Address Supplier</label>
                                                <input name="address" type="text"placeholder="Address Supplier" value="{{$sup->address}}" class=" form-control rounded-0 border-azure ">
                                            </div>
                                            <div class="col text-center col-12 mt-3">
                                                <label class="text-darker">Phone Number Supplier</label>
                                                <input name="phonenumber" type="text"placeholder="Phone Number Supplier" value="{{$sup->phonenumber}}" class=" form-control rounded-0 border-azure ">
                                            </div>
                                                
                                </div>
                                <button style="background-color:#025091;"class=" text-white btn rounded-0 mt-5 border-white">Update</button>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
          </div>
          @endforeach
    </div>
<div class="d-flex justify-content-center mt-4">
    {{$supplier->links('pagination::simple-tailwind')}};
</div>
</div>

@endsection
@extends('layout.nav')

@section('content')
<div class="container mt-5 ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded-0">
                <div class="card-body text-center">
                    <img src="{{asset('/assets/img/drug.svg')}}" width="90" class="mt-2 mb-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row mb-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" placeholder="Email" type="email" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" placeholder="Password" type="password" class="form-control rounded-0  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row align-content-center justify-content-center">
                            <div class="col-md-5 ">
                                <button type="submit" style="background-color:#0165b6;" class=" text-white btn rounded-0 mt-3 w-100 form-control">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="col-md-5 ">
                                <button type="" id="cllde" class=" btn-outline-aure  btn rounded-0 mt-3 w-100">
                                    Try Demo
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#cllde").click(function(){
    $("#email").val("guest@unknown.com");
    $("#password").val("12345678");
  });
});
</script>
@endsection

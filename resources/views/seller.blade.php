@extends('layout.nav')
@section('content')

<div class="row justify-content-lg-start m-3">
@foreach ($lists as $key => $value)
    <span class="btn btn-white m-2 rounded-0"> {{$key}} : {{$value}}</span>
@endforeach

</div>
@include('layout.table')
  <div class="d-flex justify-content-center mt-4">
    {{$sold->links('pagination::simple-tailwind')}}
</div>
@endsection
@extends('layout.nav')
@section('content')
<br>
@include('layout.card')
<div class="d-flex justify-content-center mt-4">
    {{$stocks->links('pagination::simple-tailwind')}}
</div>
@endsection
@extends('admin.layout')
@section('title', 'Ocean View | Profile')
@section('css', '/css/admin/')
@section('content')

<div class="container">
    <div class="row " style="height: 170px;">
    <div class="col-md-2 p-2 d-flex justify-content-center align-items-center">
        <img src="{{ asset('/images/resort_images/' . $guest['prof_pic']) }}" class="h-100 w-100" style="border-radius: 50%; background-color: aliceblue;" alt="..." />
    </div>
    <div class="col-md-7 text-start align-content-center">
        <h3>{{ $guest['f_name'] }}</h3>
        <h6>status</h6>
    </div>
    <div class="col-md-3 d-flex flex-column justify-content-end text-center">
        <h5 class="mt-auto">{{ $guest['balance'] }}</h5>
    </div>
</div>
<div style="border-bottom: 1px solid black; margin-top:1.4rem"></div>   
 </div>
@endsection
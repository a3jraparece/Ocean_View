@extends('user.layout')

@section('title', 'Ocean View')
@section('css', '')

@section('content')
    here yung transaction history ni {{$guest['f_name']}}
    <table></table>
    e get sa ang rows didto sa bookings nga imoha na account then e loop
    {{-- @foreach ($bookings as $book)
    @endforeach --}}
@endsection
